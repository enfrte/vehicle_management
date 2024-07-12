<?php 

namespace App\VehicleManagement\Decorators;

class FireExtinguisherDecorator extends VehicleDecorator {
    // public function getDescription() {
    //     return $this->vehicle->getDescription() . ", with fire extinguisher.";
    // }
    
    public function getMaintenanceSchedule(): array {
        // $schedule = parent::getMaintenanceSchedule();
        $schedule = parent::getMaintenanceSchedule();
        $schedule[] = ["Check fire extinguisher expiration date. "];
        return $schedule;
    }
    
}