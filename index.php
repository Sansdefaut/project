<?php
 include 'header.php';
?>
<body>
  
    <?php 	include 'cart.php'; 
    include 'sidebar.php'; ?>
        <main class="py-5">
        <section class="container max-w-7xl mx-auto p-8  bg-gray-100 py-16 px-8 sm:px-4 md:px-8 lg:px-16 xl:px-32">
      <div class="container mx-auto flex flex-col sm:flex-col md:flex-row lg:flex-row xl:flex-row justify-between items-center">
        <div class="mb-8 sm:mb-8 md:mb-0 lg:mb-0 xl:mb-0 md:w-2/3">
          <h2 class="text-4xl font-bold text-green-800">Welcome To NB SHOP</h2>
          <p class="text-gray-600 mt-4">Don't miss out on our exclusive deal! For a limited time, enjoy incredible savings on our product. Elevate your experience with this amazing offer—perfect for you! Shop now and take advantage of this fantastic opportunity!</p>
          <div class="py-3">
          <a href="/list-property" >
          <a href="best-offer" class="bg-[#] btn rounding-2 text-white hover:border-[#ff751a] border-[#00224d] hover:bg-[#ff751a] hover:text-white" style="background:#00224d;">
            View Best Deals
          </a>
          </a>
          </div>
        </div>
        <div class="md:w-1/3">
   <img class="img-fluid" style="width: 300px; height: 300px; object-fit: cover;" src="assets/images/bg-1-removebg-preview.png">
         
        </div>
      </div>
    </section>
     <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="text-end items-end flex flex-col justify-end">
        <h2 class="text-3xl font-bold leading-tight text-orange-900">Product</h2>
        <div class="mt-4 mb-12 h-1 w-24 bg-black ite"> </div>
      </div>
     
     <div class="row">
<?php  
if(!empty($_SESSION['userId'])){
    $userId = $_SESSION['userId'];
    $countQuery = "SELECT COUNT(*) as count FROM products";
    $countPrepare = $connect->prepare($countQuery);
    $countPrepare->execute();
    $countResult = $countPrepare->fetch(PDO::FETCH_ASSOC);

    if ($countResult['count'] > 0) {
        $query = "
            SELECT p.*, COALESCE(a.numberofvisit, 0) AS visit_count
            FROM products p
            LEFT JOIN activity_product a ON p.productId = a.productId AND a.userId = :userId
            ORDER BY visit_count DESC, p.productId
        ";

        // Execute the query
        $prepare = $connect->prepare($query);
        $prepare->bindParam(':userId', $userId);
        $prepare->execute();
        $products = $prepare->fetchAll(PDO::FETCH_ASSOC);
        foreach ($products as $product) {
        ?>
            <div class="col-6 col-md-4 col-xl-3 text-start mb-2">
                <a href="product-detail?productid=<?php echo $product['productId']; ?>">
                    <div class="app-card app-card-doc shadow-sm h-100 bg-transparent">
                        <div class="app-card-thumb-holder p-3">
                            <div class="app-card-thumb">
                                <img class="thumb-" src="<?php echo htmlspecialchars($product['product_image']);?>" alt="">
                                <?php /* <span class="badge bg-success">NEW</span> */ ?>
                            </div>
                        </div>
                        <div class="app-card-body p-3 has-card-actions flex-col flex gap-2">
                            <h4 class="app-doc-title truncate mb-0 font-bold"><?php echo htmlspecialchars($product['product_name']);?></h4>
                            <h4 class="app-doc-title mb-0 font-extralight truncate">
                                <?php echo htmlspecialchars($product['product_description']);?>
                            </h4>
                            <h4 class="app-doc-title truncate mb-0 font-bold"><?php echo htmlspecialchars($product['product_price']);?> RWF</h4>
                            <div class="app-card-actions">
                            </div><!--//app-card-actions-->
                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                </a>
            </div><!--//col-->
        <?php 
        }
    } else {
        ?>
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12 col-xl-12 mx-auto">
                <div class="ap-card p-5 text-center bg-white">
                    <h1 class="page-title mb-4"><span class="font-weight-light">No Product Found</span></h1>
                    <div class="mb-4">
                        Sorry, We have no product in system now.
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
} else {
    $countQuery = "SELECT COUNT(*) as count FROM products";
    $countPrepare = $connect->prepare($countQuery);
    $countPrepare->execute();
    $countResult = $countPrepare->fetch(PDO::FETCH_ASSOC);

    if ($countResult['count'] > 0) {
        $query = "
            SELECT p.*, COALESCE(a.numberofvisit, 0) AS visit_count
            FROM products p
            LEFT JOIN activity_product a ON p.productId = a.productId
            GROUP BY productId
            ORDER BY visit_count DESC, p.productId
        ";

        // Execute the query
        $prepare = $connect->prepare($query);
        $prepare->execute();
        $products = $prepare->fetchAll(PDO::FETCH_ASSOC);

        // Display the products
        foreach ($products as $product) {
        ?>
            <div class="col-6 col-md-4 col-xl-3 text-start mb-2">
                <a href="product-detail?productid=<?php echo $product['productId']; ?>">
                    <div class="app-card app-card-doc shadow-sm h-100 bg-transparent">
                        <div class="app-card-thumb-holder p-3">
                            <div class="app-card-thumb">
                                <img class="thumb-" src="<?php echo htmlspecialchars($product['product_image']);?>" alt="">
                                <?php /* <span class="badge bg-success">NEW</span> */ ?>
                            </div>
                        </div>
                        <div class="app-card-body p-3 has-card-actions flex-col flex gap-2">
                            <h4 class="app-doc-title truncate mb-0 font-bold"><?php echo htmlspecialchars($product['product_name']);?></h4>
                            <h4 class="app-doc-title mb-0 font-extralight truncate">
                                <?php echo htmlspecialchars($product['product_description']);?>
                            </h4>
                            <h4 class="app-doc-title truncate mb-0 font-bold"><?php echo htmlspecialchars($product['product_price']);?> RWF</h4>
                            <div class="app-card-actions">
                            </div><!--//app-card-actions-->
                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                </a>
            </div>
        <?php
        }
    } else {
        ?>
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12 col-xl-12 mx-auto">
                <div class="ap-card p-5 text-center bg-white">
                    <h1 class="page-title mb-4"><span class="font-weight-light">No Product Found</span></h1>
                    <div class="mb-4">
                        Sorry, We have no product in system now.
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
} 
?>
    </div>
</div>

    </main>

   <?php include 'footer.php'; ?>