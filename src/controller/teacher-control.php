<?php
    
require_once 'model/teacher.php';

Flight::route('/teacher', function() {
    echo 'teacher page';
});

Flight::route('/edit/@id', function($id) {
    Flight::render('test.php', array('name' => 'Bob'));
});