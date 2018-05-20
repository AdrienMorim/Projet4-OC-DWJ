<?php
/**
 * Created by PhpStorm.
 * User: morimadrien
 * Date: 15/05/2018
 * Time: 15:24
 */

namespace V2_MVC\Model\Backend;

require_once('model/backend/Manager.php');

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
    public function getUser($id_user)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM users WHERE id = ?');
        $req->execute(array($id_user));
        $user = $req->fetch();

        return $user;
    }

    public function getAllUsers()
    {
        $db = $this->dbConnect();
        $users = $db->query('SELECT * FROM users ORDER BY registration_date');

        return $users;
    }

    public function createUser($id_group, $pseudo, $password_hache, $email)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO users(id_group, pseudo, pass, email, registration_date) VALUES(?, ?, ?, ?, NOW())');
        $registerUser = $req->execute(array($id_group, $pseudo, $password_hache, $email));

        return $registerUser;
    }

    public function updateUser($id, $id_group, $pseudo, $pass, $email, $firstname, $surname, $birthday)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE users SET id_group= :id_group, pseudo= :pseudo, pass= :pass, email= :email, firstname= :firstname, surname= :surname, birthday_date= :birthday WHERE id= :id');
        $req->bindParam('id_group', $id_group, \PDO::PARAM_INT);
        $req->bindParam('pseudo',$pseudo, \PDO::PARAM_STR);
        $req->bindParam('pass',$pass, \PDO::PARAM_STR);
        $req->bindParam('email', $email, \PDO::PARAM_STR);
        $req->bindParam('firstname', $firstname, \PDO::PARAM_STR);
        $req->bindParam('surname', $surname, \PDO::PARAM_STR);
        $req->bindParam('birthday', $birthday, \PDO::PARAM_STR);
        $req->bindParam('id', $id, \PDO::PARAM_INT);
        $updateUser = $req->execute();

        return $updateUser;
    }

    public function deleteUser($id)
    {
        $db = $this->dbConnect();
        $user = $db->prepare('DELETE FROM users WHERE id= ?');
        $deleteUser = $user->execute(array($id));

        return $deleteUser;
    }
}