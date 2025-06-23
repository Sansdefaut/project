<?php 
include 'header.php';
if(empty($_GET['productid'])){
 ?>
    <script>
        window.location.href='./';
    </script>
    <?php

}else if(isset($_GET['productid']) && !empty($_SESSION['userId'])){
     $productId = $_GET['productid'];
    $userId = $_SESSION['userId'];
    $slect = "SELECT *,count(*) as countsaveditem FROM activity_product WHERE userId='$userId' AND productId='$productId' ";
    $pslect = $connect -> prepare($slect);
    $pslect -> execute();
    $fslect = $pslect -> fetch(PDO::FETCH_ASSOC);

if($fslect['countsaveditem'] == 0){
    $numberofvisit = 1;
    $active = 'active';
    $log_activity = "INSERT INTO activity_product (userId, productId,numberofvisit,status) VALUES (:userId, :productId, :numberofvisit, :status)";
    $prepare_log = $connect->prepare($log_activity);
    $prepare_log->bindParam(':userId', $userId);
    $prepare_log->bindParam(':productId', $productId);
    $prepare_log->bindParam(':numberofvisit', $numberofvisit);
    $prepare_log->bindParam(':status', $active);
    $prepare_log->execute();
}else{
    $countnow = $fslect['numberofvisit'] + 1;
    $log_activity = "UPDATE activity_product SET numberofvisit= :countnow WHERE activityId= :activityId";
    $prepare_log = $connect->prepare($log_activity);
    $prepare_log->bindParam(':countnow', $countnow);
    $prepare_log->bindParam(':activityId', $fslect['activityId']);
    $prepare_log->execute();
}

}

$select_products = "SELECT *, count(*) as countnowproduct FROM products WHERE status='active' AND productId='".$_GET['productid']."'";
    $prepare_products = $connect -> prepare($select_products);
    $prepare_products -> execute();
    $fetch_products = $prepare_products -> fetch(PDO::FETCH_ASSOC);
    if($fetch_products['countnowproduct'] == 0){
        ?>
    <script>
        window.location.href='./';
    </script>
    <?php
    }
    $cover_images = json_decode($fetch_products['product_cover'], true);
?>
<link rel="stylesheet" type="text/css" href="http://localhost/newstore/css/global2.css">
<body>
  

    <?php 	include 'cart.php'; 
    include 'sidebar.php'; ?>
        <main class="py-2 ">
             <section class="product-details">
        <div class="container">
            <div class="row ">
                <div class="col-lg-6 col-md-6 py-3">
              <div class="container">
    <div class="flex flex-col gap-4 md:flex-row w-full">
        <div class="flex">
            <a data-fancybox="gallery" href="#">
                <img
                    alt="Living room with white sofas round-full"
                    class="w-full rounded-lg"
                     src="<?php echo htmlspecialchars($fetch_products['product_image']); ?>"
                    style="height:530.6px;width:100%;object-fit:cover"
                    id="main-image"
                />
            </a>
        </div>
        <div class="w-full md:w-1/2 md:mt-0">
            <div class="grid grid-cols-3 sm:grid-cols-3 md:grid-cols-1  gap-2">
               <?php foreach ($cover_images as $index => $image): ?>
                <a data-fancybox="gallery" href="#">
                    <img
                        alt="Lobby with white sofas"
                        class="w-full rounded-lg cursor-pointer"
                         src="<?php echo htmlspecialchars($image); ?>"
                        style="height:170.2px;width:120.2px;object-fit:cover"
                        onclick="changeMainImage(this)"
                    />
                </a>
            <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3><?php echo $fetch_products['product_name']; ?></h3>
                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                           </i>
                            <span>(18 reviews)</span>
                        </div>
                        <div class="product__details__price"><?php echo $fetch_products['product_price'];?> FRW</div>
                        <p ><?php   echo $fetch_products[
                      'product_description']; ?></p>
                            <div class="flex flex-row justify-between items-center">
                        <div class="product__details__quantity">
    <div class="pro-qty">
        <button class="qtybtn" onclick="changeQuantity(-1)">-</button>
        <input type="text" value="1" id="quantity-input" readonly>
        <button class="qtybtn" onclick="changeQuantity(1)">+</button>
    </div>
</div>
                        <div>
                     <a href="#" id="add-to-cart" class="primary-btn bg-gray-500">ADD TO CART</a>

                    </div>
                    <div>
                        <a href="#" class="heart-icon text-red bg-gray-500" style="   color: rgb(190 18 60);"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"  class="h-5 w-5 bi" fill="currentColor"><path d="M0 190.9V185.1C0 115.2 50.52 55.58 119.4 44.1C164.1 36.51 211.4 51.37 244 84.02L256 96L267.1 84.02C300.6 51.37 347 36.51 392.6 44.1C461.5 55.58 512 115.2 512 185.1V190.9C512 232.4 494.8 272.1 464.4 300.4L283.7 469.1C276.2 476.1 266.3 480 256 480C245.7 480 235.8 476.1 228.3 469.1L47.59 300.4C17.23 272.1 .0003 232.4 .0003 190.9L0 190.9z"/></svg></a>
                    </div>
                    </div>
                        <ul>
                            <li><b>Availability</b> <span><?php   if($fetch_products['product_quantity'] != 0){
                            echo "In Stock"; }else{
                                echo "Not available";
                            }?>
                                </span></li>
                            
                            <li><b>Color</b> <span><?php   echo $fetch_products['product_color']; ?></span></li>
                            <li><b>Size</b> <span><?php   echo $fetch_products['product_size']; ?></span></li>
                            
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
        </main>
         <?php  include 'footer.php'; ?>
         <script>
function changeQuantity(delta) {
    const input = document.getElementById('quantity-input');
    let currentValue = parseInt(input.value);
    if (currentValue + delta > 0) { // Ensure quantity doesn't go below 1
        input.value = currentValue + delta;
    }
}

function changeMainImage(element) {
    const mainImage = document.getElementById('main-image');

    // Store the current main image source
    const currentMainSrc = mainImage.src;

    // Update main image to clicked side image
    mainImage.src = element.src;

    // Update the clicked side image to the previous main image
    element.src = currentMainSrc;

    // Optionally, add an active class to indicate which thumbnail is active
    const thumbnails = document.querySelectorAll('.grid img');
    thumbnails.forEach(img => img.classList.remove('active-thumbnail'));
    element.classList.add('active-thumbnail');
}

</script>
<script>

$(document).ready(function() {
    $(document).on('click', '#add-to-cart', function(event) {
        event.preventDefault();

        const productId = "<?php echo htmlspecialchars($fetch_products['productId']); ?>"; // Fetch productId from PHP
        const quantity = parseInt($('#quantity-input').val()); // Get the quantity
        const productPrice = "<?php echo htmlspecialchars($fetch_products['product_price']); ?>"; // Fetch product price
        const userId = "<?php echo htmlspecialchars($_SESSION['userId']); ?>"; // Fetch userId from session

        // Validate quantity
        if (quantity <= 0) {
            alert("Please select a valid quantity.");
            return;
        }

        $.ajax({
            url: 'http://localhost/newstore/include/add-cart', // Your PHP file to handle cart addition
            method: 'POST',
            data: {
                productId: productId,
                quantity: quantity,
                productPrice: productPrice,
                userId: userId
            },
            dataType: 'json',
            success: function(data) {
                if (data.error) {
                    alert(data.message);
                } else {
                    alert(data.message);
                    updateCartInfo(); // Call the function from footer after successful addition
                }
            },
            error: function(xhr, status, error) {
                alert(error);
            }
        });
    });
});
</script>


