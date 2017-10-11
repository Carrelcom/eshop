<?php
$display = false;

if(isset($_GET['listUrl'])){
  $url = $_GET['listUrl'];

  if($_GET['listUrl'] <> NULL){

    $booListExist = Liste::isListExist('url',$url);


    if(!$booListExist){
      echo "LA LISTE N'EXISTE PAS";
    }else if($booListExist == NULL){
      echo "ERROR, ID MULTIPLE";
    }else{

      $list = new Liste();
      $list = Liste::getOneList('url',$url);
      $arrItems = $list->getItems();
      $display = true;
    }
  }
}

$listeCat = Engine::getCategorie();
$htmlListeCat = "<select name='Categorie' id='Categorie[]' class='form-control'>";
foreach ($listeCat as $category) {
  $htmlListeCat .= "<option value='".$category->getId()."'>".$category->getLabel('fr')."</option>";
}
$htmlListeCat .= "</select>";

?>

<?php //if($display){ ?>

<div class="col-md-10 col-md-offset-1">
    <p>
        <ul>
          <li><?php echo $list->getListeName(); ?></li>
          <li>available until <?php echo $list->getEndDate(); ?></li>
          <li>Created <?php echo $list->getCreationDate(); ?></li>
          <li><?php echo $list->getDescription(); ?></li>
          <li><?php echo $list->getPublic(); ?></li>
        </ul>
    </p>

    <?php
      foreach ($arrItems as $item){
        echo $item->getItemlabel()."<br/>";
      }
    ?>

    <form method="POST" id="contact-form" class="form-horizontal" action="engine.php?action=addItem" onSubmit="alert( 'Thank you for your feedback!' );">
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
            <input type="submit" name="submit" value="Add" class="btn btn-success" />
        </div>
    </form>

    <div class="text-center"><a href="index.html">Back to Main Page</a></div>
</div>


<?php //} ?>
