<?php

namespace App\Livewire;

use App\Actions\WeatherApiAction;
use App\Models\User;
use App\Models\UserWeather;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class LiveWeather extends Component
{
    public $city;
    public $userCities;
    public $apiResponse;
    protected $rules = [
        'city' => 'required|min:3|string',
    ];

    public function render()
    {
        if(!empty($user = auth()->user())) {
            $this->userCities = $user->cities;
        }

        return view('livewire.live-weather');
    }

    public function getWeather(WeatherApiAction $weatherAction)
    {
        $this->validate();
        $this->apiResponse = $weatherAction->execute($this->city);
        $this->city = '';
    }

    public function resetApiResponse()
    {
        $this->apiResponse = null;
        $this->city = '';
    }
}
