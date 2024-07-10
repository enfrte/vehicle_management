<?php

namespace App\VehicleManagement\Models;

use PDO;
use App\VehicleManagement\Interfaces\Vehicle;
use App\VehicleManagement\Database\DatabaseConnection;
use App\VehicleManagement\Config\VehicleTypeConfigurator;

class BasicVehicle implements Vehicle
{
    private $id;
    private $make;
    private $model;
    private $year;
    private $pdo;
    private $vehicleType;

    public function __construct($id = null)
    {
        $this->pdo = DatabaseConnection::getInstance()->getConnection();

        if ($id !== null) {
            $this->loadVehicle($id);
        }
    }

    public function setProperties(string $make, string $model, int $year, int $vehicleType): self
    {
        $this->make = $make;
        $this->model = $model;
        $this->year = $year;
        $this->vehicleType = $vehicleType;
        return $this;
    }

    private function loadVehicle($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM vehicles WHERE id = ?");
        $stmt->execute([$id]);
        $vehicle = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($vehicle) {
            $this->id = $vehicle['id'];
            $this->vehicleType = $vehicle['type'];
            $this->make = $vehicle['make'];
            $this->model = $vehicle['model'];
            $this->year = $vehicle['year'];
            
        } else {
            throw new \Exception("Vehicle not found");
        }
    }

    public function save()
    {
        if ($this->id) {
            $stmt = $this->pdo->prepare("UPDATE vehicles SET make = ?, model = ?, year = ?, type = ? WHERE id = ?");
            $stmt->execute([$this->make, $this->model, $this->year, $this->vehicleType, $this->id]);
        } else {
            $stmt = $this->pdo->prepare("INSERT INTO vehicles (make, model, year, type) VALUES (?, ?, ?, ?)");
            $stmt->execute([$this->make, $this->model, $this->year, $this->vehicleType]);
            $this->id = $this->pdo->lastInsertId();
        }
        echo "Vehicle saved with ID: " . $this->id . "\n";
    }

    public function getDescription()
    {
        return "Vehicle: {$this->year}, {$this->make}, {$this->model}, {$this->vehicleType}";
    }
    
    // Maintenance schedule for vehicle based on its type
    public function getMaintenanceSchedule(): array
    {
        $maintenanceSchedule = [];
        $decorators = VehicleTypeConfigurator::getDecoratorsForType($this->vehicleType); // Load decorators based on vehicle type

        foreach ($decorators as $decoratorClass) {
            $decorator = new $decoratorClass($this);
            $maintenanceSchedule = array_merge($maintenanceSchedule, $decorator->getMaintenanceSchedule());
        }

        return $maintenanceSchedule;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setMake(string $make): self
    {
        $this->make = $make;
        return $this;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;
        return $this;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;
        return $this;
    }

    public function setVehicleType(int $type): self
    {
        $this->vehicleType = $type;
        return $this;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getMake(): string
    {
        return $this->make;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function getVehicleType(): int
    {
        return $this->vehicleType;
    }

}