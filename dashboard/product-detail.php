<?php 
include 'head.php';
if (empty($_GET['productid'])) {
  ?>
  <script>
  window.location.href='store';
</script>
  <?php
}
$productid = $_GET['productid'];
$select_event = "SELECT *,count(*) as countevent FROM products WHERE productId='$productid'";
$prepare_event = $connect -> prepare($select_event);
$prepare_event -> execute();
$fetch_event = $prepare_event -> fetch(PDO::FETCH_ASSOC);


$cover_images = json_decode($fetch_event['product_cover'], true);
 ?>
<body class="app">
    <div class="app-wrapper bg-gray-100">
      
      <div class="app-content pt-2 p-md-3 p-lg-4">
        <div class="container-xl">
          
          <h1 class="app-page-title py-1"></h1>

<div class="row" id='descripion'>
  <div class="col-xl-12">
    <div class="card details-card">
      <div class="card-body ">
        <div class="row  mb-3 justify-end flex items-center">
          <div class="col-md-6 img-card mb-sm-0 mb-3">  
            <div class="  py-2 items-start justify-between">
              <div class="row">
                <div class="stats-  text-2xl font-bold text-black text-start"><?php echo $fetch_event['product_name']; ?></div>
                <a class="btn btn- bg-white" href="#" data-bs-toggle="modal" data-bs-target="#editProductModal" style="border-radius:10px!important; border: 1px solid #05264F;color: #05264F">Edit Product</a>
              </div>
            </div>
          </div>
          <div class=" col-md-3 card-info d-flex align-items-start"></div>
          <div class=" col-md-3 card-info d-flex align-items-start">
            <div class="mr-auto pr-3">
              <h2 class="font-w600 mb-2 text-black"><?php echo $fetch_event['product_price'];?> FRW</h2>
              <span class="date">Added on</span>
            </div>
            <span class="mr-ico bg-primary"></span>
          </div>
        </div>
        <hr class="my-3"/>
        <h4 class=" text-xl font-bold text-black">Product Description</h4>
        <p><?php echo $fetch_event['product_description']; ?></p>
      </div>
    </div>
  </div>
</div>
<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="editProductForm" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="productId" value="<?php echo htmlspecialchars($fetch_event['productId']); ?>">
          <div class="mb-3">
            <label for="productName" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="productName" name="productName" value="<?php echo htmlspecialchars($fetch_event['product_name']); ?>" required>
          </div>
          <div class="mb-3">
            <label for="productDescription" class="form-label">Description</label>
            <textarea class="form-control" id="productDescription" name="productDescription" required><?php echo htmlspecialchars($fetch_event['product_description']); ?></textarea>
          </div>
          <div class="mb-3">
            <label for="productColor" class="form-label">Color</label>
            <input type="text" class="form-control" id="productColor" name="productColor" value="<?php echo htmlspecialchars($fetch_event['product_color']); ?>" required>
          </div>
          <div class="mb-3">
            <label for="productSize" class="form-label">Size</label>
            <input type="text" class="form-control" id="productSize" name="productSize" value="<?php echo htmlspecialchars($fetch_event['product_size']); ?>" required>
          </div>
          <div class="mb-3">
            <label for="productPrice" class="form-label">Price</label>
            <input type="number" class="form-control" id="productPrice" name="productPrice" value="<?php echo htmlspecialchars($fetch_event['product_price']); ?>" required>
          </div>
          <div class="mb-3">
            <label for="productQuantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="productQuantity" name="productQuantity" value="<?php echo htmlspecialchars($fetch_event['product_quantity']); ?>" required>
          </div>
          <div class="mb-3">
            <label for="mainImage" class="form-label">Main Image (leave blank to keep current)</label>
            <input type="file" class="form-control" id="mainImage" name="mainImage" accept="image/*">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
      <div id="editProductMsg" class="mt-2"></div>
    </div>
  </div>
</div>
<script>
document.getElementById('editProductForm').addEventListener('submit', function(e) {
  e.preventDefault();
  var form = document.getElementById('editProductForm');
  var formData = new FormData(form);
  fetch('include/update-product.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    var msgDiv = document.getElementById('editProductMsg');
    if (data.success) {
      msgDiv.innerHTML = '<div class="alert alert-success">' + data.message + '</div>';
      setTimeout(() => { location.reload(); }, 1500);
    } else {
      msgDiv.innerHTML = '<div class="alert alert-danger">' + data.message + '</div>';
    }
  })
  .catch(error => {
    document.getElementById('editProductMsg').innerHTML = '<div class="alert alert-danger">Error updating product.</div>';
  });
});
</script>
</div>
</div>
</div>

<?php 
  include 'footer.php';
?>