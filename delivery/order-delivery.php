<?php 
include 'head.php';

if (empty($_GET['ssicd'])) {
    ?>
    <script>
    window.location.href='bookings';
    </script>
    <?php
}

$ssicd = $_GET['ssicd'];
$sleer = "SELECT * FROM delivery WHERE deli_no='$ssicd'";
$psleer = $connect -> prepare($sleer);
$psleer -> execute();
$fsleer = $psleer -> fetch(PDO::FETCH_ASSOC);

$select_allorders = "SELECT * FROM sales WHERE salesId='".$fsleer['salesId']."'";
$prepare_allorders = $connect->prepare($select_allorders);
$prepare_allorders->execute();
$fetch_allorders = $prepare_allorders -> fetch(PDO::FETCH_ASSOC);


 
                                                      
$select_user = "SELECT * FROM users WHERE userId='".$fetch_allorders['userId']."'";
$prepare_user = $connect->prepare($select_user);
$prepare_user->execute();
$fetch_user = $prepare_user->fetch(PDO::FETCH_ASSOC);
?>
 
<body class="app">
    <div class="app-wrapper bg-gray-100">
        <div class="app-content pt-2 p-md-3 p-lg-4">
            <div class="container-xl">
                <h1 class="app-page-title py-1"></h1>
                <div class="row g-4 settings-section">
                    <div class="col-12 col-md-8">
                        <div class="p-6 shadow-lg mb-5 bg-white rounded-lg">
                            <div class="text-xl font-bold text-gray-900">Client Information</div> 
                            <hr class='my-3' />
                            <div class="mt-6">
                                <div class="flex justify-between items-center mt-2">
                                    <span class="text-sm text-gray-600">First Name:</span>
                                    <span class="font-semibold"><?php echo $fetch_user['first_name']; ?></span>
                                </div>
                                  <div class="flex justify-between items-center mt-2">
                                    <span class="text-sm text-gray-600">Last Name:</span>
                                    <span class="font-semibold"><?php echo $fetch_user['last_name']; ?></span>
                                </div>
                                <div class="flex justify-between items-center mt-2">
                                    <span class="text-sm text-gray-600">Phone Number:</span>
                                    <span class="font-semibold"><?php echo $fetch_user['phonenumber']; ?></span>
                                </div>
                                <div class="flex justify-between items-center mt-2">
                                    <span class="text-sm text-gray-600">Email:</span>
                                    <span class="font-semibold"><?php echo $fetch_user['email']; ?></span>
                                </div>
                              
                            </div>
                        </div>

                    
                   <?php if($fetch_allorders['status'] == 'paid'){
    $select_delivery = "SELECT *,count(*) as countdeli FROM delivery WHERE salesId='".$fetch_allorders['salesId']."'";
    $prepare_delivery = $connect -> prepare($select_delivery);
    $prepare_delivery -> execute();
    $fetch_delivery = $prepare_delivery -> fetch(PDO::FETCH_ASSOC);

                                    ?>
<div class="p-6 shadow-lg mb-5 bg-white rounded-lg">
                            <div class="text-xl font-bold text-gray-900">Delivery Information</div> 
                            <hr class='my-3' />
                            <?php if($fetch_delivery['countdeli'] != 0){
                                $new = "SELECT * FROM users WHERE userId='".$fetch_delivery['userId']."'";
                                $pnew = $connect -> prepare($new);
                                $pnew -> execute();
                            $fnew = $pnew -> fetch(PDO::FETCH_ASSOC); ?>
                            <div class="mt-6">
                                <div class="flex justify-between items-center mt-2">
                                    <span class="text-sm text-gray-600">Full Name:</span>
                                    <span class="font-semibold"><?php echo $fnew['first_name'].' '.$fnew['last_name']; ?></span>
                                </div>
                                 
                              
                                <div class="flex justify-between items-center mt-2">
                                    <span class="text-sm text-gray-600">Status:</span>
                                    <span class="font-semibold"><?php echo $fetch_delivery['status']; ?></span>
                                </div>
                                
                              
                            </div>
                        <?php }else{
                            ?>
                            <a class="btn app-btn-primary"  >Not Yet Assigned To delivery</a>
                            <?php
                        } ?>
                        </div>
                    <?php } ?>
                    
                    </div>

                    <div class='col-12 col-md-4'>
                        <div class="p-6 shadow-lg mb-5 bg-white rounded-lg">
                            <div class="text-xl font-bold text-gray-900">Product On Cart</div> 
                            <hr class='my-3' />
                            <div class="mt-6">
                                <?php 
                                $select_preorder = "SELECT * FROM cart_product WHERE salesId='".$fetch_allorders['salesId']."'";
                                                $prepare_preorder = $connect->prepare($select_preorder);
                                                $prepare_preorder->execute();
                                                $newtotal = 0;
                                                $name = '';
  $i = 1;
                                                while ($fetch_preorder = $prepare_preorder->fetch(PDO::FETCH_ASSOC)) {
                                                    $newtotal += $fetch_preorder['price'] * $fetch_preorder['quantity'];
                                                    $selectproder = "SELECT * FROM products WHERE productId='".$fetch_preorder['productId']."'";
                                                    $prepareproder = $connect->prepare($selectproder);
                                                    $prepareproder->execute();
                                                  

                                                    while ($fetchproder = $prepareproder->fetch(PDO::FETCH_ASSOC)) {
                                                     ?>
                                <div class="flex justify-between items-center mt-2">
                                    <span class="text-sm text-gray-600"><?php echo $fetchproder['product_name']; ?></span>
                                     <span class="font-bold"><?php echo $fetch_preorder['quantity']; ?></span>
                                    <span class="font-semibold"><?php echo $fetch_preorder['price']; ?></span>
                                    
                                </div>
                              <?php }
                              } ?>
                              <br class="my-4" />

                                <div class="flex justify-between items-center mt-2">
                                    <span class="text-sm text-gray-600">Sub Total:</span>
                                    <span class="font-semibold"><?php echo $newtotal; ?> FRW</span>
                                </div>
                             
                                <hr class="my-2" />
                                <div class="flex justify-between items-center mt-2">
                                    <span class="text-sm text-gray-600">Total:</span>
                                    <span class="font-semibold"><?php echo $newtotal; ?> FRW</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 shadow-lg mb-5 bg-white rounded-lg">
                            <div class="text-xl font-bold text-gray-900">More Options</div> 
                            <hr class='my-3' />
                              <div class="alert badge bg-primary text-white" class="alert"  id="alert_message_success"  style="display: none;" role="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
