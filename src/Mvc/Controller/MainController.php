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
        if (isset($_SESSION['name'])) {
            return View::render(array('username' => $_SESSION['name']));
        }else {
            return View::render(array('username' => null));
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
            for ($j=0; $j<count($status); $j++) {
                if ($status[$j][catdate] == true){
                    $catdate[] = $status[$j][catdate];
                }
                if ($status[$j][catdate] == false){
                    $statusA[] = $status[$j];
                }
            }
            return View::render(array('catdate' => $catdate,
                                      'status' => $statusA));
        }
    }
}
