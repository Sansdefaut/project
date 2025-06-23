  <footer style="background: #1d3057;" class=" text-white">
    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <div>
          <div class="flex items-center space-x-4 mb-4">
      NB SHOP LOGO
            
          </div>
          <p class="flex items-center space-x-2 mb-2">
            
           
            <span>info@nbshop.rw</span>
          </p>
          <p class="flex items-center ">
          
            <span>+250 787012706</span>
          </p>
        </div>
        <div>
          <h3 class="text-lg text-gray-200 font-semibold mb-4">Quick Links</h3>
          <ul class="space-y-2">
            <li>
              <a class="hover:text-blue-500" href="./">
                Home
              </a>
            </li>
            <li>
              <a class="hover:text-blue-500" href="new-arraival">
                New Arraival
              </a>
            </li>
            <li>
              <a class="hover:text-blue-500" href="popular-product">
                Popular
              </a>
            </li>
            <li>
              <a class="hover:text-blue-500" href="contact">
               Contact
              </a>
            </li>
          </ul>
        </div>
        <div>
          <h3 class="text-lg font-semibold text-gray-200  mb-4">Usefull Links</h3>
          <ul class="space-y-2">
            <li>
              <a class="hover:text-blue-500" href="#">
                Privacy Policy
              </a>
            </li>
            <li>
              <a class="hover:text-blue-500" href="#">
                Disclaimer
              </a>
            </li>
            <li>
              <a class="hover:text-blue-500" href="#">
                Terms & Condition
              </a>
            </li>
            <li>
              <a class="hover:text-blue-500" href="#">
                GDPR
              </a>
            </li>
          </ul>
        </div>
        <div>
          <h3 class="text-lg text-gray-200  font-semibold mb-4">Stay Tuned With Us</h3>
          <p class="mb-4">Explore our Product or contact us for any inquiry.</p>
          <div class="flex space-x-4">
            <Facebook class="text-white h-6 w-6" />
            <Instagram class="text-white h-6 w-6" />
            <Linkedin class="text-white h-6 w-6" />
          </div>
        </div>
      </div>
      <div class="border-t border-gray-700 mt-8 pt-8 text-center">
        <p>2025 | NB SHOP.</p>
      </div>
    </div>
  </footer>
        <!-- ****** Footer Area End ****** -->
        <script src="http://localhost/newstore/assets/plugins/popper.min.js"></script>
    <script src="http://localhost/newstore/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- Page Specific JS -->
    <script src="http://localhost/newstore/assets/js/app-2.js"></script>
    <script src="http://localhost/newstore/assets/simple-datatables/simple-datatables.js"></script>
  <script src="http://localhost/newstore/assets/tinymce/tinymce.min.js"></script>
  

  <!-- Template Main JS File -->
  <script src="http://localhost/newstore/assets/simple-datatables/main.js"></script> 
  <script src="http://localhost/newstore/assets/jquery/jquery.js"></script>
  <script src="http://localhost/newstore/app.js"></script>
   <script type="text/javascript">
    cart_card();
    document.addEventListener("DOMContentLoaded", () => {
    const sidebarButton = document.getElementById('sidebar-button'); // Updated button for sidebar
    const closeSidebarButton = document.getElementById('close-sidebar');
    const mobileSidebar = document.getElementById('mobile-sidebar');
    const mobileMenu = document.getElementById('mobile-menu');

    // Open the mobile sidebar
    sidebarButton.addEventListener('click', () => {
        mobileSidebar.classList.remove('hidden');
        document.body.classList.add('overflow-hidden'); // Prevent scrolling
    });

    // Close the mobile sidebar
    closeSidebarButton.addEventListener('click', () => {
        mobileSidebar.classList.add('hidden');
        document.body.classList.remove('overflow-hidden'); // Allow scrolling
    });

    // You can keep the existing logic for the mobile menu
    const closeMenuButton = document.getElementById('close-menu');
    closeMenuButton.addEventListener('click', () => {
        mobileMenu.classList.add('hidden');
        document.body.classList.remove('overflow-hidden'); // Allow scrolling
    });
});
function cartnumber()
{ 
    var req = new XMLHttpRequest();
    req.onreadystatechange = function() 
    { 
        if(req.readyState == 4 && req.status == 200)
        { 
      document.getElementById('cartnumber').innerHTML = req.responseText; 
        }
    }
    req.open('POST', "include/cart-number", true);
    req.send();
} 




setInterval(function(){ 
  cartnumber();

 
}, 2000);
    function cart_card() {
      $.ajax({
        url: 'include/cart-product',
        method: 'post',
        
        success: function(response) {
          $("#cartproduct").html(response);
        
        }
      });
    }
    $(document).ready(function(){
    
    $(document).on('click', '.removefromcart', function(eventsas){
   eventsas.preventDefault();
    var o_id = $(this).attr("id");
      if(confirm("Are you sure you want to remove this product?"))
    {
      $.ajax({
        url:"include/deletesimple",
        method:"GET",
        data:{
        o_id:o_id,
      },
        success:function(data)
        {
             updateCartInfo();
      document.getElementById("alert_message").style.display = "block";
              $('#alert').show();
          $('#alert_message').html(data);
       
        }
      });   
   } else
    {
      return false; 
    }
  });
     });
    function updateCartInfo() {
    // Your logic to update cart info
    cart_card(); // Call the existing function to update the cart
    
}


  </script>
  
</body>
</html>
<?php
include 'modal.php';
?>