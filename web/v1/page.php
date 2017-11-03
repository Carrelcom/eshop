<?
include ("engine.php");
if ( Utility::is_session_started() === FALSE ) session_start();

$connected = false;
$mail = "";
$labelList = "";
$disabled = "";
$run = false;
if(isset($_SESSION['mail'])){
  $connected = true;
  $mail = $_SESSION['mail'];
  $disabled = "readonly='readonly'";
}

if(isset($_GET['page']) && $_GET['page']<>"" && $_GET['page']<>Null){
  $page = $_GET['page'];
  if(file_exists("html/".$page.".php")){
    $page = 'html/'.$page.'.php';
    $run = true;
  }else{
    Utility::redirect('error',array('code'=>'404'));
  }
}else{
    Utility::redirect('error',array('code'=>'404'));
}




?>

<!DOCTYPE html>
<html>
    <head>

        <!-- /.website title -->
        <title>Backyard Landing Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <!-- CSS Files -->
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="fonts/icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet" media="screen">
        <link href="css/owl.theme.css" rel="stylesheet">
        <link href="css/owl.carousel.css" rel="stylesheet">

        <!-- CSS FILES CUSTO -->
        <link href="custo/jquery-ui/jquery-ui.min.css" rel="stylesheet">

        <!-- Colors -->
        <!-- <link href="css/css-index.css" rel="stylesheet" media="screen"> -->
        <!-- <link href="css/css-index-green.css" rel="stylesheet" media="screen"> -->
        <!-- <link href="css/css-index-purple.css" rel="stylesheet" media="screen"> -->
        <!-- <link href="css/css-index-red.css" rel="stylesheet" media="screen"> -->
        <link href="css/css-index-orange.css" rel="stylesheet" media="screen">
        <!-- <link href="css/css-index-yellow.css" rel="stylesheet" media="screen"> -->
        <link href="custo/css/custo.css" rel="stylesheet" media="screen">
        <!-- Google Fonts -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic" />


    </head>

    <body data-spy="scroll" data-target="#navbar-scroll">

        <!-- /.preloader
        <div id="preloader"></div>-->
        <div id="top"></div>

        <!-- /.parallax full screen background image -->


        <!-- NAVIGATION -->
        <div id="menu">
            <nav class="navbar-wrapper navbar-default" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-backyard">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand site-name" href="#top"><img src="images/logo2.png" alt="logo"></a>
                    </div>

                    <div id="navbar-scroll" class="collapse navbar-collapse navbar-backyard navbar-right">
                        <ul class="nav navbar-nav">
                            <? if($connected){ ?>
                              <li><?php echo $mail; ?></li>
                            <?php } ?>
                            <li><a href="index.php">Home</a></li>
                            <li><a href="page.php?page=createlist">créer une liste</a></li>
                            <? if(!$connected){ ?>
                              <li><a href="page.php?page=register">Register</a></li>
                              <li><a href="page.php?page=login">Login</a></li>
                            <?php } ?>
                            <? if($connected){ ?>
                              <li><a href="page.php?page=displaylist">Mes listes</a></li>
                              <li><a href="page.php?page=profile">Mon profil</a></li>
                              <li><a href="engine.php?action=logout">Logout</a></li>
                            <?php } ?>


                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div id="policy">
            <div class="container">
                <div class="row">
                    <!-- /.apple devices image -->
                    <div class="col-md-10 col-md-offset-1">
        <?php
          if($run){
            include($page);
          }

        ?>
      </div></div></div></div>



        <!-- /.footer -->
        <footer id="footer">
            <div class="container">
                <div class="col-sm-4 col-sm-offset-4">
                    <!-- /.social links -->
                    <div class="social text-center">
                        <ul>
                            <li><a class="wow fadeInUp" href="https://twitter.com/"><i class="fa fa-twitter"></i></a></li>
                            <li><a class="wow fadeInUp" href="https://www.facebook.com/" data-wow-delay="0.2s"><i class="fa fa-facebook"></i></a></li>
                            <li><a class="wow fadeInUp" href="https://plus.google.com/" data-wow-delay="0.4s"><i class="fa fa-google-plus"></i></a></li>
                            <li><a class="wow fadeInUp" href="https://instagram.com/" data-wow-delay="0.6s"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                    <div class="text-center wow fadeInUp" style="font-size: 14px;">Copyright eshop</div>
                    <a href="#" class="scrollToTop"><i class="pe-7s-up-arrow pe-va"></i></a>
                </div>
            </div>
        </footer>

        <!-- /.javascript files -->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/custom.js"></script>
        <script src="js/jquery.sticky.js"></script>
        <script src="js/wow.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/ekko-lightbox-min.js"></script>
        <!-- /. Custo JS files -->
        <script src="custo/jquery-ui/jquery-ui.min.js"></script>



        <script type="text/javascript">
                  $( document ).delegate( '*[data-toggle="lightbox"]', 'click', function ( event ) {
                      event.preventDefault();
                      $( this ).ekkoLightbox();
                  } );

                  //Date Picker liste management
                  $( function() {
                    $( "#EndDate" ).datepicker();
                    $( "#EndDate" ).datepicker("option", "dateFormat", "yy-mm-dd");
                    $( "#EndDate" ).datepicker("setDate",$(this).val());
                  } );


                  var $myGroup = $('#myGroup');
                    $myGroup.on('show','.collapse', function() {
                     $myGroup.find('.collapse.in').collapse('hide');
                 });


        </script>
        <script>
            new WOW().init();
        </script>
    </body>
</html>
