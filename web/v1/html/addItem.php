
<?php
$listeCat = Engine::getCategorie();
$htmlListeCat = "<select name='Categorie' id='Categorie[]' class='form-control'>";
foreach ($listeCat as $category) {
  $htmlListeCat .= "<option value='".$category->getId()."'>".$category->getLabel('fr')."</option>";
}
$htmlListeCat .= "</select>";




 ?>


<!-- /.apple devices image -->
<div class="col-md-10 col-md-offset-1">
    <p>
        <ul>
          <li>Liste *NOM DE LA LISTE*</li>
          <li>Cr&eacute;&eacute;e par *NOM DU CREATEUR*</li>
          <li>le *DATE DE CREATION*</li>
          <li>Date d'&eacute;ch&eacute;ance *DATE D'ECHEANCE*</li>
        </ul>
    </p>
    <form method="POST" id="contact-form" class="form-horizontal" action="engine.php?action=addItem" >
        <div class="form-group">
          <?php echo $htmlListeList; ?>
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
