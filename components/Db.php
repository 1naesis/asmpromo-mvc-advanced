<?php

namespace Component;

/**
 * Класс Db
 * Компонент отвечающий за подключения к БД
 */
class Db
{
    public $db = null;
    private $dbtype = null;
    private $dbhost = null;
    private $dbname = null;
    private $dbuser = null;
    private $dbpassword = null;

    public function __construct()
    {
        $this->db = App::$config;
        if (isset(App::$config['db']) && !empty(App::$config['db']['dbtype'])) {
            $this->dbtype = App::$config['db']['dbtype'];
            $this->dbhost = App::$config['db']['dbhost'];
            $this->dbname = App::$config['db']['dbname'];
            $this->dbuser = App::$config['db']['dbuser'];
            $this->dbpassword = App::$config['db']['dbpassword'];
            $this->dbcharset =  App::$config['db']['dbcharset'];
            self::connecting();
        }
    }

    private function connecting()
    {
        $dsn = "mysql:host=$this->dbhost;dbname=$this->dbname;charset=$this->dbcharset";
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->db  = new PDO($dsn, $this->dbuser, $this->dbpassword, $opt);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
            die();
        }
    }

    public function findAll($sql = NULL, $bindings = array())
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($bindings);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findOne($sql = NULL, $bindings = array())
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($bindings);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($sql = NULL, $bindings = array())
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($bindings);

        return $this->db->lastInsertId();

    }

    public function update($sql = NULL, $bindings = array())
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($bindings);

        return true;

    }

    public function delete($sql = NULL, $bindings = array())
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($bindings);

        return true;

    }



    public function count($type, $sql = NULL, $bindings = array())
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($bindings);
        return count($stmt);
    }
}