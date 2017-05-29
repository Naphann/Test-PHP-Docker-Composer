<?php
ini_set('display_errors', 1);

require 'vendor/autoload.php';

Flight::route('/', function() {
    echo 'index page';
});

Flight::route('/foo', function() {
    echo 'foo page';
});

Flight::start();
