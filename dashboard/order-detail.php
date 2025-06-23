<?php 
include 'head.php';

if (empty($_GET['orderid'])) {
    ?>
    <script>
    window.location.href='orders';
    </script>
    <?php
}

$orderid = $_GET['orderid'];
$select_allorders = "SELECT * FROM sales WHERE salesId='$orderid' ";
$prepare_allorders = $connect->prepare($select_allorders);
$prepare_allorders->execute();
$fetch_allorders = $prepare_allorders -> fetch(PDO::FETCH_ASSOC);


 
                                                      
                                                  $select_user = "SELECT * FROM users WHERE userId='".$fetch_allorders['userId']."'";
                                                $prepare_user = $connect->prepare($select_user);
                                                $prepare_user->execute();
                                                $fetch_user = $prepare_user->fetch(PDO::FETCH_ASSOC);
?>
 <script>    
function showCat(strs) {
  if (strs == "") {
    document.getElementById("dixkaa").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("dixkaa").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","select_prof?qeruio="+strs,true);
    xmlhttp.send();
  }
}

</script>
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
                                    <span class="font-semibold">
                                        <?php echo $fetch_user ? $fetch_user['first_name'] : 'Unknown'; ?>
                                    </span>
                                </div>
<div class="flex justify-between items-center mt-2">
    <span class="text-sm text-gray-600">Last Name:</span>
    <span class="font-semibold">
        <?php echo $fetch_user ? $fetch_user['last_name'] : 'Unknown'; ?>
    </span>
</div>
<div class="flex justify-between items-center mt-2">
    <span class="text-sm text-gray-600">Phone Number:</span>
    <span class="font-semibold">
        <?php echo $fetch_user ? $fetch_user['phonenumber'] : 'Unknown'; ?>
    </span>
