<?php 

namespace VehicleManagement\Decorators;

class EngineDecorator extends VehicleDecorator {
    public function getDescription() {
        return $this->vehicle->getDescription() . ", with engine";
    }
    
    public function getMaintenanceSchedule() {
        // $schedule = parent::getMaintenanceSchedule();
        $schedule[] = "Engine oil change every 5000 miles";
        return $schedule;
    }
    
}