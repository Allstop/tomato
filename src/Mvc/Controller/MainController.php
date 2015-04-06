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
    private $gtlPost = NULL;
    private $stash = NULL;
    // 使用者選擇的動作
    private $action = '__construct';
    // 初始化要執行的動作以及物件
    public function __construct()
    {
        $this->Model = new MainModel();
        $this->gtPost = $this->getPost();
        $this->gtlPost = $this->getListPost();
        $_SESSION['name']=$_GET['name'];
        $_SESSION['id']=$_GET['id'];

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
        if (isset($_POST['id'])) {
            $userData['id'] = $_POST['id'];
        }
        if (isset($_POST['name'])) {
            $userData['name'] = $_POST['name'];
        }
        if (isset($_POST['password'])) {
            $userData['password'] = $_POST['password'];
        }
        return $userData;
    }
    //取得資料
    public function getListPost()
    {
        foreach ($_POST as $key => $value)
        {
            $_POST[$key] = trim($value);
        }
        $ListData = array();
        if (isset($_POST['userId'])) {
            $ListData['userId'] = $_POST['userId'];
        }
        if (isset($_POST['date'])) {
            $ListData['date'] = $_POST['date'];
        }
        if (isset($_POST['starttime'])) {
            $ListData['starttime'] = $_POST['starttime'];
        }
        if (isset($_POST['endtime'])) {
            $ListData['endtime'] = $_POST['endtime'];
        }
        if (isset($_POST['description'])) {
            $ListData['description'] = $_POST['description'];
        }
        return $ListData;
    }
    //session檢查
    public function sessionCheck()
    {
        $status = $this->Model->sessionCheck($_SESSION['name']);
        if ($status == false) {
            return View::render(array('status' => false));
        }else {
            return View::render(array('status' => $status));
        }
    }
    //登入
    public function login()
    {
        $view = View::forge('login');
        return $view;
    }
    //登入檢查
    public function loginCheck()
    {
        $status = $this->Model->loginCheck($this->gtPost);
        if ($status == false) {
            return View::render(array('status' => $status));
        }else {
            return View::render(array('status' => $status));
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
    //建立清單
    public function createRecord()
    {
        $status = $this->Model->createRecord($this->gtlPost);
        return View::render(array('status' => $status));
    }
    //工作清單
    public function listRecord()
    {
        $status = $this->Model->listRecord($_SESSION['id'] );
        if ($status == false) {
            return View::render(array('status' => false));
        }else {
            return View::render(array('status' => $status));
        }
    }
}

session_destroy();