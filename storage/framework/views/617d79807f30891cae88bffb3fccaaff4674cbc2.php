
<!DOCTYPE html>
<html>
<head>
	<title>Login - PrimeCRM</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="icon" type="image/ico" href="<?php echo e(url('images',['primecrm.ico'])); ?>" />
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('css',['login.css'])); ?>">
    
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="<?php echo e(url('js',['parsley.min.js'])); ?>"></script>
    <script type="text/javascript" src="<?php echo e(url('js',['login.js'])); ?>"></script>
</head>
<body>
  <div class="container-fluid">
  <div class="row no-gutter">
    <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
    <div class="col-md-8 col-lg-6">
         
      <div class="login d-flex align-items-center py-5">
          
        <div class="container">
           <div class='systemicon'></div>
           <!--  <h1 style="font-family:Ubuntu-Light; font-weight:bolder;text-align:center;">PrimeCRM</h1>-->
          <div class="row">
            <div class="col-md-9 col-lg-8 mx-auto logindiv">
               
              <h3 class="login-heading mb-4">Welcome back!</h3>

             <div id="loginmsg" class="alert alert-danger alert-block statusmsg"  >
              		<button type="button" class="close" data-dismiss="alert">x</button>
                       <strong> <span id="errormsq"></span></strong>
              	</div>

                <form action="" method="POST" id="loginForm">

                 <?php echo e(csrf_field()); ?> <!-- for handling multiple exceptions -->

                <div class="form-label-group">
                  <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required data-parsley-type="email" data-parsley-trigger="keyup" data-parsley-required-message="Email is required!"/>
                  <label for="inputEmail">Email address</label>

                </div>

                <div class="form-label-group">
                  <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required data-parsley-length="[4,16]" data-parsley-trigger="keyup" data-parsley-required-message="Password is required!"/>
                  <label for="inputPassword">Password</label>

                </div>

                  <input class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit" id="submit" value="Sign In"/>
              <!--  <div class="text-center">Don't have an account?-->
                  <!--<a class="small" href="<?php echo e(url('registration')); ?>">Sign Up</a></div>-->
              </form>
               
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
<footer>
    <div class='row foot-note'>
                <div class='col-md-4'></div>
                <div class='col-md-4' style="text-align:center;">
                    <span id='dev-link'>Built By: <a class='foot-link' href='https://www.linkedin.com/in/joash-owaga-2b627886/'>Joash Owaga </a>
                     &#169;<script>document.write(new Date().getFullYear())</script></span> 
                 </div>
                <div class='col-md-4'></div>
        
                </div>
</footer>
</html>
<?php /**PATH /home/symphon3/symphonycrm/resources/views/user/login.blade.php ENDPATH**/ ?>