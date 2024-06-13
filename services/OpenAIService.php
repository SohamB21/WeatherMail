<?php

class OpenAIService
{
    public function generateWeatherReport($weatherData)
    {
        $apiKey = OPENAI_API_KEY;
        $url = "https://api.openai.com/v1/completions";

        $data = [
            'model' => 'babbage-002',
            'prompt' => $this->createPrompt($weatherData),
            'max_tokens' => 150
        ];

        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $apiKey
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);

        if ($response === false) {
            throw new Exception('Error contacting OpenAI API: ' . curl_error($ch));
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200) {
            throw new Exception('Error: ' . $httpCode . ' - ' . $response);
        }

        $responseData = json_decode($response, true);
        
        if (isset($responseData['choices'][0]['text'])) {
            return $responseData['choices'][0]['text'];
        } else {
            throw new Exception('Unexpected response format from OpenAI API');
        }
    }

    private function createPrompt($weatherData)
    {
        return "Generate a weather report for the following weather data:\n" .
               "Location: " . $weatherData['location']['name'] . ", " . $weatherData['location']['country'] . "\n" .
               "Temperature: " . $weatherData['current']['temp_c'] . "°C\n" .
               "Condition: " . $weatherData['current']['condition']['text'] . "\n" .
               "Humidity: " . $weatherData['current']['humidity'] . "%\n" .
               "Wind Speed: " . $weatherData['current']['wind_kph'] . " kph\n" .
               "Pressure: " . $weatherData['current']['pressure_mb'] . " mb\n" .
               "Precipitation: " . $weatherData['current']['precip_mm'] . " mm\n" .
               "Feels Like: " . $weatherData['current']['feelslike_c'] . "°C\n" .
               "Visibility: " . $weatherData['current']['vis_km'] . " km\n" .
               "UV Index: " . $weatherData['current']['uv'] . "\n" .
               "Last Updated: " . $weatherData['current']['last_updated'] . "\n" .
               "Cloud Cover: " . $weatherData['current']['cloud'] . "%\n" .
               "Gust Speed: " . $weatherData['current']['gust_kph'] . " kph\n";
    }
}

?>