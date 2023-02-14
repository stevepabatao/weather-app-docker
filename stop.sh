#!/bin/sh

echo "Remove all containers"
docker rm -f $(docker ps -aq)
