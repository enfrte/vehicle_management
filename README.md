Backend dev in Tests. Test CRUD operations there.

Checklist. 

- Create new vehicle.
- When creating a new vehicle, it is assigned a vehicle type. 
- Vehicle types have maintenance parts pre-assigned as per law requirements. 
- It's possible to have multiple maintenance parts like 2 fire extinguishers. 
- Add maintenance part scedule with expirary alert, last inspection (optional), and next inspection date (optional). If next inspection date is missing then expirary alert is ignored. If expirary alert is missing they won't get an expiring alert, only an expired alert. 

NEXT:

Types of maintanence
* Time - inspection_date, reminder_days (Date of upcoming inspection)
* Distance - last_distance_clocked, reminder_distance (Distance logged when part was maintained)
* Expirary - expirary_date (When things expire, like fire extingushers)
	
A vehicle part can belong to one or more of the types of maintenance. 

