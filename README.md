# Test-PHP-Docker-Composer
Testing docker-compose with php-apache, composer, phpmyadmin

## project setup

you need to have [Docker](http://www.docker.com) installed in your machine

### follow these steps to start your development

1. cd to the project root folder then 
```
    docker-compose build
```
build process may take a long time to install dependency (composer install)
2. then to start the app
```
    docker-compose up -d
```

### After the run you can access the webapp through
```
    localhost:8080
```

### Or access phpmyadmin via
```
    localhost:8081
```

### to cleanup or rebuild
to rebuild you can run (if you have access to bash)
```
    ./rebuild.sh
```
or 
```
    docker-compose down
    docker volume prune
```
