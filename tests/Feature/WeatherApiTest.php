<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class WeatherApiTest extends TestCase
{

    public function test_landing_page_not_broken(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_api_endpoint_is_not_down(): void
    {
        $response = Http::get('http://api.openweathermap.org');
        $this->assertEquals(200, $response->status());

    }

    public function test_lat_lon_api_works(): void
    {
        $response = Http::withUrlParameters([
            'endpoint' => 'http://api.openweathermap.org',
            'page' => 'geo',
            'version' => '1.0',
            'type' => 'direct',
            'city' => 'London',
            'limit' => 5,
            'api_key' => config('custom.weather_secret')
        ])->get('{+endpoint}/{page}/{version}/{type}?q={city}&limit={limit}&appid={api_key}');

        $this->assertEquals(200, $response->status());
        $this->assertEquals('London', $response->collect()->first()['name']);
    }

    public function test_location_weather_works(): void
    {
        $response = Http::withUrlParameters([
            'endpoint' => 'https://api.openweathermap.org',
            'page' => 'data',
            'version' => '2.5',
            'type' => 'weather',
            'lat' => '25.22',
            'lon' => '21.33',
            'api_key' => config('custom.weather_secret')
        ])->get('{+endpoint}/{page}/{version}/{type}?lat={lat}&lon={lon}&appid={api_key}&units=metric');

        $this->assertEquals(200, $response->status());
        $this->assertEquals($response->collect()->first()['lat'], '25.22');
        $this->assertEquals($response->collect()->first()['lon'], '21.33');

    }

}
