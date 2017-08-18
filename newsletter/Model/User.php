<?php
//ici les fonctions qui permettent de travailler avec la DB et la table "User"

function findOneUserBy($key_search, $value){ // selectionner la value
    //$sql = "SELECT * FROM user WHERE email='toto@gmai.com'";
    global $db;
    $value = clean_datas($value);
    $sql = "SELECT * FROM user WHERE $key_search = $value";
    $res = mysqli_query($db,$sql) or die(mysqli_error($db)); //mysqli_query envoie requete a la DB
    //mysqli_query($db, $sql) --->  $db est la DB ciblée ,  $sql est la requete choisi
    return $res;
}

function addUser($datas){
    global $db;
    //ex: INSERT INTO user (mail, login, nom,prenom) VALUES ('toto','toto@gmail.com','ta','ram')
    $keys = array_keys($datas); //Retourne toutes les clés ou un ensemble des clés de $datas
    $values = clean_datas($datas);

    //print_r($keys);   //tester
    //print_r($values);     //tester
    //die();
    $keys = implode(",", $keys); // rassemble en chaine
    $values = implode(",", $values);
    //echo $keys;   //tester
    //die();
    $sql = "INSERT INTO user ($keys, created_at) VALUES ($values,NOW())";
    //echo $sql; //tester $sql
   // die();
    $res = mysqli_query($db,$sql) or die(mysqli_error($db));
    return $res;

}

function clean_datas($datas){ //rendre la value dans la bonne forme
    //on recupere la variable $db du fichier de DB.php
    //Cette variable n'est pas dispo dans une fonction mais seulement en dehors. Le mot-cle global, permet d'y faire référence.
    global $db;

    if(is_array($datas)){
        $data_clean ="";
        foreach($datas as $key => $data){
            if($key == "password"){ //pour le champ "password"
                $data = sha1($data); // crypte l'entrée
            }
            $data_clean[$key] = "'".mysqli_real_escape_string($db,$data)."'";
        }


    }else{
        $data_clean = "'".mysqli_real_escape_string($db,$datas)."'";
    }       //



    //guillemets en reference à $value pour faire sortir la valeur bone conditions
    return $data_clean;
}

