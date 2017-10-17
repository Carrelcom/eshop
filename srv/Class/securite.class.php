<?php
	class Securite
	{

		/**
		* Récupère de manière sécurisée les champs de form
		*/
		public static function getField($method, $fieldName){
			$fieldValue = Null;
			/*echo "dans securite get field : method : [".$method."]";
			echo "<br/>";
			echo "dans securite get field : fieldname : [".$fieldName."]";
			echo "<br/>";
			echo "dans securite get field : GET fieldname : [".$_GET[$fieldName]."]";
			echo "<br/>";
*/
			if($method=="POST"){
				if(isset($_POST[$fieldName])){
					$fieldValue = self::bdd($_POST[$fieldName]);
				}

			}elseif ($method=="GET") {
				if(isset($_GET[$fieldName])){
					$fieldValue = self::bdd($_GET[$fieldName]);
					$fieldValue = $_GET[$fieldName];
				}
			}
			return $fieldValue;
		}


		// Récupère les données d'une liste déroulante
		public static function getSelect($method, $listeName,$multiple){
			$selection_liste = null;
			if($method == "POST"){
				if(isset($_POST[$listeName])){
					if($_POST[$listeName] <> ""){
						echo "VALEUR LISTE NAME ".$listeName."[".$_POST[$listeName]."]";
						$selection_liste = $_POST[$listeName];
					}else{
						echo "PAS DE VALEUR SELECTIONNEE";
						$selection_liste = NULL;
					}
				}
			}else if($method == "GET"){
				if(isset($_GET[$listeName])){
					if($_GET[$listeName] <> ""){
						$selection_liste = $_GET[$listeName];
					}else{
						$selection_liste = NULL;
					}
				}
			}

			return $selection_liste;
	}


		// Récupérer valeur d'une checkbox.
		public static function getCheckbox($unique, $method, $checkboxName){


			$value = Null;

			if($unique){ // SI UNIQUE EST TRUE, ON RENVOI SEULEMENT 1 ou 0 SI C'EST COCHE OU NON
				if($method=="POST"){
					if(isset($_POST[$checkboxName]) && !$_POST[$checkboxName]){
					 	$value = 0;
					}else{
						$value = 1;
					}
				}else{
					if(!$_GET[$checkboxName]){
					 	$value = 0;
					}else{
						$value = 1;
					}
				}
			}else{ // SI C'EST PAS UNIQUE, ON RENVOI LA LISTE DES VALEUR COCHEES
				// TODO: A IMPLEMENTER
			}

			return $value;
		}




		// Données entrantes
		public static function bdd($string)
		{
			// On regarde si le type de string est un nombre entier (int)
			if(ctype_digit($string))
			{
				$string = intval($string);
			}
			// Pour tous les autres types
			else
			{
				//$string = mysql_real_escape_string($string);
				$string = addcslashes($string, '%_');
			}

			return $string;

		}

		// Données sortantes
		public static function html($string)
		{
			return htmlentities($string);
		}


		// encrypt password
		public static function hashpwd1($pwd){
				return hash('ripemd160', $pwd);

		}



	}
?>
