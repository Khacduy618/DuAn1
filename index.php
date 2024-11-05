<?php

spl_autoload_register(function ($class) {
    $file = 'model/' . $class . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});
include_once 'model/pdo.php';
$conn = pdo_get_connection();

if ($conn === null) {
    die('Không thể kết nối đến cơ sở dữ liệu.');
}
$result = $conn->query("SELECT * FROM user")->fetchAll();



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
