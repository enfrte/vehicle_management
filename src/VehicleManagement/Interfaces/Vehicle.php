<?php 

namespace App\VehicleManagement\Interfaces;

interface Vehicle {
    public function getDescription();
    public function getMaintenanceSchedule(): array;
}
