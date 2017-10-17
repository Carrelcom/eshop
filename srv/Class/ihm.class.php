<?php


/**
 *
 */
class Ihm
{

/**
* Converti une date dans un nouveau format.
*
*/
public static function dateConvert($date, $to){
  $ret = null;
  //$source = '2012-07-31';
  $date = new DateTime($date);
  //echo $date->format('d.m.Y'); // 31.07.2012
  switch ($to) {
    case 'ihm':
      $ret = $date->format('d/m/Y');
      break;
    case 'bdd':
        $ret = $date->format('Y-m-d ');
        break;

    default:
      //
      break;
  }
  return $ret;
}

}




 ?>