</div>
<div class="alert badge bg-warning text-white" class="alert"  id="alert_message_warning"  style="display: none;" role="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
</div>
<div class="alert badge bg-danger text-white" class="alert"  id="alert_message_danger"  style="display: none;" role="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
</div>
                            <div class="mt-6">
                                  <?php if($fsleer['status'] == 'pending'){
                                    ?>
                                  
                                <div class="flex justify-between items-center mt-2">
<a class="btn app-btn-primary" data-bs-toggle="modal" data-bs-target="#payment-modal-now" >Delivery Now</a>

                                </div>
                      
                                 
<?php
                                   }else{
                                    ?>
                                    <button class="btn btn-success text-white">Delivered</button>
                                    <?php
                                   } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>


<div id="payment-modal-now" class="modal fade"  data-bs-backdrop="static" >
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content center">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Deliverly Now</h5>
        <a href="#" data-bs-dismiss="modal"
                                  aria-label="Close" >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 bi" viewBox="0 0 512 512">
                  <path d="M175 175C184.4 165.7 199.6 165.7 208.1 175L255.1 222.1L303 175C312.4 165.7 327.6 165.7 336.1 175C346.3 184.4 346.3 199.6 336.1 208.1L289.9 255.1L336.1 303C346.3 312.4 346.3 327.6 336.1 336.1C327.6 346.3 312.4 346.3 303 336.1L255.1 289.9L208.1 336.1C199.6 346.3 184.4 346.3 175 336.1C165.7 327.6 165.7 312.4 175 303L222.1 255.1L175 208.1C165.7 199.6 165.7 184.4 175 175V175zM512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256zM256 48C141.1 48 48 141.1 48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48z" />
                </svg>
              </a>
      </div>
      <div class="alert badge bg-primary text-white" class="alert"  id="alert_message_success4"  style="display: none;" role="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
</div>
<div class="alert badge bg-warning text-white" class="alert"  id="alert_message_warning4"  style="display: none;" role="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
</div>
<div class="alert badge bg-danger text-white" class="alert"  id="alert_message_danger4"  style="display: none;" role="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
</div>
      <form id="PayMentForm"  method="post">
      <div class="modal-body">
       
        <div class="mb-3">
            <input type="hidden" name="salesId" value="<?php echo $fsleer['deli_no']; ?>" id="salesId">
                      <label for="setting-input-3" class="form-label">Order Code</label>
                         <input type="text" placeholder="Enter Delivery Code" class="form-control" id="deliverycode" name="deliverycode" >
                  </div>
                     
      </div>
      <div class="modal-footer">
    <button type="button"  class="btn btn-danger text-white" data-bs-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <button type="submit" id="kalisa4" class="btn btn-primary text-white" >Deliverly Now</button>

                  
      </div>
      </form>
    </div>
  </div>
</div>

<script>
    $(document).ready(function(){
  $(document).on('submit', '#PayMentForm', function(event2) {
        event2.preventDefault();

        document.getElementById("alert_message_success4").style.display = "none";
        document.getElementById("alert_message_warning4").style.display = "none";
        document.getElementById("alert_message_danger4").style.display = "none";

        var salesId = $('#PayMentGateWay').val();
         var deliverycode = $('#paymentphpone').val();
     

        if (salesId != '' && deliverycode != '') {
            // Show loading state
            $('#kalisa4').text('Uploading...').prop('disabled', true);

            $.ajax({
                url: "http://localhost/newstore/delivery/include/delivery-html",
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(data) {
                    $('#kalisa4').text('Deliver Now').prop('disabled', false); // Reset button

                    if (data.error) {
                        document.getElementById("alert_message_danger4").style.display = "block";
                        $('#alert_message_danger4').html(data.message); // Corrected message handling
                    } else {
                        document.getElementById("kalisa4").style.display = "none";
                        document.getElementById("alert_message_success4").style.display = "block";
                        $('#alert_message_success4').html(data.message);

                        setTimeout(function() {
                            location.reload(true); // Force reload from server
                        }, 1000);
                    }
                },
                error: function(xhr, status, error) {
                    $('#kalisa4').text('Deliver Now').prop('disabled', false); // Reset button on error
                    document.getElementById("alert_message_danger4").style.display = "block";
                    $('#alert_message_danger4').html("An error occurred. Please try again.");
                }
            });
        } else {
            document.getElementById("alert_message_warning4").style.display = "block";
            $('#alert_message_warning4').html("All fields are required");
        }
    });

});



</script>