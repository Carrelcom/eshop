<?php
/**
 *
 */
class Users
{

private $id;
private $mail;
private $pwd;
private $nickname;
private $datecreation;


    /**
     * Get the value of Mail
     *
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set the value of Mail
     *
     * @param mixed mail
     *
     * @return self
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get the value of Pwd
     *
     * @return mixed
     */
    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * Set the value of Pwd
     *
     * @param mixed pwd
     *
     * @return self
     */
    public function setPwd($pwd)
    {
        $this->pwd = $pwd;

        return $this;
    }

    /**
     * Get the value of Nickname
     *
     * @return mixed
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Set the value of Nickname
     *
     * @param mixed nickname
     *
     * @return self
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * Get the value of Datecreation
     *
     * @return mixed
     */
    public function getDatecreation()
    {
        return $this->datecreation;
    }

    /**
     * Set the value of Datecreation
     *
     * @param mixed datecreation
     *
     * @return self
     */
    public function setDatecreation($datecreation)
    {
        $this->datecreation = $datecreation;

        return $this;
    }


/**
* Inscription
*
*/
public function register(){
  $db = db::getConnexion();


  $liste = $db->users()->insert(array(
      "mail"      => strtolower($this->mail),
      "nickname"  => $this->nickname,
      "pwd"       => Securite::hashpwd1($this->pwd)
    ));
  echo $liste;
  }



  /**
  * Update USER
  *
  */
  public function update($currentMail){
    $row = NULL;
    $result = new Result();

    if(self::checkMail($this->mail) == false){
      $db = db::getConnexion();
      $listesUpdated = Liste::updateMultipleListes("mail_admin", $currentMail,$this->mail);

      if($listesUpdated){ // SI LA MISE A JOUR DES LISTES EST OK
        $user = $db->users[$this->id];
        $user["mail"] = $this->mail;
        $user["nickname"] = $this->nickname;

        $row = $user->update(); // MAJ DE LA TABLE USER
      }else{ // SINON EXECUTION DE LA MAJ ARRIERE DES LISTES POUR RECUPERER LES LISTES QUI AURAIENT ETE MAJ.
        Liste::updateMultipleListes("mail_admin", $this->mail, $currentMail);
      }

      if($row > 0){ // SI LA MISE A JOUR DES TABLES LISTES ET USER EST OK
        $result->setStatus(true);
        $result->setParams("msg","update-user-ok");
        session_start();
        $_SESSION['mail'] = $this->mail;
      }else{
        $result->setStatus(false);
        $result->setParams("msg","update-user-ko");
        //$result->setParams("listeUrl",$url );
      }

    }else{
      $result->setStatus(false);
      $result->setParams("msg","Mail existe deja dans la base");
    }


    return $result;

    }

  /**
  * Login
  *
  */
  public static function login($mail, $pwd){
    $mail = strtolower($mail);
    $db = db::getConnexion();
    $pwd = Securite::hashpwd1($pwd);
    $users = $db->users->where("mail = ? AND pwd = ?", $mail, $pwd);

    $nbval = count($users);

    if($nbval==1){

      session_start();
      $_SESSION['mail'] = $mail;
      $booReturn = true;
      $msgReturn = "OK";
    }else if($nbval == 0){
      $booReturn = false;
      $msgReturn = "KO";
    }else{
      $booReturn = false;
      $msgReturn = "ERROR";
    }
    return array($booReturn, $msgReturn);
}

/*
* Fonction de déconnexion
*
*/
public static function logout(){
  session_start();

  // Suppression des variables de session et de la session
  $_SESSION = array();
  $booReturn = session_destroy();

  // Suppression des cookies de connexion automatique
  setcookie('login', '');
  setcookie('pass_hache', '');

  return  $booReturn;
}


/**
* Récupération d'un utilisateur en fonction du mail
*
*/
public static function getUser($mail){

  $db = db::getConnexion();

  $obj = new Users();
  $rq = null;
  $rq = $db->users("mail", $mail);

  foreach ($rq as $user) {
    $obj->setId($user['id']);
    $obj->setNickname($user['nickname']);
    $obj->setMail($user['mail']);
    $obj->setDatecreation($user['date_inscription']);

  }

  return $obj;

}
/**
* Verifie si le mail en param est déjà dans la table user.
*
*/
public static function checkMail($mail){

  $db = db::getConnexion();
  if(count($db->users("mail", $mail))==1){
    return true;
  }else{
    return false;
  }
}



    /**
     * Get the value of Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of Id
     *
     * @param mixed id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

}


 ?>
