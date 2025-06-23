<?php include 'head.php'; ?>


<body class="app">
    <div class="app-wrapper">
        <div class="app-content pt-2 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Orders</h1>
                    </div>
                 
                </div>

                <div class="mb-3">
                    <a href="download-orders-pdf.php" class="btn btn-primary" target="_blank">
                        Download All Orders PDF
                    </a>
                </div>

                <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
                    <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">Paid</a>
                    <a class="flex-sm-fill text-sm-center nav-link" id="orders-pending-tab" data-bs-toggle="tab" href="#orders-pending" role="tab" aria-controls="orders-pending" aria-selected="false">Pending</a>
                    <a class="flex-sm-fill text-sm-center nav-link" id="orders-cancelled-tab" data-bs-toggle="tab" href="#orders-cancelled" role="tab" aria-controls="orders-cancelled" aria-selected="false">Cancelled</a>
                </nav>

                <div class="tab-content" id="orders-table-tab-content">
                    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                        <div class="app-card app-card-orders-table shadow-sm mb-5">
                            <div class="app-card-body">
                                <div class="table-responsive">
                                    <table class="table app-table-hover mb-0 text-left datatable">
                                        <thead>
                                            <tr>
                                                <th class="cell">Order</th>
                                                <th class="cell">Product</th>
                                                <th class="cell">Customer</th>
                                                <th class="cell">Date</th>
                                                <th class="cell">Status</th>
                                                <th class="cell">Total</th>
                                                <th class="cell"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $select_allorders = "SELECT * FROM sales WHERE status='paid' ";
                                            $prepare_allorders = $connect->prepare($select_allorders);
                                            $prepare_allorders->execute();
                                            $iu = 1;

                                            while ($fetch_allorders = $prepare_allorders->fetch(PDO::FETCH_ASSOC)) {
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
                                                        $name .= $i.' . '.$fetchproder['product_name'].'<br>';
                                                        $i++;
                                                    }
                                                }
                                                
                                                $select_user = "SELECT * FROM users WHERE userId='".$fetch_allorders['userId']."'";
                                                $prepare_user = $connect->prepare($select_user);
                                                $prepare_user->execute();
                                                $fetch_user = $prepare_user->fetch(PDO::FETCH_ASSOC);
                                            ?>
                                            <tr>
                                                <td class="cell">#<?php echo $iu; ?></td>
                                                <td class="cell"><span class="truncate"><?php echo $name; ?></span></td>
                                                <td class="cell">
                                                    <?php if ($fetch_user) {
                                                        echo $fetch_user['first_name']." ".$fetch_user['last_name'];
                                                    } else {
                                                        echo 'Unknown User';
                                                    } ?>
                                                </td>
                                                <td class="cell"><span><?php echo date("d M", strtotime($fetch_allorders['dateadded'])); ?></span><span class="note">2:16 PM</span></td>
                                                <td class="cell">
                                                    <?php 
                                                        if ($fetch_allorders['status'] == 'in progress') {
                                                            echo '<span class="badge bg-warning">In Progress</span>';
                                                        } elseif ($fetch_allorders['status'] == 'delivered') {
                                                            echo '<span class="badge bg-success">Delivered</span>';
                                                        } elseif ($fetch_allorders['status'] == 'paid') {
                                                            echo '<span class="badge bg-info">Paid</span>';
                                                        } elseif ($fetch_allorders['status'] == 'pending') {
                                                            echo '<span class="badge bg-secondary">Pending</span>';
                                                        } elseif ($fetch_allorders['status'] == 'cancelled' || $fetch_allorders['status'] == 'canceled') {
                                                            echo '<span class="badge bg-danger">Cancelled</span>';
                                                        } else {
                                                            echo '<span class="badge bg-secondary">'.$fetch_allorders['status'].'</span>';
                                                        }
                                                    ?>
                                                </td>
                                                <td class="cell"><?php echo $newtotal; ?></td>
                                               <td class="cell"><a class="btn-sm app-btn-secondary" href="order-detail?orderid=<?php echo $fetch_allorders['salesId']; ?>">View</a></td>
                                            </tr>
                                            <?php $iu++; } ?>
                                        </tbody>
                                    </table>
                                </div><!--//table-responsive-->
                            </div><!--//app-card-body-->		
                        </div><!--//app-card-->
                    </div><!--//tab-pane-->

                    <div class="tab-pane fade" id="orders-pending" role="tabpanel" aria-labelledby="orders-pending-tab">
                        <div class="app-card app-card-orders-table shadow-sm mb-5">
                            <div class="app-card-body">
                                <div class="table-responsive">
                                    <table class="table app-table-hover mb-0 text-left datatable">
                                        <thead>
                                            <tr>
                                                <th class="cell">Order</th>
                                                <th class="cell">Product</th>
                                                <th class="cell">Customer</th>
                                                <th class="cell">Date</th>
                                                <th class="cell">Status</th>
                                                <th class="cell">Total</th>
                                                <th class="cell"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $select_allorders = "SELECT * FROM sales WHERE status='pending' ";
                                            $prepare_allorders = $connect->prepare($select_allorders);
                                            $prepare_allorders->execute();
                                            $iu = 1;

                                            while ($fetch_allorders = $prepare_allorders->fetch(PDO::FETCH_ASSOC)) {
                                                $select_preorder = "SELECT * FROM cart_product WHERE salesId='".$fetch_allorders['salesId']."'";
                                                $prepare_preorder = $connect->prepare($select_preorder);
                                                $prepare_preorder->execute();
                                                $newtotal = 0;
                                                $name = '';
$is = 1; 
                                                while ($fetch_preorder = $prepare_preorder->fetch(PDO::FETCH_ASSOC)) {
                                                    $newtotal += $fetch_preorder['price'] * $fetch_preorder['quantity'];
                                                    $selectproder = "SELECT * FROM products WHERE productId='".$fetch_preorder['productId']."'";
                                                    $prepareproder = $connect->prepare($selectproder);
                                                    $prepareproder->execute();
                                                   
                                                    while ($fetchproder = $prepareproder->fetch(PDO::FETCH_ASSOC)) {
                                                        $name .= $is . ' . ' . $fetchproder['product_name'] . ' , ';
            $is++; // Increment $is for each product 
        }
                                                }
                                                
                                                $select_user = "SELECT * FROM users WHERE userId='".$fetch_allorders['userId']."'";
                                                $prepare_user = $connect->prepare($select_user);
                                                $prepare_user->execute();
                                                $fetch_user = $prepare_user->fetch(PDO::FETCH_ASSOC);
                                            ?>
                                            <tr>
                                                <td class="cell">#<?php echo $iu; ?></td>
                                                <td class="cell"><span class="truncate"><?php echo $name; ?></span></td>
                                                <td class="cell">
                                                    <?php if ($fetch_user) {
                                                        echo $fetch_user['first_name']." ".$fetch_user['last_name'];
                                                    } else {
                                                        echo 'Unknown User';
                                                    } ?>
                                                </td>
                                                <td class="cell"><span><?php echo date("d M", strtotime($fetch_allorders['dateadded'])); ?></span><span class="note"><?php echo date("Y", strtotime($fetch_allorders['dateadded'])); ?></span></td>
                                                <td class="cell">
                                                    <?php 
                                                        if ($fetch_allorders['status'] == 'in progress') {
                                                            echo '<span class="badge bg-warning">In Progress</span>';
                                                        } elseif ($fetch_allorders['status'] == 'delivered') {
                                                            echo '<span class="badge bg-success">Delivered</span>';
                                                        } elseif ($fetch_allorders['status'] == 'paid') {
                                                            echo '<span class="badge bg-info">Paid</span>';
                                                        } elseif ($fetch_allorders['status'] == 'pending') {
                                                            echo '<span class="badge bg-secondary">Pending</span>';
                                                        } elseif ($fetch_allorders['status'] == 'cancelled' || $fetch_allorders['status'] == 'canceled') {
                                                            echo '<span class="badge bg-danger">Cancelled</span>';
                                                        } else {
                                                            echo '<span class="badge bg-secondary">'.$fetch_allorders['status'].'</span>';
                                                        }
                                                    ?>
                                                </td>
                                                <td class="cell"><?php echo $newtotal; ?></td>
                                               <td class="cell"><a class="btn-sm app-btn-secondary" href="order-detail?orderid=<?php echo $fetch_allorders['salesId']; ?>">View</a></td>
                                            </tr>
                                            <?php $iu++; } ?>
                                        </tbody>
                                    </table>
                                </div><!--//table-responsive-->
                            </div><!--//app-card-body-->		
                        </div><!--//app-card-->
                    </div><!--//tab-pane-->

                    <div class="tab-pane fade" id="orders-cancelled" role="tabpanel" aria-labelledby="orders-cancelled-tab">
                        <div class="app-card app-card-orders-table shadow-sm mb-5">
                            <div class="app-card-body">
                                <div class="table-responsive">
                                    <table class="table app-table-hover mb-0 text-left datatable">
                                        <thead>
                                            <tr>
                                                <th class="cell">Order</th>
                                                <th class="cell">Product</th>
                                                <th class="cell">Customer</th>
                                                <th class="cell">Date</th>
                                                <th class="cell">Status</th>
                                                <th class="cell">Total</th>
                                                <th class="cell"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $select_allorders = "SELECT * FROM sales WHERE status='canceled'  ";
                                            $prepare_allorders = $connect->prepare($select_allorders);
                                            $prepare_allorders->execute();
                                            $iu = 1;

                                            while ($fetch_allorders = $prepare_allorders->fetch(PDO::FETCH_ASSOC)) {
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
                                                        $name .= $i.' . '.$fetchproder['product_name'].'<br>';
                                                        $i++;
                                                    }
                                                }
                                                
                                                $select_user = "SELECT * FROM users WHERE userId='".$fetch_allorders['userId']."'";
                                                $prepare_user = $connect->prepare($select_user);
                                                $prepare_user->execute();
                                                $fetch_user = $prepare_user->fetch(PDO::FETCH_ASSOC);
                                            ?>
                                            <tr>
                                                <td class="cell">#<?php echo $iu; ?></td>
                                                <td class="cell"><span class="truncate"><?php echo $name; ?></span></td>
                                                <td class="cell">
                                                    <?php if ($fetch_user) {
                                                        echo $fetch_user['first_name']." ".$fetch_user['last_name'];
                                                    } else {
                                                        echo 'Unknown User';
                                                    } ?>
                                                </td>
                                                <td class="cell"><span><?php echo date("d M", strtotime($fetch_allorders['dateadded'])); ?></span><span class="note"><?php echo date("Y", strtotime($fetch_allorders['dateadded'])); ?></span></td>
                                                <td class="cell">
                                                    <?php 
                                                        if ($fetch_allorders['status'] == 'in progress') {
                                                            echo '<span class="badge bg-warning">In Progress</span>';
                                                        } elseif ($fetch_allorders['status'] == 'delivered') {
                                                            echo '<span class="badge bg-success">Delivered</span>';
                                                        } elseif ($fetch_allorders['status'] == 'paid') {
                                                            echo '<span class="badge bg-info">Paid</span>';
                                                        } elseif ($fetch_allorders['status'] == 'pending') {
                                                            echo '<span class="badge bg-secondary">Pending</span>';
                                                        } elseif ($fetch_allorders['status'] == 'cancelled' || $fetch_allorders['status'] == 'canceled') {
                                                            echo '<span class="badge bg-danger">Cancelled</span>';
                                                        } else {
                                                            echo '<span class="badge bg-secondary">'.$fetch_allorders['status'].'</span>';
                                                        }
                                                    ?>
                                                </td>
                                                <td class="cell"><?php echo $newtotal; ?></td>
                                               <td class="cell"><a class="btn-sm app-btn-secondary" href="order-detail?orderid=<?php echo $fetch_allorders['salesId']; ?>">View</a></td>
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
