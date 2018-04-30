<?php

class ChapterManager
{
    public function dbConnect()
    {
        private $host = 'localhost';
        private $database = 'projet4';
        private $username = 'root';
        private $password = 'root';

        $db = new PDO('mysql:host=' . $host . ';dbname=' . $database . ';charset=utf8', $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $db;
    }
}