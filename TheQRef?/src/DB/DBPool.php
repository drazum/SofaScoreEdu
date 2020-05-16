<?php

namespace DB;

use \PDO;

final class DBPool {
    private static object $pdo;

    private static string $dbname = "theqref";

    private function __construct() {}

    private function __clone() {}

    public static function getInstance() : object {
        if (!isset(self::$pdo)) {
            try {
                self::$pdo = new PDO("mysql:dbname=" . self::$dbname . ";host=localhost", "root", "",[
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                ]);
            } catch (PDOException $e) {
                var_dump($e);
                die();
            }
        }
        return self::$pdo;
    }
}