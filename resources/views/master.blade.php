<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Universal - All In 1 Template</title>
	<base href="{{asset('')}}">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="sources/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="sources/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Google fonts - Roboto-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,700">
    <!-- Bootstrap Select-->
    <link rel="stylesheet" href="sources/vendor/bootstrap-select/css/bootstrap-select.min.css">
    <!-- owl carousel-->
    <link rel="stylesheet" href="sources/vendor/owl.carousel/assets/owl.carousel.css">
    <link rel="stylesheet" href="sources/vendor/owl.carousel/assets/owl.theme.default.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="sources/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="sources/css/custom.css">
    <!-- Favicon and apple touch icons-->
    <link rel="shortcut icon" href="sources/img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="sources/img/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="57x57" href="sources/img/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="72x72" href="sources/img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="sources/img/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="sources/img/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="sources/img/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="sources/img/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="sources/img/apple-touch-icon-152x152.png">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <div id="all">
      <!-- Top bar-->
      <div class="top-bar">
        <div class="container">
          <div class="row d-flex align-items-center">
            <div class="col-md-6 d-md-block d-none">
              <p>Contact us on +420 777 555 333 or hello@universal.com.</p>
            </div>
            <div class="col-md-6">
              <div class="d-flex justify-content-md-end justify-content-between">
                <ul class="list-inline contact-info d-block d-md-none">
                  <li class="list-inline-item"><a href="#"><i class="fa fa-phone"></i></a></li>
                  <li class="list-inline-item"><a href="#"><i class="fa fa-envelope"></i></a></li>
                </ul>
                <div class="login"><a href="#" data-toggle="modal" data-target="#login-modal" class="login-btn"><i class="fa fa-sign-in"></i><span class="d-none d-md-inline-block">Sign In</span></a><a href="customer-register.html" class="signup-btn"><i class="fa fa-user"></i><span class="d-none d-md-inline-block">Sign Up</span></a></div>
                <ul class="social-custom list-inline">
                  <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                  <li class="list-inline-item"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                  <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                  <li class="list-inline-item"><a href="#"><i class="fa fa-envelope"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Top bar end-->
      <!-- Login Modal-->
      <div id="login-modal" tabindex="-1" role="dialog" aria-labelledby="login-modalLabel" aria-hidden="true" class="modal fade">
        <div role="document" class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 id="login-modalLabel" class="modal-title">Customer Login</h4>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
              <form action="customer-orders.html" method="get">
                <div class="form-group">
                  <input id="email_modal" type="text" placeholder="email" class="form-control">
                </div>
                <div class="form-group">
                  <input id="password_modal" type="password" placeholder="password" class="form-control">
                </div>
                <p class="text-center">
                  <button class="btn btn-template-outlined"><i class="fa fa-sign-in"></i> Log in</button>
                </p>
              </form>
              <p class="text-center text-muted">Not registered yet?</p>
              <p class="text-center text-muted"><a href="sources/customer-register.html"><strong>Register now</strong></a>! It is easy and done in 1 minute and gives you access to special discounts and much more!</p>
            </div>
          </div>
        </div>
      </div>
      <!-- Login modal end-->
      <!-- Navbar Start-->
	  
	  	@include('header')

      <!-- Navbar End-->
	  
		@yield('content')


      <!-- GET IT-->
      <div class="get-it">
        <div class="container">
          <div class="row">
            <div class="col-lg-8 text-center p-3">
              <h3>Do you want cool website like this one?</h3>
            </div>
            <div class="col-lg-4 text-center p-3">   <a href="#" class="btn btn-template-outlined-white">Buy this template now</a></div>
          </div>
        </div>
      </div>
      <!-- FOOTER -->
		@include('footer')
    </div>
    <!-- Javascript files-->
    <script src="sources/vendor/popper.js/umd/popper.min.js"> </script>
    <script src="sources/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="sources/vendor/jquery/jquery.min.js"></script>
    <script src="sources/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="sources/vendor/waypoints/lib/jquery.waypoints.min.js"> </script>
    <script src="sources/vendor/jquery.counterup/jquery.counterup.min.js"> </script>
    <script src="sources/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="sources/vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js"></script>
    <script src="sources/js/jquery.parallax-1.1.3.js"></script>
    <script src="sources/vendor/bootstrap-select/js/bootstrap-select.min.js"></script>
    <script src="sources/vendor/jquery.scrollto/jquery.scrollTo.min.js"></script>
    <script src="sources/js/front.js"></script>
  </body>
</html>