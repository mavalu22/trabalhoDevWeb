<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Controllers\UserController;

$action = $_GET['action'] ?? 'showLogin';
$controller = new UserController();

switch ($action) {
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->login();
        } else {
            $controller->showLogin();
        }
        break;

    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->register();
        } else {
            $controller->showRegister();
        }
        break;

    case 'logout':
        $controller->logout();
        break;

    default:
        $controller->showLogin();
        break;
}
