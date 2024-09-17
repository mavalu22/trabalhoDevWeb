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

    $createMessagesTableSQL = "CREATE TABLE IF NOT EXISTS messages (
        id INTEGER PRIMARY KEY AUTOINCREMENT ,
        user_id INTEGER NOT NULL,
        subject TEXT NOT NULL,
        message TEXT NOT NULL,
        send_datetime DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id)
    )";
    $conn->exec($createMessagesTableSQL);

    $createMessageUserTableSQL = "CREATE TABLE IF NOT EXISTS message_user (
        message_id INTEGER NOT NULL,
        user_id INTEGER NOT NULL,
        read_status INTEGER DEFAULT 0,
        PRIMARY KEY (message_id, user_id),
        FOREIGN KEY (message_id) REFERENCES messages(id) ON DELETE CASCADE,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    )";
    $conn->exec($createMessageUserTableSQL);

    echo "Tabelas criadas com sucesso!";

} catch (PDOException $e) {
    echo 'Erro ao criar tabelas: ' . $e->getMessage();
}
