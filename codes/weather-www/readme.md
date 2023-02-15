weather.local

## About
This is the front facing web app, it request for data to 
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
cd /weather-www
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
then cd again to weather-www directory
```
cd /weather-www
```
then run
```
yarn install
```
then run
```
yarn run dev //or
yarn run watch
```
## Requirement
Composer
Yarn

## Note
The app is a one page app with a weather interface and a recommendations section.

Only the weather interface is running and not the recommendations, because I'm having issues
getting results from the foursquare places api.

