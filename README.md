weather-app-docker

## About
This is as development environment that will run multiple containers.

A api app
and a web weather frontend


## Installation

go to your systems host file and add the following.
```
127.0.0.1       api.weather.local
127.0.0.1       weather.local
```
then go to the root folder and run (make sure that the.sh files are executable)
```
./start.sh
```
This will start the loading of containers, one you see
the messages below it means the environment has started.

````
[+] Running 5/5
 ⠿ Container wa-app      Started                                                                                             7.5s
 ⠿ Container wa-mariadb  Started                                                                                             7.4s
 ⠿ Container wa-redis    Started                                                                                             7.5s
 ⠿ Container wa-yarn     Started                                                                                             8.5s
 ⠿ Container wa-nginx    Started  
```