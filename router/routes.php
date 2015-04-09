<?php

require_once("vendor/autoload.php");
use Pux\Mux;

$mux = new Mux;

$mux->any('/', ['Mvc\Controller\TemplateController', 'index']);
//*session檢查
$mux->post('/sessionCheck', ['Mvc\Controller\MainController', 'sessionCheck']);
//*建立Record
$mux->post('/createRecord', ['Mvc\Controller\MainController', 'createRecord']);
//*listRecord
$mux->get('/listRecord', ['Mvc\Controller\MainController', 'listRecord']);

//*登入檢查
$mux->post('/loginCheck', ['Mvc\Controller\UserController', 'loginCheck']);
//*建立
$mux->post('/create', ['Mvc\Controller\UserController', 'create']);
//*建立檢查
$mux->post('/createCheck', ['Mvc\Controller\UserController', 'createCheck']);
//*登出
$mux->get('/logout', ['Mvc\Controller\UserController', 'logout']);

return $mux;