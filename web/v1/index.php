

<?
require_once('../../srv/Autoloader.class.php');
Autoloader::register();

if ( Utility::is_session_started() === FALSE ) session_start();
$connected = false;
$mail = "";
$labelList = "";
$disabled = "";
if(isset($_SESSION['mail'])){
  $connected = true;
  $mail = $_SESSION['mail'];
  $disabled = "disabled='disabled'";
}


?>
<!DOCTYPE html>
<html>
    <head>

        <!-- /.website title -->
        <title>Backyard Landing Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <!-- CSS Files -->
        <!-- Bootstrap files -->

        <link href="bootstrap-4.0.0-beta.2/dist/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap-4.0.0-beta.2/dist/css/bootstrap-reboot.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap-4.0.0-beta.2/dist/css/bootstrap-grid.min.css" rel="stylesheet" media="screen">


        <!-- END Bootstrap files -->
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="fonts/icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet" media="screen">
        <link href="css/owl.theme.css" rel="stylesheet">
        <link href="css/owl.carousel.css" rel="stylesheet">

        <!-- Colors
        <link href="css/css-index.css" rel="stylesheet" media="screen">-->

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

        <!-- /.preloader -->
        <div id="preloader"></div>
        <div id="top"></div>

        <!-- /.parallax full screen background image -->
        <div class="fullscreen landing parallax" >

            <div class="overlay">
                <div class="container" id="bandeauHautHome">
                    <div class="row"> <!-- ROW 1-->
                        <div class="col-md-9 col-sm-12 col-xs-12">

                            <!-- /.logo -->
                            <div class=" wow fadeInDown"> <a href=""><img src="custo/images/logo.png"/></a></div>

                            <!-- /.main title -->
                            <h1 class="wow fadeInLeft">
                                N'oubliez plus vos listes de courses
                            </h1>
                            <h2 class="wow fadeInLeft">
                                Créer une liste en 1 click
                            </h2>

                            <!-- /.header paragraph -->
                            <div class="landing-text wow fadeInUp">

                              <form method="POST" id="contact-form" class="form-horizontal" action="page.php?page=createlist" >
                                  <div class="form-group col-md-7">
                                      <input type="text" name="tempLabel" id="tempLabel" class="form-control" placeholder="What is it about..." required/>
                                  </div>

                                  <div class="form-group  col-md-3">
                                      <input type="submit" name="submit" value="I create my list" class="btn btn-primary" />
                                  </div>
                              </form>
                            </div>

                            <!-- /.header button
                            <div class="head-btn wow fadeInLeft">
                                <a href="#feature" class="btn-primary">Discover</a>
                                <a href="#download" class="btn-default">Register</a>
                            </div>
                            -->


                        </div>

                        <!-- /.signup form -->
                        <div class="col-md-3 hidden-xs hidden-sm">

                            <div class="landing wow fadeInUp">

                                <img  src="custo/images/shoppinglist.png"/>
                                <br/>
                            </div>

                        </div>
                    </div> <!-- FIN ROW 1-->
                    <div class="row"><!-- ROW 2-->
                        <div class="col-md-12 col-sm-12 col-xs-12" id="bandeauHautHome2">
                          <!-- /.feature 1 -->
                          <div class="col-sm-12 col-md-4 feat-list">
                              <i class="pe-7s-note2 pe-5x pe-va wow fadeInUp"></i>
                              <div class="inner">
                                  <h4>Créer ta liste</h4>
                                  <p class="hidden-sm hidden-xs">3 clics - 0 inscription - 0 engagement
                                  </p>
                              </div>
                          </div>

                          <!-- /.feature 2 -->
                          <div class="col-sm-12 col-md-4 feat-list">
                              <i class="pe-7s-users pe-5x pe-va wow fadeInUp" data-wow-delay="0.2s"></i>
                              <div class="inner">
                                  <h4>Partage là</h4>
                                  <p class="hidden-sm hidden-xs">Tes proches t'aident à la compléter</p>
                              </div>
                          </div>

                          <!-- /.feature 3 -->
                          <div class="col-sm-12 col-md-4 feat-list">
                              <i class="pe-7s-cart pe-5x pe-va wow fadeInUp" data-wow-delay="0.4s"></i>
                              <div class="inner">
                                  <h4>Fais tes courses</h4>
                                  <p class="hidden-sm hidden-xs">Utilise ta liste pour faire tes courses</p>
                              </div>
                          </div>
                        </div>
                    </div><!-- FIN ROW 2-->
                </div>
            </div>
        </div>

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
                        <a class="navbar-brand site-name" href="#top"><a href=""><img src="custo/images/logo2.png"/></a></a>
                    </div>

                    <div id="navbar-scroll" class="collapse navbar-collapse navbar-backyard navbar-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#about">About</a></li>
                            <li><a href="#feature">In 3 clicks</a></li>
                            <li><a href="#free">Free</a></li>
                            <li><a href="#secure">Secure</a></li>
                            <li><a href="#question">Any question</a></li>
                            <li><a href="page.php">page</a>

                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <!-- /.intro section -->
        <div id="about">
            <div class="container">
                <div class="row">

                    <!-- /.intro image -->
                    <div class="col-md-6 intro-pic wow slideInLeft">
                        <img src="images/intro-image.jpg" alt="image" class="img-responsive">
                    </div>

                    <!-- /.intro content -->
                    <div class="col-md-6 wow slideInRight">

                        <h2>Optimize performance through advanced targeting solutions</h2>
                        <p>Good marketing makes the company look smart. <a href="#">Great marketing</a> makes the customer feel smart, - Joe Chernov. Never doubt a small group of thoughtful, committed people can change the world. Indeed, it is the only thing that ever has, - Margaret Mead. The best way to predict the future is to create it, - Peter Drucker.
                        </p>

                        <div class="btn-section"><a href="#feature" class="btn-default">Learn More</a></div>

                    </div>
                </div>
            </div>
        </div>

        <!-- /.feature section -->
        <div id="feature">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 col-sm-12 text-center feature-title">

                        <!-- /.feature title -->
                        <h2>Recreate your ideas and gain more success</h2>
                        <p>Increase your user loyalty by maintaining mutual communication and nurturing your online community.</p>
                    </div>
                </div>
                <div class="row row-feat">
                    <div class="col-md-4 text-center">

                        <!-- /.feature image -->
                        <div class="feature-img">
                            <img src="images/feature-image.jpg" alt="image" class="img-responsive wow fadeInLeft">
                        </div>
                    </div>

                    <div class="col-md-8">

                        <!-- /.feature 1 -->
                        <div class="col-sm-6 feat-list">
                            <i class="pe-7s-notebook pe-5x pe-va wow fadeInUp"></i>
                            <div class="inner">
                                <h4>Marketing Strategy</h4>
                                <p>Good marketing makes the company look smart. Great marketing makes the customer feel smart.
                                </p>
                            </div>
                        </div>

                        <!-- /.feature 2 -->
                        <div class="col-sm-6 feat-list">
                            <i class="pe-7s-cash pe-5x pe-va wow fadeInUp" data-wow-delay="0.2s"></i>
                            <div class="inner">
                                <h4>App Monetization</h4>
                                <p>Content builds relationships. Relationships are built on trust. Trust drives revenue. - Andrew Davis</p>
                            </div>
                        </div>

                        <!-- /.feature 3 -->
                        <div class="col-sm-6 feat-list">
                            <i class="pe-7s-cart pe-5x pe-va wow fadeInUp" data-wow-delay="0.4s"></i>
                            <div class="inner">
                                <h4>Store Optimization</h4>
                                <p>Never doubt a small group of thoughtful, committed people can change the world. Indeed, it is the only thing that ever has.</p>
                            </div>
                        </div>

                        <!-- /.feature 4 -->
                        <div class="col-sm-6 feat-list">
                            <i class="pe-7s-users pe-5x pe-va wow fadeInUp" data-wow-delay="0.6s"></i>
                            <div class="inner">
                                <h4>User Management</h4>
                                <p>Instead of using technology to automate processes, think about using technology to enhance human interaction.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- /.feature 2 section -->
        <div id="free">
            <div class="container">
                <div class="row">

                    <!-- /.feature content -->
                    <div class="col-md-6 wow fadeInLeft">
                        <h2>Learn how to make your app marketing efficient</h2>
                        <p>Good marketing makes the company look smart. <span class="highlight">Great marketing</span> makes the customer feel smart, - Joe Chernov. Never doubt a small group of thoughtful, committed people can change the world. Indeed, it is the only thing that ever has, - Margaret Mead. The best way to predict the future is to create it, - Peter Drucker.
                        </p>

                        <div class="btn-section"><a href="#download" class="btn-default">Download Now</a></div>

                    </div>

                    <!-- /.feature image -->
                    <div class="col-md-6 feature-2-pic wow fadeInRight">
                        <img src="images/feature2-image.jpg" alt="macbook" class="img-responsive">
                    </div>
                </div>

            </div>
        </div>


        <!-- /.download section -->
        <div id="secure">
            <div class="action fullscreen parallax" style="background-image:url('images/bg.jpg');" data-img-width="2000" data-img-height="1333" data-diff="100">
                <div class="overlay">
                    <div class="container">
                        <div class="col-md-8 col-md-offset-2 col-sm-12 text-center">

                            <!-- /.download title -->
                            <h2 class="wow fadeInRight">Would like to know more?</h2>
                            <p class="download-text wow fadeInLeft">We'll research the market, identify the right target audience, analyze competitors and avoid users churn to increase retention. Download now for free and join with thousands happy clients.</p>

                            <!-- /.download button -->
                            <div class="download-cta wow fadeInLeft">
                                <a href="#contact" class="btn-secondary">Get Connected</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- /.contact section -->
        <div id="contact">
            <div class="contact fullscreen parallax" style="background-image:url('images/bg.jpg');" data-img-width="2000" data-img-height="1334" data-diff="100">
                <div class="overlay">
                    <div class="container">
                        <div class="row contact-row">

                            <!-- /.address and contact -->
                            <div class="col-sm-5 contact-left wow fadeInUp">
                                <h2><span class="highlight">Get</span> in touch</h2>
                                <ul class="ul-address">
                                    <li><i class="pe-7s-map-marker"></i>1600 Amphitheatre Parkway, Mountain View</br>
                                        California 55000
                                    </li>
                                    <li><i class="pe-7s-phone"></i>+1 (123) 456-7890</br>
                                        +2 (123) 456-7890
                                    </li>
                                    <li><i class="pe-7s-mail"></i><a href="mailto:info@yoursite.com">info@yoursite.com</a></li>
                                    <li><i class="pe-7s-look"></i><a href="#">www.yoursite.com</a></li>
                                </ul>

                            </div>

                            <!-- /.contact form -->
                            <div class="col-sm-7 contact-right">
                                <form method="POST" id="contact-form" class="form-horizontal" action="contactengine.php" >
                                    <div class="form-group">
                                        <input type="text" name="Name" id="Name" class="form-control wow fadeInUp" placeholder="Name" required/>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="Email" id="Email" class="form-control wow fadeInUp" placeholder="Email" required/>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="Message" rows="20" cols="20" id="Message" class="form-control input-message wow fadeInUp"  placeholder="Message" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="submit" value="Submit" class="btn btn-success wow fadeInUp" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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


        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="bootstrap-4.0.0-beta.2/assets/js/vendor/jquery.min.js"><\/script>')</script>

        <!-- /.javascript files -->

        <script src="bootstrap-4.0.0-beta.2/assets/js/vendor/popper.min.js"></script>
        <script src="bootstrap-4.0.0-beta.2/dist/js/bootstrap.min.js"></script>

        <script src="js/custom.js"></script>
        <script src="js/jquery.sticky.js"></script>
        <script src="js/wow.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script>
            new WOW().init();
        </script>
    </body>
</html>
