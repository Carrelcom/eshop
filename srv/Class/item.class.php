<?php

/**
 *
 */
class Item
{
  private $itemlabel;
  private $itemQty;
  private $itemCategoryId;
  private $itemCategoryLabel;
  private $itemListeId;
  private $itemId;
  private $itemAuthor;



      /**
       * Get the value of Item Author
       *
       * @return mixed
       */
      public function getItemAuthor()
      {
          return $this->itemAuthor;
      }

      /**
       * Set the value of Item Author
       *
       * @param mixed itemAuthor
       *
       * @return self
       */
      public function setItemAuthor($itemAuthor)
      {
          $this->itemAuthor = $itemAuthor;

          return $this;
      }

      /**
       * Get the value of Item Id
       *
       * @return mixed
       */
      public function getItemId()
      {
          return $this->itemId;
      }

      /**
       * Set the value of Item Id
       *
       * @param mixed itemId
       *
       * @return self
       */
      public function setItemId($itemId)
      {
          $this->itemId = $itemId;

          return $this;
      }

    /**
     * Get the value of Itemlabel
     *
     * @return mixed
     */
    public function getItemlabel()
    {
        return $this->itemlabel;
    }

    /**
     * Set the value of Itemlabel
     *
     * @param mixed itemlabel
     *
     * @return self
     */
    public function setItemlabel($itemlabel)
    {
        $this->itemlabel = $itemlabel;

        return $this;
    }

    /**
     * Get the value of Item Qty
     *
     * @return mixed
     */
    public function getItemQty()
    {
        return $this->itemQty;
    }

    /**
     * Set the value of Item Qty
     *
     * @param mixed itemQty
     *
     * @return self
     */
    public function setItemQty($itemQty)
    {
        $this->itemQty = $itemQty;

        return $this;
    }

    /**
     * Get the value of Item Category Id
     *
     * @return mixed
     */
    public function getItemCategoryId()
    {
        return $this->itemCategoryId;
    }

    /**
     * Set the value of Item Category Id
     *
     * @param mixed itemCategoryId
     *
     * @return self
     */
    public function setItemCategoryId($itemCategoryId)
    {
        $this->itemCategoryId = $itemCategoryId;

        return $this;
    }

    /**
     * Get the value of Item Category Label
     *
     * @return mixed
     */
    public function getItemCategoryLabel()
    {
        return $this->itemCategoryLabel;
    }

    /**
     * Set the value of Item Category Label
     *
     * @param mixed itemCategoryLabel
     *
     * @return self
     */
    public function setItemCategoryLabel($itemCategoryLabel)
    {
        $this->itemCategoryLabel = $itemCategoryLabel;

        return $this;
    }


    /**
     * Get the value of Item Liste Id
     *
     * @return mixed
     */
    public function getItemListeId()
    {
        return $this->itemListeId;
    }

    /**
     * Set the value of Item Liste Id
     *
     * @param mixed itemListeId
     *
     * @return self
     */
    public function setItemListeId($itemListeId)
    {
        $this->itemListeId = $itemListeId;

        return $this;
    }

    /**
    * Save Item
    *
    */
    public function saveItem(){

      $result = new Result();
      $db = db::getConnexion();
        $row = $db->items()->insert(array(
          "label" => $this->itemlabel,
          "quantity" => $this->itemQty,
          "category_id" => $this->itemCategoryId,
          "liste_id" => $this->itemListeId,
          "author"    =>  $this->itemAuthor

        ));

        if($row > 0){
          $result->setStatus(true);
          $result->setParams("msg","enregistrement-item-ok");
          //$result->setParams("listeUrl",$url );
        }else{
          $result->setStatus(false);
          $result->setParams("msg","enregistrement-item-ko");
          //$result->setParams("listeUrl",$url );
        }
        return $result;
      }
    /**
    * supprime un item
    */
    public  function deleteItem(){
      $result = new Result();
      $db = db::getConnexion();

      $row = $db->items("id", $this->itemId)->delete();

      if($row > 0){
        $result->setStatus(true);
        $result->setParams("msg","suppression-item-ok");
        //$result->setParams("listeUrl",$url );
      }else{
        $result->setStatus(false);
        $result->setParams("msg","suppression-item-ko");
        //$result->setParams("listeUrl",$url );
      }
      return $result;
    }
      /**
      * return all items of list
      *
      */
      public static function getItemsFromListe($idListe){
        $arrResult = array();
        $db = db::getConnexion();


        foreach ($db->items("liste_id", $idListe)->order("category_id") as $item) {
          $obj = new Item();

          $obj->setItemlabel($item["label"]);
          $obj->setItemQty($item["quantity"]);
          $obj->setItemCategoryId($item["category_id"]);
          $obj->setItemListeId($item["liste_id"]);
          $obj->setItemId($item["id"]);
          $obj->setItemAuthor($item['author']);

          array_push($arrResult,$obj);

        }

        return $arrResult;
      }






}
 ?>
