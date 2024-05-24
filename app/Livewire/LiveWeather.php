<?php

namespace App\Livewire;

use App\Actions\HowToDressAction;
use App\Actions\WeatherApiAction;
use Livewire\Component;

class LiveWeather extends Component
{
    public $city;
    public $userCities;
    public $currentWeather;
    public $user;
    public $showHowToDressButton = false;
    public $howToDress;
    protected $rules = [
        'city' => 'required|min:3|string',
    ];

    public function render()
    {
        if(!empty($this->user = auth()->user())) {
            $this->userCities = $this->user->cities;
        }

        return view('livewire.live-weather');
    }

    public function getWeather(WeatherApiAction $weatherAction)
    {
        if(empty($this->user)){
            return redirect()->route('register');
        }
        $this->validate();
        $this->currentWeather = $weatherAction->execute($this->city);
        $this->showHowToDressButton = (bool)strpos($this->currentWeather, 'current temperature'); //Just for test app
        $this->city = '';
    }

    public function howToDressAPI(HowToDressAction $howToDressAction)
    {
        $this->howToDress = $howToDressAction->execute($this->currentWeather);
        $this->showHowToDressButton = false;
    }

    public function resetApiResponse()
    {
        $this->currentWeather = null;
        $this->city = '';
        $this->howToDress = '';
    }
}
