<?php include 'inc/inc.db.php';
 $database = new Connection();
  $connect = $database->open();

 ?>

<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>NB - SHop</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="Client Portal - Ali Gas Stock Management System">
    <meta name="author" content="Bizimana King Sharoon">    
    <link rel="shortcut icon" href="http://localhost/newstore/favicon.ico"> 
    
    <!-- FontAwesome JS-->
    <script defer src="http://localhost/newstore/assets/plugins/fontawesome/js/all.min.js"></script>
    
    <!-- App CSS -->  
    <link rel="stylesheet" type="text/css" href="http://localhost/newstore/css/global.css">
       <link rel="stylesheet" type="text/css" href="http://localhost/newstore/css/global2.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/newstore/css/tailwind.css">
<link href="http://localhost/newstore/assets/simple-datatables/style.css" rel="stylesheet">
<style type="text/css" media="all">
  @import "http://localhost/newstore/assets/widgEditor/css/widgEditor.css";
</style>

</script>
</head> 
  <nav id="navbar" class="relative px-4 py-3 flex justify-between items-center bg-white shadow-lg z-50">        <a class="text-2xl font-bold leading-none" href="dashboard/">
           <svg width="120" height="30" viewBox="0 0 240 60" xmlns="http://www.w3.org/2000/svg">
             <rect x="10" y="10" width="220" height="40" rx="8" ry="8" fill="#4a6eb5" />
             <text x="121" y="38" font-family="Arial, sans-serif" font-weight="bold" font-size="28" text-anchor="middle" fill="#1a365d">NB SHOP</text>
             <text x="120" y="37" font-family="Arial, sans-serif" font-weight="bold" font-size="28" text-anchor="middle" fill="#ffffff">NB SHOP</text>
             <path d="M190,28 h6 v12 h-26 v-12 h6 v-3 a7,7 0 0,1 14,0 z" fill="#ffffff" />
             <path d="M180,25 v-3 a3,3 0 0,0 -6,0 v3" fill="none" stroke="#4a6eb5" stroke-width="1.5" />
           </svg>
        </a>
        <!-- Product Search Form -->
        <form action="search.php" method="get" class="hidden md:flex items-center mx-2 w-64">
            <input type="text" name="q" class="w-full px-2 py-1 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" placeholder="Search..." required>
            <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded-r-md hover:bg-blue-700 text-sm">🔍</button>
        </form>
        <ul id="menu-items" class="hidden absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2 lg:flex lg:mx-auto lg:items-center lg:w-auto lg:space-x-6">
            <li><a href="./" class="h-10 px-3 py-3 rounded-md text-xs font-bold">home</a></li>
            <li><a href="new-arraival" class="h-10 px-3 py-3 rounded-md text-xs font-bold">New Arrival</a></li>
            <li><a href="popular-product" class="h-10 px-3 py-3 rounded-md text-xs font-bold">Popular</a></li>
                </ul>
        <?php if(!empty($_SESSION['userId'])){
            ?>

               <a class="inline-block ml-auto lg:mr-3 py-2 px-6 bg-orange-50 hover:bg-orange-100 text-sm text-gray-900 font-bold rounded-xl" href="#" data-bs-toggle="modal" data-bs-target="#session-modal-now" ><?php echo $_SESSION['fullname']; ?></a>
            <?php
        }else{
            ?>
             <a class="inline-block ml-auto lg:mr-3 py-2 px-6 bg-orange-50 hover:bg-orange-100 text-sm text-gray-900 font-bold rounded-xl" href="#" data-bs-toggle="modal" data-bs-target="#login-modal-now" >Sign In / Up</a>
            <?php
        } ?>
       
        <a href="#" id="menu-button" class="relative inline-block">
     <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-gear icon h-7 w-7"  viewBox="0 0 576 512"><path d="M96 0C107.5 0 117.4 8.19 119.6 19.51L121.1 32H541.8C562.1 32 578.3 52.25 572.6 72.66L518.6 264.7C514.7 278.5 502.1 288 487.8 288H170.7L179.9 336H488C501.3 336 512 346.7 512 360C512 373.3 501.3 384 488 384H159.1C148.5 384 138.6 375.8 136.4 364.5L76.14 48H24C10.75 48 0 37.25 0 24C0 10.75 10.75 0 24 0H96zM272 180H316V224C316 235 324.1 244 336 244C347 244 356 235 356 224V180H400C411 180 420 171 420 160C420 148.1 411 140 400 140H356V96C356 84.95 347 76 336 76C324.1 76 316 84.95 316 96V140H272C260.1 140 252 148.1 252 160C252 171 260.1 180 272 180zM128 464C128 437.5 149.5 416 176 416C202.5 416 224 437.5 224 464C224 490.5 202.5 512 176 512C149.5 512 128 490.5 128 464zM512 464C512 490.5 490.5 512 464 512C437.5 512 416 490.5 416 464C416 437.5 437.5 416 464 416C490.5 416 512 437.5 512 464z"/></svg>
           <span class="absolute now  bg-red-500 text-white font-bold text-xs rounded-full px-1 " id="cartnumber"></span>
     </a>
        
             <div class="lg:hidden">
            <button id="sidebar-button" class="navbar-burger flex items-center text-blue-600 p-3">
    <svg class="block h-4 w-4 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <title>Open Sidebar</title>
        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
    </svg>
</button>

        </div>
     
    </nav>