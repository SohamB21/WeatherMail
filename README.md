# WeatherMail

WeatherMail is a web application that provides weather summaries via email using OpenAI's natural language generation and a weather API.

## Installation

To run WeatherMail locally, follow these steps:

1. **Clone the repository:**

   ```bash
   git clone https://github.com/SohamB21/WeatherMail.git
   cd WeatherMail
   ```

2. **Install dependencies:**

   WeatherMail requires PHP and a web server (e.g., Apache, Nginx). If you don't have PHP installed, you can install it using XAMPP, WAMP, or any other PHP environment.

3. **Set up configuration:**

   - Create a `config.php` file in the root directory with your API keys:

     ```php
     <?php
     
     define('WEATHER_API_KEY', 'your_weather_api_key');
     define('OPENAI_API_KEY', 'your_openai_api_key');
     
     ?>
     ```

     Replace `'your_weather_api_key'` and `'your_openai_api_key'` with your actual API keys.

4. **Start your web server:**

   Configure your web server to serve the `WeatherMail` directory.

5. **Access the application:**

   Open a web browser and navigate to `http://localhost/WeatherMail` (adjust the URL based on your server configuration).

## Usage

- **Accessing the application:**
  - Navigate to the homepage (`index.php`) to use WeatherMail.
  - Enter your email address and submit to receive a weather summary via email.

## Functionality Description

WeatherMail integrates two main functionalities:

1. **Weather Data Retrieval:**
   - Uses an API from https://www.weatherapi.com/ to fetch current weather data based on user input.

2. **Email Sending:**
   - Sends weather summary emails using PHP's `mail()` function, integrating OpenAI's natural language generation to provide a descriptive weather report.

## Examples of API Responses

- **Weather API Response:**

  ```json
  {
    "location": "New York",
    "temperature": 25,
    "description": "Partly cloudy",
    "humidity": 70
  }
  ```

- **OpenAI API Response (Generated Weather Report):**

  ```plaintext
  Today's weather in New York is partly cloudy with a temperature of 25 degrees Celsius and 70% humidity.
  ```

## Contributing

Contributions are welcome! Follow these steps to contribute to WeatherMail:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature/your-feature`).
3. Make your changes.
4. Commit your changes (`git commit -am 'Add new feature'`).
5. Push to the branch (`git push origin feature/your-feature`).
6. Create a new Pull Request.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