</div>
<div class="flex justify-between items-center mt-2">
    <span class="text-sm text-gray-600">Email:</span>
    <span class="font-semibold">
        <?php echo $fetch_user ? $fetch_user['email'] : 'Unknown'; ?>
    </span>
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
                            <a class="btn app-btn-primary" data-bs-toggle="modal" data-bs-target="#assign-modal-now" >Assign To delivery</a>
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
                                  <?php if($fetch_allorders['status'] == 'pending'){
                                    ?>
                                  
                                <div class="flex justify-between items-center mt-2">
<a class="btn app-btn-primary" data-bs-toggle="modal" data-bs-target="#payment-modal-now" >Pay Now</a>
<button class="btn btn-danger text-white takedesicion" id="<?php echo $fetch_allorders['salesId']; ?>">Cancel Now</button>
                                </div>
                                  <?php
                                   }else if($fetch_allorders['status'] == 'canceled'){
                                    ?>
<button class="btn btn-danger text-white">Canceled</button>
<?php
                                   }else{
                                    ?>
                                    <button class="btn btn-success text-white">Paid</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
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
            <input type="hidden" name="salesId" value="<?php echo $fetch_allorders['salesId']; ?>" id="salesId">
                      <label for="setting-input-3" class="form-label"> Payment Gate Way</label>
                         <select id="PayMentGateWay" name="PayMentGateWay" class='flex h-10 w-full items-center justify-between rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50' required  onchange="showCat(this.value)">
                             <option selected disabled>Select Payment Gate Way</option>
                                                    <option value="MOMO PAY">MOMO PAY</option>
                                                    <option value="VISA CARD">VISA CARD</option>
                                                    <option value="PAYPAL">PAYPAL</option>
                                                  
                                                </select>
                  </div>
                       <div class="mb-3" id="dixkaa">
                     
                      
                  </div>
                  <div class="mb-3">
  <label for="paymentphpone" class="form-label">Phone Number</label>
  <input type="text" id="paymentphpone" name="paymentphpone" placeholder="0700000000" class="form-control" required pattern="07[0-9]{8}" maxlength="10" inputmode="numeric">
</div>
<div class="mb-3">
  <label for="paymentemail" class="form-label">Email</label>
  <input type="email" id="paymentemail" name="paymentemail" placeholder="email@example.com" class="form-control" required pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$">
</div>
      </div>
      <div class="modal-footer">
    <button type="button"  class="btn btn-danger text-white" data-bs-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <button type="submit" id="kalisa4" class="btn btn-primary text-white" >Pay Now</button>

                  
      </div>
      </form>
    </div>
  </div>
</div>








<div id="assign-modal-now" class="modal fade"  data-bs-backdrop="static" >
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content center">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Assigning Delivery</h5>
        <a href="#" data-bs-dismiss="modal"
                                  aria-label="Close" >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 bi" viewBox="0 0 512 512">
                  <path d="M175 175C184.4 165.7 199.6 165.7 208.1 175L255.1 222.1L303 175C312.4 165.7 327.6 165.7 336.1 175C346.3 184.4 346.3 199.6 336.1 208.1L289.9 255.1L336.1 303C346.3 312.4 346.3 327.6 336.1 336.1C327.6 346.3 312.4 346.3 303 336.1L255.1 289.9L208.1 336.1C199.6 346.3 184.4 346.3 175 336.1C165.7 327.6 165.7 312.4 175 303L222.1 255.1L175 208.1C165.7 199.6 165.7 184.4 175 175V175zM512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256zM256 48C141.1 48 48 141.1 48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48z" />
                </svg>
              </a>
      </div>
      <div class="alert badge bg-primary text-white" class="alert"  id="alert_message_success5"  style="display: none;" role="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
</div>
<div class="alert badge bg-warning text-white" class="alert"  id="alert_message_warning5"  style="display: none;" role="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
</div>
<div class="alert badge bg-danger text-white" class="alert"  id="alert_message_danger5"  style="display: none;" role="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
</div>
      <form id="AssignForm"  method="post">
      <div class="modal-body">
       
        <div class="mb-3">
            <input type="hidden" name="salesId" value="<?php echo $fetch_allorders['salesId']; ?>" id="salesId">
                      <label for="setting-input-3" class="form-label"> Delivery Account</label>
                         <select id="deliveryid" name="deliveryid" class='flex h-10 w-full items-center justify-between rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50' required>
                <option selected disabled>Select Delivery Account</option>
                <?php
                 $select_alldeliverys = "SELECT * FROM users WHERE access='3'";
                 $prepare_alldeliverys = $connect -> prepare($select_alldeliverys);
                 $prepare_alldeliverys -> execute();
                 while($fetch_alldeliverys = $prepare_alldeliverys -> fetch(PDO::FETCH_ASSOC)){
                 ?>
            <option value="<?php echo $fetch_alldeliverys['userId']; ?>"><?php echo $fetch_alldeliverys['first_name'].' '.$fetch_alldeliverys['last_name']; ?></option>
        <?php }
        ?>
                                                  
                                                </select>
                <input type="hidden" name="orderid" id="orderid" value="<?php echo $orderid;?>">
                  </div>
                    
      </div>
      <div class="modal-footer">
    <button type="button"  class="btn btn-danger text-white" data-bs-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <button type="submit" id="kalisa5" class="btn btn-primary text-white" >Assign Now</button>

                  
      </div>
      </form>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    function showAlert(messageId, message) {
        // Hide all messages first
        $('.alert-message').hide();
        $(messageId).show().html(message);
    }

    $(document).on('submit', '#PayMentForm', function(event) {
        event.preventDefault();

        showAlert("#alert_message_success4", "");
        showAlert("#alert_message_warning4", "");
        showAlert("#alert_message_danger4", "");

        var PayMentGateWay = $('#PayMentGateWay').val();
        var paymentphpone = $('#paymentphpone').val();
        var salesId = $('#salesId').val();

        if (PayMentGateWay && paymentphpone && salesId) {
            $('#kalisa4').text('Uploading...').prop('disabled', true);

            $.ajax({
                url: "http://localhost/newstore/dashboard/include/payment-html",
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(data) {
                    $('#kalisa4').text('Pay Now').prop('disabled', false);

                    if (data.error) {
                        showAlert("#alert_message_danger4", data.message);
                    } else {
                        $('#kalisa4').hide();
                        showAlert("#alert_message_success4", data.message);
                        setTimeout(function() {
                            location.reload(true);
                        }, 1000);
                    }
                },
                error: function(xhr, status, error) {
                    $('#kalisa4').text('Pay Now').prop('disabled', false);
                    showAlert("#alert_message_danger4", "An error occurred. Please try again.");
                    console.error(xhr.responseText); // Log for debugging
                }
            });
        } else {
            showAlert("#alert_message_warning4", "All fields are required");
        }
    });

    $(document).on('click', '.takedesicion', function() {
        var button = $(this);
        var jobapp_no = button.attr("id");

        if (confirm("Are you sure you want to Cancel this sale now?")) {
            button.prop('disabled', true).text('Loading...');

            $.ajax({
                url: "include/payment-cancel-html",
                method: "POST",
                data: { jobapp_no: jobapp_no },
                dataType: 'json',
                success: function(data) {
                    if (data.error) {
                        showAlert("#alert_message_danger", data.message);
                    } else {
                        showAlert("#alert_message_success", data.message);
                        setTimeout(function() {
                            location.reload(true);
                        }, 2000);
                    }
                },
                error: function() {
                    showAlert("#alert_message_danger", "An error occurred. Please try again.");
                },
                complete: function() {
                    button.prop('disabled', false).text('Cancel Sale');
                }
            });
        }
    });

    $(document).on('submit', '#AssignForm', function(event) {
        event.preventDefault();

        showAlert("#alert_message_success5", "");
        showAlert("#alert_message_warning5", "");
        showAlert("#alert_message_danger5", "");

        var deliveryid = $('#deliveryid').val();
        var orderid = $('#orderid').val();

        if (deliveryid && orderid) {
            $('#kalisa5').text('Uploading...').prop('disabled', true);

            $.ajax({
                url: "http://localhost/newstore/dashboard/include/assign-html",
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(data) {
                    $('#kalisa5').text('Assign Now').prop('disabled', false);

                    if (data.error) {
                        showAlert("#alert_message_danger5", data.message);
                    } else {
                        $('#kalisa5').hide();
                        showAlert("#alert_message_success5", data.message);
                        setTimeout(function() {
                            location.reload(true);
                        }, 1000);
                    }
                },
                error: function(xhr, status, error) {
                    $('#kalisa5').text('Assign Now').prop('disabled', false);
                    showAlert("#alert_message_danger5", "An error occurred. Please try again.");
                    console.error(xhr.responseText); // Log for debugging
                }
            });
        } else {
            showAlert("#alert_message_warning5", "All fields are required");
        }
    });
});
</script>
