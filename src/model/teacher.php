<?php

require_once 'db-helper.php';

class Teacher {
    var $tid;
    var $title;
    var $name;
    var $lastname;
    var $oldname;
    var $oldlastname;
    var $start_year;
    var $end_year;
    var $tugen;
    var $sex;
    var $nationalid;
    var $birthday;
    var $houseno;
    var $building;
    var $villageno;
    var $soi;
    var $subdistrict;
    var $district;
    var $province;
    var $postalcode;
    var $country;
    var $hometel;
    var $mobile;
    var $email;

    function __construct($properties = array()) {
        $this->tid = 0;
        foreach ($properties as $prop => $val) {
            // TODO: remove null value from this
            $this->$prop = $val;
        }
    }

    function edit($properties) {
        foreach ($properties as $prop => $val) {
            // TODO: remove null value from this
            $this->$prop = $val;
        }
    }

    function save() {
        if ($this->tid == 0) {
            // this teacher doesn't exists before => insert
            $pdo = DB::getPDO();
            $params = DB::objectToParams($this, array('tid'));

            $insertFields = DB::objectToInsertParams($this, array('tid'));
            $insertValues = DB::objectToValueParams($this, array('tid'));

            $stmt = $pdo->prepare("INSERT INTO Teacher $insertFields
                                        VALUES $insertValues
            ");
            $stmt->execute($params);
            $numAffectedRows = $stmt->rowCount();
            $newId = $pdo->lastInsertId();
            $this->tid = $newId;
            return $numAffectedRows;
        } else {
            // this teacher already exists => update
            $pdo = DB::getPDO();
            $params = array();

            $updateStmt = DB::objectToInsertParams($this, array('tid'));

            $stmt = $pdo->prepare("UPDATE Teacher
                                      SET $updateStmt
                                    WHERE tid = :tid
            ");
            $stmt->execute($params);
            $numAffectedRows = $stmt->rowCount();
            $newId = $pdo->lastInsertId();
            $this->tid = $newId;
            return $numAffectedRows;
        }
    }

    function delete() {
        try {
            $pdo = DB::getPDO();
            $params = array(
                ':tid' => $this->tid
            );
            $stmt = $pdo->prepare('DELETE FROM Teacher
                                     WHERE tid = :tid');
            $stmt->execute($params);
            $affectedRows = $stmt->rowCount();
            return $affectedRows > 0;
        } catch (Exception $e) {
            return false;
        }
    }

    static function load($tid) {
        $pdo = DB::getPDO();
        $params = array(
            ':tid' => $tid
        );

        $stmt = $pdo->prepare('SELECT * FROM Teacher
                                       WHERE tid = :tid'
        );
        $stmt->execute($params);
        $props = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!is_array($props)) {
            return false;
        }
        return new Teacher($props);
    }

    static function getByName($name) {
        $pdo = DB::getPDO();
        $params = array(
            ':name' => $name
        );

        $stmt = $pdo->prepare('SELECT * FROM Teacher
                                       WHERE name = :name');
        $stmt->execute($params);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $teachers = array();
        foreach ($rows as $row) {
            $teachers[] = new Teacher($row);
        }
        return $teachers;
    }

    static function loadAll($start = 0, $limit = 50) {
        $pdo = DB::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM Teacher LIMIT $start, $limit");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $teachers = array();
        foreach ($rows as $row) {
            $teachers[] = new Teacher($row);
        }
        return $teachers;
    }

//    static function deleteById($id) {
//        $pdo = DB::getPDO();
//        $params = array(
//            ':tid' => $id
//        );
//        $stmt = $pdo->prepare('DELETE FROM Teacher WHERE tid = :tid');
//        $numAffected = $stmt->execute($params);
////        if ($numAffected == 0)
//    }

    static function loadByQuery($queryProps, $start = 0, $limit = 50) {
        $searchParams = DB::objectToQueryField($queryProps);
        $queryParams = DB::objectToQueryParams($queryProps);
        $pdo = DB::getPDO();
        $stmt = $pdo->prepare("SELECT tid, name, lastname, oldname, oldlastname FROM Teacher
                                                                               WHERE $searchParams
                                                                               LIMIT $start, $limit");
        $stmt->execute($queryParams);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $teachers = array();
        foreach ($rows as $row) {
            $teachers[] = new Teacher($row);
        }
        return $teachers;
    }

}
