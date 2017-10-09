<?php
/**
* Simple autoloader, so we don't need Composer just for this.
*/
class Autoloader
{
    public static function register()
    {
        spl_autoload_register(function ($class) {

            //  $file = str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';

            $file = dirname(__FILE__)."/Class".DIRECTORY_SEPARATOR.strtolower($class).".class.php";
            //echo "Fichier de la classe à charger [".$file."]";
            if (file_exists($file)) {
                require $file;
                //echo "Fichier [".$file."] OK";
                return true;
            }
            //echo "Fichier [".$file."] NOT OK";
            return false;
        });
    }
}
