<?php
//ici logique métier pour prendre en charge l'inscrip
//1 Connexion DB
require_once "../Kernel/DB.php";
//2 Recuperer données formulaire
    //on appelle la function extract_data_form
require_once "../Kernel/fonctions.php";
require_once "../Model/User.php";



$datas = extract_data_form($_POST);
//var_dump($_POST); //a utiliser pour tester
//var_dump($datas); //a utiliser pour tester



$messages = [];
//3 verifier les logins
        //aucun champ vite
if (in_array(null, $datas)){
    $messages[] = "Tous les champs sont obligatoires";


  /*  setFlash($messages, '\'warning\'');
  header('Location: ../index.php');*/

}
        //login unique
$user1 = findOneUserBy('login', $datas['login']);
//var_dump($user->num_rows); // num_rows = compte nombre de fois

if($user1->num_rows == 1) {
    $messages[] = "le login {$datas['login']} est déjà pris";
}

$user = findOneUserBy('email', $datas['email']);
//var_dump($user->num_rows); // num_rows = compte nombre de fois


if($user->num_rows == 1){
    $messages[] = "l' email {$datas['mail']} est déjà pris";

}





//mot de passe (min 8 caratcteres)

if(checkPass($datas['password']) == false ) {

    $messages[] = "le mot de passe {$datas['password']} est trop court";
}

$is_valid_format_email = checkEmail($datas['email']);
if($is_valid_format_email == false){
    $messages[] = "Format email pas valide";
}

if (count($messages) == 0){

    addUser($datas);
    setFlash('Merci, à bientot', 'success');
    header('Location: ../index.php?action=success');// Renvoi en GET $action = success
}else{
    setFlash($messages, 'danger');
    header('Location: ../index.php');
}





//setFlash($messages, 'danger');
//header('Location: ../index.php');

        //format email valide

/*if(() {

    $messages[] = "le mot de passe {$datas['password']} est trop court";*/


//4  si tout est ok, insertion des donnees dans TABLE user..