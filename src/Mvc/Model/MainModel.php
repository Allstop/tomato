<?php

namespace Mvc\Model;

class MainModel
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
    //*檢查session資料是否已存在
    public function sessionCheck($name)
    {
        if ($name == true) {
            $sql = self::$db->prepare("SELECT id,name FROM user
            where name='".$name."' "
            );
            if ($sql->execute()) {
                $sql=$sql->fetchAll(\PDO::FETCH_ASSOC);
                return $sql;
            }
        } else {
            return false;
        }
    }
    //*檢查登入資料是否已存在
    public function loginCheck($gtPost)
    {
        $sql = self::$db->prepare("SELECT id, name FROM user
        where name='".$gtPost['name']."' and password='".$gtPost['password']."' "
        );
        if ($sql->execute()) {
            $sql=$sql->fetchAll(\PDO::FETCH_ASSOC);
            return $sql;
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
    public function createCheck($gtPost)
    {
        $sql = self::$db->query(
            "SELECT name FROM user
        where name='".$gtPost."'"
        );
        if ($sql->fetch()) {
            return 'success';
        } else {
            return false;
        }
    }
    //*建立清單
    public function createRecord($gtlPost)
    {
        if ($this->status !== true) {
            return 'error in create!';
        }
        try {
            $_userId = $gtlPost['userId'];
            $_date = date("Y-m-d");
            $_starttime = $gtlPost['starttime'];
            $_endtime = $gtlPost['endtime'];
            $_description = $gtlPost['description'];
            $sql = self::$db->prepare(
                "INSERT INTO record (userId, date, starttime, endtime, description)
            VALUES (:userId, :date, :starttime, :endtime, :description)"
            );
            //var_dump($_endtime);
            $sql->bindvalue(':userId', $_userId);
            $sql->bindvalue(':date', $_date);
            $sql->bindvalue(':starttime', $_starttime);
            $sql->bindvalue(':endtime', $_endtime);
            $sql->bindvalue(':description', $_description);

            return ($sql->execute()) ? '成功': '失敗';
        } catch (PDOException $e) {
            return 'error in insert!';
        }
    }
    //*工作清單
    public function listRecord($userId)
    {
        if ($this->status !== true) {
            return 'error';
        }
        try {
            $sqltt = self::$db->prepare("SELECT date,time(starttime) starttime,time(endtime)endtime,description
                                       FROM record
                                       where userId='".$userId."' order by date,starttime" );
            if ($sqltt->execute()) {
                $sql=$sqltt->fetchAll(\PDO::FETCH_ASSOC);
               return $sql;
            }else{
                return false;
            }
        }catch(\PDOException $e){
            return false;
        }
    }
}