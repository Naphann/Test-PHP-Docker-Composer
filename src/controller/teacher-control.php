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
    header('Content-type: application/json');
    echo json_encode($teachers, JSON_UNESCAPED_UNICODE);
});

Flight::route('GET /api/teacher/@id', function ($id) {
    // TODO: need authorization
    $teacher = Teacher::load($id);
    if ($teacher === false) {
        // error no id found
        header('Content-type: application/json', true, 400);
        echo json_encode(array(
            'error' => 'tid not found'
        ), JSON_UNESCAPED_UNICODE);
    } else {
        header('Content-type: application/json');
        echo json_encode($teacher, JSON_UNESCAPED_UNICODE);
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
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
            echo json_encode(array(
                'error' => 'something went wrong'
            ));
        } else {
            header('Content-type: application/json');
            echo json_encode(array(
                'success' => true
            ), JSON_UNESCAPED_UNICODE);
        }
    }
});

Flight::route('POST /api/teacher/search', function () {
    // TODO: validate form
    // TODO: authorization
    $body = json_decode(Flight::request()->getBody());
    $teachers = Teacher::loadByQuery($body);
    header('Content-type: application/json');
    echo json_encode($teachers, JSON_UNESCAPED_UNICODE);
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
