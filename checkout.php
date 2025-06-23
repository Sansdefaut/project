<?php include 'header.php'; ?>
<link rel="stylesheet" type="text/css" href="http://localhost/newstore/css/global2.css">
<body>
    <?php include 'cart.php'; 
    include 'sidebar.php';
    if(!empty($_SESSION['userId'])){


    $select_arll = "SELECT * FROM users WHERE userId='" . $_SESSION['userId'] . "'";
    $prepare_arll = $connect->prepare($select_arll);
    $prepare_arll->execute();
    $fetch_arll = $prepare_arll->fetch(PDO::FETCH_ASSOC);
    ?>
    <main class="py-2">
        <section class="checkout">
            <div class="container">
                <div class="checkout__form">
                    <h4>Billing Details</h4>
                    <form id="checkoutForm" action="#" method="POST">
                        <div class="row">
                            <div class="col-lg-8 col-md-6">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="checkout__input">
                                            <p>First Name<span>*</span></p>
                                            <input type="text" id="firstname" name="firstname" value="<?php echo $fetch_arll['first_name']; ?>">

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="checkout__input">
                                            <p>Last Name<span>*</span></p>
                                            <input type="text" id="lastname" name="lastname" value="<?php echo $fetch_arll['last_name']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="checkout__input">
                                    <p>Country<span>*</span></p>
                                    <input type="text" id="country" name="country">
                                </div>
                                <div class="checkout__input">
                                    <p>Address<span>*</span></p>
                                    <input type="text" name="address" placeholder="Street Address" class="checkout__input__add">
                                    <input type="text" name="address_optional" placeholder="Apartment, suite, unit etc. (optional)">
                                </div>
                                <div class="checkout__input">
                                    <p>Town/City<span>*</span></p>
                                    <input type="text" id="town" name="town">
                                </div>
                                <div class="checkout__input">
                                    <p>State<span>*</span></p>
                                    <input type="text" id="state" name="state">
                                </div>
                                <div class="checkout__input">
                                    <p>Postcode / ZIP<span>*</span></p>
                                    <input type="text" id="postcode" name="postcode">
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="checkout__input">
                                            <p>Phone<span>*</span></p>
                                            <input type="text" id="phonenumber" name="phonenumber" value="<?php echo $fetch_arll['phonenumber']; ?>" required pattern="07[0-9]{8}" maxlength="10" inputmode="numeric">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="checkout__input">
                                            <p>Email<span>*</span></p>
                                            <input type="email" id="email" name="email" value="<?php echo $fetch_arll['email']; ?>" required pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="checkout__order">
                                    <h4>Your Order</h4>
                                    <div class="checkout__order__products">Products <span>Total</span></div>
                                    <?php 
                                    if (!empty($_SESSION['userId'])) {
                                        $userid = $_SESSION['userId'];
                                        $select_count = "SELECT count(*) as countcart FROM cart_product WHERE userId='$userid' and status='oncart'";
                                        $prepare_count = $connect->prepare($select_count);
                                        $prepare_count->execute();
                                        $fetch_count = $prepare_count->fetch(PDO::FETCH_ASSOC);
                                        
                                        if ($fetch_count['countcart'] != 0) {
                                            $select_product_cart = "SELECT * FROM cart_product WHERE userId='$userid' and status='oncart'";
                                            $prepare_product_cart = $connect->prepare($select_product_cart);
                                            $prepare_product_cart->execute();
                                            $total = 0;
                                            ?>
                                            <ul>
                                                <?php
                                                $ui = 1;
                                                while ($fetch_product_cart = $prepare_product_cart->fetch(PDO::FETCH_ASSOC)) {
                                                    $sub_total = (int)$fetch_product_cart['price'] * (int)$fetch_product_cart['quantity'];
                                                    $select_product = "SELECT * FROM products WHERE productId='" . $fetch_product_cart['productId'] . "'";
                                                    $prepare_product = $connect->prepare($select_product);
                                                    $prepare_product->execute();
                                                    $fetch_product = $prepare_product->fetch(PDO::FETCH_ASSOC);
                                                    ?>
                                                    <li class="flex flex-row justify-between">
                                                        <p><?php echo $ui . " . " . $fetch_product['product_name']; ?></p>
                                                        <p><?php echo $fetch_product_cart['quantity']; ?></p>
                                                        <span><?php echo $sub_total; ?></span>
                                                    </li>
                                                    <?php $total += $sub_total; $ui++;
                                                } ?>
                                            </ul>
                                            <div class="checkout__order__subtotal">Subtotal <span><?php echo $total ?></span></div>
                                            <div class="checkout__order__total">Total <span><?php echo $total ?></span></div>
                                            
                                            <div class="checkout__input__checkbox">
                                                <label for="payment">
                                                    Save For later
                                                    <input type="checkbox" id="payment">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="checkout__input__checkbox">
                                                <label for="paypal">
                                                    Mark It
                                                    <input type="checkbox" id="paypal">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <button type="submit" class="site-btn">PLACE ORDER</button>
                                        <?php } else { ?>
                                            <ul>
                                                <li>Empty Cart <span>please add any product to your cart</span></li>
                                            </ul>
                                        <?php }
                                    } else { ?>
                                        <ul>
                                            <li>Empty Cart <span>please login first</span></li>
                                        </ul>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <?php 


}else{
    ?>
     <main class="py-2">
        <section class="checkout">
            <div class="container">
     <ul class="flex flex-col justify-center items-center">
            <li class="flex items-center py-2">
                <div class="ap-card p-5 text-center">
                    <h1 class="page-title mb-4"><span class="font-weight-light">No user detected</span></h1>
                    <div class="mb-4">
                        Sorry, you have to log in first.
                    </div>
                </div>
            </li>
        </ul>
    </div>
</section>
</main>
    <?php
}
include 'footer.php'; ?>
       <script>
        $(document).ready(function() {
            $(document).on('submit', '#checkoutForm', function(event) {
                event.preventDefault();

                // Show loading state
                $('.site-btn').text('Processing...').prop('disabled', true);

                $.ajax({
                    url: "http://localhost/newstore/include/checkout-process",
                    method: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    beforeSend: function() {
                        console.log('Sending AJAX request to checkout-process with data:', $('#checkoutForm').serialize());
                    },
                    success: function(data) {
                        console.log('AJAX success response:', data);
                        $('.site-btn').text('PLACE ORDER').prop('disabled', false); // Reset button

                        if (data.error) {
                            alert(data.message); // Handle error messages
                        } else {
                            alert(data.message); // Show success message
                           window.location.href=data.link; // Reload the page after successful order
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('AJAX error:', xhr, status, error);
                        $('.site-btn').text('PLACE ORDER').prop('disabled', false); // Reset button on error
                        alert("An error occurred. Please try again.");
                    }
                });
            });
        });
    </script>