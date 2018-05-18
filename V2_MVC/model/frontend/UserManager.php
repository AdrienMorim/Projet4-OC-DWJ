<?php

namespace V2_MVC\Model\Frontend;

require_once('model/frontend/Manager.php');

/**
 * Class UserManager
 * @package V2_MVC\Model\Frontend
 */
class UserManager extends Manager
{
    /**
     * @param $pseudo
     * @param $pass
     * @return mixed
     */
    public function getUser($pseudo)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, id_group, pseudo, pass FROM users WHERE pseudo = ?');
        $req->execute(array($pseudo));
        $user = $req->fetch();

        return $user;
    }

    public function createUser($id_group, $pseudo, $password_hache, $email)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO users(id_groupe, pseudo, pass, email, registration_date) VALUES(?, ?, ?, ?, NOW())');
        $registerUser = $req->execute(array($id_group, $pseudo, $password_hache, $email));

        return $registerUser;
    }

    public function updateUser($id, $pseudo, $password_hash, $email) // A MODIFIER
    {
        $db = $this->dbConnect();

    }

    public function deleteUser($id) // A Ajouter dans le controller
    {
        $db = $this->dbConnect();
        $user = $db->prepare('DELETE FROM users WHERE id= ?');
        $deleteUser = $user->execute(array($id));

        return $deleteUser;
    }
}