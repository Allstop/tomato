<?php
namespace Mvc\Sys;

use Mvc\Core\GPost;

class Controller
{
    public static $app = null;

    public static function init()
    {
        self::$app = new GPost();
        self::$app->getPost();
        self::$app->getListPost();
    }
}