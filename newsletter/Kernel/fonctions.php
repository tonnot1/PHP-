<?php
//Toolbox de fonctions reutilisables dans "n" projet
//extraire les donnees de formulaire..


/**
 * Extraire les donnees d'un formulaire
 * @param array $_POST ou £_GET > datas_bruts
 * @return array $datas
 */
function extract_data_form($datas_brut){
    $datas = array(); // ou [];
    foreach ($datas_brut as $key => $data){
        //Veririfier si champ vide
        if (empty($data) == false){
            //on insere dans le nouveau array $datas la valeur "néttoyée". trim enleve les eventuels espaces saisis par erreur
            $datas[$key] = trim($data);
        }else{
            //si une donnée est vide
            $datas[$key] = null;
        }
}
    return $datas;
}
//____________________________________
/**
 * Stocker un message "Flash" dans la session
 * @param $message
 * @param $type (danger, success, warning, info)
 */
function setFlash($message,$type){
    if(isset($_SESSION) == false){
        session_start();
    }
    $_SESSION['flash'] = array('type'=>$type, 'message'=>$message);

}


//_____________________________________

function getFlash(){
    /*if(isset($_SESSION) == false){
        session_start();
    }*/



    if(isset($_SESSION['flash'])){

    $type = $_SESSION['flash']['type'];

    $message = $_SESSION['flash']['message'];

        $html = "<div class='alert alert-$type'>";


    if(is_array($message)){
       foreach($message as $m) {
           $html .= $m . '<br/>';
        }
       }else{
           $html .= $message; // ".="
       }




    $html .= "</div>";
    //Affichage du message
    echo $html;
    // Destruction du message
    unset($_SESSION['flash']);//supprimer cle dans un tableau
    }

}

function checkPass($pass){
    $resa = true;
    if (strlen($pass) < 8 ){
        $resa = false;
    }
    return $resa;
}

function checkEmail($email){
    // filter_var Verifie le format de l'adresse
    //Verifie le serveur MX du domaine

    $is_valid = true;
    if(filter_var($email,FILTER_VALIDATE_EMAIL)== false){
        $is_valid = false;
    }

    $domaine_email = explode("@",$email);
    // checkdnsrr() Verifie le serveur MX du domaine

    if(checkdnsrr($domaine_email[1], 'MX')== false){
        $is_valid = false;
    }
    return $is_valid;

}

//function


