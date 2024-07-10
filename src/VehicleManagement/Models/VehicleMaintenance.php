<?php

namespace App\VehicleManagement\Models;

use PDO;
use App\VehicleManagement\Database\DatabaseConnection;
use App\VehicleManagement\Config\VehicleTypeConfigurator;
use App\VehicleManagement\Interfaces\Vehicle;
use App\VehicleManagement\Models\BasicVehicle;

class VehicleMaintenance 
{
    private $pdo;
    private $id;
    private $vehicleType;

    public function __construct(BasicVehicle $vehicle)
    {
        $this->pdo = DatabaseConnection::getInstance()->getConnection();
        $this->id = $vehicle->getId();
        $this->vehicleType = $vehicle->getVehicleType();
    }
    
    // Maintenance schedule for vehicle based on its type
    public function getMaintenanceSchedule(): array
    {
        $maintenanceSchedule = [];
        $decorators = VehicleTypeConfigurator::getDecoratorsForType($this->vehicleType); // Load decorators based on vehicle type
        $basicVehecle = new BasicVehicle($this->id);

        foreach ($decorators as $decoratorClass) {
            $decorator = new $decoratorClass($basicVehecle);
            $maintenanceSchedule = array_merge($maintenanceSchedule, $decorator->getMaintenanceSchedule());
        }

        return $maintenanceSchedule;
    }

}