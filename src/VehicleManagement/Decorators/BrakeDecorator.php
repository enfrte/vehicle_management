<?php 

namespace App\VehicleManagement\Decorators;

class BrakeDecorator extends VehicleDecorator {
    // public function getDescription() {
    //     return $this->vehicle->getDescription() . ", with brakes";
    // }

    public function getMaintenanceSchedule(): array
    {
        // $schedule = parent::getMaintenanceSchedule();
        // Todo: Query db for maintenance schedule 
        
        $schedule[] = "Brake inspection every 10000 miles";
        return $schedule;
    }
}