<?php 

namespace App\VehicleManagement\Decorators;

class TyreDecorator extends VehicleDecorator {
    // public function getDescription() {
    //     return $this->vehicle->getDescription() . ", with tyres";
    // }
    
    public function getMaintenanceSchedule() {
        // $schedule = parent::getMaintenanceSchedule();
        
        $schedule[] = "Tyre check every 10000 miles";
        return $schedule;
    }
    
}