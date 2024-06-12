<?php

class WeatherService
{
    public function getWeather($location)
    {
        $apiKey = WEATHER_API_KEY;
        $url = "http://api.weatherapi.com/v1/current.json?key={$apiKey}&q={$location}";

        $response = file_get_contents($url);
        return json_decode($response, true);
    }
}

?>