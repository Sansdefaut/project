<?php
include 'session.php';
$data = array();
$database = new Connection();
$connect = $database->open();

try {
    // Check for required fields
    if (empty($_POST['productId']) || empty($_POST['productName']) || empty($_POST['productDescription']) || empty($_POST['productColor']) || empty($_POST['productSize']) || empty($_POST['productPrice']) || empty($_POST['productQuantity'])) {
        $data['error'] = true;
        $data['message'] = "Error occurred, all fields are required";
    } else {
        $productId = $_POST['productId'];
        $productName = $_POST['productName'];
        $productDescription = $_POST['productDescription'];
        $productColor = $_POST['productColor'];
        $productSize = $_POST['productSize'];
        $productPrice = $_POST['productPrice'];
        $productQuantity = $_POST['productQuantity'];
        
        // Optional: handle image update if provided
        $updateImage = '';
        if (!empty($_FILES['mainImage']['name'])) {
            $mainImage = $_FILES['mainImage'];
            $fileInfo = pathinfo($mainImage['name']);
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            $maxFileSize = 8 * 1024 * 1024; // 8MB
            if (!in_array(strtolower($fileInfo['extension']), $allowedExtensions)) {
                $data['error'] = true;
                $data['message'] = 'Error: Main image file extension not supported. Supported are jpg, jpeg, png';
                echo json_encode($data);
                exit;
            } elseif ($mainImage['size'] > $maxFileSize) {
                $data['error'] = true;
                $data['message'] = 'Error: Main image file size exceeds the 8MB limit';
                echo json_encode($data);
                exit;
            } else {
                $mainImageFilename = $productId . "." . $fileInfo['extension'];
                $mainImagePath = "../../assets/product/images/" . $mainImageFilename;
                if (move_uploaded_file($mainImage["tmp_name"], $mainImagePath)) {
                    $mainImageUrl = "http://localhost/newstore/assets/product/images/" . $mainImageFilename;
                    $updateImage = ", product_image = :productImage";
                }
            }
        }
        
        $updateProduct = "UPDATE products SET product_name = :productName, product_description = :productDescription, product_color = :productColor, product_size = :productSize, product_price = :productPrice, product_quantity = :productQuantity $updateImage WHERE productId = :productId";
        $stmt = $connect->prepare($updateProduct);
        $params = [
            'productId' => $productId,
            'productName' => $productName,
            'productDescription' => $productDescription,
            'productColor' => $productColor,
            'productSize' => $productSize,
            'productPrice' => $productPrice,
            'productQuantity' => $productQuantity
        ];
        if ($updateImage) {
            $params['productImage'] = $mainImageUrl;
        }
        if ($stmt->execute($params)) {
            $data['success'] = true;
            $data['message'] = 'Product updated successfully';
        } else {
            $data['error'] = true;
            $data['message'] = 'Failed to update product';
        }
    }
} catch (Exception $e) {
    $data['error'] = true;
    $data['message'] = $e->getMessage();
}
echo json_encode($data);
