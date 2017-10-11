
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
      $db = db::getConnexion();

      // SI ID NULL --> INSERT
      if($this->idListe == NULL){
        $url = Utility::generateUniqueUrl($this->adminEmail, $this->listeName, $this->endDate);
        $liste = $db->listes()->insert(array(

          "label" =>   $this->listeName,
          "mail_admin" => $this->adminEmail,
          "nom_admin" => $this->adminEmail,
        	"date_echeance" => $this->endDate,
          "public" => $this->public,
          "commentaires" => $this->description,
          "url" => $url

        ));

      }elseif(is_integer($this->idListe)){
        // SI L'ID n'est pas NULL --> UPDATE AVEC LE NUMERO D'ID
        $liste = $db->listes[$this->idListe];

        $liste["label"] = $this->listeName;
        $liste["date_echeance"] = $this->endDate;
        $liste["public"] = $this->public;
        $liste["commentaires"] = $this->description;
        $url = $this->url;

        $liste->update();
      }
      return $url;
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
          $listes = $db->listes($filter);
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
      if($type=="url"){
        $rq = $db->listes("url", $val);
      }else if($type=="id"){
        $rq = $db->listes("id", $val);
      }

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
      if($type=="url"){
        $nbVal = count($db->listes("url", $val));
      }else if($type=="id"){
        $nbVal = count($db->listes("id", $val));
      }

      echo $nbVal;
      $retVal = Null;

      if($nbVal == 1){
        $retVal = true;
      }else if($nbVal == 0){
        $retVal = false;
      }

      return $retVal;
    }









}

 ?>
