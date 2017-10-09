<?php
// CHARGEMENT DES CLASSES
require_once('../../srv/Autoloader.class.php');
Autoloader::register();


// ACTION A REALISER
$act = Null;
if(isset($_GET['action'])){
  echo "ACTION est set";
  if($_GET['action'] <> Null || $_GET['action'] <> ""){
    echo "ACTION est non null et non vide";
    $act = Securite::getField('GET','action');
    echo "act : [".$act."]";
  }
}


switch ($act) {
  case 'createList':
    Engine::saveOneListe();
    break;
  case 'addItem';
    Engine::addItemToListe();
  break;


  default:
    # code...
    break;
}


/**
 *
 */
class Engine
{

public static function test(){
  echo "test ok";
}

// Récupérere toutes les listes
public static function GetListes()
{
  return Liste::getAllliste(NULL);
}

// Récupère toutes les catégories
public static function getCategorie(){
  return Category::getCategories();
}

  //Enregistrer une liste
  public static function saveOneListe(){

    $liste = new Liste();

    $liste->setIdListe(NULL);
    $liste->setListeName(Securite::getField('POST','ListeName'));
    $liste->setAdminName(Securite::getField('POST','Name'));
    $liste->setAdminEmail(Securite::getField('POST','Mail'));
    $liste->setEndDate(Securite::getField('POST','Date'));
    $liste->setDescription(Securite::getField('POST','Description'));
    $liste->setPublic(Securite::getCheckbox(true,'POST','public'));


    $liste->saveListe();

  }

  public static function addItemToListe(){
    $item  = new Item();
    $item->setItemlabel(Securite::getField('POST','Product'));
    $item->setItemQty(Securite::getField('POST','Quantity'));
    $item->setItemCategoryId(Securite::getSelect('POST','Categorie', null));
    $item->setItemListeId(Securite::getField('POST','Liste'));

    $item->saveItem();
    

  }

}



 ?>
