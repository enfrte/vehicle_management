## Pattern - Decorator

The decorator pattern is suitable for several use cases:

1. Adding responsibilities dynamically: When you need to extend an object's functionality without altering its structure.
2. Feature customization: Allowing users to build custom configurations of features.
3. Avoiding class explosion: When you have many independent ways to extend functionality.
4. Single Responsibility Principle: Keeping classes focused on a single task while allowing combinations.
5. Open/Closed Principle: Enabling extension of a class's behavior without modifying its code.

There are usually 3 main components that make up the decorator pattern. 

1. **Component Interface:** Define an interface that sets the contract for both concrete components and decorators.
2. **Concrete Component:** Implement the basic functionality.
3. **Decorator:** Extend the functionality of the concrete component by wrapping it.

To use the decorator, you need to call the decorator classes by pushing the previous object into the current constructor argument (wrapping). It could look something like this...

```php
$coffeeWithMilkAndSugar = new SugarDecorator(new MilkDecorator(new SimpleCoffee())); // SimpleCoffee is the concrete component
echo $coffeeWithMilkAndSugar->description() . ' costs $' . $coffeeWithMilkAndSugar->cost() . "\n";
```

This will run through the description and cost methods in the component interface for each decorator and the concrete component. 


## Example 

I've tried to mock-up an example of decorator pattern use. In the example there is a vehicle maintenance system where we have basic a vehicle with different parts we want to track the maintenance schedules of.

Each decorator is added to in the Decorators folder. In this way we don't need to touch the original vehicle code. We also use an abstract VehicleDecorator class to reduce decorator broilerplate code. 

Currently, the VehicleTypeConfigurator, a class that maps vehicle types to the decorators for that type, is not part of BasicVehicle. I thought this being separate would reduce cognative load of people extending the functionality of the feature. 


## How to use

Backend dev in Tests. Test CRUD operations there.

## Requirements checklist

- Create new vehicle.
- When creating a new vehicle, it is assigned a vehicle type. 
- Vehicle types have maintenance parts pre-assigned as per law requirements. 
- It's possible to have multiple maintenance parts like 2 fire extinguishers. 
- Add maintenance part scedule with expirary alert, last inspection (optional), and next inspection date (optional). If next inspection date is missing then expirary alert is ignored. If expirary alert is missing they won't get an expiring alert, only an expired alert. 

## Next thing to do, maybe

Types of maintanence
* Time - inspection_date, reminder_days (Date of upcoming inspection)
* Distance - last_distance_clocked, reminder_distance (Distance logged when part was maintained)
* Expirary - expirary_date (When things expire, like fire extingushers)
	
A vehicle part can belong to one or more of the types of maintenance. 
