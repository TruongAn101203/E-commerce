<?php
session_start();
require_once 'app/config/database.php';

// Lấy controller và action từ URL
$controller = $_GET['controller'] ?? 'product';
$action = $_GET['action'] ?? 'index';

// Chuyển đổi tên controller thành class name
$controllerName = ucfirst($controller) . 'Controller';
$controllerFile = "app/controllers/{$controllerName}.php";

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controllerInstance = new $controllerName();
    if (method_exists($controllerInstance, $action)) {
        if (isset($_GET['id'])) {
            $controllerInstance->$action($_GET['id']);
        } else {
            $controllerInstance->$action();
        }
    } else {
        die("404 - Không tìm thấy action");
    }
} else {
    die("404 - Không tìm thấy controller");
}