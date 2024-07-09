<?php

namespace VehicleManagement\Controllers;

use VehicleManagement\Database\DatabaseConnection;
use VehicleManagement\Models\BasicVehicle;

class VehicleController
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = DatabaseConnection::getInstance()->getConnection();
    }

    public function getAllVehicles()
    {
        $stmt = $this->pdo->query("SELECT * FROM vehicles ORDER BY id DESC");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function addVehicle($make, $model, $year, $vehicleType)
    {
        $vehicle = new BasicVehicle();
        $vehicle->setProperties($make, $model, $year, $vehicleType);
        $vehicle->save();
    }
}
