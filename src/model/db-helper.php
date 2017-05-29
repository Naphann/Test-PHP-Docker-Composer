<?php

class DB {

    function __construct() {
    }

    static function getPDO() {
        try {
            $config = parse_ini_file(__DIR__.'/../config/database-config.ini');
            $pdo = new PDO('mysql:host=' . $config['servername'] . ';dbname=' . $config['dbname'] . ';charset=utf8mb4',
                $config['username'], $config['password']);
            return $pdo;
        } catch (PDOException $e) {
            die(json_encode(array('outcome' => false, 'message' => 'Unable to connect', 'errorMessage' => $e)));
        }
    }
    
    static function objectToParams($obj, $exceptionList=array()) {
        $arr = array();
        foreach ($obj as $key => $val) {
            if (in_array($key, $exceptionList)) {
                continue;
            } else {
                $arr[":$key"] = $val;
            }
        }
        return $arr;
    }

    static function objectToInsertParams($obj, $exceptionList=array()) {
        $arr = array();
        foreach ($obj as $key => $val) {
            if (in_array($key, $exceptionList)) {
                continue;
            } else {
                $arr[] = $key;
            }
        }

        return '(' . join(',', $arr) . ')';
    }

    static function objectToValueParams($obj, $exceptionList=array()) {
        $arr = array();
        foreach ($obj as $key => $val) {
            if (in_array($key, $exceptionList)) {
                continue;
            } else {
                $arr[] = ":$key";
            }
        }

        return '(' . join(',', $arr) . ')';
    }

    static function objectToUpdateParams($obj, $exceptionList=array()) {
        $arr = array();
        foreach ($obj as $key => $val) {
            if (in_array($key, $exceptionList)) {
                continue;
            } else {
                $arr[] = "$key = :$key";
            }
        }

        return join(', ', $arr);
    }
}