<?php
require_once 'config.php';
class Db
{
    /** @var \PDO */
    private $pdo;
    private $log = [];
    private static $instance;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function getInstance()
    {
        if (!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function getConnection()
    {
        $host = DB_HOST;
        $name = DB_NAME;
        $user = DB_ROOT;
        $pass = DB_PASS;

        if (!$this->pdo){
            $this->pdo = new \PDO("mysql:host=$host;dbname=$name", $user, $pass);
        }

        return $this->pdo;
    }

    public function fetchAll($query, $_method, array $params = [])
    {
        $time = microtime(true);
        $prepared = $this->getConnection()->prepare($query);

        $ret = $prepared->execute($params);

        if(!$ret){
            $error = $prepared->errorInfo();
            trigger_error("{$error[0]}#{$error[1]}: " .$error[2]);
            return [];
        }

        $data = $prepared->fetchAll(\PDO::FETCH_ASSOC);
        $affectedRows = $prepared->rowCount();
        $this->log[] = [$query, microtime(true) - $time, $_method, $affectedRows];

        return $data;
    }

    public function fetchOne($query, $_method, array $params = [])
    {
        $time = microtime(true);
        $prepared = $this->getConnection()->prepare($query);

        $ret = $prepared->execute($params);

        if(!$ret){
            $error = $prepared->errorInfo();
            trigger_error("{$error[0]}#{$error[1]}: " .$error[2]);
            return [];
        }

        $data = $prepared->fetchAll(\PDO::FETCH_ASSOC);
        $affectedRows = $prepared->rowCount();
        $this->log[] = [$query, microtime(true) - $time, $_method, $affectedRows];

        if (!$data){
            return false;
        }
        return reset($data);
    }

    public function exec($query, $_method, array $params = [])
    {
        $time = microtime(1);
        $pdo = $this->getConnection();
        $prepared = $pdo->prepare($query);

        $ret = $prepared->execute($params);

        if(!$ret){
            $error = $prepared->errorInfo();
            trigger_error("{$error[0]}#{$error[1]}: " .$error[2]);
            return -1;
        }

        $affectedRows = $prepared->rowCount();

        $this->log[] = [$query, microtime(1)-$time, $_method, $affectedRows];

        return $affectedRows;
    }

    public function lastInsertId()
    {
        return $this->getConnection()->lastInsertId();
    }
}