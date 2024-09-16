<?php

namespace App\Controllers;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Models\User;

class UserController
{
    private $userModel;

    public function __construct()
    {
        session_start();
        $this->userModel = new User();
    }
    
    public function showLogin()
    {
        require __DIR__ . '/../views/user/login.php';
    }
    
    public function showRegister()
    {
        require __DIR__ . '/../views/user/register.php';
    }
    
    public function login()
    {
        $usernameOrEmail = $_POST['usernameOrEmail'] ?? '';
        $password = $_POST['password'] ?? '';
    
        if ($usernameOrEmail && $password) {
            $user = $this->userModel->findByUsernameOrEmail($usernameOrEmail);
    
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                header('Location: index.php');
                exit();
            } else {
                header('Location: index.php?action=login&error=1');
                exit();
            }
        }
    }
    
    public function register()
    {
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
    
        if ($username && $email && $password) {
            if ($this->userModel->create($username, $email, $password)) {
                header('Location: index.php?action=login');
                exit();
            } else {
            }
        }
    }
    
    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: index.php?action=login');
        exit();
    }
    
}
