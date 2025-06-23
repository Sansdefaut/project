<?php
include '../inc/inc.db.php';
$database = new Connection();
$connect = $database->open();

// InTouch SMS sending function
function sendSuccessSMS($to, $message) {
    $url = "https://www.intouchsms.co.rw/api/sendsms/";
    $fields = [
        "username" => "Sansdefaut",
        "password" => "Sande4fo",
        "sender"   => "NewStore",  // Updated sender name to valid alphanumeric string
        "recipients" => $to,
        "message" => $message
    ];
    $fields_string = http_build_query($fields);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    $curlError = curl_error($ch);
    // Log the result and any curl error to a file for debugging
    $logMessage = date('Y-m-d H:i:s') . " - SMS to $to - Result: $result";
    if ($curlError) {
        $logMessage .= " - Curl Error: $curlError";
    }
    file_put_contents(__DIR__ . '/sms_log.txt', $logMessage . "\n", FILE_APPEND);
    curl_close($ch);
    return $result;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_SESSION['userId'])) {
        echo json_encode(['error' => true, 'message' => 'User not logged in.']);
        exit();
    }
    $userId = $_SESSION['userId'];
    $salesId = uniqid('sales_'); // Generate a unique sales ID
    $country = $_POST['country'] ?? '';
    $address = $_POST['address'] ?? '';
    $town = $_POST['town'] ?? '';
    $state = $_POST['state'] ?? '';
    $zip = $_POST['postcode'] ?? '';
    $phonenumber = $_POST['phonenumber'] ?? '';
    $status = 'pending';
    $dateAdded = date('Y-m-d H:i:s');

    // Validate required fields
    if (empty($country) || empty($address) || empty($town) || empty($state) || empty($zip)) {
        echo json_encode(['error' => true, 'message' => 'All billing fields are required.']);
        exit();
    }

    try {
        // Begin a transaction
        $connect->beginTransaction();

        // Update user's phone number in users table
        $phonenumber_international = preg_replace('/^0/', '250', $phonenumber);
        error_log("Updating phone number for userId $userId to $phonenumber_international");
        $updatePhoneQuery = "UPDATE users SET phonenumber = :phonenumber WHERE userId = :userId";
        $updatePhoneStmt = $connect->prepare($updatePhoneQuery);
        $updatePhoneStmt->bindParam(':phonenumber', $phonenumber_international);
        $updatePhoneStmt->bindParam(':userId', $userId);
        $updatePhoneStmt->execute();
        error_log("Phone number updated for userId $userId");

        // Insert into sales table
        $insertSalesQuery = "INSERT INTO sales (salesId, userId, country, address, town, state, zip, status, dateadded) 
                              VALUES (:salesId, :userId, :country, :address, :town, :state, :zip, :status, :dateadded)";
        $insertSalesStmt = $connect->prepare($insertSalesQuery);
        $insertSalesStmt->bindParam(':salesId', $salesId);
        $insertSalesStmt->bindParam(':userId', $userId);
        $insertSalesStmt->bindParam(':country', $country);
        $insertSalesStmt->bindParam(':address', $address);
        $insertSalesStmt->bindParam(':town', $town);
        $insertSalesStmt->bindParam(':state', $state);
        $insertSalesStmt->bindParam(':zip', $zip);
        $insertSalesStmt->bindParam(':status', $status);
        $insertSalesStmt->bindParam(':dateadded', $dateAdded);

        if ($insertSalesStmt->execute()) {
            // Assign a delivery user (access=3, status='active')
            $selectDeliveryUser = "SELECT userId FROM users WHERE access=3 AND status='active' ORDER BY RAND() LIMIT 1";
            $stmtDeliveryUser = $connect->prepare($selectDeliveryUser);
            $stmtDeliveryUser->execute();
            $deliveryUser = $stmtDeliveryUser->fetch(PDO::FETCH_ASSOC);
            if ($deliveryUser && !empty($deliveryUser['userId'])) {
                $deliveryUserId = $deliveryUser['userId'];
                $code_now = uniqid();
                $deliveryStatus = 'in progress';
                $insertDelivery = "INSERT INTO delivery (userId, salesId, code_now, status) VALUES (:userId, :salesId, :code_now, :status)";
                $stmtInsertDelivery = $connect->prepare($insertDelivery);
                $stmtInsertDelivery->bindParam(':userId', $deliveryUserId);
                $stmtInsertDelivery->bindParam(':salesId', $salesId);
                $stmtInsertDelivery->bindParam(':code_now', $code_now);
                $stmtInsertDelivery->bindParam(':status', $deliveryStatus);
                $stmtInsertDelivery->execute();
                // Update sales status to in progress
                $updateSalesStatus = "UPDATE sales SET status='in progress' WHERE salesId=:salesId";
                $stmtUpdateSales = $connect->prepare($updateSalesStatus);
                $stmtUpdateSales->bindParam(':salesId', $salesId);
                $stmtUpdateSales->execute();
                $status = 'in progress';
            }

            // Prepare to update cart_product and products
            $updateCartQuery = "SELECT productId, quantity FROM cart_product WHERE userId = :userId AND status = 'oncart'";
            $updateCartStmt = $connect->prepare($updateCartQuery);
            $updateCartStmt->bindParam(':userId', $userId);
            $updateCartStmt->execute();

            // Iterate through cart items to update product quantities
            while ($cartItem = $updateCartStmt->fetch(PDO::FETCH_ASSOC)) {
                $productId = $cartItem['productId'];
                $quantity = $cartItem['quantity'];

                // Update product quantity
                $updateProductQuery = "UPDATE products SET product_quantity = product_quantity - :quantity WHERE productId = :productId";
                $updateProductStmt = $connect->prepare($updateProductQuery);
                $updateProductStmt->bindParam(':quantity', $quantity);
                $updateProductStmt->bindParam(':productId', $productId);
                $updateProductStmt->execute();
            }

            // Update cart_product table
            $updateCartStatusQuery = "UPDATE cart_product SET salesId = :salesId, status = 'success' WHERE userId = :userId AND status = 'oncart'";
            $updateCartStatusStmt = $connect->prepare($updateCartStatusQuery);
            $updateCartStatusStmt->bindParam(':salesId', $salesId);
            $updateCartStatusStmt->bindParam(':userId', $userId);
            $updateCartStatusStmt->execute();

            // Commit the transaction
            $connect->commit();
            $link = '';
            if($_SESSION['access_id'] == 1){
                $link = 'dashboard/order-detail?orderid='.$salesId;
            }else{
                  $link = 'customer/order-detail?orderid='.$salesId;
            }

            // Send SMS to client after successful order
            if (!empty($phonenumber)) {
                $to = preg_replace('/^0/', '250', $phonenumber); // Convert to international format if needed

                // Check if phone number exists in users table
                error_log("Checking if phone number $to exists in users table");
                $checkUserQuery = "SELECT COUNT(*) as count FROM users WHERE phonenumber = :phonenumber";
                $checkUserStmt = $connect->prepare($checkUserQuery);
                $checkUserStmt->bindParam(':phonenumber', $to);
                $checkUserStmt->execute();
                $userCount = $checkUserStmt->fetchColumn();
                error_log("Phone number $to found count: $userCount");

                if ($userCount > 0) {
                    $smsMessage = "Your payment was successful. Thank you for your purchase!";
                    sendSuccessSMS($to, $smsMessage);
                    // Log SMS sending event
                    error_log("SMS sent to $to with message: $smsMessage");
                } else {
                    // Log error if phone number not found
                    error_log("SMS not sent. Phone number $to not found in users table.");
                }
            }

            echo json_encode(['error' => false, 'message' => 'Order placed successfully!', 'link'=> $link]);
        } else {
            // Rollback the transaction
            $connect->rollBack();
            echo json_encode(['error' => true, 'message' => 'Failed to place the order.']);
        }
    } catch (Exception $e) {
        // Rollback the transaction on error
        $connect->rollBack();
        error_log("Error during checkout process: " . $e->getMessage());
        echo json_encode(['error' => true, 'message' => 'An error occurred: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => true, 'message' => 'Invalid request method.']);
}

$database->close();
?>
