# Booking REST API

This is a REST api built with the SlimPHP framework and uses MySQL for storage.


### Usage


### Installation

Create database or import from _sql/customer.sql

Edit db/config params

Install SlimPHP and dependencies

```sh
$ composer
```
### API Endpints
```sh
$ GET /booked_tickets  ->  It displays a list of all the bookings made along with user details.
$ GET /booked_tickets/{id}  ->  It displays the details of booking of that specific id.
$ POST /book_ticket  ->  It is used to make a new booking which takes care that there are no more than 20 bookings on any date and time. The input parameters required are "name","phone","email","datentime" and "gender".
$ PUT /update/{id}  ->  It modifies the booking datentime of column and again takes care of the condition that there are no more than 20 bookings at that date and time. The input parameter required is "datentime".
$ DELETE /delete/{id}  ->  It is used to delete the ticket with that specific id.
```
