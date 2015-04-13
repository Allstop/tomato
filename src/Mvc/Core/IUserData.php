<?php
namespace Mvc\Core;

use Mvc\Interfaces\IUser;

class IUserData
{
    // 共用的物件
    private static $user = null;
    // 初始化要執行的動作以及物件
    public  static function getUser()
    {
        if (self::$user == null) {
            self::$user = new IUserData();
        }
        if (self::$user instanceof IUser) {
            return self::$user;
        }  else {
            return false;
        }
    }
}