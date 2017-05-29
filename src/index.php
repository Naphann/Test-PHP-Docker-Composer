<?php
ini_set('display_errors', 1);

require 'vendor/autoload.php';

Flight::route('/', function() {
    $config = parse_ini_file('./config/test.ini');
    var_dump($config);
    echo 'index page foo';
});

Flight::route('/foo', function() {
    echo 'foo page';
});

Flight::start();
