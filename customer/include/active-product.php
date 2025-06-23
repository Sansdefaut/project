<div class="tab-pane fade show active" id="upcoming-Events" role="tabpanel" aria-labelledby="upcoming-Events-tab">
					    <div class="app-card app-card-orders-table mb-1 bg-transparent p-2">
						    <div class="app-card-body">
							   

	<?php 	
$select_product = "SELECT * FROM products WHERE status='active'";
	$prepare_product = $connect -> prepare($select_product);
	$prepare_product -> execute();
	?>
	<div class="row"><?php
	while($fetch_product = $prepare_product -> fetch(PDO::FETCH_ASSOC)){ ?>    	
		<div class="col-6 col-md-6 col-xl-4 col-xxl-3 text-start">
		<a href="product-detail?productid=<?php 	
				    	echo $fetch_product['productId']; ?>">
					    <div class="app-card app-card-doc shadow-sm  h-100 bg-transparent">
						    <div class="app-card-thumb-holder p-3">
							    <div class="app-card-thumb">
	                                <img class="thumb-image" src="<?php 	echo $fetch_product['product_image']; ?>" alt="">
	                                 <span class="badge bg-success">NEW</span>
	                            </div>
	                            
						    </div>
						    <div class="app-card-body p-3 has-card-actions flex-col flex gap-2">
							    
							    <h4 class="app-doc-title truncate mb-0 font-bold"><?php 	echo $fetch_product['product_name']; ?></h4>
							     <h4 class="app-doc-title mb-0 font-extralight truncate">
							     	<?php 	echo $fetch_product['product_description']; ?>
				</h4>
			<h4 class="app-doc-title truncate mb-0 font-bold">$<?php 	echo $fetch_product['product_price']; ?></h4>
							
			 <div class="app-card-actions">
								   
			 </div><!--//app-card-actions-->
								    
		  </div><!--//app-card-body-->

			</div><!--//app-card-->
		</a>
				    </div><!--//col-->
							 <?php 	} ?>

							 

</div>
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->
					
			        </div>