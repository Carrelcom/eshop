<?php

include_once dirname(__FILE__) . "/connect.inc.php";
echo "avant requete";
//foreach ($eshop->listes() as $liste) {
//	echo "$liste[label]"."\n";
//}


$listes = $db->listes()
    ->select("id, label");

foreach ($listes as $id => $liste) {
    echo "$liste[id] ";
		echo "$liste[label]";
		echo "<br/>";
}



echo "après requete";

 ?>
