<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('city_weather', function (Blueprint $table) {
            $table->id();
            $table->string('city')->index();
            $table->string('comment')->nullable();
            $table->float('lat');
            $table->float('lon');
            $table->float('current_temp')->nullable();
            $table->float('temp_min')->nullable();
            $table->float('temp_max')->nullable();
            $table->float('humidity')->nullable();
            $table->float('temp_feels_like')->nullable();
            $table->dateTime('weather_updated_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('city_weather');
    }
};
