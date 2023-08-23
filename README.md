<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Task2

Install Laravel 8 & write a function to validate and book tickets while adhering to the following specifications.

Specifications
---------------
1. There are initially 200 seats available across 20 columns (columns A to T) and 10 rows (row 1 to 10). So the first seat will be represented as A1 , and last seat as T10 in both input and output operations.
2. The function will accept the input of 1 seat of user's choice, and the number of tickets they want to book (maximum 5). Ex: "bookSeats('A15', 4);"
3. The function will need to check for available adjacent seats (both left or right of the supplied seat) including the seat of user's choice matching the number of tickets supplied.
4. If the seats are available, the function will need to book them in database and return a confirmation with the list of seats booked.
5. If the seats are not available, the function needs to return a message indicating a booking failure, and a set of alternate suggested seats depending on availability.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
