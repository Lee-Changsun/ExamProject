<?php
/**
 * Created by PhpStorm.
 * User: 이창선
 * Date: 2018-01-19
 * Time: 오전 10:53
 */

class Database{
    private $dbhost;
    private $dbPort;
    private $dbName;
    private $dbUser;
    private $dbPw;
    private $dbCharset;

    private $pdo;

    function __construct($dbHost, $dbPort, $dbName, $dbUser, $dbPw, $dbCharset)
    {
        $this->dbhost = $dbHost;
        $this->dbPort = $dbPort;
        $this->dbName = $dbName;
        $this->dbUser = $dbUser;
        $this->dbPw = $dbPw;
        $this->dbCharset = $dbCharset;
    }

    private function connect(){
        try{
            $this->pdo = new PDO("mysql:host={$this->dbHost};port={$this->dbPort};dbname={$this->dbName};charset={$this->dbCharset};", $this->dbUser, $this->dbPw);
        } catch(PDOException $e){

        }
    }

    public function query($query){
        $result = null;

        if($this->pdo === null){
            $this->connect();
        }

        try{
            $result = $this->pdo->query($query);

        } catch(PDOException $e){
            print_r($e);
            return false;
        }
        return $result;
    }

    public function exec($query){
        $result = null;

        if($this->pdo === null){
            $this->connect();
        }

        try{
            $result = $this->pdo->exec($query);

        } catch(PDOException $e){
            print_r($e);
            return false;
        }
        return $result;
    }

}