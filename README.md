<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Requirements
- php version  >= 8.2 
- composer
- npm 

## Installation
Use your local terminal
- run: ```composer install```
- update .env.example to .env and update the database credentials to satisfy your local environment
- To migrate the initial schema run: ```php artisan migrate ```
- To install the components run: ``` npm install ``` and ``` npm run build ``` 
- run: php artisan serve . This command will start a server at the address http://127.0.0.1:8000/
- That's it. Create an account and enjoy the api.  :)

## Testing
   run: php artisan test --filter WeatherApiTest tests/Feature/WeatherApiTest.php
