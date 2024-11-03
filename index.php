<?php
session_start();

$controller = $_GET['controller'] ?? 'account';
$action = $_GET['action'] ?? 'index';

require_once 'controller\/AccountController.php';

$controllerClass = ucfirst($controller) . 'Controller';
$controllerObject = new $controllerClass();

if (method_exists($controllerObject, $action)) {
    $controllerObject->$action();
} else {
    echo "Không tìm thấy hành động!";
}
