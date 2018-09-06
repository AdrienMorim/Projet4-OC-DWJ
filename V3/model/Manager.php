<?php

namespace V3\Model;
use \PDO;

/**
 * Class Manager
 * classe abstraite
 * @package V3\Model\Backend
 */
abstract class Manager
{
    /**
     * @var $_db            Instance de PDO
     */
    private $_db;

    /**
     * @return Instance
     */
    public function getDb()
    {
        return $this->_db;
    }
    /**
     * @return PDO|Instance
     */
    protected function dbConnect()
    {
        $host = 'mysql:host=localhost;';
        $database = 'dbname=projet4';
        $dsn = $host . $database;
        $username = 'root';
        $password = 'root';

        $this->_db = new PDO($dsn . ';charset=utf8', $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $this->_db;
    }
}