<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database file
$dbFile = __DIR__ . '/../../vehicle_management.sqlite';

// Create a PDO instance
try {
    $pdo = new PDO("sqlite:$dbFile");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Create vehicles table
$pdo->exec("CREATE TABLE IF NOT EXISTS vehicles (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    make TEXT NOT NULL,
    model TEXT NOT NULL,
    year INTEGER NOT NULL,
    type INTEGER NOT NULL
)");

// Sample data
$vehicles = [
    ['Toyota', 'Corolla', 2022, 1],
    ['Honda', 'Civic', 2023, 2],
    ['Ford', 'F-150', 2021, 3],
    ['Chevrolet', 'Malibu', 2022, 3],
    ['Nissan', 'Altima', 2023, 2]
];

// Prepare insert statement
$stmt = $pdo->prepare("INSERT INTO vehicles (make, model, year, type) VALUES (?, ?, ?, ?)");

// Insert sample data
foreach ($vehicles as $vehicle) {
    $stmt->execute($vehicle);
}

echo "Database setup complete. " . count($vehicles) . " sample vehicles added.\n";

// Optional: Display the inserted data
$result = $pdo->query("SELECT * FROM vehicles");
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    echo "ID: {$row['id']}, Make: {$row['make']}, Model: {$row['model']}, Year: {$row['year']}, Type: {$row['type']}\n";
}