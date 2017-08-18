<?php
error_reporting(E_ERROR | E_PARSE);
//logique métier pour se connecter à une DB
//print_r($_SERVER);
$connexion = true;
if ($_SERVER['SERVER_ADDR'] == "127.0.25.15"){
    define('DB_NAME', 'newsletter_db');
    define('DB_USER', 'root');
    define('DB_PASSWORD', 'root');
    define('DB_HOST', 'localhost');


}
//Si serveur de prod(remplacer par l'ip fournie par votre hebergeur)
elseif ($_SERVER['SERVER_ADDR'] == "127.0.0.1"){
    define('DB_NAME', 'newsletter_db');
    define('DB_USER', 'root');
    define('DB_PASSWORD', 'root');
    define('DB_HOST', 'localhost');

}else{
    $connexion = false;
    die("impossible de se connecter à la DB");
}

if ($connexion){
    $db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('erreur de connexion'.mysqli_error($db));
    //DEBUG en bas
    //echo "connection ok";
}