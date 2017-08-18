<?php

namespace TODO\Kernel;

use TODO\Controller\ControllerConnexion;


class Controller
{
    public function __construct()
    {
        //recuperation du param action dans l'url
        $action = isset($_GET['action'])? $_GET['action']: false;

        //on doit deduire de l'action le nom du sous controller à instancier et le nom de la methode à appeler pour afficher la vue demandée...

        $action = explode("/",$action );


        if(count($action)!=2 ) {
            $this->notFound404();
        }else{



            $controller_name = $action[0];
            $controller_action = $action[1];

            //$call = new ControllerMailer();
            //$call->showForm();

            //**************************************************
            //Instanciation dynamique en passant par des variables
            $controller_str = "\\TODO\\Controller\\Controller$controller_name";


            if(class_exists($controller_str) ==false){
                $this->notFound404();
            }


            $controller = new $controller_str;
            if(method_exists($controller, $controller_action) ==false){
                $this->notFound404();
            }
            $controller->$controller_action();

            //************************************************

        }

    }

    protected function notFound404(){
        header('HTTP/1.0 404 Not found');
        die("Fichier introuvable");
    }

    protected function forbidden403(){
        header('HTTP/1.0 403 Forbidden');
        die("Acces interdit");
    }


}