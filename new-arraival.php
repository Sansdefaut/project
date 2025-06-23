<?php include 'header.php';?>
<body>
  

    <?php 	include 'cart.php'; 
    include 'sidebar.php'; ?>
        <main class="py-5">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="text-start">
        <h2 class="text-3xl font-bold leading-tight text-gray-900">New Arraival</h2>
        <div class="mt-4 mb-12 h-1 w-24 bg-black " />
      </div>
     
     <div class="row">
     	<?php
    // Fetch latest products (new arrivals)
    $stmt = $connect->prepare("SELECT * FROM products WHERE status = 'active' ORDER BY date_added DESC LIMIT 12");
    $stmt->execute();
    while ($fetch_product = $stmt->fetch()) {
    ?>
     	<div class="col-6 col-md-4 col-xl-3 text-start mb-2">
		<a href="product-detail?productid=<?php echo $fetch_product['productId']; ?>">
					    <div class="app-card app-card-doc shadow-sm  h-100 bg-transparent">
						    <div class="app-card-thumb-holder p-3">
							    <div class="app-card-thumb" >
	                                <img class="thumb-" src="<?php echo $fetch_product['product_image']; ?>" alt="">
	                                 <span class="badge bg-success">NEW</span>
	                            </div>
	                            
						    </div>
						    <div class="app-card-body p-3 has-card-actions flex-col flex gap-2">
							    
							    <h4 class="app-doc-title truncate mb-0 font-bold"><?php echo htmlspecialchars($fetch_product['product_name']); ?></h4>
							     <h4 class="app-doc-title mb-0 font-extralight truncate">
							     	<?php echo htmlspecialchars($fetch_product['product_description']); ?>
				</h4>
			<h4 class="app-doc-title truncate mb-0 font-bold"><?php echo number_format($fetch_product['product_price']); ?> RWF</h4>
							
			 <div class="app-card-actions">
								   
			 </div><!--//app-card-actions-->
								    
		  </div><!--//app-card-body-->

			</div><!--//app-card-->
		</a>
				    </div><!--//col-->
    <?php } ?>
    </div>
</div>
 </main>

   <?php 	include 'footer.php'; ?>
