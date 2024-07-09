<?php

use PHPUnit\Framework\TestCase;
use VehicleManagement\Models\BasicVehicle;
use VehicleManagement\Decorators\EngineDecorator;
use VehicleManagement\Decorators\BrakeDecorator;

class VehicleTest extends TestCase
{
    public function testCreateAndRetrieveVehicle()
    {
        // Create a new vehicle
        $newCar = new BasicVehicle();
        $newCar->setProperties("Toyota", "Corolla", 2024);
        $newCar->save();

        $newId = $newCar->getId();
        $this->assertNotNull($newId, "Vehicle ID should not be null after saving");

        // Retrieve the vehicle
        $retrievedCar = new BasicVehicle($newId);
        $this->assertEquals("Toyota", $retrievedCar->getMake(), "Retrieved vehicle make should match");
        $this->assertEquals("Corolla", $retrievedCar->getModel(), "Retrieved vehicle model should match");
        $this->assertEquals(2024, $retrievedCar->getYear(), "Retrieved vehicle year should match");
    }

    public function testVehicleDecorators()
    {
        $car = new BasicVehicle();
        $car->setProperties("Honda", "Civic", 2023);

        $decoratedCar = new EngineDecorator(new BrakeDecorator($car));

        $description = $decoratedCar->getDescription();
        $this->assertStringContainsString("Honda", $description);
        $this->assertStringContainsString("Civic", $description);
        $this->assertStringContainsString("2023", $description);
        $this->assertStringContainsString("engine", $description);
        $this->assertStringContainsString("brakes", $description);

        $schedule = $decoratedCar->getMaintenanceSchedule();
        $this->assertContains("Engine oil change every 5000 miles", $schedule);
        $this->assertContains("Brake inspection every 10000 miles", $schedule);
    }
}