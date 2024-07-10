<?php 

namespace App\VehicleManagement\Decorators;

use App\VehicleManagement\Interfaces\Vehicle;

abstract class VehicleDecorator implements Vehicle {
    protected $vehicle;
    
    public function __construct(Vehicle $vehicle) {
        $this->vehicle = $vehicle;
    }
    
    public function getDescription() {
        return $this->vehicle->getDescription();
    }
    
    public function getMaintenanceSchedule() {
        return $this->vehicle->getMaintenanceSchedule();
    }
}