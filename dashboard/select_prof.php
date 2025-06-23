<?php
$q = $_GET['qeruio'];
if($q == 'MOMO PAY'){
?>
<div>
               <label htmlFor="paymentphpone" class="form-label">MOMO Number</label>
              

               <input type="text" placeholder="078220882" class="form-control" id="paymentphpone" name="paymentphpone" >
             
</div>
<?php }else if($q == 'VISA CARD'){
?>
<div>
               <label htmlFor="paymentphpone" class="form-label">VISA CARD / MASTER CARD</label>
              

                 <input type="text" placeholder="4099920888367871" class="form-control" id="paymentphpone" name="paymentphpone" >
             
</div>
<?php       
}else{
       ?>
       <div>
               <label htmlFor="paymentphpone" class="form-label">PAYPAL EMAIL</label>
              

               <input type="text" placeholder="example@gmail.com" class="form-control" id="paymentphpone" name="paymentphpone" >
             
</div>
<?php
} ?>