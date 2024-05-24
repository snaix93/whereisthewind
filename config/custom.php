<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Weather Api Credentials
    |--------------------------------------------------------------------------
    | This file would not be necessary in a real app.
    | The secret would be called from .env or better Circle.ci or AWS
    */

    'weather_secret' => env('WEATHER_SECRET', ''),
    'open-ai' => env('OPEN_AI', ''),
    'open-ai-api' => env('OPEN_AI_API', 'https://api.openai.com/v1/chat/completions'),
];
