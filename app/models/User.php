<?php

namespace App\Models;
require_once __DIR__ . '/../../vendor/autoload.php';

use PDO;
use App\Services\Database;

class User
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance();
    }

    public function findByUsernameOrEmail($usernameOrEmail)
    {
        $sql = "SELECT * FROM users WHERE username = :usernameOrEmail OR email = :usernameOrEmail";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['usernameOrEmail' => $usernameOrEmail]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($username, $email, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['username' => $username, 'email' => $email, 'password' => $hashedPassword]);
    }
}
