<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Requirements
- php version  >= 8.2 
- composer
- npm 

## Installation
Use your local terminal
- run: ```composer install```
- update .env.example to .env and update the database credentials to satisfy your local environmen
- add the keys to the env  ```OPEN_AI={secret} ``` && ``` WEATHER_SECRET={secret} ``` that I have provided.
- To migrate the initial schema run: ```php artisan migrate ```
- To install the components run: ``` npm install ``` and ``` npm run build ``` 
- run: ```php artisan serve```. This command will start a server at the address http://127.0.0.1:8000/
- That's it. Create an account and enjoy the api.  :)

How to dress? function is connected to ChatGpt and generates data per request.  
## Testing
   run: ```php artisan test --filter WeatherApiTest tests/Feature/WeatherApiTest.php ```


## If I would have more time
- Login modal + google/apple auth
- Limit the number of request per minute 		
- Take in consideration the country (some cities has same/similar names)
- Fahrenheit  option  
- Scheduler to automatically update the weather
- More testing (frontend, api requests, create data)
- Refresh previous requests

