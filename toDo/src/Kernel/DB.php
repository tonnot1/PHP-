<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 09/06/2017
 * Time: 11:11
 */

namespace TODO\Kernel;


class DB
{
    private $pdo;

    public static $db_name;
    public static $db_login;
    public static $db_password;
    public static $db_host;

    public function __construct()
    {

        $dsn = 'mysql:host='.static::$db_host.';dbname='.static::$db_name;// le sgbd choisi avec indentifaints
        $options = array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
        $this->pdo = new \PDO($dsn, static::$db_login, static::$db_password, $options);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

    }





    //Recuperer la connexion à la DB
    public function getConnection(){
        return $this->pdo;
    }
}