<?php

session_start();
require_once __DIR__ . '/../../vendor/autoload.php';

use VehicleManagement\Controllers\VehicleController;

error_reporting(E_ALL);
ini_set('display_errors', 1);

$message = $_SESSION['message'] ?? '';
$error = $_SESSION['error'] ?? '';
unset($_SESSION['message'], $_SESSION['error']);

$controller = new VehicleController();
$vehicles = $controller->getAllVehicles();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Vehicle Management</h1>
        
        <?php if ($message): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form action="process_vehicle.php" method="POST" class="mb-5">
            <div class="mb-3">
                <label for="make" class="form-label">Make</label>
                <input type="text" class="form-control" id="make" name="make" value="Ford" required>
            </div>
            <div class="mb-3">
                <label for="model" class="form-label">Model</label>
                <input type="text" class="form-control" id="model" name="model" value="Fiesta" required>
            </div>
            <div class="mb-3">
                <label for="year" class="form-label">Year</label>
                <input type="number" class="form-control" id="year" name="year" min="1970" value="1970" required>
            </div>
            <div class="mb-3">
                <label for="year" class="form-label">Vehicle type</label>
                <select name="type">
                    <option value="1">Bus</option>
                    <option value="2">Lorry</option>
                    <option value="3">Van</option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Add Vehicle</button>
        </form>

        <h2 class="mb-3">Saved Vehicles</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Year</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vehicles as $vehicle): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($vehicle['id']); ?></td>
                        <td><?php echo htmlspecialchars($vehicle['make']); ?></td>
                        <td><?php echo htmlspecialchars($vehicle['model']); ?></td>
                        <td><?php echo htmlspecialchars($vehicle['year']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>