<?php include 'head.php'; ?>
<body class="app">
   
    <div class="app-wrapper">
        <div class="app-content pt-2 p-md-3 p-lg-4">
            <div class="container-xl">
                <h1 class="app-page-title py-1"></h1>
                <div class="row g-4 mb-4 bg-gray-100 p-2">
                    <div class="col-12 col-lg-12">
                        <div class="app-card app-card-stat h-100 bg-transparent">
                            <div class="app-card-body p-3 p-lg-4">
                                <div class=" flex flex-col  items-start justify-start text-start">
                                    <div class="stats- text-2xl font-bold text-black mb-2 text-start">Add Product</div>
                                    <form class="row" id="AddProductForm" >
                                        <div class="col-12 col-lg-6">
                                            <div class="mb-3 form-group text-start col-lg-12">
                                                <label for="productName" class="form-label">Product Name</label>
                                                <input type="text" class="form-control" id="productName" name="productName" placeholder="Steve" required>
                                            </div>
                                            <div class="mb-3 form-group text-start col-lg-12">
                                                <label for="productDescription" class="form-label">Product Description</label>
                                                <textarea
                                                    class="bg-whitesmoke w-full outline self-stretch rounded-lg p-4 text-base text-black border-black"
                                                    name="productDescription"
                                                    id="productDescription"
                                                    rows="3"
                                                    placeholder="Add Description"
                                                    required
                                                ></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="mb-3 form-group text-start col-lg-12">
                                                <label for="productColor" class="form-label">Color</label>
                                                <input type="text" class="form-control" id="productColor" name="productColor" placeholder="Doe" required>
                                            </div>
                                            <div class="mb-3 form-group text-start col-lg-12">
                                                <label for="productSize" class="form-label">Size</label>
                                                <select id="productSize" name="productSize" class='flex h-10 w-full items-center justify-between rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50' required>
                                                    <option selected disabled>Select Size</option>
                                                    <option>XX Large</option>
                                                    <option>X Large</option>
                                                    <option>Large</option>
                                                    <option>Medium</option>
                                                    <option>Small</option>
                                                </select>
                                            </div>
                                            <div class="mb-3 form-group text-start col-lg-12 row">
                                                <div class="col-12 col-lg-6">
                                                    <label for="productPrice" class="form-label">Price</label>
                                                    <input type="number" class="form-control" id="productPrice" name="productPrice" placeholder="1" required>
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <label for="productQuantity" class="form-label">Quantity</label>
                                                    <input type="number" class="form-control" id="productQuantity" name="productQuantity" placeholder="1" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 form-group text-start col-lg-12">
                                                <label for="mainImage" class="form-label">Main Image</label>
                                                <input type="file" class="form-control" id="mainImage" name="mainImage" required>
                                            </div>
                                            <div class="mb-3 form-group text-start col-lg-12 row">
                                                <label for="coverImages" class="form-label">Cover Images</label>
                                                <div class="col-lg-4 col-12">
                                                    <input type="file" class="form-control" id="coverImage1" name="coverImages[]" required>
                                                </div>
                                                <div class="col-lg-4 col-12">
                                                    <input type="file" class="form-control" id="coverImage2" name="coverImages[]" required>
                                                </div>
                                                <div class="col-lg-4 col-12">
                                                    <input type="file" class="form-control" id="coverImage3" name="coverImages[]" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pt-2 flex p-2 gap-2 flex-row justify-end items-end">
                                            <a href="store" class="btn btn-danger text-white" style="border-radius:10px!important;">Cancel</a>
                                            <button type="submit" class="btn btn- bg-white" id="addProductButton" style="border-radius:30px!important;">Save & continue</button>
                                        </div>
                                    </form>
                                    <hr class="my-3">
                                    <div class="alert badge bg-primary text-white" id="alert_message_success" style="display: none;" role="alert">
                                        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                                    </div>
                                    <div class="alert badge bg-warning text-white" id="alert_message_warning" style="display: none;" role="alert">
                                        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                                    </div>
                                    <div class="alert badge bg-danger text-white" id="alert_message_danger" style="display: none;" role="alert">
                                        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                                    </div>
                                </div>
                            </div><!--//app-body-->
                        </div><!--//app-card-->
                    </div><!--//row-->
                </div><!--//container-xl-->
            </div><!--//app-content-->
        </div><!--//app-wrapper-->
    </div><!--//app-->

<?php include 'footer.php'; ?>

<script>
$(document).ready(function() {
    $(document).on('submit', '#AddProductForm', function(event) {
        event.preventDefault();

        document.getElementById("alert_message_success").style.display = "none";
        document.getElementById("alert_message_warning").style.display = "none";
        document.getElementById("alert_message_danger").style.display = "none";

        var formData = new FormData(this);

        // Show loading state
        $('#addProductButton').text('Uploading...').prop('disabled', true);

        $.ajax({
            url: "http://localhost/newstore/dashboard/include/add-product",
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                // Upload progress
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        $('#addProductButton').text('Uploading... ' + percentComplete + '%');
                    }
                }, false);
                return xhr;
            },
            success: function(data) {
                $('#addProductButton').text('Save & continue').prop('disabled', false); // Reset button

                if (data.error) {
                    document.getElementById("alert_message_danger").style.display = "block";
                    $('#alert_message_danger').html(data.message);
                } else {
                    document.getElementById("addProductButton").style.display = "none";
                    document.getElementById("alert_message_success").style.display = "block";
                    $('#alert_message_success').html(data.message);

                    setTimeout(function() {
                        window.location.href = 'product-detail?productid=' + data.product; // Redirect or handle as needed
                    }, 1000);
                }
            },
            error: function(xhr, status, error) {
                $('#addProductButton').text('Save & continue').prop('disabled', false); // Reset button on error
                document.getElementById("alert_message_danger").style.display = "block";
                $('#alert_message_danger').html("An error occurred. Please try again.");
            }
        });
    });
});
</script>
