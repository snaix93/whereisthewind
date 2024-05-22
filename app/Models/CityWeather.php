<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CityWeather extends Model
{
    use HasFactory;
    protected $fillable = [
        'city', 'comment', 'lat', 'lon', 'temp_min', 'weather_updated_at',
        'temp_max', 'humidity', 'temp_feels_like', 'weather_update_at'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_weather');
    }
}
