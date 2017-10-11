<?php
/**
 *
 */
class Utility
{

  /**
  *   Génère l'url unique d'une liste qui sera stockée dans la bdd
  *   Return string @short_hash;
  */
  public static function generateUniqueUrl($id, $pre, $suf){

    $url;
    $part0 = substr(time(),0,4)."-";
    $part1 = substr(hash('ripemd160', $pre),0,3);
    $part2 = hash('md2',$id);
    $part3 = substr(hash('ripemd160', $suf),0,3);
    $ret = $part1.$part2.$part3;

    return $ret;

  }

  /**
  * Gère les redirections
  *
  */
  public static function redirect($page, $param){

    $url = "location:page.php?page=".$page;
    echo "AVANT PARAM [".$url."]";
    if($param <> NULL){
      foreach ($param as $key => $value) {
        $url .= "&".$key."=".$value;
      }
    }
    echo "APRES PARAM [".$url."]";
    header($url);
  }

  /**
  * @return bool
  */
  public static function is_session_started()
  {
      if ( php_sapi_name() !== 'cli' ) {
          if ( version_compare(phpversion(), '5.4.0', '>=') ) {
              return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
          } else {
              return session_id() === '' ? FALSE : TRUE;
          }
      }
      return FALSE;
  }

}




 ?>
