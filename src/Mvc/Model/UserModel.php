<?php

namespace Mvc\Model;

class UserModel implements \Mvc\Interfaces\IUser
{

    private static $db = null;

    protected $status = false;

    public function __construct($filename = null, $path = null)
    {
        try {
            self::$db = array();
            if (! $path) {
                $path = dirname(dirname(dirname(__DIR__))).'/config';
            }
            if (! $filename) {
                $filename = 'config.php';
            }
            self::$db = require(implode('/', array($path, $filename)));
            self::$db = new \PDO(self::$db['db']['dsn'], self::$db['db']['user'], self::$db['db']['pwd']);
            self::$db->query('set character set utf8');
            $this->status = true;
        } catch (PDOException $e) {
            $this->status = false;
            return;
        }
    }
    //*檢查登入資料是否已存在
    public function loginCheck($gtPost)
    {
        $sql = self::$db->prepare("SELECT name FROM user
        where name='".$gtPost['name']."' and password='".$gtPost['password']."' "
        );
        if ($sql->execute()) {
            $sql=$sql->fetchAll(\PDO::FETCH_ASSOC);
            return $sql[0];
        } else {
            return false;
        }
    }
    //*建立使用者
    public function create($gtPost)
    {
        if ($this->status !== true) {
            return 'error in create!';
        }
        try {
            $_name = $gtPost['name'];
            $_password = $gtPost['password'];
            $sql = self::$db->prepare(
                "INSERT INTO user (name, password)
            VALUES (:name, :password)"
            );
            $sql->bindvalue(':name', $_name);
            $sql->bindvalue(':password', $_password);
            return ($sql->execute()) ? $gtPost['name'] : '失敗';
        } catch (PDOException $e) {
            return 'error in insert!';
        }
    }
    //*檢查建立資料是否已存在
    public function createCheck($name)
    {
        $sql = self::$db->query(
            "SELECT name FROM user
        where name='".$name."'"
        );
        if ($sql->fetch()) {
            return 'success';
        } else {
            return false;
        }
    }
}