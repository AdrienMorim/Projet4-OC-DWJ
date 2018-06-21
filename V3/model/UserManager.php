<?php
/**
 * Created by PhpStorm.
 * User: morimadrien
 * Date: 15/05/2018
 * Time: 15:24
 */

namespace V3\Model;

require_once('model/Manager.php');

use \DateTime;
use \PDO;

/**
 * Class UserManager
 * @package V3\Model\Frontend
 */
class UserManager extends Manager
{
    // Attributs de la classe
    /**
     * @var int         $_id_user                     identifiant de l'utilisateur (généré automatiquement par le SGBDR donc pas de setter)
     * @var int         $id_group               identifiant du groupe utilisateur (défini la niveau d'administration)
     * @var string      $_pseudo                 le pseudo de l'utilisateur
     * @var string      $_email                  l'email de l'utilisateur
     * @var string      $_registration_date      date d'inscription de l'utilisateur
     * @var string      $_firstname              prénom de l'utilisateur
     * @var string      $_surname                nom de l'utilisateur
     * @var string      $_birthday_date          date de naissance de l'utilisateur
     */
    private $_id_user, $_id_group, $_pseudo, $_pass, $_email, $_registration_date, $_firstname, $_surname, $_birthday_date;

    /**
     * UserManager constructor.
     * Methode magique car elle est automatiquement appelée lors de l'instanciation de UserManager
     */
    public function __construct()
    {

    }

    /*************************************** ACCESSEURS / GETTERS: permet d'accéder aux attributs **********************/

    /**
     * @return int              $_id_user
     */
    public function getIdUser()
    {
        return $this->_id_user;
    }

    /**
     * @return int              $_id_group
     */
    public function getIdGroup()
    {
        return $this->_id_group;
    }

    /**
     * @return string           $_pseudo
     */
    public function getPseudo()
    {
        return $this->_pseudo;
    }

    /**
     * @return string           $_pass
     */
    public function getPass()
    {
        return $this->_pass;
    }

    /**
     * @return string           $_email
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @return string           $_registration_date
     */
    public function getRegistrationDate()
    {
        return $this->_registration_date;
    }

    /**
     * @return string           $_firstname
     */
    public function getFirstname()
    {
        return $this->_firstname;
    }

    /**
     * @return string           $_surname
     */
    public function getSurname()
    {
        return $this->_surname;
    }

    /**
     * @return string           $_birthday_date
     */
    public function getBirthdayDate()
    {
        return $this->_birthday_date;
    }

    /********************************************* MUTATEURS / SETTERS *************************************************/

    /**
     * @param mixed $id_user
     */
    public function setIdUser($id_user)
    {
        $id_user = (int) $id_user;
        if($id_user > 0){
            $this->_id_user = $id_user;
        }

    }

    /**
     * @param int    $id_group
     */
    public function setIdGroup($id_group)
    {
        $id_group = (int) $id_group;
        if($id_group > 0)
        {
            $this->_id_group = $id_group;
        }
    }

    /**
     * @param string     $pseudo
     */
    public function setPseudo($pseudo)
    {
        if(is_string($pseudo)) {
            $this->_pseudo = $pseudo;
        }
    }

    /**
     * @param string     $pass
     */
    public function setPass($pass)
    {
        if(is_string($pass)) {
            $this->_pass = $pass;
        }
    }

    /**
     * @param string     $email
     */
    public function setEmail($email)
    {
        if(is_string($email)) {
            $this->_email = $email;
        }
    }

    /**
     * @param string     $registration_date
     */
    public function setRegistrationDate(DateTime $registration_date)
    {
        $this->_registration_date = $registration_date;
    }

    /**
     * @param string     $firstname
     */
    public function setFirstname($firstname)
    {
        if(is_string($firstname)) {
            $this->_firstname = $firstname;
        }
    }

    /**
     * @param string     $surname
     */
    public function setSurname($surname)
    {
        if(is_string($surname)) {
            $this->_surname = $surname;
        }
    }

    /**
     * @param string     $birthday_date
     */
    public function setBirthdayDate(DateTime $birthday_date)
    {
        $this->_birthday_date = $birthday_date;
    }

    /*********************************************** METHODES *********************************************************/

    // READ
    /**
     * @param                       $pseudo
     * @param                       $pass
     * @return mixed                Récupère un utilisateur via son pseudo
     */
    public function getUser($pseudo)
    {
        $this->setPseudo($pseudo);

        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM users WHERE pseudo = ?');
        $req->execute(array($this->getPseudo()));
        $user = $req->fetch();

        return $user;
    }

