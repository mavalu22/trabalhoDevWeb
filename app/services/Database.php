<?php
namespace App\Services;
require_once __DIR__ . '/../../vendor/autoload.php';

use PDO;
use PDOException;

class Database {
    private static $instance = null;
    private $connection;

    private $dbFile = __DIR__ . '/../../database/forum.db';

    private function __construct() {
        try {
            $this->connection = new PDO("sqlite:" . $this->dbFile);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Erro de conexão: ' . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }

        return self::$instance->connection;
    }

    private function __clone() { }

    public function __wakeup() { }
}
