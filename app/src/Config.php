<?php

namespace App;

class Config
{
    public static $DB_SERVER_NAME;
    public static $DB_USERNAME;
    public static $DB_PASSWORD;
    public static $DB_NAME;

    public static function init()
    {
        self::$DB_SERVER_NAME = getenv('DB_SERVER_NAME');
        self::$DB_USERNAME = getenv('DB_USERNAME');
        self::$DB_PASSWORD = getenv('DB_PASSWORD');
        self::$DB_NAME = getenv('DB_NAME');
    }
}

Config::init();
?>