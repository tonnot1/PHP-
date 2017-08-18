<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 09/06/2017
 * Time: 11:10
 */

namespace TODO\Repository;

use TODO\Entity\User;
use TODO\Kernel\DB;
class UserRepository
{
    private $table_name = "user";
    private $pdo;

    public function __construct()
    {
        //Recuperer la connexion a la DB
        $db= new DB();
        $this->pdo = $db->getConnection();

    }

    public function getLastInsertId(){
        return $this->pdo->lastInsertId();
    }

    public function reqLogin(User $user){
        // Requete préparée
        $login = $user->getLogin();
        $password = $user->getPassword();

        $sql = "SELECT * FROM {$this->table_name} WHERE login= :login AND password= :password";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":login",$login,\PDO::PARAM_STR );
        $stmt->bindParam(':password',$password,\PDO::PARAM_STR );

        //execution de la requete
        $stmt->execute();

        //Recuperation du resultat de la requete
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'TODO\Entity\User');
        $res = $stmt->fetchAll();
        return $res;
        //var_dump($res);

    }

    /**
     * @param User $user Instance de type User dans Entity
     * @return bool
     */
    public function reqRegister(User $user){
        $login = $user->getLogin();
        $password = $user->getPassword();

        $sql = "INSERT INTO {$this->table_name} (login,password,is_admin,email,prenom,nom,created_at) VALUES (:login,:password,:is_admin,:email,:prenom,:nom,:created_at)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':login',$user->getLogin(),\PDO::PARAM_STR );
        $stmt->bindValue(':password',$user->getPassword(),\PDO::PARAM_STR );
        $stmt->bindValue(':is_admin',$user->getisAdmin(),\PDO::PARAM_STR );
        $stmt->bindValue(':email',$user->getEmail(),\PDO::PARAM_STR );
        $stmt->bindValue(':prenom',$user->getPrenom(),\PDO::PARAM_STR );
        $stmt->bindValue(':nom',$user->getNom(),\PDO::PARAM_STR );
        $stmt->bindValue(':created_at',$user->getCreatedAt(true),\PDO::PARAM_STR );

        //execution de la requete
        $res =$stmt->execute();
        return $res;

    }

    public function findUser($critere, $value){
        $sql = "SELECT * FROM {$this->table_name} WHERE $critere =:critere";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':critere', $value, \PDO::PARAM_STR);
        $stmt->execute(); //execute la requete
        $stmt->setFetchMode(\PDO::FETCH_CLASS,'TODO\Entity\User');
        $res = $stmt->fetchAll(); //renvoi tableau
        return $res;
    }



}