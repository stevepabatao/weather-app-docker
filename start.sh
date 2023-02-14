#!/bin/sh

echo "Remove all containers"
docker rm -f $(docker ps -aq)

echo "start app"
docker-compose up --build -d

IP=$(docker inspect -f '{{range.NetworkSettings.Networks}}{{.IPAddress}}{{end}}' wa-nginx)
docker exec -t wa-app bash -c "echo ${IP}  api.local bo.local >> /etc/hosts"
