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

    function __construct($properties=array()) {
        $this->tid = 0;
        foreach ($properties as $prop => $val) {
            $this->$prop = $val;
        }
    }

    function load($tid) {
        $pdo = DB::getPDO();
        $params = array(
            ':tid' => $tid
        );

        $stmt = $pdo->prepare('SELECT * FROM Teacher
                                       WHERE tid = :tid'
        );
        $stmt->execute($params);
        $props = $stmt->fetch(PDO::FETCH_ASSOC);

        return new Teacher($props);
    }

    function edit($properties) {
        foreach ($properties as $prop => $val) {
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

}
