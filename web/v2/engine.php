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
  case 'saveList':
    Engine::saveList();
    break;
  case 'addItem';
    Engine::addItemToListe();
  break;
  case 'delItem';
    Engine::deleteItemFromListe();
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
  case 'updateUser';
    Engine::updateUser();
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
public static function getCategories(){
  return Category::getCategories();
}

public static function getUser($mail){
  return Users::getUser($mail);
}

//Enregistrer une liste
public static function saveList(){

  if(isset($_GET['refer0'])){   $referFail = Securite::getField('GET','refer0');  }
  if(isset($_GET['refer1'])){   $referSuccess = Securite::getField('GET','refer1'); }

  $liste = new Liste();

  if(isset($_POST['ListeId'])){
       $liste->setIdListe(Securite::getField('POST','ListeId'));
       if(Securite::getField('POST','EndDate') == ""){
         $liste->setEndDate(new DateTime(Securite::getField('POST','CurrentEndDate')));
       }else{
         $liste->setEndDate(new DateTime(Securite::getField('POST','EndDate')));
       }

  }else{
    $liste->setIdListe(NULL);
    $liste->setEndDate(new DateTime(Securite::getField('POST','EndDate')));
  }

  $liste->setListeName(Securite::getField('POST','ListeName'));
  $liste->setAdminName(Securite::getField('POST','Name'));
  $liste->setAdminEmail(Securite::getField('POST','Mail'));
  $liste->setEndDate(new DateTime(Securite::getField('POST','EndDate')));
  $liste->setDescription(Securite::getField('POST','Description'));
  $liste->setPublic(Securite::getCheckbox(true,'POST','public'));

  $result = $liste->saveListe();

  if($result->getStatus()){
      Utility::redirect($referSuccess, $result->getStatusToString().$result->getParams());
  }else{
      Utility::redirect($referFail,  $result->getStatusToString().$result->getParams());
  }



}

/**
* Ajouter un composant à la liste
*
*/
public static function addItemToListe(){
  $item  = new Item();
  $item->setItemlabel(Securite::getField('POST','Product'));
  $item->setItemQty(Securite::getField('POST','Quantity'));
  $item->setItemCategoryId(Securite::getSelect('POST','Categorie', null));
  $item->setItemListeId(Securite::getField('POST','Liste'));
  $item->setItemAuthor(Securite::getField('POST','Author'));

  $result = $item->saveItem();

  $result->setParams("listeUrl",Securite::getField('POST','Url'));

  Utility::redirect("showlist", $result->getStatusToString().$result->getParams() );

}


public static function deleteItemFromListe(){

  $item = new Item();
  $item->setItemId(Securite::getField('GET','iditem'));
  $result = $item->deleteItem();
  $result->setParams("listeUrl",Securite::getField('GET','url'));

  Utility::redirect("listeManagement", $result->getStatusToString().$result->getParams() );
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
  Utility::redirect("showlists", null);
}

/**
* Unlog
*
*/
public static function logout(){
  $ret = Users::logout();
  if($ret[0]){
    echo $ret[1];
  }else{
    echo $ret[1];
  }
  Utility::redirect("index", null);
}


/**
* Mise à jour d'un user hors Mdp
*
*
*/
public static function updateUser(){
  $currentMail = Securite::getField('POST','currentMail');

  $user = new Users();
  $user->setId(Securite::getField('POST','idUser'));
  $user->setNickname(Securite::getField('POST','Nickname'));
  $user->setmail(Securite::getField('POST','Mail'));
  $result = $user->update($currentMail);
  Utility::redirect("profile", $result->getStatusToString().$result->getParams());

}



}



 ?>
