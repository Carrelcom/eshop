<?php
  /**
   *
   */
  class Category
  {

    private $id;
    private $label;





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

    /**
     * Get the value of Labels
     *
     * @return mixed
     */
    public function getLabel($lang)
    {
        if($lang==NULL){
          return $this->labels;
        }else{
          $arrLang =  $this->labels;
          return $arrLang[$lang];
        }

    }

    /**
     * Set the value of Labels
     *
     * @param mixed labels
     *
     * @return self
     */
    public function setLabel($label)
    {
        $this->labels = $label;

        return $this;
    }

    /**
    * récupère toutes les catégories
    *
    */
    public static function getCategories(){

      $db = db::getConnexion();
      $returnArr = array();
      foreach ($db->categories() as $category) {

        $obj = new Category();
        $obj->setId($category['id']);
        $arrLang = array();
        $arrLang["fr"] = $category['label_fr'];
        $arrLang["en"] = $category['label_en'];
        $obj->setLabel($arrLang);

        array_push($returnArr,$obj);

      }
      return $returnArr;
    }


}






 ?>
