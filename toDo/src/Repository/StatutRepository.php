<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 12/06/2017
 * Time: 16:24
 */

namespace TODO\Repository;

use TODO\Entity\Statut;
use TODO\Kernel\DB;
class StatutRepository
{

    private $table_name = "statut";
    private $pdo;

    public function __construct()
    {

        //Recuperer la connexion a la DB
        $db= new DB();
        $this->pdo = $db->getConnection();


    }

    public function findStatut(){
        $sql = "SELECT * FROM {$this->table_name}";
        $res = $this->pdo->query($sql);
//      $stmt->bindValue( $value, \PDO::PARAM_STR);
        //$stmt->execute();
        $res = $res->FetchAll(\PDO::FETCH_CLASS,'TODO\Entity\Statut');
        //$res = $stmt->fetchAll();*/
        return $res;
    }



}