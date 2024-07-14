<?php

namespace App\VehicleManagement\Config;

use App\VehicleManagement\Interfaces\Vehicle;
use App\VehicleManagement\Decorators\FireExtinguisherDecorator;
use App\VehicleManagement\Decorators\BrakeDecorator;
use App\VehicleManagement\Decorators\TyreDecorator;

/**
 * This class maps vehicle types to the decorators for that type.
 */
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

    public static function getDecoratorsForType(int $vehicleType): array
    {
        if (!isset(self::$decoratorConfigs[$vehicleType])) {
            throw new \InvalidArgumentException("Unknown vehicle type: $vehicleType");
        }

        return self::$decoratorConfigs[$vehicleType];
    }

}
