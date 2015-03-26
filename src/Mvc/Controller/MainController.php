<?php
namespace Mvc\Controller;
use Mvc\Model\Model;
use Mvc\View\View;
class mainController
{
    // 共用的物件
    private $Model = NULL;
    private $gtPost = NULL;
    // 使用者選擇的動作
    private $action = '__construct';
    // 建構函式
    // 初始化要執行的動作以及物件
    public function __construct()
    {
    }
    public final function run()
    {
        $this->{$this->action}();
    }
}    