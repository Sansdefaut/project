<?php include 'head.php'; ?>
<body class="app">
   
    <div class="app-wrapper bg-white">
	    
	    <div class="app-content pt-2 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <h1 class="app-page-title py-1"></h1>
			    
			   
			    <div class="row g-4 mb-4 bg-gray-100 p-1">
				    
				    <div class="col-12 col-lg-12">
					    <div class="app-card app-card-stat h-100 bg-transparent">
						    <div class="app-card-body p-2 p-lg-4 ">
						    	<div class=" flex flex-col  items-start justify-start">
						    	<div class="">
						    	<div class="stats-  text-2xl font-bold text-black text-start py-2">Store </div>
							   
							   
							</div>
							<a class="flex items-center text-center justify-center gap-2" href="add-product">
							    <div class="p-2  rounded-3xl  btn- bg-white "style="border-radius:10px!!important; border: 1px solid #05264F;background-color: #05264F"><svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 448 512"><path d="M64 80c-8.8 0-16 7.2-16 16V416c0 8.8 7.2 16 16 16H384c8.8 0 16-7.2 16-16V96c0-8.8-7.2-16-16-16H64zM0 96C0 60.7 28.7 32 64 32H384c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zM200 344V280H136c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V168c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H248v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"/></svg>
							    	</div>
							    	<div class="gap-2">
<div class="stats-  text-md font-bold text-black text-start ">Add Product </div>
 <h4 class="stats-  text-sm font-extralight text-start">share product description</h4>
</div>
							    </a>

						    </div>
						    <hr class="my-3" />
           
			    <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav  flex-column flex-sm-row mb-1 bg-transparent">
				   
				    <a class="flex-sm-fill text-sm-center nav-link active"  id="upcoming-Events-tab" data-bs-toggle="tab" href="#upcoming-Events" role="tab" aria-controls="upcoming-Events" aria-selected="false">Active Product</a>
				    <a class="flex-sm-fill text-sm-center nav-link" id="events-pending-tab" data-bs-toggle="tab" href="#events-pending" role="tab" aria-controls="events-pending" aria-selected="false">Out-of Stock</a>
				    <a class="flex-sm-fill text-sm-center nav-link" id="orders-articles-tab" data-bs-toggle="tab" href="#orders-articles" role="tab" aria-controls="orders-articles" aria-selected="false">Canceled Product</a>
				</nav>
				<div class="tab-content" id="orders-table-tab-content" style="height: 350px;overflow-y: auto;overflow-x:hidden;">
			        <?php 	include 'include/active-product.php'; ?>
						   </div>

					    </div><!--//app-body-->
				    </div><!--//app-card-->
			    </div><!--//row-->
			    
	    
    </div><!--//app-wrapper-->
    </div>    					  		
    </div>
    </div>		
<?php include 'footer.php'; ?>