<?php

  $lang = "en";

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
      0 => "An error occured",
      404 => "Page missing",
      2002 => "The connexion is impossible"
    )



  ); // FIN ARRAY MESSAGE

 ?>



 <div id="content-wrapper">
     <section id="about-us" class="white">
         <div class="container">
             <div class="gap"></div>
             <div class="row">
                 <div class="col-md-12 fade-up">
                   <h2 class="main-title">Error</h2>
                   <hr>
 <!-- DEBUT INCLUDE -->
 <?php
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

 <!-- FIN INCLUDE -->
                 </div>
             </div>
           </div>
     </section>
 </div>
