<?php

namespace Alaska\Src\Model;
use \PDO;

/**
 * Class Manager
 * classe abstraite
 * @package Alaska\Src\Model
 */
abstract class Manager
{
    /**
     * @var $_db            Instance de PDO
     */
    private $_db;

    /**
     * @const   HOST            Nom du server.
     * @const   DB_NAME         Nom de la bdd.
     * @const   CHARSET         Encodage.
     * @const   DB_HOST         Nom du server, de la bdd et de l'encodage.
     * @const   DB_USER         Nom de l'utilisateur.
     * @const   DB_PASS         Mot de passe de l'utilisateur.
     */
    const HOST = 'localhost';
    const DB_NAME = 'projet4';
    const CHARSET = 'utf8';
    const DB_HOST = 'mysql:host='. self::HOST .';dbname=' . self::DB_NAME . ';charset=' . self::CHARSET;
    const DB_USER = 'root';
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