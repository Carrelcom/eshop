<?php
if($connected && $mail <> ""){

$user = new Users();
$obj = $user->getUser($mail);

?>



<section id="single-page-slider" class="no-margin">
    <div class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="center gap fade-down section-heading">
                                <h2 class="main-title">My profile</h2>
                                <hr>
                                <?php if(isset($_GET['status'])){
                                  $stat = $_GET['status'];
                                  if($stat==1){
                                    $type = "alert alert-success";
                                  }else{
                                    $type = "alert alert-danger";
                                  }
                                  $message = Securite::getField('GET','msg');
                                  ?>
                                  <div class="<?php echo $type; ?>" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                    <?php echo $message; ?>
                                  </div>

                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.item-->
        </div><!--/.carousel-inner-->
    </div><!--/.carousel-->
</section><!--/#main-slider-->

<div id="content-wrapper">
    <section id="about-us" class="white">
        <div class="container">
            <div class="gap"></div>
            <div class="row">
                <div class="col-md-12 fade-up">
<!-- DEBUT INCLUDE -->

<form method="POST" id="contact-form" class="form-horizontal" action="engine.php?action=updateUser" >
      <input type="hidden" name="idUser" id="idUser" value="<?php echo $obj->getId(); ?>" />
      <input type="hidden" name="currentMail" id="currentMail" value="<?php echo $obj->getMail(); ?>" />
    <div class="form-group">
        <input type="text" name="Mail" id="Mail" value="<?php echo $obj->getMail(); ?>" class="form-control" placeholder="Your email" required/>
    </div>
    <div class="form-group">
        <input type="text" name="Nickname" id="Nickname" value="<?php echo $obj->getNickname(); ?>"  class="form-control" placeholder="public name" required/>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" value="Add" class="btn btn-success" />
    </div>
</form>





<form method="POST" id="contact-form" class="form-horizontal" action="engine.php?action=updatePassword" >

    <div class="form-group">
        <input type="password" name="Pwd1" id="Pwd1" class="form-control" placeholder="Password" required/>
    </div>
    <div class="form-group">
        <input type="password" name="Pwd2" id="Pwd2" class="form-control" placeholder="verify your password" required/>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" value="Add" class="btn btn-success" />
    </div>
</form>


<!-- FIN INCLUDE -->
                </div>
            </div>
          </div>
    </section>
</div>

<?php } ?>
