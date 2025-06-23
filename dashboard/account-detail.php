<?php
 include 'head.php'; 
if (empty($_GET['userno'])) {
    ?>
    <script>
    window.location.href='users';
    </script>
    <?php
}
  $select_user = "SELECT * FROM users WHERE userId='".$_GET['userno']."'";
                        $prepare_user = $connect->prepare($select_user);
                                            $prepare_user->execute();
                                          $fetch_user = $prepare_user->fetch(PDO::FETCH_ASSOC);
?>
    <div class="app-wrapper">
	    
	    <div class="app-content pt-2 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <h1 class="app-page-title py-2">Overview</h1>
			    
			   
			    <div class="row g-4 mb-4 bg-gray-100 p-2">
				    <div class="col-12 col-lg-4 ">
					    <div class="app-card app-card-stat shadow-sm h-100  items-center bg-gray-200">
						    <div class="app-card-body p-3 p-lg-4  ">
						    	<div class="flex flex-col items-center justify-center py-2">
						    	
							    <div class="rounded-xl bg-whitesmoke-200 flex items-start justify-start py-2"  style="border-radius:20px">

<img

  class="image-fluid"
  loading="lazy"
  alt=""
  style="hight:100.2px;width:100.2px;border-radius:100px;object-fit:cover"
   src="<?php if($profilepicture == ''){ echo 'https://soracert.afrikacs.com/assets/images/Imageplaceholder.png';
                            }else{
                              echo $profilepicture;
                            }?>"
 
/>
</div>

</div>
<div class="flex flex-col items-start  justify-start py-2">

	
</p>
</div>

<div class="flex flex-col items-start  justify-start py-2">
	<h2 class="text-black font-black text-xl"><?php echo $username; ?></h2>
	<ol >
		<li class="text-start font-extralight">
			 <a class="flex flex-row items-center" href="#"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right m-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
</svg><span><?php echo $fetch_username['phonenumber']; ?></span></a>
		</li>
		<li class="text-start font-extralight">
			<a class="flex flex-row items-center" href="#"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right m-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
</svg><span><?php echo $fetch_username['email']; ?></span></a>
		</li>


	</ol>
</div>

			    </div><!--//app-card-->
				
				    </div><!--//col-->
				</div>
				    
				    
				    <div class="col-12 col-lg-8">
					    <div class="app-card app-card-stat h-100 bg-transparent">
						    <div class="app-card-body p-3 p-lg-4 ">
						    	<div class=" flex flex-col py-2 items-start justify-start text-start">
						    	<div class="py-1">
						    	<div class="stats-  text-xl font-bold text-black text-start">Hello <?php echo $username; ?> ,</div>
							    <h4 class="stats- mb-1 text-xl font-extralight text-start">Account Detail For <?php echo $fetch_user['first_name']; ?></h4>
							   
							</div>
						</div>
<form class="row" id="">
							   	<div class="mb-3 form-group  text-start col-lg-12">
									    <label for="firstname" class="form-label">First name</label>
									    <input type="text" class="form-control" disabled id="firstname" name="firstname" value="<?php echo $fetch_user['first_name']; ?>" required>
									</div>
										<div class="mb-3 form-group  text-start col-lg-12">
									    <label for="lastname" class="form-label">Second name</label>
									    <input type="text" class="form-control" disabled id="lastname" name="lastname" value="<?php echo $fetch_user['last_name']; ?>" required>
									</div>
										<div class="mb-3 form-group  text-start col-lg-12">
									    <label for="email" class="form-label">Email</label>
									    <input type="email" class="form-control" disabled id="email" name="email" value="<?php echo $fetch_user['email']; ?>" required>
									</div>
									<div class="mb-3 form-group  text-start col-lg-12">
									    <label for="phonenumber" class="form-label">Phonenumber</label>
									    <input type="emai" class="form-control" disabled id="phonenumber" name="phonenumber" value="<?php echo $fetch_user['phonenumber']; ?>" required>
									</div>
									
										
								
</form>
<hr class="my-3">
<div class="alert badge bg-primary text-white" class="alert"  id="alert_message_success"  style="display: none;" role="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
</div>
<div class="alert badge bg-warning text-white" class="alert"  id="alert_message_warning"  style="display: none;" role="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
</div>
<div class="alert badge bg-danger text-white" class="alert"  id="alert_message_danger"  style="display: none;" role="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
</div>
<hr class="my-3">

						    </div>
   
					    </div><!--//app-body-->
				    </div><!--//app-card-->
			    </div><!--//row-->
			    
	    
    </div><!--//app-wrapper-->
    </div>    					
  </div>
 <?php include 'footer.php'; ?>
