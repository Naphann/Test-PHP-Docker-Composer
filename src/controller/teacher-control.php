<?php

require_once __DIR__ . '/../model/teacher.php';

function validateEditTeacherForm($body) {
    return true;
}

Flight::route('/t/@id', function ($id) {
    $t = Teacher::load($id);
    var_dump($t);
});

Flight::route('/api/teacher', function () {
    // TODO: need authorization
    // TODO: in browser unreadable char but in POSTMAN it's fine ?
    $teachers = Teacher::loadAll();
    Flight::json($teachers);
});

Flight::route('GET /api/teacher/@id', function ($id) {
    // TODO: need authorization
    $teacher = Teacher::load($id);
    if ($teacher === false) {
        // error no id found
        $resp = array('error' => 'tid not found');
        Flight::json($resp, 500);
    } else {
        Flight::json($teacher);
    }
});

Flight::route('PUT /api/teacher/@id', function ($id) {
    // TODO: need authorization
    $body = Flight::request()->getBody();
    if (!validateEditTeacherForm($body)) {
        $teacher = Teacher::load($id);
        $teacher->edit($body);
        $result = $teacher->save();
        if ($result <= 0) {
            $resp = array('error' => 'something went wrong', 'success' => false);
            Flight::json($resp, 500);
        } else {
            $resp = array('success' => true);
            Flight::json($resp);
        }
    }
});

Flight::route('POST /api/teacher/search', function () {
    // TODO: validate form
    // TODO: authorization
    $body = json_decode(Flight::request()->getBody());
    $teachers = Teacher::loadByQuery($body);
    Flight::json($teachers);
});

Flight::route('DELETE /api/teacher/@id', function ($id) {
    // TODO: need authorization

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
