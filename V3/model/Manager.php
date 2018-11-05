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
        $host = 'mysql:host=localhost;'; // db760145379.hosting-data.io
        $database = 'dbname=projet4';
        $dsn = $host . $database;
        $username = 'root'; // dbo760145379
        $password = 'root'; // Livio.3107

        $this->_db = new PDO($dsn . ';charset=utf8', $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $this->_db;
    }
}