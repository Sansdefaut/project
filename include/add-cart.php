<?php
include '../inc/inc.db.php';
$database = new Connection();
$connect = $database->open();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productId = $_POST['productId'] ?? null;
    $quantity = $_POST['quantity'] ?? 0;
    $productPrice = $_POST['productPrice'] ?? 0;
    $userId = $_POST['userId'] ?? null;

    // Validate inputs
    if (empty($productId) || $quantity <= 0 || empty($userId)) {
        echo json_encode(['error' => true, 'message' => 'All fields are required and quantity must be greater than zero.']);
        exit();
    }

    // Check available quantity in the cart
    $select_available_quantity = "SELECT SUM(quantity) AS total_quantity FROM cart_product WHERE productId = :productId AND status = 'oncart'";
    $prepare_available_quantity = $connect->prepare($select_available_quantity);
    $prepare_available_quantity->bindParam(':productId', $productId);

    $prepare_available_quantity->execute();
    $result = $prepare_available_quantity->fetch(PDO::FETCH_ASSOC);
    $quantityavailable = $result['total_quantity'] ?? 0;

    // Get product details
    $quantity_product = "SELECT product_quantity FROM products WHERE productId = :productId";
    $prepare_product_quantity = $connect->prepare($quantity_product);
    $prepare_product_quantity->bindParam(':productId', $productId);
    $prepare_product_quantity->execute();
    $fetch_product_quantity = $prepare_product_quantity->fetch(PDO::FETCH_ASSOC);

    // Check available stock
    if ($fetch_product_quantity) {
        $availableStock = $fetch_product_quantity['product_quantity'] - $quantityavailable;
        $n = $availableStock - $quantity;
        if ($n >= 0) {
            // Check if the product is already in the cart
            $query = "SELECT *, COUNT(*) as countcart FROM cart_product WHERE productId = :productId AND userId = :userId AND status = 'oncart'";
            $stmt = $connect->prepare($query);
            $stmt->bindParam(':productId', $productId);
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();
            $cartItem = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($cartItem['countcart'] == 0) {
                // Product is not in the cart, add it
                $cartId = 'cart-' . uniqid();
                $insertQuery = "INSERT INTO cart_product (cartId, productId, price, userId, quantity, status) VALUES (:cartId, :productId, :productPrice, :userId, :quantity, 'oncart')";
                $insertStmt = $connect->prepare($insertQuery);

                $insertStmt->bindParam(':cartId', $cartId);
                $insertStmt->bindParam(':productId', $productId);
                $insertStmt->bindParam(':productPrice', $productPrice);
                $insertStmt->bindParam(':userId', $userId);
                $insertStmt->bindParam(':quantity', $quantity);

                if ($insertStmt->execute()) {
                    echo json_encode(['error' => false, 'message' => 'Product added to cart successfully!']);
                } else {
                    echo json_encode(['error' => true, 'message' => 'Failed to add product to cart.']);
                }
            } else {
                // Product is already in the cart, update the quantity
                $quantityNew = $cartItem['quantity'] + $quantity;
                $normal = $availableStock - $quantityNew;
                // Check if the new quantity exceeds available stock
                if ($normal == 0) {
                    if($availableStock == 0){
                          echo json_encode(['error' => true, 'message' => 'Out of stock on this product.']);
                    exit();
                }else{
                    echo json_encode(['error' => true, 'message' => 'Only ' . $availableStock . ' quantity available.']);
                    exit();
                }
                }

                $updateQuery = "UPDATE cart_product SET quantity = :quantityNew WHERE cartId = :cartId";
                $updateStmt = $connect->prepare($updateQuery);
                
                $updateStmt->bindParam(':quantityNew', $quantityNew);
                $updateStmt->bindParam(':cartId', $cartItem['cartId']);

                if ($updateStmt->execute()) {
                    echo json_encode(['error' => false, 'message' => 'Product quantity updated in cart successfully!']);
                } else {
                    echo json_encode(['error' => true, 'message' => 'Failed to update product quantity in cart.']);
                }
            }
        } else {

           if($availableStock == 0){
                          echo json_encode(['error' => true, 'message' => 'Out of stock on this product.']);
                    exit();
                }else{
                    echo json_encode(['error' => true, 'message' => 'Only d' . $availableStock . ' quantity available.']);
                    exit();
                }
        }
    } else {
        echo json_encode(['error' => true, 'message' => 'Invalid product ID.']);
    }
} else {
    echo json_encode(['error' => true, 'message' => 'Invalid request method.']);
}
?>