    /**
     * @param                       $id_user
     * @return mixed                Récupère un utilisateur via son identifiant
     */
    public function getUserById($id_user)
    {
        $this->setIdUser($id_user);

        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM users WHERE id = ?');
        $req->execute(array($this->getIdUser()));
        $user = $req->fetch();

        return $user;
    }

    /**
     * @return bool|\PDOStatement           Récupère tous les utilisateurs par ordre d'inscription
     */
    public function getAllUsers()
    {
        $db = $this->dbConnect();
        $users = $db->query('SELECT * FROM users ORDER BY registration_date');

        return $users;
    }

    // COUNT
    /**
     * @return int                      Compte le nombre d'utilisateur enregistré
     */
    public function countUsers()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(*) AS total_users FROM users');
        $req->execute();
        $usersTotal = $req->fetch();
        return $usersTotal;
    }

    // CREATE
    /**
     * @param                               $id_group
     * @param                               $pseudo
     * @param                               $password_hache
     * @param                               $email
     * @return bool                         Inscription d'un utilisateur
     */
    public function createUser($id_group, $pseudo, $password_hache, $email)
    {
        $this->setIdGroup($id_group);
        $this->setPseudo($pseudo);
        $this->setPass($password_hache);
        $this->setEmail($email);

        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO users(id_group, pseudo, pass, email, registration_date) VALUES(?, ?, ?, ?, NOW())');
        $registerUser = $req->execute(array(
            $this->getIdGroup(),
            $this->getPseudo(),
            $this->getPass(),
            $this->getEmail()
            ));

        return $registerUser;
    }

    // UPDATE
    /**
     * @param $id
     * @param $id_group
     * @return bool
     */
    public function updateGroupUser($id, $id_group)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE users SET id_group= :id_group WHERE id= :id');
        $req->bindParam('id_group', $id_group, PDO::PARAM_INT);
        $req->bindParam('id', $id, PDO::PARAM_INT);
        $updateUser = $req->execute();

        return $updateUser;
    }

    /**
     * @param $id
     * @param $pseudo
     * @return bool
     */
    public function updatePseudoUser($id, $pseudo)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE users SET pseudo= :pseudo WHERE id= :id');
        $req->bindParam('pseudo',$pseudo, PDO::PARAM_STR);
        $req->bindParam('id', $id, PDO::PARAM_INT);
        $updateUser = $req->execute();

        return $updateUser;
    }

    /**
     * @param $id
     * @param $pass
     * @return bool
     */
    public function updatePassUser($id, $pass)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE users SET pass= :pass WHERE id= :id');
        $req->bindParam('pass',$pass, PDO::PARAM_STR);
        $req->bindParam('id', $id, PDO::PARAM_INT);
        $updateUser = $req->execute();

        return $updateUser;
    }

    /**
     * @param $id
     * @param $firstname
     * @param $surname
     * @return bool
     */
    public function updateNameUser($id, $firstname, $surname)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE users SET firstname= :firstname, surname= :surname WHERE id= :id');
        $req->bindParam('firstname', $firstname, PDO::PARAM_STR);
        $req->bindParam('surname', $surname, PDO::PARAM_STR);
        $req->bindParam('id', $id, PDO::PARAM_INT);
        $updateUser = $req->execute();

        return $updateUser;
    }

    /**
     * @param $id
     * @param $email
     * @return bool
     */
    public function updateEmailUser($id, $email)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE users SET email= :email WHERE id= :id');
        $req->bindParam('email', $email, PDO::PARAM_STR);
        $req->bindParam('id', $id, PDO::PARAM_INT);
        $updateUser = $req->execute();

        return $updateUser;
    }

    /**
     * @param $id
     * @param $birthday
     * @return bool
     */
    public function updateBirthdayUser($id, $birthday)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE users SET birthday_date= :birthday WHERE id= :id');
        $req->bindParam('birthday', $birthday, PDO::PARAM_STR);
        $req->bindParam('id', $id, PDO::PARAM_INT);
        $updateUser = $req->execute();

        return $updateUser;
    }

    // DELETE
    /**
     * @param                       $id_user
     * @return bool                 Supprime un utilisateur via son identifiant
     */
    public function deleteUser($id_user)
    {
        $this->setIdUser($id_user);

        $db = $this->dbConnect();
        $user = $db->prepare('DELETE FROM users WHERE id= ?');
        $deleteUser = $user->execute(array($this->getIdUser()));

        return $deleteUser;
    }
}