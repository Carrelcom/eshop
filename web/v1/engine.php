<?php
// CHARGEMENT DES CLASSES
require_once('../../srv/Autoloader.class.php');
Autoloader::register();


// ACTION A REALISER
$act = Null;
if(isset($_GET['action'])){
  if($_GET['action'] <> Null || $_GET['action'] <> ""){
    $act = Securite::getField('GET','action');
  }
}


switch ($act) {
  case 'createList':
    Engine::saveOneListe();
    break;
  case 'addItem';
    Engine::addItemToListe();
  break;
  case 'register';
    Engine::register();
  break;
  case 'login';
    Engine::login();
  break;
  case 'logout';
    Engine::logout();
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
public static function GetListes($arr)
{
  return Liste::getAllliste($arr);
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
    $url = $liste->saveListe();


    Utility::redirect("displayOneListe", array("listUrl" => $url) );
    //header('location:page.php?page=displayOneListe&listUrl='.$url);
  }

  public static function addItemToListe(){
    $item  = new Item();
    $item->setItemlabel(Securite::getField('POST','Product'));
    $item->setItemQty(Securite::getField('POST','Quantity'));
    $item->setItemCategoryId(Securite::getSelect('POST','Categorie', null));
    $item->setItemListeId(Securite::getField('POST','Liste'));

    $item->saveItem();
    $url = Securite::getField('POST','Url');
    Utility::redirect("displayOneListe", array("listUrl" => $url) );

  }

  /**
  *  Inscription
  */
  public static function register(){

    $pwd1 = Securite::getField('POST','Pwd1');
    $pwd2 = Securite::getField('POST','Pwd2');


    if($pwd1 == $pwd2){
      $user = new Users();

      $user->setMail(Securite::getField('POST','Mail'));
      $user->setPwd(Securite::getField('POST','Pwd1'));
      $user->setNickName(Securite::getField('POST','Nickname'));

      $user->register();
    }
      Utility::redirect("register", null);
  }

  // LOGIN
  public static function login(){

    $mail = Securite::getField('POST','Mail');
    $pwd = Securite::getField('POST','Pwd');

    $ret = Users::login($mail,$pwd);
    if($ret[0]){
      echo $ret[1];
    }else{
      echo $ret[1];
    }
    Utility::redirect("displaylist", null);
  }

  public static function logout(){
    $ret = Users::logout();
    if($ret[0]){
      echo $ret[1];
    }else{
      echo $ret[1];
    }
    Utility::redirect("displaylist", null);
  }

}



 ?>
