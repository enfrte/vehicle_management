<?php 

namespace App\VehicleManagement\Decorators;

class BrakeDecorator extends VehicleDecorator {
    // public function getDescription() {
    //     return $this->vehicle->getDescription() . ", with brakes";
    // }

    public function getMaintenanceSchedule(): array
    {
        // Todo: Query db for maintenance schedule 
        $schedule = parent::getMaintenanceSchedule();
        $schedule[] = ["Brake inspection every 10,000 miles. "];
        return $schedule;
    }
}