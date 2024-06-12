<?php

require 'config.php';
require 'services/WeatherService.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $location = $_POST['location'];

    $weatherService = new WeatherService();
    $weatherData = $weatherService->getWeather($location);

    $weatherJson = json_encode($weatherData);
    header("Location: index.php?weather=" . urlencode($weatherJson));
}

?>
