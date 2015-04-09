<?php
namespace Mvc\Controller;

use Mvc\Model\MainModel;
use Mvc\View\View;
use Mvc\Core\GPost;

class MainController
{
    // 共用的物件
    private $Model = NULL;
    private $gtPost = NULL;
    // 初始化要執行的動作以及物件
    public function __construct()
    {
        $this->Model = new MainModel();
        $this->gtPost = new GPost();
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
        $status = $this->Model->createRecord($this->gtPost->getListPost());
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
