<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WeatherMail</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">
                    Weather Summary
                </h4>
            </div>
            <div class="card-body">

                <?php
                require 'config.php';
                require 'services/OpenAIService.php';
                require 'services/EmailService.php';

                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['weatherData'])) {
                    $weatherData = json_decode($_POST['weatherData'], true);
                    $openaiService = new OpenAIService();
                    
                    try {
                        $weatherReport = $openaiService->generateWeatherReport($weatherData);
                        echo '<p>' . $weatherReport . '</p>';
                    } catch (Exception $e) {
                        $errorMessage = $e->getMessage();
                        $location = $weatherData['location']['name'] ?? 'Unknown location';
                        $temp_c = $weatherData['current']['temp_c'] ?? 'N/A';
                        $humidity = $weatherData['current']['humidity'] ?? 'N/A';
                        $precipitation = $weatherData['current']['precip_mm'] ?? 'N/A';
                        $condition = $weatherData['current']['condition']['text'] ?? 'N/A';

                        $defaultMessage = "Currently in {$location}, the temperature is {$temp_c} °C with a humidity of {$humidity} %. Precipitation is at {$precipitation} mm and the weather condition is described as '{$condition}'.";

                        echo '<div class="alert alert-info" role="alert">';
                        echo $defaultMessage;
                        echo '</div>';
                        echo '<div class="alert alert-danger" role="alert">OpenAI Could Not Generate Weather Report Because: ' . $e->getMessage() . '</div>';
                    }
                } else {
                    echo '<div class="alert alert-danger" role="alert">No weather data received.</div>';
                }

                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['weatherReport']) && isset($_POST['email'])) {
                    $to = $_POST['email'];
                    $weatherReport = $_POST['weatherReport'];

                    // Initialize EmailService
                    $emailService = new EmailService();

                    try {
                        // Send email
                        $emailService->sendEmail($to, 'Weather Report', $weatherReport);
                    } catch (Exception $e) {
                        echo '<div class="alert alert-danger" role="alert">Error: ' . $e->getMessage() . '</div>';
                    }
                }
                ?>
                
                <form action="weatherSummary.php" method="POST">
                    <div class="form-group">
                        <label for="email">Enter your email:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <input type="hidden" name="weatherReport" value="<?= htmlentities($weatherReport) ?? '' ?>">
                    <button type="submit" class="btn btn-primary">Send Email</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>