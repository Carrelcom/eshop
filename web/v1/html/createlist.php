<?php
$labelList = "";

if(isset($_POST['tempLabel'])){
  if($_POST['tempLabel'] <> ""){
      $labelList = $_POST['tempLabel'];
  }
}


 ?>
<!-- MESSAGE ALERT -->
 <?php if(isset($_GET['status'])){
   $stat = $_GET['status'];
   if($stat==1){
     $type = "alert alert-success";
     $message = "Traitement réalisé avec succés";
   }else{
     $type = "alert alert-danger";
     $message = "Erreur dans le traitement";
   }
   ?>

   <div class="<?php echo $type; ?>" role="alert">
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
     <span aria-hidden="true">&times;</span>
   </button>
     <?php echo $message; ?>
   </div>

 <?php } ?>
<!-- FIN MESSAGE ALERT -->

      <form method="POST" id="contact-form" class="form-horizontal" action="engine.php?action=saveList&refer0=createlist&refer1=listeManagement">

          <div class="form-group">
              <input type="text" name="ListeName" id="ListName" class="form-control" value="<?php echo $labelList; ?>" placeholder="The list name" />
          </div>
          <div class="form-group">
              <input type="text" name="Name" id="Name" class="form-control" placeholder="Your Name" />
          </div>
          <div class="form-group">
              <input type="mail" name="Mail" id="Mail" class="form-control" placeholder="Your mail" value="<?php echo $mail; ?>" <?php echo $disabled; ?> />
          </div>
          <div class="form-group">
              <input type="text" name="EndDate" id="EndDate" class="form-control" placeholder="Available until ..." />
          </div>
          <div class="form-group">
              <textarea name="Description" rows="20" cols="20" id="Description" class="form-control input-message"  placeholder="Any comment ?" ></textarea>
          </div>
          <!-- <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="public[]"> Public ?
              </label>
            </div>
          </div> -->
          <div class="form-group">
              <input type="submit" name="submit" value="Submit" class="btn btn-success" />
          </div>
      </form>
