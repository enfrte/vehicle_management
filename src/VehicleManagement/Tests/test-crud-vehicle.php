<?php 

namespace App\VehicleManagement\Scripts;

require_once __DIR__ . '/../../../vendor/autoload.php';

use App\VehicleManagement\Models\BasicVehicle;
use App\VehicleManagement\Config\VehicleTypeConfigurator;

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Create
$vehicleModel = new BasicVehicle();
$vehicleModel->setProperties("Transit 1", "Ford 1", 2023, VehicleTypeConfigurator::VAN);
$vehicleModel->save();

// Read
$newId = $vehicleModel->getId();
$newVehicleModel = new BasicVehicle($newId);
echo "<pre>Read:\n";
echo $vehicleModel->getDescription() . "\n";
$decoratedVehicle = $newVehicleModel->getDecoratedVehicle();
print_r($decoratedVehicle->getMaintenanceSchedule()) . "\n";
echo '</pre>';

// Update
echo "<pre>Update:\n";
$newVehicleModel->setProperties("Transit 2", "Ford 2", 2024, VehicleTypeConfigurator::VAN);
$newVehicleModel->save();
echo $newVehicleModel->getDescription() . "\n";
$decoratedVehicle = $newVehicleModel->getDecoratedVehicle();
print_r($decoratedVehicle->getMaintenanceSchedule()) . "\n";
echo '</pre>';

// Delete
// $newCar->delete();
