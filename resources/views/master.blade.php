<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BK CINEMA</title>
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
  <link rel="stylesheet" href="sources/css/style.lightblue.css" id="theme-stylesheet">
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
  <!-- Tweaks for older IEs-->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body>
  <div id="all">

    @include('topbar')

    @include('menubar')

    @include('flash-message')
    
    @yield('content')

    @include('footer')

    
  </div>
  <!-- Javascript files-->
  <script src="sources/vendor/jquery/jquery.min.js"></script>
  <script src="sources/vendor/jquery.cookie/jquery.cookie.js">
  </script>
  <script src="sources/vendor/jquery.counterup/jquery.counterup.min.js">
  </script>
  <script src="sources/vendor/jquery.scrollto/jquery.scrollTo.min.js"></script>
  <script src="sources/js/jquery.parallax-1.1.3.js"></script>
  <script src="sources/vendor/popper.js/umd/popper.min.js">
  </script>
  <script src="sources/vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="sources/vendor/waypoints/lib/jquery.waypoints.min.js">
  </script>
  <script src="sources/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="sources/vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js"></script>
  <script src="sources/vendor/bootstrap-select/js/bootstrap-select.min.js"></script>
  <script src="sources/js/front.js"></script>
  <!-- Button back-to-top -->
  <script type="text/javascript">
    $(function(){
      $(window).scroll(function () {
        if ($(this).scrollTop() > 100) $('#goTop').fadeIn();
        else $('#goTop').fadeOut();
      });
      $('#goTop').click(function () {
        $('body,html').animate({scrollTop: 0}, 'slow');
      });
    });
  </script>

  
</body>

</html>