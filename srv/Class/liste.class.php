
<?php

/**
 * Classe métier Liste
 */
class Liste
{
  private $idListe;
  private $listeName;
  private $adminName;
  private $adminEmail;
  private $endDate;
  private $creationDate;
  private $public;
  private $description ;
  private $url;
  private $adminUrl;

  /**
   * Get the value of Admin Url
   *
   * @return mixed
   */
  public function getAdminUrl()
  {
      return $this->adminUrl;
  }

  /**
   * Set the value of Admin Url
   *
   * @param mixed AdminUrl
   *
   * @return self
   */
  public function setAdminUrl($adminUrl)
  {
      $this->adminUrl = $adminUrl;

      return $this;
  }
    /**
     * Get the value of Liste Name
     *
     * @return mixed
     */
    public function getListeName()
    {
        return $this->listeName;
    }

    /**
     * Set the value of Liste Name
     *
     * @param mixed listeName
     *
     * @return self
     */
    public function setListeName($listeName)
    {
        $this->listeName = $listeName;

        return $this;
    }

    /**
     * Get the value of Admin Name
     *
     * @return mixed
     */
    public function getAdminName()
    {
        return $this->adminName;
    }

    /**
     * Set the value of Admin Name
     *
     * @param mixed adminName
     *
     * @return self
     */
    public function setAdminName($adminName)
    {
        $this->adminName = $adminName;

        return $this;
    }

    /**
     * Get the value of Admin Email
     *
     * @return mixed
     */
    public function getAdminEmail()
    {
        return $this->adminEmail;
    }

    /**
     * Set the value of Admin Email
     *
     * @param mixed adminEmail
     *
     * @return self
     */
    public function setAdminEmail($adminEmail)
    {
        $this->adminEmail = $adminEmail;

        return $this;
    }

    /**
     * Get the value of End Date
     *
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set the value of End Date
     *
     * @param mixed endDate
     *
     * @return self
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get the value of Creation Date
     *
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set the value of Creation Date
     *
     * @param mixed creationDate
     *
     * @return self
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get the value of Public
     *
     * @return mixed
     */
    public function getPublic()
    {
        return $this->public;
    }

    /**
    * Get The value of PUblic for Html Form
    *
    */
    public function getPublicIHM(){
      if ($this->public == 1){
        return "checked";
      }else{
        return "";
      }
    }



    /**
     * Set the value of Public
     *
     * @param mixed public
     *
     * @return self
     */
    public function setPublic($public)
    {
        $this->public = $public;

        return $this;
    }

    /**
     * Get the value of Description
     *
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of Description
     *
     * @param mixed description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }


    /**
     * Get the value of Id Liste
     *
     * @return mixed
     */
    public function getIdListe()
    {
        return $this->idListe;
    }

    /**
     * Set the value of Id Liste
     *
     * @param mixed idListe
     *
     * @return self
     */
    public function setIdListe($idListe)
    {
        $this->idListe = $idListe;

        return $this;
    }

    /**
     * Get the value of Url
     *
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set the value of Url
     *
     * @param mixed url
     *
     * @return self
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

/**
* Enregistrement d'une nouvelle liste.
**/
    public function saveListe(){

      $url = NULL;
      $result = new Result();


      if($this->checkMandatoryFields() == true){

        $db = db::getConnexion();

        // SI ID NULL --> INSERT
        if($this->idListe == NULL){
          //echo "url";
          //echo "end date [".$this->endDate->format('Y-m-d H:i:s')."]";
          //$date->format('Y-m-d H:i:s');
          $url = Utility::generateUniqueUrl($this->adminEmail, $this->listeName, $this->endDate->format('Y-m-d H:i:s'));
          //echo "urladmin";
          $urlAdmin = Utility::generateUniqueUrl($this->listeName, $this->adminEmail,"admin");

          $row = $db->listes()->insert(array(
            "id" => $this->idListe,
            "label" =>   $this->listeName,
            "mail_admin" => $this->adminEmail,
            "nom_admin" => $this->adminName,
          	"date_echeance" => $this->endDate,
            "public" => $this->public,
            "commentaires" => $this->description,
            "url" => $url,
            "admin_url" => $urlAdmin
          ));

        }else{

          $liste = $db->listes[$this->idListe];
          $url = $liste["url"];

          $liste["label"] = $this->listeName;
          $liste["nom_admin"] = $this->adminName;
          $liste["date_echeance"] = $this->endDate->format("Y-m-d H:i:s");
          $liste["commentaires"] = $this->description;

          $row = $liste->update();
        }


        if($row > 0){
          $result->setStatus(true);
          $result->setParams("msg","enregistrement-liste-ok");
          $result->setParams("listeUrl",$url );
        }else{
          $result->setStatus(false);
          $result->setParams("msg","enregistrement-liste-ko");
          $result->setParams("listeUrl",$url );
        }


      }else{
        foreach ($this->checkMandatoryFields() as $value) {
          $result->setParams('msg',$value);
        }

        $result->setStatus(false);


      }

      return $result;

    }



    // Get all items of current liste
    // return items arr
    public function getItems(){
      return Item::getItemsFromListe($this->idListe);
    }


