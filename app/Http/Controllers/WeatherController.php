<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{

    public function welcome()
    {
        return view('welcome');
    }

    public function showWeather(Request $request)
    {
        try {
            $lat = $request->query('lat');
            $lon = $request->query('lon');

            $apiKey = config('services.weather.api_key');
            $apiEndpoint = "https://api.weatherapi.com/v1/current.json";
            $params = [
                'key' => $apiKey,
                'q' => "{$lat},{$lon}",
                'lang' => 'ja',
            ];
            
            $response = Http::get($apiEndpoint, $params);
            $weatherData = $response->json();

            $city = $weatherData['location']['region'];
            $temperature = $weatherData['current']['temp_c'];
            $condition = $weatherData['current']['condition']['text'];
            
            $cityKanji = config("cities.{$city}", $city);

            return view('home', [
                'city' => $cityKanji,
                'temperature' => $temperature,
                'condition' => $condition,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error fetching weather data: ' . $e->getMessage());
            return view('home')->with('error', 'Unable to fetch weather data');
        }
    }
}
