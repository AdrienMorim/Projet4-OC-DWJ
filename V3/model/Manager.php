<?php

namespace V3\Model;
use \PDO;

/**
 * Class Manager
 * classe abstraite
 * @package V3\Model
 */
abstract class Manager
{
    /**
     * @var $_db            Instance de PDO
     */
    private $_db;

    /**
     * @const   DB_HOST         Nom du server, de la bdd et de l'encodage.
     */
    const DB_HOST = 'mysql:host=localhost;dbname=projet4;charset=utf8';

    /**
     * @const   DB_USER         Nom de l'utilisateur.
     */
    const DB_USER = 'root';

    /**
     * @const   DB_PASS         Mot de passe de l'utilisateur.
     */
    const DB_PASS = 'root';

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
        $this->_db = new PDO(self::DB_HOST, self::DB_USER, self::DB_PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $this->_db;
    }
}