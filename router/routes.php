<?php

require_once("vendor/autoload.php");
use Pux\Mux;

$mux = new Mux;

$mux->any('/', ['Mvc\Controller\TemplateController', 'index']);
//*session檢查
$mux->post('/sessionCheck', ['Mvc\Controller\MainController', 'sessionCheck']);
//*登入
$mux->post('/login', ['Mvc\Controller\MainController', 'login']);
//*登入檢查
$mux->post('/loginCheck', ['Mvc\Controller\MainController', 'loginCheck']);
//*建立
$mux->post('/create', ['Mvc\Controller\MainController', 'create']);
//*建立檢查
$mux->post('/createCheck', ['Mvc\Controller\MainController', 'createCheck']);

return $mux;