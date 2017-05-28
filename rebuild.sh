#! /bin/bash

DOCKER="docker"
COMPOSE="docker-compose"
DB_VOLUME="testphpdockercompose_db-data"

set -e

if grep -qE "(Microsoft|WSL)" /proc/version &> /dev/null ; then
    DOCKER="docker.exe"
    COMPOSE="docker-compose.exe"
fi

# $COMPOSE down
if echo "$($DOCKER volume ls)" | grep -qE "$DB_VOLUME" ; then
    $DOCKER volume rm testphpdockercomposer_db-data
fi

$COMPOSE build
$COMPOSE up -d
echo "rebuilding done !!!"
