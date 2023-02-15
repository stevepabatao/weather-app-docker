<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Weather App</title>
    <!-- Link to Bootstrap CSS -->
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">->
    <!-- Link to custom CSS -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
<div id="app">
<div class="container mt-5" >
    <h1 class="text-center">Bizmates PH Weather App</h1>

    <div>
        <weather></weather>
    </div>

    <h3>Recommendations:</h3>

    <div>
        <recommendations></recommendations>
    </div>

</div>
</div>
<script src="{{ mix('js/app.js') }}"></script>
</div>
</body>
</html>

