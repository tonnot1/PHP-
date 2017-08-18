<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 12/06/2017
 * Time: 16:24
 */

namespace TODO\Repository;

use TODO\Entity\Task;
use TODO\Kernel\DB;
class TaskRepository
{
    private $table_name = "task";
    private $pdo;

    public function __construct()
    {

        //Recuperer la connexion a la DB
        $db= new DB();
        $this->pdo = $db->getConnection();


    }

    /*public function findTask(){
        $sql = "SELECT * FROM {$this->table_name} LEFT JOIN statut AS S ON S.id_statut = {$this->table_name}.id_statut ";
        $res = $this->pdo->query($sql);
        //$stmt->execute();
        $res = $res->FetchAll(\PDO::FETCH_CLASS,'TODO\Entity\Task');

        return $res;
    }*/

    //taches par utilisateur
    public function taskByUser($idUser,$id_statut = false){
        $sql = "SELECT * FROM {$this->table_name} LEFT JOIN statut AS S ON S.id_statut = {$this->table_name}.id_statut WHERE 
id_user =:id_user";
        if (is_numeric($id_statut)){
            $sql .= " AND {$this->table_name}.id_statut = :id_statut";
        }
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':id_user', $idUser, \PDO::PARAM_INT);

        if(is_numeric($id_statut)){
            $stmt->bindValue(':id_statut', $id_statut, \PDO::PARAM_INT);
        }
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS,'TODO\Entity\Task');
        $res = $stmt->FetchAll();

        return $res;
    }

    public function updateTask(Task $task){
        $sql = "UPDATE {$this->table_name} SET titre = :titre,resume =:resume,content =:content,id_statut =:id_statut,id_user =:id_user WHERE 
id_task =:id_task";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id_task', $task->getIdTask(), \PDO::PARAM_INT);
        $stmt->bindValue(':titre', $task->getTitre(), \PDO::PARAM_STR);
        $stmt->bindValue(':resume', $task->getResume(), \PDO::PARAM_STR);
        $stmt->bindValue(':content', $task->getContent(), \PDO::PARAM_STR);
        $stmt->bindValue(':id_statut', $task->getIdStatut(), \PDO::PARAM_INT);
        $stmt->bindValue(':id_user', $task->getIdUser(), \PDO::PARAM_INT);
        $res = $stmt->execute();

        return $res;
    }

    public function deleteTask($idTask){
        $sql = "DELETE FROM {$this->table_name} WHERE id_task= :id_task";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id_task', $idTask, \PDO::PARAM_INT);
       $res = $stmt->execute();
        //$stmt->setFetchMode(\PDO::FETCH_CLASS,'TODO\Entity\Task');
       // $res = $stmt->FetchAll();

        return $res;
    }

    public function createTask(Task $task){
        $sql = "INSERT INTO {$this->table_name} (titre,resume,content,created_at,id_statut,id_user) VALUES (:titre,:resume,:content,:created_at,:id_statut,:id_user)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':titre', $task->getTitre(), \PDO::PARAM_STR);
        $stmt->bindValue(':resume', $task->getResume(), \PDO::PARAM_STR);
        $stmt->bindValue(':content', $task->getContent(), \PDO::PARAM_STR);
        $stmt->bindValue(':created_at', $task->getCreatedAt(true), \PDO::PARAM_STR);
        $stmt->bindValue(':id_statut', $task->getIdStatut(), \PDO::PARAM_INT);
        $stmt->bindValue(':id_user', $task->getIdUser(), \PDO::PARAM_INT);
        $res = $stmt->execute();

        return $res;


    }

    public function findIfTask($critere, $value,$idUser, $one=false){
        $sql = "SELECT * FROM {$this->table_name} WHERE $critere =:critere AND id_user = :id_user";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':critere', $value, \PDO::PARAM_STR);
        $stmt->bindValue(':id_user', $idUser, \PDO::PARAM_INT);
        $stmt->execute(); //execute la requete
        $stmt->setFetchMode(\PDO::FETCH_CLASS,'TODO\Entity\Task');
        if ($one){
            $res = $stmt->fetch();
        }else{
            $res = $stmt->fetchAll(); //renvoi tableau
        }

        return $res;
    }


    //

    /*public function findByStatut($idSatut){
        $sql = "SELECT * FROM {$this->table_name} WHERE $critere =:critere";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':critere', $value, \PDO::PARAM_STR);
        $stmt->execute(); //execute la requete
        $stmt->setFetchMode(\PDO::FETCH_CLASS,'TODO\Entity\Task');
        $res = $stmt->fetchAll(); //renvoi tableau
        return $res;

    }*/




    /*public function TaskByUser($critere, $value){
        $sql = "SELECT * FROM"{$this->table_name} WHERE
    }
    */

   /* public function taskBy(:id_user, ){
        $sql = "SELECT * FROM {$this->table_name} LEFT JOIN statut AS S ON S.id_statut = {$this->table_name}.id_statut WHERE :id_user";
        $res = $this->pdo->query($sql);
        //$stmt->execute();
        $res = $res->FetchAll(\PDO::FETCH_CLASS,'TODO\Entity\Task');

        return $res;
    }*/


}