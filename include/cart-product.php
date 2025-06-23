<?php 
include '../inc/inc.db.php';

$database = new Connection();
$connect = $database->open();

try {
    if(!empty($_SESSION['userId'])){
        $userid = $_SESSION['userId'];
        $select_count = "SELECT count(*) as countcart FROM cart_product WHERE userId='$userid' and status='oncart'";
        $prepare_count = $connect -> prepare($select_count);
        $prepare_count -> execute();
        $fetch_count = $prepare_count -> fetch(PDO::FETCH_ASSOC);
        
        if($fetch_count['countcart'] != 0){
            $select_product_cart = "SELECT * FROM cart_product WHERE userId='$userid' and status='oncart'";
            $prepare_product_cart = $connect -> prepare($select_product_cart);
            $prepare_product_cart -> execute();
            ?>
            <ul class="body" style="height:64vh; overflow-y:auto; overflow-x:hidden;">
                <?php
                $total = 0;
                while($fetch_product_cart = $prepare_product_cart -> fetch(PDO::FETCH_ASSOC)){
                    $sub_total = (int)$fetch_product_cart['price'] * (int)$fetch_product_cart['quantity'];
                    $select_product = "SELECT * FROM products WHERE  productId='".$fetch_product_cart['productId']."'";
                    $prepare_product = $connect -> prepare($select_product);
                    $prepare_product -> execute();
                    $fetch_product = $prepare_product -> fetch(PDO::FETCH_ASSOC);
                    ?>
                    <hr />
                    <li class="flex items-center py-2">
                        <div class="flex flex-col row">
                        	
                           
                            <img class="image-fluid h-11 w-20" loading="lazy" alt="Product 1" src="<?php echo $fetch_product['product_image']; ?>" style="object-fit: cover;border-radius: 10px;" />
                        </div>
                        <div class="text-management justify-start text-start flex-grow ml-4">
                            <div class="flex justify-between row">
                                <div class="col-md-2">
                                    <p class="text-sm text-black"><?php echo $fetch_product_cart['quantity']; ?></p>
                                </div>
                                <div  class="col-md-4">
                                    <p class="text-sm text-black"><?php echo $fetch_product_cart['price']; ?> </p>
                                </div>
                                <div  class="col-md-4">
                                    <p class="text-sm text-black"><?php echo $sub_total; ?> </p>
                                </div>
                                <div  class="col-md-2">
                                	<a href="#" id="<?php echo $fetch_product_cart['cartId'];  ?>" class="removefromcart" class="items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 bi" viewBox="0 0 512 512">
                                        <path d="M175 175C184.4 165.7 199.6 165.7 208.1 175L255.1 222.1L303 175C312.4 165.7 327.6 165.7 336.1 175C346.3 184.4 346.3 199.6 336.1 208.1L289.9 255.1L336.1 303C346.3 312.4 346.3 327.6 336.1 336.1C327.6 346.3 312.4 346.3 303 336.1L255.1 289.9L208.1 336.1C199.6 346.3 184.4 346.3 175 336.1C165.7 327.6 165.7 312.4 175 303L222.1 255.1L175 208.1C165.7 199.6 165.7 184.4 175 175V175zM512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256zM256 48C141.1 48 48 141.1 48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48z" />
                                    </svg>
                                </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <hr />
                    <?php
                    $total += $sub_total;
                }
                ?>
                </ul>
                <div class="mt-auto position-sticky">
                    <div class="pt-6">
                        <hr class="my-1" />
                        <div class="flex justify-between items-center mt-2">
                            <span class="text-sm text-gray-600">Total:</span>
                            <span class="font-semibold"><?php echo $total; ?> RWF</span>
                        </div>
                        <hr class="my-1" />
                        <div class="flex gap-2">
                            <a href="checkout" class="text-center mt-2 p-2 w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 text-xs">Proceed to Checkout</a>
                            <button class="mt-2 w-full bg-red-500 text-white py-2 rounded hover:bg-red-600 text-xs">Clear Cart</button>
                        </div>
                    </div>
                </div>
            
            <?php
        } else {
            // Empty Cart
            ?>
            <ul class="flex flex-col justify-center items-center" >
                <li class="flex items-center py-2">
                    <div class="ap-card p-5 text-center">
                        <h1 class="page-title mb-4"><span class="font-weight-light">Empty Cart</span></h1>
                        <div class="mb-4">
                            Sorry, you have nothing in your cart.
                        </div>
                    </div>
                </li>
            </ul>
            <?php
        }
    } else {
        // No User Detected
        ?>
        <ul class="flex flex-col justify-center items-center">
            <li class="flex items-center py-2">
                <div class="ap-card p-5 text-center">
                    <h1 class="page-title mb-4"><span class="font-weight-light">No user detected</span></h1>
                    <div class="mb-4">
                        Sorry, you have to log in first.
                    </div>
                </div>
            </li>
        </ul>
        <?php
    }
} catch(PDOException $e) {
    $data['error'] = true;
    $data['message'] = $e->getMessage();
}

// Close connection
$database->close();
?>
