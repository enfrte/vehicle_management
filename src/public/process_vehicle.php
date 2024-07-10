<?php

session_start();
require_once __DIR__ . '/../../vendor/autoload.php';

use App\VehicleManagement\Controllers\VehicleController;

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $controller = new VehicleController();
        $controller->addVehicle($_POST['make'], $_POST['model'], $_POST['year'], $_POST['type']);
        
        $_SESSION['message'] = "Vehicle added successfully!";
    } catch (Exception $e) {
        $_SESSION['error'] = "Error adding vehicle: " . $e->getMessage();
    }
}

// Redirect back to the form page
header('Location: public/vehicle_form.php');
exit();
