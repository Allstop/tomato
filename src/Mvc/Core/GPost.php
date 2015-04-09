<?php
namespace Mvc\Core;

class GPost {
    // 共用的物件
    private $gtPost = NULL;
    private $gtlPost = NULL;
    // 初始化要執行的動作以及物件
    public function __construct()
    {
        $this->gtPost = $this->getPost();
        $this->gtlPost = $this->getListPost();
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
}