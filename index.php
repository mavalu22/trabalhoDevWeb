<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Controllers\UserController;
use App\Controllers\MessageController;

$action = $_GET['action'] ?? 'showLogin';
$controller = new UserController();
$messageController = new MessageController();

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

    case 'sendMessage':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $messageController->sendMessage();
        } else {
            $messageController->showSendMessage();
        }
        break;

    case 'deleteMessage':
        $messageController->deleteMessage();
        break;
    
    case 'searchRecipient':
        $messageController->searchRecipient();
        break;

    case 'home':
        $messageController->showHome();
        break;

    case 'logout':
        $controller->logout();
        break;
    
    case 'viewMessage':
        $messageController->viewMessage();
        break;        

    default:
        $controller->showLogin();
        break;
}
