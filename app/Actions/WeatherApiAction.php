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
     * Delete the given user.
     */
    public function execute($city): CityWeather
    {
        $city = strtolower($city);
        //Get the lat & lon for the city
        $latLonByName = Http::withUrlParameters([
            'endpoint' => 'http://api.openweathermap.org',
            'page' => 'geo',
            'version' => '1.0',
            'type' => 'direct',
            'city' => $city,
            'limit' => 5,
            'api_key' => config('custom.weather_secret')
        ])->get('{+endpoint}/{page}/{version}/{type}?q={city}&limit={limit}&appid={api_key}');

        //Select the first result (if are multiple cities with the same name).
        // This approach is only for this test app (otherwise user would select the country)
        $latLonByName = $latLonByName->collect()->first();

        if(!empty($latLonByName['name'])){
            $lat = $latLonByName['lat'];
            $lon = $latLonByName['lon'];
        }

        //Get the weather by lat & lon
        $cityWeather = Http::withUrlParameters([
            'endpoint' => 'https://api.openweathermap.org',
            'page' => 'data',
            'version' => '2.5',
            'type' => 'weather',
            'lat' => $lat,
            'lon' => $lon,
            'api_key' => config('custom.weather_secret')
        ])->get('{+endpoint}/{page}/{version}/{type}?lat={lat}&lon={lon}&appid={api_key}&units=metric');

        //Check if the city already exists in the database and create if not
        $location = CityWeather::whereCity($city)
            ->first();


        if(empty($location)){
            $location = CityWeather::create([
                'city' => $city,
                'lat' => $lat,
                'lon' => $lon
            ]);
        }

        $userWeather = UserWeather::whereUserId(($user = auth()->user())->id)
            ->whereCityWeatherId($location->id)->first();

        if(empty($userWeather)){
            $userWeather = UserWeather::create([
                'user_id' => $user->id,
                'city_weather_id' => $location->id
            ]);
        }

        $cityWeather = $cityWeather->object();

        $location->update([
            'comment' => !empty($comment = $cityWeather->weather[0]) ? $comment->description : null,
            'temp' => $cityWeather->main->temp,
            'temp_feels_like' => $cityWeather->main->feels_like,
            'temp_min' => $cityWeather->main->temp_min,
            'temp_max' => $cityWeather->main->temp_max,
            'humidity' => $cityWeather->main->humidity,
            'weather_updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        return $location;
//        'name' => 'Madagascar'
//    'local_names' => array:7 [▶]
//    'lat' => -18.77914875
//    'lon' => 46.712171616567
//    'country' => 'MG'
//    'state' => 'Province d’Antananarivo'

        dd($response->json());

        http://api.openweathermap.org/geo/1.0/direct?q=London&limit=5&appid=858f15fed9292cbe25c341a754c55e45
    }
}
