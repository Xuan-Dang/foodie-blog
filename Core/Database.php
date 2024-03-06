<?php
class Database
{
    const URL = "mysql:host=localhost;dbname=foodieblog;charset=utf8";
    const USERNAME = "root";
    const PASSWORD = "";
    public function connect() {
        $conn = new PDO(self::URL, self::USERNAME, self::PASSWORD);
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
}
