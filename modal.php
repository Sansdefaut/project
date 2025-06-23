<div id="login-modal-now" class="modal fade"  data-bs-backdrop="static" >
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content center">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
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
      <form id="LoginForm"  method="post">
      <div class="modal-body">
       
        <div class="mb-3">
                      <label for="setting-input-3" class="form-label">Email</label>
                      <input type="email" placeholder="email@example.com" class="form-control" id="username" name="username" required pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$">
                  </div>
                      <div class="mb-3">
                      <label for="setting-input-3" class="form-label">Password</label>
                      <input type="password" class="form-control" id="passwords" name="passwords" placeholder="********" >
                  </div>
      
         
        <a href="" class="forgot-password-link text-success" >Forgot password?</a>
     <p class="login-card-footer-tet">Don&rsquo;t have an account?  <a href="#" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#register-modal-now" class="" style="color:#009BD2;">Register here</a></p>
      </div>
      <div class="modal-footer">
    <button type="button"  class="btn btn-danger text-white" data-bs-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <button type="submit" id="kalisa4" class="btn btn-primary text-white" >Login</button>

                  
      </div>
      </form>
    </div>
  </div>
</div>


<div id="register-modal-now" class="modal fade"  data-bs-backdrop="static" >
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content center">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Register</h5>
        <a href="#" data-bs-dismiss="modal"
                                  aria-label="Close" >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 bi" viewBox="0 0 512 512">
                  <path d="M175 175C184.4 165.7 199.6 165.7 208.1 175L255.1 222.1L303 175C312.4 165.7 327.6 165.7 336.1 175C346.3 184.4 346.3 199.6 336.1 208.1L289.9 255.1L336.1 303C346.3 312.4 346.3 327.6 336.1 336.1C327.6 346.3 312.4 346.3 303 336.1L255.1 289.9L208.1 336.1C199.6 346.3 184.4 346.3 175 336.1C165.7 327.6 165.7 312.4 175 303L222.1 255.1L175 208.1C165.7 199.6 165.7 184.4 175 175V175zM512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256zM256 48C141.1 48 48 141.1 48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48z" />
                </svg>
              </a>
      </div>
      <div class="alert badge bg-primary text-white" class="alert"  id="alert_message_success3"  style="display: none;" role="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
</div>
<div class="alert badge bg-warning text-white" class="alert"  id="alert_message_warning3"  style="display: none;" role="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
</div>
<div class="alert badge bg-danger text-white" class="alert"  id="alert_message_danger3"  style="display: none;" role="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
</div>
      <form id="RegisterFormNow"  method="post">
      <div class="modal-body">
         <div class="mb-3 row">
          <div class="col-md-6">
            <label for="firstname" class="form-label">First Name</label>
                      <input type="text" placeholder="John" class="form-control" id="firstname" name="firstname" >
          </div>
          <div class="col-md-6">
            <label for="lastname" class="form-label">Last Name</label>
                      <input type="text" placeholder="Doe" class="form-control" id="lastname" name="lastname" >
          </div>
                      
                  </div>
        <div class="mb-3 row">
          <div class="col-md-6">
            <label for="phonenumber" class="form-label">Phone Number</label>
            <input type="text" placeholder="0700000000" class="form-control" id="phonenumber" name="phonenumber" required pattern="07[0-9]{8}" maxlength="10" inputmode="numeric">
          </div>
          <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" placeholder="email@example.com" class="form-control" id="email" name="email" required pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$">
          </div>
        </div>
                      <div class="mb-3">
                      <label for="passwords" class="form-label">Password</label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="********" >
                  </div>
      
         
     
     <p class="login-card-footer-tet"> have an account? <a href="#"  data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#login-modal-now"  style="color:#009BD2;">Login here</a></p>
      </div>
      <div class="modal-footer">
    <button type="button"  class="btn btn-danger text-white" data-bs-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <button type="submit" id="kalisa3" class="btn btn-primary text-white" >
                    Register</button>

                  
      </div>
      </form>
    </div>
  </div>
</div>
<div id="session-modal-now" class="modal fade"  data-bs-backdrop="static" >
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content center">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">User menu</h5>
        <a href="#" data-bs-dismiss="modal"
                                  aria-label="Close" >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 bi" viewBox="0 0 512 512">
                  <path d="M175 175C184.4 165.7 199.6 165.7 208.1 175L255.1 222.1L303 175C312.4 165.7 327.6 165.7 336.1 175C346.3 184.4 346.3 199.6 336.1 208.1L289.9 255.1L336.1 303C346.3 312.4 346.3 327.6 336.1 336.1C327.6 346.3 312.4 346.3 303 336.1L255.1 289.9L208.1 336.1C199.6 346.3 184.4 346.3 175 336.1C165.7 327.6 165.7 312.4 175 303L222.1 255.1L175 208.1C165.7 199.6 165.7 184.4 175 175V175zM512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256zM256 48C141.1 48 48 141.1 48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48z" />
                </svg>
              </a>
      </div>
        <div class="modal-body">
    <div class="flex gap-2">
                    
                <?php if(!empty($_SESSION['userId'])){
                 if(!empty($_SESSION['access_id']) && $_SESSION['access_id']==1){
                  ?>
                    <a href="dashboard/" class=" text-center mt-2 p-2 w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 text-xs">Dashbord</a>
                  <?php
                 }else if(!empty($_SESSION['access_id']) && $_SESSION['access_id'] == 2){
                  ?>
                    <a href="customer/" class=" text-center mt-2 p-2 w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 text-xs">Dashbord</a>
                  <?php
                 }elseif(!empty($_SESSION['access_id']) && $_SESSION['access_id'] == 3){
                  ?>
                    <a href="delivery/" class=" text-center mt-2 p-2 w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 text-xs">Dashbord</a>
                    <?php

                 }
                  ?>

                  
              
                <a href='js/logout' class=" text-center mt-2 w-full bg-red-500 text-white py-2 rounded hover:bg-red-600 text-xs">Logout</a>
                <?php
                } ?>
                </div>
              </div>
</div>
  
    </div>
  </div>
</div>
