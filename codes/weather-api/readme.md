weather.local

## About
This is the api
```
http://api.weather.local/api
```

## Installation

Ensure that the container are running by checking docker desktop or running
```
docker ps
```
Go inside of the container wa-app
```
docker exec -it wa-app bash
```
you will see a promp
```
root@54b7c333ae92:/srv/html# 
```
cd to weather-www directory
```
cd /weather-api
```
and run
```
composer install
```
after the exit the container then run
and run
```
docker-compose run wa-yarn bash
```

## Endpoints
```
http://api.weather.local/api/weather/{city)
http://api.weather.local/api/nearby/{city}
```

