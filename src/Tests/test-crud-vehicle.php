<?php 

namespace VehicleManagement\scripts;

require_once __DIR__ . '/../../vendor/autoload.php';

use VehicleManagement\Models\BasicVehicle;
use VehicleManagement\Config\VehicleTypeConfigurator;

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Create
$vehicleModel = new BasicVehicle();
$vehicleModel->setProperties("Toyota 1", "Corolla 1", 2023, VehicleTypeConfigurator::VAN);
$vehicleModel->save();

// Read
$newId = $vehicleModel->getId();
$newVehicleModel = new BasicVehicle($newId);

echo '<pre>';
echo $newVehicleModel->getDescription() . "\n";
print_r($newVehicleModel->getMaintenanceSchedule());

// Update
$newVehicleModel->setProperties("Toyota 2", "Corolla 2", 2024, VehicleTypeConfigurator::VAN);
$newVehicleModel->save();

echo 'Updated vehicle:' . "\n";
echo $newVehicleModel->getDescription() . "\n";
print_r($newVehicleModel->getMaintenanceSchedule());
echo '</pre>';

// Delete
// $newCar->delete();
