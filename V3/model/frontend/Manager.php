<?php

namespace V3\Model\Frontend;
use \PDO;

/**
 * Class Manager
 * @package V3\Model\Frontend
 */
class Manager
{
    /**
     * @var string      $_db            Objet PDO d'acces à la bdd
     * @var string      $_host          le nom de l'hôte
     * @var string      $_database      la base de donnée
     * @var string      $_username      le login
     * @var string      $_password      le mot de passe
     */
    private $_db, $_host, $_database, $_username, $_password;

    /**
     * Manager constructor.
     */
    public function __construct()
    {
        $this->_host = 'localhost';
        $this->_database = 'projet4';
        $this->_username = 'root';
        $this->_password = 'root';
    }

    /**
     * @return string
     */
    private function getHost()
    {
        return $this->_host;
    }

    /**
     * @return string
     */
    private function getDatabase()
    {
        return $this->_database;
    }

    /**
     * @return string
     */
    private function getUsername()
    {
        return $this->_username;
    }

    /**
     * @return string
     */
    private function getPassword()
    {
        return $this->_password;
    }

    /**
     * @return PDO
     */
    protected function dbConnect()
    {
        $this->_db = new PDO('mysql:host=' . $this->getHost() . ';dbname=' . $this->getDatabase() . ';charset=utf8', $this->getUsername(), $this->getPassword(), array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $this->_db;
    }
}