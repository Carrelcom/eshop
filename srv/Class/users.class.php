<?php
/**
 *
 */
class Users
{
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



public static function createCookies($name, $time, $value){

}



}


 ?>
