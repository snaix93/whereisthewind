<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWeather extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'city_weather_id'
    ];
}
