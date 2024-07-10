<?php

namespace App\VehicleManagement\Models;

use PDO;
use App\VehicleManagement\Database\DatabaseConnection;
use App\VehicleManagement\Config\VehicleTypeConfigurator;
use App\VehicleManagement\Models\BasicVehicle;

class VehicleMaintenance 
{
    private $pdo;
    private $vehicleType;

    public function __construct($vehicleType = null)
    {
        $this->pdo = DatabaseConnection::getInstance()->getConnection();
        $this->vehicleType = $vehicleType;
    }
    
    // Maintenance schedule for vehicle based on its type
    public function getMaintenanceSchedule(): array
    {
        $maintenanceSchedule = [];
        $decorators = VehicleTypeConfigurator::getDecoratorsForType($this->vehicleType); // Load decorators based on vehicle type
        $basicVehecle = new BasicVehicle();

        foreach ($decorators as $decoratorClass) {
            $decorator = new $decoratorClass($basicVehecle);
            $maintenanceSchedule = array_merge($maintenanceSchedule, $decorator->getMaintenanceSchedule());
        }

        return $maintenanceSchedule;
    }

}