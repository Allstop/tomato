<?php
namespace Mvc\Controller;

use Mvc\Model\MainModel;
use Mvc\View\View;
use Mvc\Sys\Controller;

class MainController extends Controller
{
    // 共用的物件
    private $Model = NULL;
    private $gtPost = NULL;
    // 初始化要執行的動作以及物件
    public function __construct()
    {
        Controller::init();
        $this->Model = new MainModel();
        $this->gtPost =self::$app->getListPost();
    }
    //session檢查
    public function sessionCheck()
    {
        $status = $this->Model->sessionCheck($_SESSION['name']);
        if ($status == false) {
            return View::render(array('status' => false));
        } else {
            return View::render(array('status' => $status, 'username' => $_SESSION['name']));
        }
    }
    //建立清單
    public function createRecord()
    {
        $status = $this->Model->createRecord($this->gtPost);
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
