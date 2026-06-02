<?php
require_once 'app/helpers/SessionHelper.php';
SessionHelper::start();
require_once 'app/models/ProductModel.php';

// Tự động tính BASE_URL - hoạt động ở localhost:8080, localhost:80, hay bất kỳ host nào
$scheme   = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host     = $_SERVER['HTTP_HOST'];                        // e.g. localhost:8080
$script   = dirname($_SERVER['SCRIPT_NAME']);             // e.g. /webbanhang
$script   = rtrim($script, '/');
define('BASE_URL', $scheme . '://' . $host . $script);   // http://localhost:8080/webbanhang

$url = $_GET['url'] ?? '';
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);

$controllerName = isset($url[0]) && $url[0] != '' ? ucfirst($url[0]) . 'Controller' : 'ProductController';
$action = isset($url[1]) && $url[1] != '' ? $url[1] : 'index';

if (!file_exists('app/controllers/' . $controllerName . '.php')) {
    die('Controller not found');
}
require_once 'app/controllers/' . $controllerName . '.php';
$controller = new $controllerName();

if (!method_exists($controller, $action)) {
    die('Action not found');
}
call_user_func_array([$controller, $action], array_slice($url, 2));
