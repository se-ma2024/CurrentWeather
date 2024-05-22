<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function showWeather()
    {
        try{
            $apiKey = config('services.weather.api_key');
            $apiEndpoint = "https://api.weatherapi.com/v1/current.json";
            $params = [
                'key' => $apiKey,
                'q' => "tokyo",
                'lang' => 'ja',
            ];
            
            $response = Http::get($apiEndpoint, $params);
            
            $weatherData = $response->json();
            $city = $weatherData['location']['name'];
            $temperature = $weatherData['current']['temp_c'];
            $condition = $weatherData['current']['condition']['text'];
            
            return view('home', [
                'city' => $city,
                'temperature' => $temperature,
                'condition' => $condition,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error fetching weather data: ' . $e->getMessage());
        }
    }
}
