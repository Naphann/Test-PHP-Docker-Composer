<?php
ini_set('display_errors', 1);

require 'vendor/autoload.php';
require_once 'controller/teacher-control.php';
require_once 'model/teacher.php';
require_once 'model/db-helper.php';
require_once 'model/foo.php';

Flight::route('/', function() {
    echo 'index page';
});

Flight::route('/foo', function() {
    echo 'foo page';
    $foo = new Foo('nap', 12, 'hello world');
    var_dump(DB::objectToUpdateParams($foo, ['name']));
});

Flight::start();
