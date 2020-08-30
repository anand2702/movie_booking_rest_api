# Booking REST API

This is a REST api built with the SlimPHP framework and uses MySQL for storage.

### Description

A table named bookings has been created with the following given description.

<div align="center">
    <img src="../ScreenShots/TableDesription.png" width="400px"></img> 
</div>


### Usage
### Installation

Create database or import from _sql/movie_ticket.sql

Edit db/config params

Install SlimPHP and dependencies

```sh
$ composer
```
### API Endpints
```sh
$ GET http://localhost/slim/public/index.php/booked_tickets  ->  It displays a list of all the bookings made along with user details.

![Alt text](/ScreenShots/GetRequest.png?raw=true)


$ GET http://localhost/slim/public/index.php/booked_tickets/{id}  ->  It displays the details of booking of that specific id.
$ POST http://localhost/slim/public/index.php/book_ticket  ->  It is used to make a new booking which takes care that there are no more than 20 bookings on any date and time. The input parameters required are "name","phone","email","datentime" and "gender".
$ PUT http://localhost/slim/public/index.php/update/{id}  ->  It modifies the booking datentime of column and again takes care of the condition that there are no more than 20 bookings at that date and time. The input parameter required is "datentime".
$ DELETE http://localhost/slim/public/index.php/delete/{id}  ->  It is used to delete the ticket with that specific id.
```

Now, we are ready to set the Windows Task Scheduler to run shellscript.vbs at the required time interval:

Open Task Scheduler from windows Start menu
Go to Action menu and hit Create Task...
in General tab, fill the Name and Description fields as you want
in Triggers tab, hit New button.
from Begin the Task dropdown, select On a schedule and choose Daily
from Advanced settings section, select Repeat task every as you want and set for a duration on Indefinitely.
on Actions tab, from Action dropdown, select Start a program.
on the Program\script box, enter path to shellscript.vbs like C:\path\to\shellscript.vbs.
leave Add argumentts (optional) section empty.
in Start in (optional) box, enter parent directory of shellscript.vbs like C:\path\to\.


