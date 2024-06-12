<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>WeatherMail</title>
        <link
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
            rel="stylesheet"
        />
        <style>
            .list-group-item {
                padding-top: 5px;
                padding-bottom: 5px;
            }
        </style>
    </head>
    <body>
        <div class="container mt-4">
            <h2 class="text-center mb-5">
                Get Your Personalized Weather Report
            </h2>
            <form action="getWeather.php" method="POST" class="row mb-3">
                <div class="form-group col-md-10">
                    <input
                        type="text"
                        class="form-control"
                        id="location"
                        name="location"
                        placeholder="Enter Location"
                        required
                    />
                </div>
                <div class="form-group col-md-2">
                    <button type="submit" class="btn btn-primary btn-block">
                        Get Weather
                    </button>
                </div>
            </form>
            <?php if (isset($_GET['weather'])): ?> <?php $weatherData =
            json_decode($_GET['weather'], true); ?>
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        Weather Report for <?= $weatherData['location']['name']
                        ?>, <?= $weatherData['location']['country'] ?>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="list-group">
                                <h5
                                    class="list-group-item list-group-item-action active"
                                >
                                    Current Weather
                                </h5>
                                <p class="list-group-item">
                                    Temperature: <?=
                                    $weatherData['current']['temp_c'] ?>°C
                                </p>
                                <p class="list-group-item">
                                    Condition: <?=
                                    $weatherData['current']['condition']['text']
                                    ?>
                                </p>
                                <p class="list-group-item">
                                    Humidity: <?=
                                    $weatherData['current']['humidity'] ?>%
                                </p>
                                <p class="list-group-item">
                                    Wind Speed: <?=
                                    $weatherData['current']['wind_kph'] ?> kph
                                </p>
                                <p class="list-group-item">
                                    Pressure: <?=
                                    $weatherData['current']['pressure_mb'] ?> mb
                                </p>
                                <p class="list-group-item">
                                    Precipitation: <?=
                                    $weatherData['current']['precip_mm'] ?> mm
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="list-group">
                                <h5
                                    class="list-group-item list-group-item-action active"
                                >
                                    Additional Details
                                </h5>
                                <p class="list-group-item">
                                    Feels Like: <?=
                                    $weatherData['current']['feelslike_c'] ?>°C
                                </p>
                                <p class="list-group-item">
                                    Visibility: <?=
                                    $weatherData['current']['vis_km'] ?> km
                                </p>
                                <p class="list-group-item">
                                    UV Index: <?= $weatherData['current']['uv']
                                    ?>
                                </p>
                                <p class="list-group-item">
                                    Last Updated: <?=
                                    $weatherData['current']['last_updated'] ?>
                                </p>
                                <p class="list-group-item">
                                    Cloud Cover: <?=
                                    $weatherData['current']['cloud'] ?>%
                                </p>
                                <p class="list-group-item">
                                    Gust Speed: <?=
                                    $weatherData['current']['gust_kph'] ?> kph
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>
