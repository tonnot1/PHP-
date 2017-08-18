<?php
//Charger l'autloader
require_once 'vendor/autoload.php';


//charger config
\TODO\Services\FormFactory::$bootstrap = false;

$connexion = true;
if($_SERVER['SERVER_ADDR'] == '127.0.0.1'){
\TODO\Kernel\DB::$db_name = "todo_db";
\TODO\Kernel\DB::$db_login = "root";
\TODO\Kernel\DB::$db_password = "root";
\TODO\Kernel\DB::$db_host = "localhost";
}
//Coordonées autre serveur OVH, etc....
elseif($_SERVER['SERVER_ADDR'] == '127.0.0.45'){
    \TODO\Kernel\DB::$db_name = "autre_db_ovh";
    \TODO\Kernel\DB::$db_login = "autre";
    \TODO\Kernel\DB::$db_password = "autre";
    \TODO\Kernel\DB::$db_host = "ailleurs";

}else{
    $connexion = false;
    die( "erreur de connexion");

}
//instancer le controller principal
new \TODO\Kernel\Controller(); ///En dernier