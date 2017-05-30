<?php

require_once __DIR__ . '/../model/teacher.php';

Flight::route('/t/@id', function ($id) {
    $t = Teacher::load($id);
    var_dump($t);
});

Flight::route('/api/teacher', function () {
    // TODO: need authorization
    // TODO: in browser unreadable char but in POSTMAN it's fine ?
    $teachers = Teacher::loadAll();
    header('Content-type: application/json');
    echo json_encode($teachers, JSON_UNESCAPED_UNICODE);
});

Flight::route('/api/teacher/@id', function ($id) {
    // TODO: need authorization
    $teacher = Teacher::load($id);
    header('Content-type: application/json');
    echo json_encode($teacher, JSON_UNESCAPED_UNICODE);
});

Flight::route('/edit/@id', function ($id) {
    // TODO: edit a teacher
    Flight::render('test.php', array('name' => 'Bob'));
});

Flight::route('POST /api/teacher', function () {
    // TODO: create a new teacher
    $body = Flight::request()->getBody();
    echo 'receiving post request with body:';
    var_dump($body);
});