    // Retourne une liste de listes
    public static function getAllListe($filter){

      $listes = null;
      $db = db::getConnexion();

      if($filter === NULL){
        $listes = $db->listes();
      }else{
          $listes = $db->listes($filter)->order("date_creation DESC");
      }

      $arrlistes = array();

      foreach ($listes as $liste) {
        $objliste = new Liste();
        $objliste->setListeName($liste['label']);
        $objliste->setAdminName($liste['nom_admin']);
        $objliste->setAdminEmail($liste['mail_admin']);
        $objliste->setEndDate($liste['date_echeance']);
        $objliste->setCreationDate($liste['date_creation']);
        $objliste->setPublic($liste['public']);
        $objliste->setDescription($liste['commentaires']);
        $objliste->setIdListe($liste['id']);
        $objliste->setUrl($liste['url']);
        $objliste->setAdminUrl($liste['admin_url']);
        array_push($arrlistes,$objliste);
      }

      return $arrlistes;


    }

    /**
    * Get One list why ID
    * Return Obj liste
    */
    public static function getOneList($type,$val){

      $db = db::getConnexion();
      $arrlistes = array();
      $objliste = new Liste();
      $rq = null;

      $rq = $db->listes($type, $val);

      foreach ($rq as $liste) {

        $objliste->setListeName($liste['label']);
        $objliste->setAdminName($liste['nom_admin']);
        $objliste->setAdminEmail($liste['mail_admin']);
        $objliste->setEndDate($liste['date_echeance']);
        $objliste->setCreationDate($liste['date_creation']);
        $objliste->setPublic($liste['public']);
        $objliste->setDescription($liste['commentaires']);
        $objliste->setIdListe($liste['id']);
        $objliste->setUrl($liste['url']);
        $objliste->setAdminUrl($liste['admin_url']);

      }
      return $objliste;
    }


    /*
    * Check if the list exists or not
    * Return true if  exists
    * Return false if not exists
    * Return NULL if error (nb val > 1 for an unique ID)
    */
    public static function isListExist($type,$val){

      $db = db::getConnexion();
      $nbVal = Null;
      $nbVal = count($db->listes($type, $val));

      $retVal = Null;

      if($nbVal == 1){
        $retVal = true;
      }else if($nbVal == 0){
        $retVal = false;
      }

      return $retVal;
    }

/**
* Vérifie la présence de tous les champs obligatoires.
*
*/
public function checkMandatoryFields(){

  $message = array();

  if($this->listeName == "" || $this->listeName == NULL){
    array_push($message, "Merci de préciser un nom pour cette liste");
  }
  if($this->adminName == "" || $this->adminName == NULL){
    array_push($message, "Merci de préciser votre nom");
  }
  if($this->adminEmail == "" || $this->adminEmail == NULL){
    array_push($message, "Merci de préciser votre email");
  }


  if(count($message)>0){
      return $message;
  }else{
      return true;
  }


}
/**
* Vérifie la présence de tous les champs obligatoires.
*
*/
public function checkMandatoryFieldsCreation(){

  $message = array();

  if($this->listeName == "" || $this->listeName == NULL){
    array_push($message, "Merci de préciser un nom pour cette liste");
  }
  if($this->adminName == "" || $this->adminName == NULL){
    array_push($message, "Merci de préciser votre nom");
  }
  if($this->adminEmail == "" || $this->adminEmail == NULL){
    array_push($message, "Merci de préciser votre email");
  }


  if(count($message)>0){
      return $message;
  }else{
      return false;
  }


}



/**
* Vérifie la présence de tous les champs obligatoires.
*
*/
public function checkMandatoryFieldsUpdate(){

  $message = array();

  if($this->listeName == "" || $this->listeName == NULL){
    array_push($message, "Merci de préciser un nom pour cette liste");
  }
  if($this->adminName == "" || $this->adminName == NULL){
    array_push($message, "Merci de préciser votre nom");
  }



  if(count($message)>0){
      return $message;
  }else{
      return false;
  }


}

/**
* Créer l'objet liste en recevant la ligne de la requete.
*
*
*/
public function setListe($liste){
  //$objliste = new Liste();

  $this->setListeName($liste['label']);
  $this->setAdminName($liste['nom_admin']);
  $this->setAdminEmail($liste['mail_admin']);
  $this->setEndDate($liste['date_echeance']);
  $this->setCreationDate($liste['date_creation']);
  $this->setPublic($liste['public']);
  $this->setDescription($liste['commentaires']);
  $this->setIdListe($liste['id']);
  $this->setUrl($liste['url']);
  $this->setAdminUrl($liste['admin_url']);

  //return $objliste;
}



/**
* Mise à jour massive pour 1 champ
*
*/
public static function updateMultipleListes($field, $old, $new){

  $db = db::getConnexion();
  $listes = $db->listes('id')->where($field.' = ? ', $old);
  $nblistesToUpdate = count($listes);

  $nblistesUpdated = 0;
  foreach ($listes as $value) {
    $liste = $db->listes[$value];
    $liste[$field]=$new;
    $exec =$liste->update();

    $nblistesUpdated ++;

  }
  if($nblistesUpdated == $nblistesToUpdate){
    return true;
  }else{
    return false;
  }

}







}

 ?>
