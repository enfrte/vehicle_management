<?php

namespace App\VehicleManagement\Database;

use PDO;
use PDOException;

class DatabaseConnection
{
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        $dbFile = __DIR__ . '/../../../vehicle_management.sqlite';
        try {
            $this->pdo = new PDO("sqlite:$dbFile");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->pdo;
    }

    // Prevent cloning of the instance
    private function __clone() {}

    // Prevent unserializing of the instance
    public function __wakeup() {}
}