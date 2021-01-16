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
        $this->test = App::$config;
        if (isset(App::$config['db']) && !empty(App::$config['db']['dbtype'])) {
            $this->dbtype = App::$config['db']['dbtype'];
            $this->dbhost = App::$config['db']['dbhost'];
            $this->dbname = App::$config['db']['dbname'];
            $this->dbuser = App::$config['db']['dbuser'];
            $this->dbpassword = App::$config['db']['dbpassword'];
            if(!$this->connecting()){
                throw new \Exception("Ошибка: Проблема с подключением к базе данных!");
            }
        }
    }

    private function connecting()
    {
        $this->db = new $this->dbtype;
        $this->db->setup( 'mysql:host='.$this->dbhost.';dbname='.$this->dbname,$this->dbuser, $this->dbpassword, false);
        if($this->db->testConnection()){
            return true;
        }
        return false;
    }

    public function findAll($type, $sql = NULL, $bindings = array())
    {
        return $this->db->findAll($type, $sql, $bindings);
    }

    public function findOne($type, $sql = NULL, $bindings = array())
    {
        return $this->db->findOne($type, $sql, $bindings);
    }

    public function load($type, $id = NULL)
    {
        return $this->db->load($type, $id);
    }

    public function count($type, $sql = NULL, $bindings = array())
    {
        return count($this->db->findAll($type, $sql, $bindings));
    }
}