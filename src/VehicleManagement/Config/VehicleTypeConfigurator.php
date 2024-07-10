<?php

namespace App\VehicleManagement\Config;

use App\VehicleManagement\Interfaces\Vehicle;
use App\VehicleManagement\Decorators\FireExtinguisherDecorator;
use App\VehicleManagement\Decorators\BrakeDecorator;
use App\VehicleManagement\Decorators\TyreDecorator;

// Import other decorators as needed

class VehicleTypeConfigurator
{
    const BUS = 1;
    const LORRY = 2;
    const VAN = 3;

    private static $decoratorConfigs = [
        self::BUS => [FireExtinguisherDecorator::class, BrakeDecorator::class],
        self::LORRY => [FireExtinguisherDecorator::class, BrakeDecorator::class],
        self::VAN => [FireExtinguisherDecorator::class, TyreDecorator::class],
        // Add more configurations as needed
    ];

    public static function configure(Vehicle $vehicle, int $vehicleType): Vehicle
    {
        if (!isset(self::$decoratorConfigs[$vehicleType])) {
            throw new \InvalidArgumentException("Unknown vehicle type: $vehicleType");
        }

        $decoratedVehicle = $vehicle;
        
        foreach (self::$decoratorConfigs[$vehicleType] as $decoratorClass) {
            $decoratedVehicle = new $decoratorClass($decoratedVehicle);
        }

        return $decoratedVehicle;
    }

    public static function getDecoratorsForType(int $vehicleType): array
    {
        if (!isset(self::$decoratorConfigs[$vehicleType])) {
            throw new \InvalidArgumentException("Unknown vehicle type: $vehicleType");
        }

        return self::$decoratorConfigs[$vehicleType];
    }

}
