<?php

namespace App\Actions;

use App\Models\CityWeather;
use App\Models\User;
use App\Models\UserWeather;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Laravel\Jetstream\Contracts\DeletesUsers;

class WeatherApiAction implements DeletesUsers
{
    /**
     * Get weather info based on a city provided by a user
     */
    public function execute($city)
    {
        $city = strtolower($city);
        //Get the lat & lon for the city
        $latLonByName = $this->getLatLon($city);
        if(empty($latLonByName->json())){
            return 'The city is not valid';
        }

        // Select the first result (if are multiple cities with the same name).
//        Todo: allow user to select the country and get only 1 result
        $latLonByName = $latLonByName->collect()->first();
        if(!empty($latLonByName['name'])){
            $lat = $latLonByName['lat'];
            $lon = $latLonByName['lon'];
        }

        //Get the weather by lat & lon
        $cityWeather = $this->getWeatherBasedOnLatLon($lat, $lon);
        $location = $this->checkOrCreateLocation($city, $lat, $lon);

//        Todo: add more checks if the data is not consistent
        $cityWeather = $cityWeather->object();

        $location->update([
            'comment' => !empty($comment = $cityWeather->weather[0]) ? $comment->description : null,
            'current_temp' => $cityWeather->main->temp,
            'temp_feels_like' => $cityWeather->main->feels_like,
            'temp_min' => $cityWeather->main->temp_min,
            'temp_max' => $cityWeather->main->temp_max,
            'humidity' => $cityWeather->main->humidity,
            'weather_updated_at' => Carbon::now(),
        ]);

//        Todo: return with status (success, error, etc.)
        return 'The current temperature in ' . ucfirst($city) . ' is ' . $cityWeather->main->temp
                . '°C. Feels like ' . $cityWeather->main->feels_like . '°C, ' . $comment->description . ', ' . $cityWeather->main->humidity . '% humidity.';
    }

    private function getLatLon($city)
    {
        return Http::withUrlParameters([
            'endpoint' => 'http://api.openweathermap.org',
            'page' => 'geo',
            'version' => '1.0',
            'type' => 'direct',
            'city' => $city,
            'limit' => 5,
            'api_key' => config('custom.weather_secret')
        ])->get('{+endpoint}/{page}/{version}/{type}?q={city}&limit={limit}&appid={api_key}');
    }

    private function getWeatherBasedOnLatLon($lat, $lon)
    {
        return Http::withUrlParameters([
            'endpoint' => 'https://api.openweathermap.org',
            'page' => 'data',
            'version' => '2.5',
            'type' => 'weather',
            'lat' => $lat,
            'lon' => $lon,
            'api_key' => config('custom.weather_secret')
        ])->get('{+endpoint}/{page}/{version}/{type}?lat={lat}&lon={lon}&appid={api_key}&units=metric');
    }

    private function checkOrCreateLocation($city, $lat, $lon)
    {
        //Check if the city already exists in the database
        $location = CityWeather::whereCity($city)
            ->first();

        //Create location if it doesn't exist
        if(empty($location)){
            $location = CityWeather::create([
                'city' => $city,
                'lat' => $lat,
                'lon' => $lon
            ]);
        }

        //Save the search
        $userWeather = UserWeather::whereUserId(($user = auth()->user())->id)
            ->whereCityWeatherId($location->id)->first();
        if(empty($userWeather)){
            UserWeather::create([
                'user_id' => $user->id,
                'city_weather_id' => $location->id
            ]);
        }

        return $location;
    }
}
