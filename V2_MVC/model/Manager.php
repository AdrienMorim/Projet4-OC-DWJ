<?php

namespace V2_MVC\Model;

class Manager
{
    protected function dbConnect()
    {
        $host = 'localhost';
        $database = 'projet4';
        $username = 'root';
        $password = 'root';

        $db = new \PDO('mysql:host=' . $host . ';dbname=' . $database . ';charset=utf8', $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $db;
    }
}