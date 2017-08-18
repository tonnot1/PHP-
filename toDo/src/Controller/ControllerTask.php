<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 12/06/2017
 * Time: 16:20
 */

namespace TODO\Controller;


use TODO\Entity\Task;
use TODO\Kernel\Controller;
use TODO\Repository\TaskRepository;
use TODO\Repository\StatutRepository;
use TODO\Services\FormFactory;
use TODO\Kernel\EntityManager;
use TODO\Services\Toolbox;
use TODO\Services\Validator;

class ControllerTask extends Controller
{

    private $root_path_views;
    private $task_repository;
    private $statut_repository;

    public function __construct()
    {

        $this->root_path_views = dirname(dirname (__FILE__)).'/Views/Task/';
        $this->task_repository = new TaskRepository();
        $this->statut_repository = new StatutRepository();


        session_start();
        if (isset($_SESSION['is_logged']) == false || ($_SESSION['is_logged']) == false ){
            $this->forbidden403();
        }else{
            //print_r($_SESSION);
        }

    }

    public function showAll(){


        $id_user = $_SESSION['id_user'];
        $id_statut = isset($_GET['id_statut'])? $_GET['id_statut']: false;


        $tasks = $this->task_repository->taskByUser($id_user,$id_statut);

        //$del = $this->task_repository->deleteTask();
        //$statuts = $this->task_repository->findByStatut();
        $statuts = $this->statut_repository->findStatut();
        //$json =
        //var_dump($tasks);
        require_once $this->root_path_views.'showAll.php';
        //echo "Bienvenue dans le showAll !!";

    }

    public function manageTask(){


        $statuts = $this->statut_repository->findStatut();
        //Seilement dans le cas d'une modification, on a dans l'url une cle id_task
        $id_task = isset($_GET['id_task'])? $_GET['id_task']: false;
        //recuperation du user connecté, Cela nous permet de vérifier que le user a bien le droit de consulter/modifier cette task
        $id_user = $_SESSION['id_user'];
        $action = "Ajouter";
        if($id_task){
            //si modif, on recupère dans la DB l'instance task à modifier
            $task = $this->task_repository->findIfTask('id_task',$id_task,$id_user, true);
            //var_dump($task);
            $form = new FormFactory($task);
            $action = "Modifier";
        }else{
            //Sinon, on est en mode création de task
            $form = new FormFactory($_POST);
        }
        //var_dump($statuts);
       // die();

        //$form = new FormFactory($_POST);
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            //1.Gestion des erreurs via le service Validator > tous les champs sont obligatoires


            $validators = ['empty'=>$_POST];
            $validator = new Validator($validators);
            if ($validator->getMessages()){
                Toolbox::setFlash('Tous les champs sont obligatoires', 'danger');
            }else{

                //2.hydratation de l'objet Task

                    $task = EntityManager::hydrate($_POST, '\TODO\Entity\Task');
                    $task->setIdUser($_SESSION['id_user']);
                    $task->setIdUser($id_task);
                    //Ajout des données manquantes qui ne viennent pas du formulaire

                    //$task->getIdUser();
                //3. Verification des doublons sur le titre, un utilisitateur ne peut pas creer 2 taches avec le m^me titre

                $count_titre = $this->task_repository->findIfTask('titre', $task->getTitre(), $task->getIdUser());


                //4.si tout est ok, insertion des données dans la table via la méthode createTask() du TaskRepository()
                if (count($count_titre) > 0 && ($count_titre[0])->getIdTask() != $id_task){

                    Toolbox::setFlash('Le titre est déjà utilisé', 'danger');

                        }else{

                    if($id_task == false){
                        Toolbox::setFlash('La tache a été crée', 'success');
                        $this->task_repository->createTask($task);

                    }else{
                        Toolbox::setFlash('La tache a été modifiée', 'success');
                        $this->task_repository->updateTask($task);


                    }

                    //die();

                    header('Location: index.php?action=Task/showAll');
                    exit;
                }


//_____________________________________________





                /* print_r($_SESSION);
                 var_dump($task);
                 die();*/











                //$this->task_repository->createTask($task);



            } //else
                /*['titre' => $user->getEmail(), 'resume' => $_POST['password'], 'content' => $_POST];*/


        }
        require_once $this->root_path_views.'manage.php';
    }

    public function delete()
    {
        //print_r($_GET);
        $id_task = $_GET['id'];
        // appeler la requête SQL dans TaskRepository > ReqDelete($id_task);

        $res = $this->task_repository->deleteTask($_GET['id']);
        if($res)
        {
            Toolbox::setFlash('La tache a été supprimer', 'success');
            header('Location: index.php?action=Task/showAll');
            exit;
        }else{
            Toolbox::setFlash('Une erreur est survenue lors de la suppression', 'danger');
        }
        //Si suppression ok> redirection vers showAll() avec message succès


        //}
    }


    /*public function filter()
    {
        $id_statut = isset($_GET['statut'])? $_GET['statut']: false;
        //print_r($_GET);
        //$id_statut = $_GET['statut'];
        if(!$id_statut){
            $tasks = $this->task_repository->taskByUser($id_user,false);
        }else{
            $tasks = $this->task_repository->taskByUser($id_user,$id_statut);
        }
        print_r($tasks);
        // appeler la requête SQL dans TaskRepository > ReqDelete($id_task);
        $res= $this->task_repository->taskByUser($id_statut);
        //Si suppression ok> redirection vers showAll() avec message succès
        if () {
            ;

        }*/
   // }


}