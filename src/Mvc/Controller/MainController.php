<?php
namespace Mvc\Controller;

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
    private $action = 'run';
    // 初始化要執行的動作以及物件
    public function __construct()
    {
        $this->Model = new MainModel();
        $this->gtPost = $this->getPost();
        $this->gtlPost = $this->getListPost();
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
    //取得record資料
    public function getListPost()
    {
        foreach ($_POST as $key => $value)
        {
            $_POST[$key] = trim($value);
        }
        $ListData = array();
        if (isset($_POST['name'])) {
            $ListData['name'] = $_POST['name'];
        }
        if (isset($_POST['startTime'])) {
            $ListData['starttime'] = $_POST['startTime'];
        }
        if (isset($_POST['endTime'])) {
            $ListData['endtime'] = $_POST['endTime'];
        }
        if (isset($_POST['description'])) {
            $ListData['description'] = $_POST['description'];
        }
        return $ListData;
    }
    //session檢查
    public function sessionCheck()
    {
//        if (isset($_SESSION['name']) && isset($_SESSION['password'])) {
//            session_destroy();
//            return false;
//        } else {
        $status = $this->Model->sessionCheck($_SESSION['name']);
        if ($status == false) {
            return View::render(array('status' => false));
        }else {
            return View::render(array('status' => $status, 'username' => $_SESSION['name']));
        }
    }
    //登出
    public function logout()
    {
        session_destroy();
    }
    //登入檢查
    public function loginCheck()
    {
        $_SESSION['name'] = $this->gtPost['name'];
        $_SESSION['password'] = $this->gtPost['password'];
        $status = $this->Model->loginCheck($_SESSION);
        if ($status == false) {
            session_destroy();
            return View::render(array('status' => false));
        }else {
            return View::render(array('status' => $status, 'username' => $_SESSION['name']));
        }
    }
    //建立
    public function create()
    {
        $status = $this->Model->create($_SESSION);
        return View::render(array('status' => $status));
    }
    //建立檢查
    public function createCheck()
    {
        $status = $this->Model->createCheck($_SESSION['name']);
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
        $status = $this->Model->listRecord($_SESSION['name']);
        if ($status == false) {
            return View::render(array('status' => false));
        }else {

            return View::render(array('status' => $status));
        }
    }
}
