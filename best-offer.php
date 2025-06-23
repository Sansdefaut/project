<?php include 'header.php';?>
<body>
  

    <?php 	include 'cart.php'; 
    include 'sidebar.php'; ?>
        <main class="py-5">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="text-center">
        <h2 class="text-3xl font-bold leading-tight text-gray-900">Best Offer</h2>
        <div class="mt-4 mb-12 h-1 w-24 bg-black mx-auto" />
      </div>
     
     <div class="row">
     	<div class="col-6 col-md-4 col-xl-3 text-start mb-2">
		<a href="product-detail?productid=<?php 	
				    	echo $fetch_product['productId']; ?>">
					    <div class="app-card app-card-doc shadow-sm  h-100 bg-transparent">
						    <div class="app-card-thumb-holder p-3">
							    <div class="app-card-thumb" >
	                                <img class="thumb-" src="assets/images/product-5.jpg" alt="">
	                                 <span class="badge bg-success">NEW</span>
	                            </div>
	                            
						    </div>
						    <div class="app-card-body p-3 has-card-actions flex-col flex gap-2">
							    
							    <h4 class="app-doc-title truncate mb-0 font-bold">Big Jeans</h4>
							     <h4 class="app-doc-title mb-0 font-extralight truncate">
							     	Best Trouser In current Black and White
				</h4>
			<h4 class="app-doc-title truncate mb-0 font-bold">200,000 RWF</h4>
							
			 <div class="app-card-actions">
								   
			 </div><!--//app-card-actions-->
								    
		  </div><!--//app-card-body-->

			</div><!--//app-card-->
		</a>
				    </div><!--//col-->
    </div>
</div>
 </main>

   <?php 	include 'footer.php'; ?>
