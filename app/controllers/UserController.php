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
        if (isset($_SESSION['user_id'])) {
            header('Location: index.php?action=home');
            exit();
        }
        require __DIR__ . '/../views/user/login.php';    }
    
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
                $_SESSION['username'] = $user["username"];
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
            $userUN = $this->userModel->findByUsernameOrEmail($username);
            $userEM = $this->userModel->findByUsernameOrEmail($email);

            if (!($userUN || $userEM)){
                if ($this->userModel->create($username, $email, $password)) {
                    header('Location: index.php?action=login');
                    exit();
                }
            }else{
                header('Location: index.php?action=register&error=1');
                exit();
            }
        }
    }

    public function home()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /public/index.php?action=login');
            exit();
        }
        require __DIR__ . '/../views/user/home.php';
    }
    
    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: index.php?action=login');
        exit();
    }
    
}
