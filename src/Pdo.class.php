<?php
class PDO_CLASS {
    private static $_pdo;
    public static function getPDO() {
        if(!self::$_pdo) {
            $settings = require __DIR__ . '/../src/settings.php';
            $dsn = "mysql:host=".getenv('DB_HOST').";dbname=".getenv('DB_DATABASE').";charset=utf8";
            $opt = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            self::$_pdo = new PDO($dsn, $settings['db']['user'], $settings['db']['pass'], $opt);
        }
        return self::$_pdo;
    }
}