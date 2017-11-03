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


if(isset($_GET['listeUrl'])){
  $getVar = "url";
  if($_GET['listeUrl'] <> ""){
    $url = Securite::getField('GET','listeUrl');
  }else{
    array_push($error, "id liste manquant");
  }

}else if(isset($_GET['listeUrlAdmin'])){
  $admin = true;
  $getVar = "admin_url";

  if($_GET['listeUrlAdmin'] <> ""){
    $url = Securite::getField('GET','listeUrlAdmin');
  }else{
    array_push($error, "id liste admin manquant");
  }

}else{
  array_push($error, "Aucune liste demandée");
}


if($url <> NULL){

  // quel que soit l'appel, on vérifie si la liste existe

  $booListExist = Liste::isListExist($getVar,$url);

  if($booListExist){
    $list = new Liste();
    $list = Liste::getOneList($getVar,$url);
    $arrItems = $list->getItems();
    $run = true;

  }else if(!$booListExist){
      array_push($error, "La liste demandée n'existe pas");
      $run = false;
  }else if($booListExist == NULL){
      array_push($error, "Erreur, plusieurs listes semblent exister avec cet ID");
      $run = false;

  }else{
    array_push($error, "Erreur incconue");
    $run = false;
  }



  // Vérification de la connexion d'un ADMIN

  if($run){

    if($connected ){
      if($getVar == "url" && $mail == $list->getAdminEmail()){
        // SI ADMIN connecté et que le mail de l'admin = le mail d'admin de la liste
        $readOnly = false;
        $admin = true;
      }
    }
  }



}
// FIN TRAITEMENT
?>

<?php if($run){ ?>

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



<div class="col-md-5">


<p>

      <h3><?php echo $list->getListeName(); ?></h3>
      <p>available until <?php echo $list->getEndDate(); ?></p>
      <p>Created <?php echo $list->getCreationDate(); ?></p>
      <p class="justified"><?php echo $list->getDescription(); ?></p>


</p>
<?php if($admin){ ?>
  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse-modify-list" aria-expanded="false" aria-controls="collapse-modify-list">
    Modify the list
  </button>
<?php } ?>
</div>
<div class="col-md-7">
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

<div class="col-md-12">

<?php if($admin){ ?>


  <div class="collapse" id="collapse-modify-list">
    <div class="card card-block">
      <form method="POST" id="contact-form" class="form-horizontal" action="engine.php?action=saveList&refer0=listeManagement&refer1=listeManagement" >
          <div class="form-group">
              <input type="hidden" name="ListeId" id="ListeId" class="form-control" value="<?php echo $list->getIdListe(); ?>"/>
              <input type="text" name="ListeName" id="ListName" class="form-control" value="<?php echo $list->getListeName(); ?>" placeholder="The list name" required/>
          </div>
          <div class="form-group">
              <input type="text" name="Name" id="Name" class="form-control" placeholder="Your Name" value="<?php echo $list->getAdminName(); ?>" required/>
          </div>
          <div class="form-group">
              <input type="text" name="EndDate" id="EndDate" class="form-control" value="16 09 14" required/>
          </div>
          <div class="form-group">
              <input type="mail" name="Mail" id="Mail" class="form-control" placeholder="Your mail" value="<?php echo $list->getAdminEMail(); ?>" readonly/>
          </div>
          <input type="hidden" name="currentEndDate" value="<?php echo Ihm::dateConvert($list->getEndDate(),"ihm"); ?>"/>
          <div class="form-group">
              <textarea name="Description" rows="20" cols="20" id="Description" class="form-control input-message"  placeholder="Any comment ?" required><?php echo $list->getDescription(); ?></textarea>
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
<?php } // END IF ADMIN?>

<div class="table-responsive">
  <table class="table table-hover">

    <?php
      $currentCat = "";
      foreach ($arrItems as $item){

        if($currentCat <> $item->getItemCategoryId()){
          echo "<tr>";
          echo "<td colspan = '4'><h3>cat ".$item->getItemCategoryId()."</h3></td>";
          echo "</tr>";
          $currentCat = $item->getItemCategoryId();
        }
        echo "<tr>";
        echo "<td>".$item->getItemlabel()."</td>";
        echo "<td>".$item->getItemQty()."</td>";
        echo "<td><small><i>".$item->getItemAuthor()."</i></small></td>";
        if($admin){
          echo "<td><a href='engine.php?action=delItem&url=".$list->getUrl()."&iditem=".$item->getItemId()."'> X </a></td>";
        }else{
          echo "<td></td>";
        }

        echo "<tr>";
      }
    ?>
    </table>
  </div>





    <div class="text-center"><a href="index.html">Back to Main Page</a></div>
</div>


<?php
}else{
  echo "<h3>Erreur</h3>";
  foreach($error as $message){
    echo $message ."<br/>";
  }
} ?>
