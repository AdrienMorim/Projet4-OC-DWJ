<?php

namespace V3\Model\Backend;
use \PDO;

/**
 * Class Manager
 * @package V3\Model\Backend
 */
class Manager
{
    private $_db;
    /**
     * @return PDO
     */
    protected function dbConnect()
    {
        $host = 'localhost';
        $database = 'projet4';
        $username = 'root';
        $password = 'root';

        $this->_db = new PDO('mysql:host=' . $host . ';dbname=' . $database . ';charset=utf8', $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $this->_db;
    }
}