<?php

/*
PARAM INPUT
GET : listeUrl
GET : listeUrlAdmin
GET : status
GET : msg
*/

$readonly = true; // True si la liste n'est pas modifiable, false si elle est modifiable
$public = false; // Si la liste est identifiée comme publique, c'est à dire que tous les détenteurs de l'adresse peuvent voir le contenu

$url = NULL;
$admin = false; // True si la page est affichée par son admin
$getVar = ""; // Nom de la variable GET qui appelle la liste . listeUrl = appelée par un participant, listeUrlAdmin par son admin
$run  = false; //Ok pour chargement de la page
$error = array(); // Contient les messages d'erreur accumulés.
$lang = "en";

$listeCat = Engine::getCategories();
$htmlListeCat = "<select name='Categorie' id='Categorie[]' class='form-control'>";
foreach ($listeCat as $key => $category) {
  $htmlListeCat .= "<option value='".$category->getId()."'>".$category->getLabel($lang)."</option>";
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

      $arrCat = array(); // Liste des catégories
      $arrAuthor = array(); // Liste des auteurs
      foreach ($arrItems as $item){
          array_push($arrCat, $item->getItemCategoryId());
          array_push($arrAuthor, $item->getItemAuthor());
      }
      $arrCat = array_unique($arrCat);
      $arrAuthor = array_unique($arrAuthor);


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

    if($connected){ // Vérification de la connexion d'un ADMIN
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


<div id="content-wrapper">
    <section id="about-us" class="white">
        <div class="container">
            <div class="gap"></div>
            <div class="row">
                <div class="col-md-4 fade-up">
                  <div class="tile-progress tile-red bounce-in">
                      <div class="tile-header">
                        <h3><?php echo $list->getListeName(); ?></h3>
                        <span class="glyphicon glyphicon-dashboard"></span> available until <?php echo $list->getEndDate(); ?><br/>
                        <span class="glyphicon glyphicon-flag"></span> Created <?php echo $list->getCreationDate(); ?><br/>
                        <span class="glyphicon glyphicon-tags"></span> <?php echo $list->getDescription(); ?><br/>
                        <span class="glyphicon glyphicon-user"></span> <?php echo $list->getAdminName(); ?><br/>

                        <?php if($admin){ ?>
                            <a class="btn btn-primary" href='page.php?page=updatelist&listeUrlAdmin=<?php echo $list->getAdminUrl(); ?>'>modify</a>
                        <?php } ?>

                      </div>

                  </div>
                </div>
                <div class="col-md-8 fade-up">
                  <div class="tile-progress tile-red bounce-in">
                      <div class="tile-header">
                          <h3>ADD A PRODUCT</h3>
                          <?php if(isset($_GET['status'])){
                            $stat = $_GET['status'];
                            if($stat==1){
                              $type = "alert alert-success";
                            }else{
                              $type = "alert alert-danger";
                            }
                            $message = Securite::getField('GET','msg');
                            ?>
                            <div class="<?php echo $type; ?>" role="alert" id="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                              <?php echo $message; ?>
                            </div>

                          <?php } ?>
                          <form method="POST" id="contact-form" class="form-horizontal" action="engine.php?action=addItem" >
                              <div class="form-group">
                                <input type="hidden" name="Liste" id="Liste" value="<?php echo $list->getIdListe(); ?>"/>
                                <input type="hidden" name="Url" id="Url" value="<?php echo $list->getUrl(); ?>"/>
                              </div>
                              <div class="form-group">
                                  <input type="text" name="Product" id="Product" class="form-control" placeholder="Product to add" required/>
                              </div>
                              <div class="form-group">
                                  <?php echo $htmlListeCat; ?>
                              </div>
                              <div class="form-group">
                                  <input type="text" name="Quantity" id="Quantity" class="form-control" placeholder="Quantity" required/>
                              </div>
                              <div class="form-group">
                                  <input type="text" name="Author" id="Author" class="form-control" placeholder="Your name" required/>
                              </div>
                              <div class="form-group">
                                  <input type="submit" name="submit" value="Add" class="btn btn-success" />
                              </div>
                          </form>
                      </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="testimonial-list-item col-md-6">

                      <blockquote>
                        <h3>Filter by category</h3>
                        <ul class="portfolio-filter fade-down center">
                            <li><a class="btn btn-outlined btn-primary active" href="#" data-filter="*">All</a></li>
                            <?php foreach ($arrCat as $cat) { ?>
                              <li><a class="btn btn-outlined btn-primary active" href="#" data-filter=".cat-<?php echo $cat; ?>"><?php echo $listeCat[$cat]->getLabel($lang); ?></a></li>
                            <?php }?>
                        </ul><!--/#portfolio-filter-->
                      </blockquote>
                  </div>
                  <div class="testimonial-list-item col-md-6">

                      <blockquote>
                        <h3>Filter by contributor</h3>
                        <ul class="portfolio-filter fade-down center">
                            <?php foreach ($arrAuthor as $author) { ?>
                              <li><a class="btn btn-outlined btn-primary active" href="#" data-filter=".author-<?php echo Ihm::cleanString($author); ?>"><?php echo $author; ?></a></li>
                            <?php } ?>
                        </ul><!--/#portfolio-filter-->
                      </blockquote>
                  </div>
                </div>
                <div class="col-md-12">
                  <ul class="portfolio-items col-3 col-sm-12 isotope fade-up">
                    <?php
                    $currentCat = "";
                    foreach ($arrItems as $item){ ?>
                        <li class="portfolio-item <?php echo "cat-".$item->getItemCategoryId(); ?> <?php echo "author-".Ihm::cleanString($item->getItemAuthor()); ?>">
                            <div class="item-inner">
                                <h5><?php echo $item->getItemlabel(); ?> <span class="badge"><?php echo $item->getItemQty(); ?></span></h5>
                                <span class="label label-default"><?php echo $item->getItemAuthor(); ?></span>
                                <span class="label label-primary"><?php echo $listeCat[$item->getItemCategoryId()]->getLabel($lang); ?></span>

                            </div>
                        </li><!--/.portfolio-item-->

                    <?php } ?>
                  </ul>
                </div>
            </div>
          </div>
    </section>
</div>

<?php } ?>
