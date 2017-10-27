<?php

  $lang = "frd";

  $error = NULL;
  if(isset($_GET['code'])){
    $error = Securite::getField("GET","code");
  }

  $arr = array(
    "fr" => array(
      0 => "Une erreur a eu lieu",
      404 => "Page introuvable",
      2002 => "Connexion impossible"
    ), // FIN ARRAY FR
    "en" => array(
      0 => "An error occured"
    )



  ); // FIN ARRAY MESSAGE

  if($error <> NULL){
      if(!isset($arr[$lang][$error])){
        $error = 0;
      }
      if(!isset($arr[$lang])){
        $lang = "en";
      }
      echo "<h1>".$arr[$lang][$error]."</h1>";
  }


 ?>
