<?php
$readonly = true; // True si la liste n'est pas modifiable, false si elle est modifiable
$public = false; // Si la liste est identifiée comme publique, c'est à dire que tous les détenteurs de l'adresse peuvent voir le contenu

$url = NULL;
$admin = false; // True si la page est affichée par son admin
$getVar = ""; // Nom de la variable GET qui appelle la liste . listeUrl = appelée par un participant, listeUrlAdmin par son admin
$run  = false; //Ok pour chargement de la page
$error = array(); // Contient les messages d'erreur accumulés.

$listeCat = Engine::getCategories();
$htmlListeCat = "<select name='Categorie' id='Categorie[]' class='form-control'>";
foreach ($listeCat as $category) {
  $htmlListeCat .= "<option value='".$category->getId()."'>".$category->getLabel('fr')."</option>";
}
$htmlListeCat .= "</select>";
// Vérification de l'appel.



if(isset($_GET['listeUrl'])){           // Récup de l'url de la liste
  $getVar = "url";
  if($_GET['listeUrl'] <> ""){
    $url = Securite::getField('GET','listeUrl');
  }else{
    array_push($error, "id liste manquant");
  }
}else if(isset($_GET['listeUrlAdmin'])){  // Récup de l'url si ListeAdmin
  $admin = true;
  $getVar = "admin_url";

  if($_GET['listeUrlAdmin'] <> ""){
    $url = Securite::getField('GET','listeUrlAdmin');
  }else{
    array_push($error, "id liste admin manquant");
  }

}else{                                    //Si pas de liste
  array_push($error, "Aucune liste demandée");
}



// DERNIERE VERIFICATION AVANT EXECUTION DE LA PAGE.
if($url <> NULL){

  $booListExist = Liste::isListExist($getVar,$url);    // quel que soit l'appel, on vérifie si la liste existe

  if($booListExist){    // Si la liste existe, on instancie l'objet
    $list = new Liste();
    $list = Liste::getOneList($getVar,$url);
    $arrItems = $list->getItems();
    $run = true;

  }else if(!$booListExist){     // Si la liste n'existe pas, on pousse le message d'erreur.
      array_push($error, "La liste demandée n'existe pas");
      $run = false;
  }else if($booListExist == NULL){   // S'il y a une erreur dans la récupération de la liste, BOO = NULL
      array_push($error, "Erreur, plusieurs listes semblent exister avec cet ID");
      $run = false;

  }else{            // Dans tout autre cas, message d'erreur standard.
    array_push($error, "Erreur incconue");
    $run = false;
  }

  if($run){

    if($connected ){ // Vérification de la connexion d'un ADMIN
      if($getVar == "url" && $mail == $list->getAdminEmail()){
        // SI ADMIN connecté et que le mail de l'admin = le mail d'admin de la liste
        $readOnly = false;
        $admin = true;
      }
    }
  } // FIN RUN (verif admin)



} // FIN <> URL NULL


?>


<?php if($run){ ?>
  <section id="single-page-slider" class="no-margin">
      <div class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
              <div class="item active">
                  <div class="container">
                      <div class="row">
                          <div class="col-md-12">
                              <div class="center gap fade-down section-heading">
                                  <h2 class="main-title">Update your list</h2>
                                  <hr>

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
              </div>
              <div class="row">
                  <div class="col-md-4 fade-up">
                    <!-- DEBUT INCLUDE -->
                    <h3><?php echo $list->getListeName(); ?></h3>
                    <span class="icon icon-home"></span>available until <?php echo $list->getEndDate(); ?><br/>
                    <span class="icon icon-phone">Created <?php echo $list->getCreationDate(); ?><br/>
                    <span class="icon icon-mobile"></span><?php echo $list->getDescription(); ?><br/>
                    <span class="icon icon-user"></span><?php echo $list->getAdminName(); ?><br/>
                    <br/>
                    <a class="btn btn-primary" href='page.php?page=showlist&listeUrl=<?php echo $list->getUrl(); ?>'>See</a>
                    <a class="btn btn-secondary" href='page.php?page=showlists'>Back to my lists</a>
                  </div>
                  <div class="col-md-8 fade-up">
                    <form method="POST" id="contact-form" class="form-horizontal" action="engine.php?action=saveList&refer0=updatelist&refer1=updatelist" >
                        <div class="form-group">
                            <input type="hidden" name="ListeId" id="ListeId" class="form-control" value="<?php echo $list->getIdListe(); ?>"/>
                            <input type="text" name="ListeName" id="ListName" class="form-control" value="<?php echo $list->getListeName(); ?>" placeholder="The list name" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" name="Name" id="Name" class="form-control" placeholder="Your Name" value="<?php echo $list->getAdminName(); ?>" required/>
                        </div>
                        <div class="form-group">
                          <input type="hidden" name="CurrentEndDate" class="form-control" value="<?php echo $list->getEndDate(); ?>"/>
                            <input type="text" name="EndDate" id="EndDate" class="form-control" placeholder="End date"/>
                        </div>
                        <div class="form-group">
                            <input type="mail" name="Mail" id="Mail" class="form-control" placeholder="Your mail" value="<?php echo $list->getAdminEMail(); ?>" readonly/>
                        </div>
                        <input type="hidden" name="currentEndDate" value="<?php echo Ihm::dateConvert($list->getEndDate(),"ihm"); ?>"/>
                        <div class="form-group">
                            <textarea name="Description" rows="3" cols="20" id="Description" class="form-control input-message"  placeholder="Any comment ?" required><?php echo $list->getDescription(); ?></textarea>
                        </div>
                        <!-- <div class="form-group">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="public[]" <?php //echo $list->getPublicIHM(); ?> /> Public ?
                            </label>
                          </div>
                        </div> -->
                        <div class="form-group">
                            <input type="submit" name="submit" value="Submit" class="btn btn-success" />
                        </div>
                    </form>
                  </div>
              </div>

            </div>
      </section>
      <?php if($admin){ ?>

      <?php } // END IF ADMIN?>

  </div> <!-- FIN content-wrapper -->



<?php } ?>
