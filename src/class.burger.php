<?php
require_once 'src/class.db.php';
require_once 'config.php';
class Burger

{

    public function getUserByEmail($email)
    {
        $db = Db::getInstance();
        $query = "SELECT * FROM users WHERE email = :email";
        return  $db->fetchOne($query, __METHOD__, [':email' => $email]);
    }

    public function incOrders($userId)
    {
        $db = Db::getInstance();
        $query = "UPDATE users SET `count` = `count` + 1 WHERE userId = $userId";
        return $db->exec($query, __METHOD__);
    }

    public function createUser($email, $name)
    {
        $db = Db::getInstance();
        $query = "INSERT INTO users(email, `name`) VALUES (:email, :name)";
        $result = $db->exec($query, __METHOD__, [
            ':email' => $email,
            ':name' => $name
            ]
        );
        if(!$result){
            return false;
        }

        return $db->lastInsertId();
    }

    public function orders($userId, array $data)
    {
        $db = Db::getInstance();
        $query = "INSERT INTO orders(userId, address, created_at) VALUES (:userId, :address, :created_at)";
        $result = $db->exec($query, __METHOD__, [':userId' => $userId, ':address' => $data['address'], ':created_at' => date('Y-m-d H:i:s')]);
        if(!$result){
            return false;
        }
        return $db->lastInsertId();
    }
}