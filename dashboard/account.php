<?php
 include 'head.php'; 

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
<button class=" btn-sm btn  btn-secondary">Upload Profile</button>
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
						    	<div class="stats-  text-2xl font-bold text-black text-start">Hello <?php echo $username; ?> ,</div>
							    <h4 class="stats- mb-1 text-sm font-extralight text-start">Joined 24 May 2024</h4>
							   
							</div>
						</div>
<form class="row" id="Update-login-account">
							   	<div class="mb-3 form-group  text-start col-lg-12">
									    <label for="firstname" class="form-label">First name</label>
									    <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $fetch_username['first_name']; ?>" required>
									</div>
										<div class="mb-3 form-group  text-start col-lg-12">
									    <label for="lastname" class="form-label">Second name</label>
									    <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $fetch_username['last_name']; ?>" required>
									</div>
										<div class="mb-3 form-group  text-start col-lg-12">
									    <label for="email" class="form-label">Email</label>
									    <input type="email" class="form-control" id="email" name="email" value="<?php echo $fetch_username['email']; ?>" required>
									</div>
									<div class="mb-3 form-group  text-start col-lg-12">
									    <label for="phonenumber" class="form-label">Phonenumber</label>
									    <input type="emai" class="form-control" id="phonenumber" name="phonenumber" value="<?php echo $fetch_username['phonenumber']; ?>" required>
									</div>
									
										
									<div class="pt-2 flex p-2 gap-2 flex-row justify-end items-end">
										
									
										<button type="submit" class="btn  btn- bg-white " id="updateprofilebtn" style="border-radius:30px!!important;">Update Profile</button>
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
<script>
  $(document).ready(function(){
  $(document).on('submit', '#Update-login-account', function(event2){
    event2.preventDefault();
    
    document.getElementById("alert_message_success").style.display = "none";
    document.getElementById("alert_message_warning").style.display = "none";
    document.getElementById("alert_message_danger").style.display = "none";
    
    var firstname = $('#firstname').val();
    var lastname = $('#lastname').val();
      var email = $('#email').val();
    var phonenumber = $('#phonenumber').val();
    
   

    if(firstname != '' && lastname != '' && email != '' && phonenumber != '' ) {
      // Show loading state
      $('#updateprofilebtn').text('Loading...').prop('disabled', true);

      $.ajax({
        url: "https://soracert.afrikacs.com/dashboard/include/update-account",
        method: 'POST',
        data: new FormData(this),
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(data) {
          $('#updateprofilebtn').text('Update Account').prop('disabled', false); // Reset button

          if(data.error){
            document.getElementById("alert_message_danger").style.display = "block";
            $('#alert_message_danger').html(data.message); // Corrected message handling
          } else {
            document.getElementById("updateprofilebtn").style.display = "none";
           
            document.getElementById("alert_message_success").style.display = "block";
             document.getElementById("alert_message_warning").style.display = "none";
       document.getElementById("alert_message_danger").style.display = "none";
            $('#alert_message_success').html(data.message);

            setTimeout(function () {
             window.location.reload();
            }, 1000);
          }
        },
        error: function(xhr, status, error) {
          $('#updateprofilebtn').text('Update Account').prop('disabled', false); // Reset button on error
          document.getElementById("alert_message_danger").style.display = "block";
          $('#alert_message_danger').html("An error occurred. Please try again.");
           document.getElementById("alert_message_warning").style.display = "none";
       document.getElementById("alert_message_success").style.display = "none";
        }
      });
    } else {
      document.getElementById("alert_message_warning").style.display = "block";
       document.getElementById("alert_message_danger").style.display = "none";
        document.getElementById("alert_message_success").style.display = "none";
      $('#alert_message_warning').html("All Fields are Required");
    }
  });

});

     </script>
