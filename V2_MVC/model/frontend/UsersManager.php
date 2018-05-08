<?php

namespace V2_MVC\Model\Frontend;

require_once('model/frontend/Manager.php');

/**
 * Class UsersManager
 * @package V2_MVC\Model\Frontend
 */
class UsersManager extends Manager
{
    /**
     * @param $pseudo
     * @param $pass
     * @return mixed
     */
    public function getUser($pseudo)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, pseudo, pass FROM users WHERE pseudo = ?');
        $req->execute(array($pseudo));
        $user = $req->fetch();

        return $user;
    }

    public function createUser($pseudo, $password_hache, $email)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO users(pseudo, pass, email, registration_date) VALUES( ?, ?, ?, NOW())');
        $registerUser = $req->execute(array($pseudo, $password_hache, $email));

        return $registerUser;
    }
}