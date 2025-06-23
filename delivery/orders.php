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
                                            // Only show orders assigned to this delivery user
                                            $select_allorders = "SELECT s.* FROM sales s JOIN delivery d ON s.salesId = d.salesId WHERE d.userId = '".$_SESSION['userId']."' ";
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
                                                        $name .= $i.' . '.$fetchproder['product_name'];
                                                        $i++;
                                                    }
                                                }
                                                $select_user = "SELECT * FROM users WHERE userId='".$fetch_allorders['userId']."'";
                                                $prepare_user = $connect->prepare($select_user);
                                                $prepare_user->execute();
                                                $fetch_user = $prepare_user->fetch(PDO::FETCH_ASSOC);
                                                // Get delivery status
                                                $select_delivery = "SELECT status FROM delivery WHERE salesId='".$fetch_allorders['salesId']."' AND userId='".$_SESSION['userId']."'";
                                                $prepare_delivery = $connect->prepare($select_delivery);
                                                $prepare_delivery->execute();
                                                $fetch_delivery = $prepare_delivery->fetch(PDO::FETCH_ASSOC);
                                                $delivery_status = $fetch_delivery ? $fetch_delivery['status'] : '';
                                            ?>
                                            <tr>
                                                <td class="cell">#<?php echo $iu; ?></td>
                                                <td class="cell"><span class="truncate"><?php echo $name; ?></span></td>
                                                <td class="cell"><?php echo $fetch_user['first_name']." ".$fetch_user['last_name']; ?></td>
                                                <td class="cell"><span><?php echo date("d M", strtotime($fetch_allorders['dateadded'])); ?></span></td>
                                                <td class="cell">
                                                    <?php if($delivery_status == 'in progress') { ?>
                                                        <span class="badge bg-warning">In Progress</span>
                                                        <form method="post" style="display:inline;">
                                                            <input type="hidden" name="mark_delivered" value="<?php echo $fetch_allorders['salesId']; ?>">
                                                            <button type="submit" class="btn btn-success btn-sm">Mark as Delivered</button>
                                                        </form>
                                                    <?php } elseif($delivery_status == 'delivered') { ?>
                                                        <span class="badge bg-success">Delivered</span>
                                                    <?php } else { ?>
                                                        <span class="badge bg-secondary">Unknown</span>
                                                    <?php } ?>
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
                                            $select_allorders = "SELECT * FROM sales WHERE status='pending' and userId='".$_SESSION['userId']."' ";
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
                                                
                                                $select_user = "SELECT * FROM users WHERE userId='".$_SESSION['userId']."'";
                                                $prepare_user = $connect->prepare($select_user);
                                                $prepare_user->execute();
                                                $fetch_user = $prepare_user->fetch(PDO::FETCH_ASSOC);
                                            ?>
                                            <tr>
                                                <td class="cell">#<?php echo $iu; ?></td>
                                                <td class="cell"><span class="truncate"><?php echo $name; ?></span></td>
                                                <td class="cell"><?php echo $fetch_user['first_name']." ".$fetch_user['last_name']; ?></td>
                                                <td class="cell"><span><?php echo date("d M", strtotime($fetch_allorders['dateadded'])); ?></span><span class="note"><?php echo date("Y", strtotime($fetch_allorders['dateadded'])); ?></span></td>
                                                <td class="cell"><span class="badge bg-warning">Pending</span></td>
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
                                            $select_allorders = "SELECT * FROM sales WHERE status='cancelled' and userId='".$_SESSION['userId']."' ";
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
                                                        $name .= $i.' . '.$fetchproder['product_name'];
                                                        $i++;
                                                    }
                                                }
                                                
                                                $select_user = "SELECT * FROM users WHERE userId='".$_SESSION['userId']."'";
                                                $prepare_user = $connect->prepare($select_user);
                                                $prepare_user->execute();
                                                $fetch_user = $prepare_user->fetch(PDO::FETCH_ASSOC);
                                            ?>
                                            <tr>
                                                <td class="cell">#<?php echo $iu; ?></td>
                                                <td class="cell"><span class="truncate"><?php echo $name; ?></span></td>
                                                <td class="cell"><?php echo $fetch_user['first_name']." ".$fetch_user['last_name']; ?></td>
                                                <td class="cell"><span><?php echo date("d M", strtotime($fetch_allorders['dateadded'])); ?></span><span class="note"><?php echo date("Y", strtotime($fetch_allorders['dateadded'])); ?></span></td>
                                                <td class="cell"><span class="badge bg-danger">Cancelled</span></td>
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

<?php
// Handle mark as delivered
if(isset($_POST['mark_delivered'])) {
    $salesId = $_POST['mark_delivered'];
    // Update delivery table
    $updateDelivery = "UPDATE delivery SET status='delivered' WHERE salesId=:salesId AND userId=:userId";
    $stmtDelivery = $connect->prepare($updateDelivery);
    $stmtDelivery->bindParam(':salesId', $salesId);
    $stmtDelivery->bindParam(':userId', $_SESSION['userId']);
    $stmtDelivery->execute();
    // Update sales table
    $updateSales = "UPDATE sales SET status='delivered' WHERE salesId=:salesId";
    $stmtSales = $connect->prepare($updateSales);
    $stmtSales->bindParam(':salesId', $salesId);
    $stmtSales->execute();
    // Refresh page
    echo '<script>window.location.reload();</script>';
}
?>
