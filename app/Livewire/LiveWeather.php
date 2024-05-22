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
    protected $rules = [
        'city' => 'required|min:3|string',
    ];

    public function render()
    {
        if(!empty(auth()->user())) {
            $this->userCities = auth()->user()->cities;
        }
        return view('livewire.live-weather');
    }

    public function getWeather(WeatherApiAction $weatherAction)
    {
        $this->validate();
        $weatherAction->execute($this->city);
    }
}
//
//import pandas as pd
//
//# User data (Reduced to 10 users)
//users = pd.DataFrame([
//    {"user_id": 1, "gender": "Female", "age": 30, "ethnicity": "Asian", "location": "New York", "has_family": True, "type_of_commitment": "Full-time job"},
//    {"user_id": 2, "gender": "Male", "age": 25, "ethnicity": "Caucasian", "location": "Los Angeles", "has_family": False, "type_of_commitment": "Student"},
//    {"user_id": 3, "gender": "Female", "age": 45, "ethnicity": "African American", "location": "Chicago", "has_family": True, "type_of_commitment": "Part-time job"},
//    {"user_id": 4, "gender": "Male", "age": 35, "ethnicity": "Hispanic", "location": "Houston", "has_family": True, "type_of_commitment": "Full-time job"},
//    {"user_id": 5, "gender": "Female", "age": 28, "ethnicity": "Caucasian", "location": "Phoenix", "has_family": False, "type_of_commitment": "Freelancer"},
//    {"user_id": 6, "gender": "Male", "age": 32, "ethnicity": "Asian", "location": "Philadelphia", "has_family": True, "type_of_commitment": "Full-time job"},
//    {"user_id": 7, "gender": "Female", "age": 29, "ethnicity": "Hispanic", "location": "San Antonio", "has_family": False, "type_of_commitment": "Student"},
//    {"user_id": 8, "gender": "Male", "age": 40, "ethnicity": "African American", "location": "San Diego", "has_family": True, "type_of_commitment": "Full-time job"},
//    {"user_id": 9, "gender": "Female", "age": 50, "ethnicity": "Caucasian", "location": "Dallas", "has_family": True, "type_of_commitment": "Retired"},
//    {"user_id": 10, "gender": "Male", "age": 27, "ethnicity": "Asian", "location": "San Jose", "has_family": False, "type_of_commitment": "Freelancer"}
//])
//
//# Favorite cars data (Reduced to 10 users)
//favorite_cars = pd.DataFrame([
//    {"user_id": 1, "favorite_cars": ["Subaru Outback", "Toyota Camry", "Honda Civic"]},
//    {"user_id": 2, "favorite_cars": ["Honda Civic", "Mazda CX-5", "Tesla Model 3"]},
//    {"user_id": 3, "favorite_cars": ["Toyota Camry", "Chevrolet Tahoe", "Kia Sorento"]},
//    {"user_id": 4, "favorite_cars": ["Ford F-150", "Chevrolet Tahoe", "Toyota Camry"]},
//    {"user_id": 5, "favorite_cars": ["Tesla Model 3", "Hyundai Elantra", "Mazda CX-5"]},
//    {"user_id": 6, "favorite_cars": ["Toyota Camry", "Lexus RX", "Subaru Outback"]},
//    {"user_id": 7, "favorite_cars": ["Nissan Altima", "Honda Civic", "Hyundai Elantra"]},
//    {"user_id": 8, "favorite_cars": ["Ford F-150", "Chevrolet Tahoe", "Subaru Outback"]},
//    {"user_id": 9, "favorite_cars": ["Lexus RX", "Toyota Camry", "Mercedes-Benz C-Class"]},
//    {"user_id": 10, "favorite_cars": ["Tesla Model 3", "Audi A4", "BMW 3 Series"]}
//])
//
//# Define the target user profile
//target_profile = {
//    "gender": "Male",
//    "age": 29,
//    "ethnicity": "Asian",
//    "has_family": True,
//    "type_of_commitment": "Full-time job"
//}
//
//# Find similar users
//similar_users = users[
//(users["gender"] == target_profile["gender"]) &
//(users["ethnicity"] == target_profile["ethnicity"]) &
//(users["has_family"] == target_profile["has_family"]) &
//(users["type_of_commitment"] == target_profile["type_of_commitment"])
//]
//
//# Extract favorite cars for similar users
//recommended_cars = favorite_cars[favorite_cars["user_id"].isin(similar_users["user_id"])]
//
//# Flatten the list of favorite cars
//car_recommendations = recommended_cars["favorite_cars"].explode().value_counts()
//
//# Display the recommended cars
//recommended_cars_array = car_recommendations.index.to_numpy()
//print(recommended_cars_array)
