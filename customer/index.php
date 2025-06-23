<?php include 'head.php'; ?>
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <h1 class="app-page-title">Overview</h1>
			    
			   
			    <div class="row g-4 mb-4">
				    <div class="col-6 col-lg-6">
					    <div class="app-card app-card-stat shadow-sm h-100  items-center" style="background: #E3F5FF;">
						    <div class="app-card-body p-3 p-lg-4  flex items-center justify-between">
						    	<div>
							    <h4 class="stats- text-md font-bold mb-1">Total Sales</h4>
							    <div class="stats-  text-lg font-extrabold text-black"><?php 
							     $select_allorders = "SELECT * FROM sales WHERE status='paid' AND userId='".$_SESSION['userId']."'";
                                            $prepare_allorders = $connect->prepare($select_allorders);
                                            $prepare_allorders->execute();
                                            $iu = 1;
   $newtotal = 0;
                                            while ($fetch_allorders = $prepare_allorders->fetch(PDO::FETCH_ASSOC)) {
                                                $select_preorder = "SELECT * FROM cart_product WHERE salesId='".$fetch_allorders['salesId']."'";
                                                $prepare_preorder = $connect->prepare($select_preorder);
                                                $prepare_preorder->execute();
                                             
                                                $name = '';
  $i = 1;
                                                while ($fetch_preorder = $prepare_preorder->fetch(PDO::FETCH_ASSOC)) {
                                                    $newtotal += $fetch_preorder['price'] * $fetch_preorder['quantity'];
                                                    $selectproder = "SELECT * FROM products WHERE productId='".$fetch_preorder['productId']."'";
                                                    $prepareproder = $connect->prepare($selectproder);
                                                    $prepareproder->execute();
                                                  
                                                  }
                                                  } 
                                                  echo $newtotal;?> FRW</div>
							    </div>
							   
						    </div><!--//app-card-body-->
						    <a class="app-card-link-mask" href="#"></a>
					    </div><!--//app-card-->
				    </div><!--//col-->
				    
				    <div class="col-6 col-lg-6">
					    <div class="app-card app-card-stat shadow-sm h-100" style="background: #E5ECF6;">
						    <div class="app-card-body p-3 p-lg-4  flex items-center justify-between">
						    	<div>
							    <h4 class="stats- text-md font-bold mb-1">Daily Sales</h4>
							    <div class="stats-  text-lg font-extrabold text-black"><?php
$sdate = date("Y-m-d");

// Correct SQL syntax using AND instead of two WHERE
$select_allorders = "SELECT * FROM sales WHERE status = :paid AND DATE(dateadded) = :dates AND userId = :userId";
$prepare_allorders = $connect->prepare($select_allorders);
$prepare_allorders->execute([':paid' => 'paid', ':dates' => $sdate,':userId' => $_SESSION['userId']]);

$iu = 1;
$newtotal = 0;

while ($fetch_allorders = $prepare_allorders->fetch(PDO::FETCH_ASSOC)) {
    $select_preorder = "SELECT * FROM cart_product WHERE salesId = :salesId";
    $prepare_preorder = $connect->prepare($select_preorder);
    $prepare_preorder->execute([':salesId' => $fetch_allorders['salesId']]);
    
    $name = '';
    $i = 1;

    while ($fetch_preorder = $prepare_preorder->fetch(PDO::FETCH_ASSOC)) {
        $newtotal += $fetch_preorder['price'] * $fetch_preorder['quantity'];
        $selectproder = "SELECT * FROM products WHERE productId = :productId";
        $prepareproder = $connect->prepare($selectproder);
        $prepareproder->execute([':productId' => $fetch_preorder['productId']]);
        
        // You might want to fetch the product details here if needed
    }
} 

echo $newtotal;
?>
 FRW</div>
							</div>
							    
						    </div><!--//app-card-body-->
						   
					    </div><!--//app-card-->
				    </div><!--//col-->
				    
				    
			    </div><!--//row-->
			    <div class="row g-4 mb-4">
			        <div class="col-12 col-lg-8">
				         <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
				    <div class="inner">
					    <div class="app-card-body p-3 p-lg-4">
						    <h3 class="mb-3">Welcome, <?php echo $username; ?>!</h3>
						    <div class="row gx-5 gy-3">
						        <!--//col-->
							    <div class="col-12 col-lg-12">
								    <a class="btn app-btn-primary" href="../">
</svg>Back To the Website</a>
							    </div><!--//col-->
						    </div><!--//row-->
						   
					    </div><!--//app-card-body-->
					    
				    </div><!--//inner-->
			    </div><!--//app-card-->
			        </div><!--//col-->
			        
				    <div class="col-12 col-lg-4">
				        <div class="app-card app-card-progress-list h-100 shadow-sm">
					        <div class="app-card-header p-3">
						        <div class="row justify-content-between align-items-center">
							        <div class="col-auto">
						                <h4 class="app-card-title">Most Viewed Product</h4>
							        </div><!--//col-->
							        <div class="col-auto">
								        <div class="card-header-action">
									        <a href="store">All Product</a>
								        </div><!--//card-header-actions-->
							        </div><!--//col-->
						        </div><!--//row-->
					        </div><!--//app-card-header-->
					        <div class="app-card-body" style="height: 180px; overflow-y: auto;">
							   
							    
							    <?php  

 $query = "
                        SELECT p.*, COALESCE(a.numberofvisit, 0) AS visit_count
                        FROM products p
                        LEFT JOIN activity_product a ON p.productId = a.productId AND a.userId = :userId
                        ORDER BY visit_count DESC, p.productId
                    ";

    // Execute the query
    $prepare = $connect->prepare($query);
    $prepare->bindParam(':userId', $_SESSION['userId']);
    $prepare->execute();
    $products = $prepare->fetchAll(PDO::FETCH_ASSOC);
        foreach ($products as $product) {
    	?>					     <div class="item p-3">
								    <div class="row align-items-center">
									    <div class="col">
										    <div class="title mb-1 "><?php echo htmlspecialchars($product['product_name']);?></div>
										    <div class="pogress">
 <?php echo $product['visit_count'] ?>
</div>
									    </div><!--//col-->
									    <div class="col-auto">
										    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
</svg>
									    </div><!--//col-->
								    </div><!--//row-->
								    <a class="item-link-mask" href="#"></a>
							    </div><!--//item-->
							    <?php }
							    ?>
							   
							    
							   
		
					        </div><!--//app-card-body-->
				        </div><!--//app-card-->
			        </div><!--//col-->
			       
			    </div><!--//row-->
			   
	  
	    
    </div><!--//app-wrapper-->   
</div>
</div>
<?php include 'footer.php'; ?>