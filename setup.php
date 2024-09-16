<?php

require_once __DIR__ . '/app/services/Database.php';

use App\Services\Database;

$conn = Database::getInstance();

try {
    $createUsersTableSQL = "CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        email TEXT NOT NULL UNIQUE,
        username TEXT NOT NULL UNIQUE,
        password TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $conn->exec($createUsersTableSQL);

    echo "Tabelas criadas com sucesso!";

} catch (PDOException $e) {
    echo 'Erro ao criar tabelas: ' . $e->getMessage();
}
