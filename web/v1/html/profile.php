<?php
if($connected && $mail <> ""){

$user = new Users();
$obj = $user->getUser($mail);

?>



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



<div class="col-md-10 col-md-offset-1">

      <p>
          Profil
      </p>
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





    <div class="text-center"><a href="index.html">Back to Main Page</a></div>
</div>
<?php } ?>
