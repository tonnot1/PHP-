<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 08/06/2017
 * Time: 14:53
 */

namespace TODO\Controller;

use TODO\Kernel\EntityManager;
use TODO\Services\Toolbox;
use TODO\Entity\User;
use TODO\Kernel\Controller;
use TODO\Repository\UserRepository;
use TODO\Services\FormFactory;
use TODO\Services\Validator;

class ControllerConnexion
{
    private $root_path_views;
    private $user_repository;


    public function __construct()
    {
        $this->root_path_views = dirname(dirname (__FILE__)).'/Views/';
        $this->user_repository = new UserRepository();
        session_start();

    }
//Affiche le formulaire pour s'identifier
    public function show(){

            $form = new FormFactory($_POST);
           require $this->root_path_views.'User/show.php';
    } //*****************************************************************


//Traitement du formulaire du login une fois validé
        public function doLogin(){
            //on recupere les donnees du formulaire, cela nous permet d'instancier un objet de type Entity\User.

            //instanciation du UserRepository
            //$user_repository = new UserRepository(); //valable avant

//***********************************************
            /*$user = new User();

            $user->setLogin($_POST['login']);
            $user->setPassword($_POST['password']);*/ //EntityManager qui prend le relais
            //**********************************************************

             $user = EntityManager::hydrate($_POST, '\TODO\Entity\User');

            //var_dump($user);
            //die();
            //*************************************************************************
            $validators = ['empty'=>$_POST];
            $validator = new Validator($validators);
            //var_dump($validator->getMessages());
            //die();
            //*********************************************

            if($validator->getMessages()){
                Toolbox::setFlash($validator->getMessages(),'danger');
                header('Location: index.php?action=Connexion/show');
            } else {
                /**
                 * @param User $user
                 * @return array User $users
                 */
                $res = $this->user_repository->reqLogin($user);
                //echo $res->getLogin();

                if(count($res)==1){

                    $_SESSION['id_user'] = $res[0]->getIdUser();
                    $_SESSION['is_logged'] = true;
                    header('Location: index.php?action=Task/showAll');
                }else{
                    Toolbox::setFlash('Erreur d\'identification','danger');
                    header('Location: ?action=Connexion/show');
                    //echo "faux nul zero";

                }
            }




            //echo "tout va bien";
            //var_dump($res);
            //die();
        }


//Affiche le formulaire pour s'enregistrer
        public function register(){
            $form = new FormFactory($_POST);
           require $this->root_path_views.'User/register.php';
       }

       public function doRegister()
       {
           //hydrater l'instance
           $user = EntityManager::hydrate($_POST, '\TODO\Entity\User');


           //preparer un tableau associatif avec les données validées
           $validators = ['email' => $user->getEmail(), 'password' => $_POST['password'], 'empty' => $_POST];
           //instanciation de Validator
           $validator = new Validator($validators);
           //var_dump($validator->getMessages());
           //die();


           $res = $this->user_repository->reqRegister($user);

           echo "Insérées dans la DB";
           //var_dump($user);
           //die();
           if ($validator->getMessages()) {
               Toolbox::setFlash($validator->getMessages(), 'danger');
               header('Location: index.php?action=Connexion/register');
           } else {
               // Chercher si on a déjà un user avec ce mail
               $count_email_user = $this->user_repository->findUser('email', $user->getEmail());
               $count_login_user = $this->user_repository->findUser('login', $user->getLogin());

                   //var_dump($count_email_user);
                   //die();

               $crea_compte = true;
               $messages = [];
               if(count($count_email_user) == 1){

                   $messages[]= "Email deja utilisé";

                   //Toolbox::setFlash('un compte est déjà cree avec cette adresse email', 'danger');
                   $crea_compte = false;
               }
               if(count($count_login_user) == 1){

                   $messages[]= "Login deja utilisé";
                   //Toolbox::setFlash('un compte est déjà cree avec celogin', 'danger');
                   $crea_compte = false;

               }
//-----------------------------------------------------
               if ($crea_compte){
                   //insertion user dans ma table
                   $res = $this->user_repository->reqRegister($user);


                   if($res){
                       //Récupération de l'id du user qui vient d'être inséré dans la table
                       $lastId = $this->user_repository->getLastInsertId();
                       //die($lastId);
                       $_SESSION['id_user'] = $lastId;
                       $_SESSION['is_logged'] = true;
                       header('Location: index.php?action=Task/showAll');
                   }else{
                       Toolbox::setFlash("impossible de créer un compte", 'danger');
                       header('Location: index.php?action=Connexion/register');
                   }



               }else{
                   Toolbox::setFlash($messages, 'danger');
                   header('Location: index.php?action=Connexion/register');
               }





               //$res = $this->user_repository->reqRegister($user);
               //echo $res->getLogin();

              /* if ($res) {

               } else {*/
                  // Toolbox::setFlash('creation compte impossible', 'danger');
                   //header('Location: ?action=Connexion/register');
                   //echo "faux nul zero";
               //}
           }
       }

}