<?php

/**
*   Gestion des return d'execution
*   @Status : 1 pour ok, 0 pour ko
*   @params : array key (type d'info) => value (message d'info)
*
*/
class Result
{
  private $status = NULL;
  private $params = "";
  private $obj = NULL;

  /**
  * Ajoute un message à la liste courante
  *
  */
  public function addParam($key,$param){
    $data = $this->params;
    $subdata = array();

    if(array_key_exists($key, $data)){
      $subdata = $data[$key];
      array_push($subdata, $param);
    }else{
      array_push($subdata, $param);
    }
    $data[$key] = $subdata;
    $this->params = $data;

  }

  public function getFlatParam(){
    $data = $this->params;
    $str = "";
    foreach ($data as $key => $value) {
      $str .=$key."=";
      foreach ($value as $subvalue) {
        $str .=$subvalue.";";
      }
    }
    return $str;
  }




  /**
   * Get the value of Gestion des return d'execution
   *
   * @return mixed
   */
  public function getStatusToString()
  {
      return "status=".$this->status."&";
  }




    /**
     * Get the value of Gestion des return d'execution
     *
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of Gestion des return d'execution
     *
     * @param mixed status
     *
     * @return self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of params
     *
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Set the value of params
     *
     * @param mixed params
     *
     * @return self
     */
    public function setParams($key,$value)
    {
        $this->params .= $key."=".$value."&";

        return $this;
    }





    /**
     * Get the value of Obj
     *
     * @return mixed
     */
    public function getObj()
    {
        return $this->obj;
    }

    /**
     * Set the value of Obj
     *
     * @param mixed obj
     *
     * @return self
     */
    public function setObj($obj)
    {
        $this->obj = $obj;

        return $this;
    }

}




 ?>
