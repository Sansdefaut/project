<?php
include 'session.php';
$data = array();
$database = new Connection();
$connect = $database->open();

try {
    // Check for required fields
    if (empty($_POST['productName']) || empty($_POST['productDescription']) || empty($_POST['productColor']) || empty($_POST['productSize']) || empty($_POST['productPrice']) || empty($_POST['productQuantity']) || empty($_FILES['mainImage'])) {
        $data['error'] = true;
        $data['message'] = "Error occurred, all fields are required";
    } else {
        $productName = $_POST['productName'];
        $productDescription = $_POST['productDescription'];
        $productColor = $_POST['productColor'];
        $productSize = $_POST['productSize'];
        $productPrice = $_POST['productPrice'];
        $productQuantity = $_POST['productQuantity'];
        $mainImage = $_FILES['mainImage'];
        $coverImages = $_FILES['coverImages']; // Array of files

        // Check if product already exists
        $checkProduct = "SELECT count(*) as nowcount FROM products WHERE product_name = :productName";
        $stmt = $connect->prepare($checkProduct);
        $stmt->execute(['productName' => $productName]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['nowcount'] == 0) {
            $uniqid = 'prod-' . uniqid();

            // Handle main image
            if (!isset($mainImage['name']) || empty($mainImage['name'])) {
                $data['error'] = true;
                $data['message'] = 'Error: Empty main image, please insert a file';
            } else {
                // Validate main image file type and size
                $fileInfo = pathinfo($mainImage['name']);
                $allowedExtensions = ['jpg', 'jpeg', 'png'];
                $maxFileSize = 8 * 1024 * 1024; // 8MB

                if (!in_array(strtolower($fileInfo['extension']), $allowedExtensions)) {
                    $data['error'] = true;
                    $data['message'] = 'Error: Main image file extension not supported. Supported are jpg, jpeg, png';
                } elseif ($mainImage['size'] > $maxFileSize) {
                    $data['error'] = true;
                    $data['message'] = 'Error: Main image file size exceeds the 8MB limit';
                } else {
                    $mainImageFilename = $uniqid . "." . $fileInfo['extension'];
                    $mainImagePath = "../../assets/product/images/" . $mainImageFilename;

                    if (move_uploaded_file($mainImage["tmp_name"], $mainImagePath)) {
                        $mainImageUrl = "http://localhost/newstore/assets/product/images/" . $mainImageFilename;

                        // Handle cover images
                        $coverImageUrls = [];
                        foreach ($coverImages['name'] as $index => $name) {
                            $fileInfo = pathinfo($name);
                            if (!empty($name)) {
                                if (!in_array(strtolower($fileInfo['extension']), $allowedExtensions)) {
                                    $data['error'] = true;
                                    $data['message'] = 'Error: One or more cover images have unsupported file extensions. Supported are jpg, jpeg, png';
                                    break;
                                } elseif ($coverImages['size'][$index] > $maxFileSize) {
                                    $data['error'] = true;
                                    $data['message'] = 'Error: One or more cover images exceed the 8MB size limit';
                                    break;
                                } else {
                                    $coverImageFilename = $uniqid . "_cover" . $index . "." . $fileInfo['extension'];
                                    $coverImagePath = "../../assets/product/images/" . $coverImageFilename;

                                    if (move_uploaded_file($coverImages["tmp_name"][$index], $coverImagePath)) {
                                        $coverImageUrls[] = "http://localhost/newstore/assets/product/images/" . $coverImageFilename;
                                    } else {
                                        $data['error'] = true;
                                        $data['message'] = 'Error: Could not upload cover image ' . ($index + 1);
                                        break;
                                    }
                                }
                            }
                        }

                        if (!isset($data['error']) || !$data['error']) {
                            // Insert product details into database
                            $values = [
                                'productName' => $productName,
                                'productDescription' => $productDescription,
                                'productColor' => $productColor,
                                'productSize' => $productSize,
                                'productPrice' => $productPrice,
                                'productQuantity' => $productQuantity,
                                'mainImage' => $mainImageUrl,
                                'coverImages' => json_encode($coverImageUrls), // Store cover images as JSON array
                                'status' => 'active',
                                'productId' => $uniqid
                            ];

    $insertProduct = "INSERT INTO products(productId, product_name , product_image,product_size,product_color, product_description,product_cover,  product_price, product_quantity, status)

     VALUES(:productId, :productName,:mainImage, :productSize,:productColor, :productDescription,:coverImages,  :productPrice, :productQuantity,   :status)";
                            $stmt = $connect->prepare($insertProduct);
                            $stmt->execute($values);

                            if ($stmt) {
                                $data['error'] = false;
                                $data['product'] = $uniqid;
                                $data['message'] = 'Product added successfully';
                            } else {
                                $data['error'] = true;
                                $data['message'] = "Error occurred while adding the product";
                            }
                        }
                    } else {
                        $data['error'] = true;
                        $data['message'] = 'Error: Could not upload the main image';
                    }
                }
            }
        } else {
            $data['error'] = true;
            $data['message'] = "Error occurred, product with this name already exists in the system";
        }
    }
} catch (PDOException $e) {
    $data['error'] = true;
    $data['message'] = "Database error: " . $e->getMessage();
}

// Close connection
$database->close();

// Return response
echo json_encode($data);
?>
