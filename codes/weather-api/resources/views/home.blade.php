<!DOCTYPE html>
<html>
<head>
    <title>API Documentation: http://api.weather.local/api</title>
</head>
<body>
<h1>API Documentation: http://api.weather.local/api</h1>

<h2>Endpoints</h2>

<h3>1. /weather/{city}</h3>

<h4>Description</h4>
<p>This endpoint returns the current weather information for the specified city.</p>

<h4>Method</h4>
<p>GET</p>

<h4>URL</h4>
<p>http://api.weather.local/api/weather/{city}</p>

<h4>URL Parameters</h4>
<ul>
    <li>city: name of the city (required)</li>
</ul>

<h4>Success Response</h4>
<p>Code: 200 OK</p>
<p>Content:</p>
<pre>
  {
      "city": "city",
      "temperature": "temperature",
      "humidity": "humidity",
      "wind_speed": "wind_speed",
      "weather_condition": "weather_condition"
  }
  </pre>

<h4>Error Response</h4>
<p>Code: 404 Not Found</p>
<p>Content:</p>
<pre>
  {
      "error": "City not found"
  }
  </pre>

<h3>2. /nearby/{city}</h3>

<h4>Description</h4>
<p>This endpoint returns the weather information for cities located near the specified city.</p>

<h4>Method</h4>
<p>GET</p>

<h4>URL</h4>
<p>http://api.weather.local/api/nearby/{city}</p>

<h4>URL Parameters</h4>
<ul>
    <li>city: name of the city (required)</li>
</ul>

<h4>Success Response</h4>
<p>Code: 200 OK</p>
<p>Content:</p>
<pre>
  [
      {
          "city": "city",
          "temperature": "temperature",
          "humidity": "humidity",
          "wind_speed": "wind_speed",
          "weather_condition": "weather_condition"
      },
      ...
  ]
  </pre>

<h4>Error Response</h4>
<p>Code: 404 Not Found</p>
<p>Content:</p>
<pre>
  {
      "error": "City not found"
  }
  </pre>

<h2>Note</h2>
<p>Endpoint names and response data may vary and are subject to change. Be sure to check for any updates to this documentation. If you encounter any issues or have any questions, please contact the API provider for further assistance.</p>
</body>
</html>
