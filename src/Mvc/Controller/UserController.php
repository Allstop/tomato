<?php
namespace Mvc\Controller;

use Mvc\Model\UserModel;
use Mvc\View\View;
use Mvc\Core\GPost;

class UserController
{
    // 共用的物件
    private $Model = NULL;
    private $gtPost = NULL;
    // 初始化要執行的動作以及物件
    public function __construct()
    {
        $this->Model = new UserModel();
        $this->gtPost = new GPost();
    }
    //登出
    public function logout()
    {
        session_destroy();
    }
    //登入檢查
    public function loginCheck()
    {
        $_SESSION['name'] = $this->gtPost->getPost()['name'];
        $_SESSION['password'] = $this->gtPost->getPost()['password'];
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
        $_SESSION['name'] = $this->gtPost->getPost()['name'];
        $_SESSION['password'] = $this->gtPost->getPost()['password'];
        $status = $this->Model->createCheck($_SESSION['name']);
        if ($status == 'success') {
            return View::render(array('status' => false));
        }else {
            return View::render(array('status' => 'success'));
        }
    }
}
