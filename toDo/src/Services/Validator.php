<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 12/06/2017
 * Time: 11:16
 */

namespace TODO\Services;


class Validator
{
    private $messages = [];
    public static $password_length = 8;


    public function __construct(array $validators)
    {
        foreach ($validators as $validator => $value){
            $validator_method = "check";
            $validator_method .=ucfirst($validator);
            $this->$validator_method($value);
        }
        return $this;
        //var_dump($this);
        //die();
    }


    private function addMessages($message){
        $this->messages[] = $message;
    }

    public function getMessages(){
        if(count($this->messages)>0){
            return $this->messages;
        }else{
            return false;
        }

    }
//********************************************************************************validators
    /**
     * @param $_POST['email']
     * @return bool
     */
    private function checkEmail($email){
        // filter_var Verifie le format de l'adresse
        //Verifie le serveur MX du domaine

        $is_valid = true;
        if(filter_var($email,FILTER_VALIDATE_EMAIL)== false){
            $is_valid = false;
            $this->addMessages("Email invalide: format email invalide");
        }

        $domaine_email = explode("@",$email);
        // checkdnsrr() Verifie le serveur MX du domaine
        if($is_valid) {
            if(checkdnsrr($domaine_email[1], 'MX')== false){
                $is_valid = false;
                $this->addMessages("Email invalide: Serveur MX indispensable");
            }
        }
    }

    /**
     * @param $pass
     */
    private function checkPassword($password){
        $resa = true;
        if (strlen($password) < static::$password_length ){
            $resa = false;
            $this->addMessages("Mot de passe invalide: Pas assez long");
        }
        //return $resa;
    }

    private function checkEmpty($datas)
    {
        if (in_array(null, $datas)) {
            $this->addMessages("Tous les champs sont obligatoires");

        }
    }

}