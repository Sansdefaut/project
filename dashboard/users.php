<?php include 'head.php'; ?>


<body class="app">
    <div class="app-wrapper">
        <div class="app-content pt-2 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Account</h1>

                    </div>
                        <div class="col-auto">
                         <a class="inline-block ml-auto lg:mr-3 py-2 px-6 bg-gray-50 hover:bg-gray-100 text-sm text-gray-900 font-bold rounded-xl" href="#" data-bs-toggle="modal" data-bs-target="#register-modal-now" >Register Deliverly account</a>
                    </div>
                 
                </div>

          

                <div class="tab-content" id="orders-table-tab-content">
                    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                        <div class="app-card app-card-orders-table shadow-sm mb-5">
                            <div class="app-card-body">
                                <div class="table-responsive">
                                    <table class="table app-table-hover mb-0 text-left datatable">
                                        <thead>
                                            <tr>
                                                <th class="cell">no</th>
                                                <th class="cell">FullName</th>
                                                <th class="cell">Email</th>
                                                <th class="cell">Access</th>
                                                <th class="cell">status</th>
                                                <th class="cell"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $select_user = "SELECT * FROM users";
                                            $prepare_user = $connect->prepare($select_user);
                                            $prepare_user->execute();
                                            $iu = 1;

                                            while ($fetch_user = $prepare_user->fetch(PDO::FETCH_ASSOC)) {
                                               
                                            
                                            ?>
                                            <tr>
                                                <td class="cell">#<?php echo $iu; ?></td>
                                                   <td class="cell"><?php echo $fetch_user['first_name']." ".$fetch_user['last_name']; ?></td>

                                                <td class="cell"><?php echo $fetch_user['email']; ?></td>
                                               
        <td class="cell"><span class="">
            <?php if($fetch_user['access'] == '1'){
                 echo 'Admin Account';
            }else if($fetch_user['access'] == '2'){
                 echo 'Customer Account';
            }else{
                 echo 'delivery Account';
            } ?></span></td>
                                                <td class="cell"><?php echo $fetch_user['status']; ?></td>
                                               <td class="cell"><a class="btn-sm app-btn-secondary" href="account-detail?userno=<?php echo $fetch_user['userId']; ?>">View</a></td>
                                            </tr>
                                            <?php $iu++; } ?>
                                        </tbody>
                                    </table>
                                </div><!--//table-responsive-->
                            </div><!--//app-card-body-->		
                        </div><!--//app-card-->
                    </div><!--//tab-pane-->

            
                
                </div><!--//tab-content-->
            </div><!--//container-xl-->
        </div><!--//app-content-->
    </div><!--//app-wrapper-->
    
<?php include 'footer.php'; ?>
<?php include 'modal.php'; ?>
<script>
    
    $(document).ready(function(){
$(document).on('submit', '#RegisterFormNow', function(event) {
    event.preventDefault();

    // Reset alerts
    $("#alert_message_success3, #alert_message_warning3, #alert_message_danger3").hide();

    var firstname = $('#firstname').val().trim();
    var lastname = $('#lastname').val().trim();
    var phonenumber = $('#phonenumber').val().trim();
    var email = $('#email').val().trim();
    var password = $('#password').val().trim();

    if (firstname && lastname && phonenumber && email && password) {
        $('#kalisa3').text('Uploading...').prop('disabled', true);

        $.ajax({
            url: "http://localhost/newstore/dashboard/include/register-html",
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data) {
                $('#kalisa3').text('Register').prop('disabled', false);
                
                if (data.error) {
                    $("#alert_message_danger3").show().html(data.message);
                } else {
                    $("#kalisa3").hide();
                    $("#alert_message_success3").show().html(data.message);
                    setTimeout(function() {
                        location.reload(true);
                    }, 1000);
                }
            },
            error: function() {
                $('#kalisa3').text('Register').prop('disabled', false);
                $("#alert_message_danger3").show().html("An error occurred. Please try again.");
            }
        });
    } else {
        $("#alert_message_warning3").show().html("All fields are required.");
    }
});

   });

</script>