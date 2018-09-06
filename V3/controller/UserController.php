<?php
/**
 * Created by PhpStorm.
 * User: morimadrien
 * Date: 14/06/2018
 * Time: 16:04
 */

namespace V3\Controller;

require_once('model/UserManager.php');

use V3\Model\UserManager;
use \Exception;

class UserController
{
    private $_user;

    public function __construct()
    {
        $this->_user = new UserManager();
    }

// Inscription
    public function registerUser($id_group, $pseudo, $password_hache, $email){

        $userPseudo = $this->_user->getUser($pseudo);
        $userEmail = $this->_user->getUserByEmail($email);
        if($userPseudo == true)
        {
            throw new Exception('Le pseudo est déjà utilisé par un autre utilisateur.');
        }
        elseif($userEmail == true)
        {
            throw new Exception('L\'email est déjà utilisé par un autre utilisateur.');
        }
        else{
            $registerUser = $this->_user->createUser($id_group, $pseudo, $password_hache, $email);
            header('Location: ../V3/index.php');
        }
    }

// Liste des membres
    public function adminListUsers()
    {
        $users = $this->_user->getAllUsers();
        require ('view/backend/listUsersView.php');
    }

// Connexion
    public function logUser($pseudo, $pass)
    {
        $user = $this->_user->getUser($pseudo);
        $proper_pass = password_verify($pass, $user['pass']);

        if(!$user)
        {
            throw new Exception('Wrong username or/and password');
        }
        else{
            if($proper_pass && $user['id_group'] == 2)
            {
                session_start();
                $_SESSION['id'] = $user['id'];
                $_SESSION['pseudo'] = $user['pseudo'];
                $_SESSION['pass'] = $user['pass'];
                $_SESSION['id_group'] = $user['id_group'];

                $id = $user['id'];
                $pseudo = $user['pseudo'];
                $pass_hash = $user['pass'];
                $group = $user['id_group'];

                setcookie('id', $id, time() + 1800, null, null, false, true);
                setcookie('pseudo', $pseudo, time() + 1800, null, null, false, true);
                setcookie('pass', $pass_hash, time() + 1800, null, null, false, true);
                setcookie('id_group', $group, time() + 1800, null, null, false, true);

                header('Location: ../V3/index.php');
            }
            elseif($proper_pass && $user['id_group'] == 1)
            {
                session_start();
                $_SESSION['id'] = $user['id'];
                $_SESSION['pseudo'] = $user['pseudo'];
                $_SESSION['pass'] = $user['pass'];
                $_SESSION['id_group'] = $user['id_group'];

                $id = $user['id'];
                $pseudo = $user['pseudo'];
                $pass_hash = $user['pass'];
                $group = $user['id_group'];

                setcookie('id', $id, time() + 1800, null, null, false, true);
                setcookie('pseudo', $pseudo, time() + 1800, null, null, false, true);
                setcookie('pass', $pass_hash, time() + 1800, null, null, false, true);
                setcookie('id_group', $group, time() + 1800, null, null, false, true);

                header('Location: ../V3/index.php?action=dashbord');
            }
            else
            {
                throw new Exception('Wrong Username or Password');
            }
        }
    }

// Page d'édition d'un utilisateur
    public function adminUpdateUser()
    {
        $user = $this->_user->getUserById($_GET['id_user']);
        require ('view/backend/updateUserView.php');
    }

// Editer le groupe d'un membre
    public function updateGroupUser($id, $id_group)
    {
        $updateUser = $this->_user->updateGroupUser($id, $id_group);
        if($updateUser === false)
        {
            throw new Exception('Impossible d\'éditer le groupe de l\'utilisateur');
        }
        else
        {
            header('Location: ../V3/index.php?action=adminUpdateUser&id_user=' . $id);
        }
    }

    public function updatePseudoUser($id, $pseudo)
    {
        $updateUser = $this->_user->updatePseudoUser($id, $pseudo);
        if($updateUser === false)
        {
            throw new Exception('Impossible d\'éditer le pseudo de l\'utilisateur');
        }
        else
        {
            header('Location: ../V3/index.php?action=adminUpdateUser&id_user=' . $id);
        }
    }
    public function updatePassUser($id, $pass)
    {
        $updateUser = $this->_user->updatePassUser($id, $pass);
        if($updateUser === false)
        {
            throw new Exception('Impossible d\'éditer l\'utilisateur');
        }
        else
        {
            header('Location: ../V3/index.php?action=adminUpdateUser&id_user=' . $id);
        }
    }
    public function updateNameUser($id, $firstname, $surname)
    {
        $updateUser = $this->_user->updateNameUser($id, $firstname, $surname);
        if($updateUser === false)
        {
            throw new Exception('Impossible d\'éditer l\'utilisateur');
        }
        else
        {
            header('Location: ../V3/index.php?action=adminUpdateUser&id_user=' . $id);
        }
    }
    public function updateEmailUser($id, $email)
    {
        $updateUser = $this->_user->updateEmailUser($id, $email);
        if($updateUser === false)
        {
            throw new Exception('Impossible d\'éditer l\'utilisateur');
        }
        else
        {
            header('Location: ../V3/index.php?action=adminUpdateUser&id_user=' . $id);
        }
    }
    public function updateBirthdayUser($id, $birthday)
    {
        $updateUser = $this->_user->updateBirthdayUser($id, $birthday);
        if($updateUser === false)
        {
            throw new Exception('Impossible d\'éditer l\'utilisateur');
        }
        else
        {
            header('Location: ../V3/index.php?action=adminUpdateUser&id_user=' . $id);
        }
    }

// Supprimer un membre
    public function deleteUser($id)
    {
        $deleteUser = $this->_user->deleteUser($id);
        if($deleteUser === false)
        {
            throw new Exception('Impossible de supprimer l\'utilisateur' );
        }
        else
        {
            header('Location: ../V3/index.php?action=adminListUsers');
        }
    }

// Deconnexion
    public function logoutUser()
    {
        session_start();
        // Suppression des variables de session et de la session
        $_SESSION = array();
        session_destroy();

        // Suppression des cookies de connexion automatique
        setcookie('id', '');
        setcookie('pseudo', '');
        setcookie('pass', '');
        setcookie('id_group', '');

        header('Location: ../V3/index.php');
    }
}