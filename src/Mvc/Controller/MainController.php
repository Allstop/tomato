<?php
namespace Mvc\Controller;

session_start();

use Mvc\Model\MainModel;
use Mvc\View\View;
class MainController
{
    // 共用的物件
    private $Model = NULL;
    private $gtPost = NULL;
    // 使用者選擇的動作
    private $action = '__construct';
    // 初始化要執行的動作以及物件
    public function __construct()
    {
        $this->Model = new MainModel();
        $this->gtPost = $this->getPost();
    }

    public final function run()
    {
        $this->{$this->action}();
    }
    //取得資料
    public function getPost()
    {
        foreach ($_POST as $key => $value)
        {
            $_POST[$key] = trim($value);
        }
        $userData = array();
        if (isset($_POST['name'])) {
            $userData['name'] = $_POST['name'];
        }
        if (isset($_POST['password'])) {
            $userData['password'] = $_POST['password'];
        }
        return $userData;
    }
    //session檢查
    public function sessionCheck()
    {
        $status = $this->Model->sessionCheck($this->gtPost['name']);
        if ($status == 'success') {
            return View::render(array('status' => false));
        }else {
            return View::render(array('status' => 'success'));
        }
    }
    //登入
    public function login()
    {
        $status = $this->Model->loginCheck($this->gtPost);
        if ($status == false) {
            return View::render(array('status' => false));
        }else {
            return View::render(array('status' => $status));
        }
    }
    //登入檢查
    public function loginCheck()
    {
        $status = $this->Model->loginCheck($this->gtPost['name']);
        if ($status == 'success') {
            return View::render(array('status' => false));
        }else {
            return View::render(array('status' => 'success'));
        }
    }
    //建立
    public function create()
    {
        $status = $this->Model->create($this->gtPost);
        return View::render(array('status' => $status));
    }
    //建立檢查
    public function createCheck()
    {
        $status = $this->Model->createCheck($this->gtPost['name']);
        if ($status == 'success') {
            return View::render(array('status' => false));
        }else {
            return View::render(array('status' => 'success'));
        }
    }
}    