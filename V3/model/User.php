<?php

namespace V3\Model;

/**
 * Class User
 * @package V3\Model
 */
class User
{
    // Attributs de la classe
    /**
     * @var int         $id                     identifiant de l'utilisateur (généré automatiquement par le SGBDR donc pas de setter)
     * @var int         $id_group               identifiant du groupe utilisateur (défini la niveau d'administration)
     * @var string      $pseudo                 le pseudo de l'utilisateur
     * @var string      $email                  l'email de l'utilisateur
     * @var string      $registration_date      date d'inscription de l'utilisateur
     * @var string      $firstname              prénom de l'utilisateur
     * @var string      $surname                nom de l'utilisateur
     * @var string      $birthday_date          date de naissance de l'utilisateur
     */
    private $id, $id_group, $pseudo, $pass, $email, $registration_date, $firstname, $surname, $birthday_date;

    /**
     * User constructor.
     */
    public function __construct()
    {

    }
    // ACCESSEURS / GETTERS: permet d'accéder aux attributs
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getIdGroup()
    {
        return $this->id_group;
    }

    /**
     * @return string
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @return string
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getRegistrationDate()
    {
        return $this->registration_date;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @return string
     */
    public function getBirthdayDate()
    {
        return $this->birthday_date;
    }

    // MUTATEURS / SETTERS

    /**
     * @param int    $id_group
     */
    public function setIdGroup($id_group)
    {
        $this->id_group = $id_group;
    }

    /**
     * @param string     $pseudo
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    /**
     * @param string     $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    /**
     * @param string     $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param string     $registration_date
     */
    public function setRegistrationDate($registration_date)
    {
        $this->registration_date = $registration_date;
    }

    /**
     * @param string     $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @param string     $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * @param string     $birthday_date
     */
    public function setBirthdayDate($birthday_date)
    {
        $this->birthday_date = $birthday_date;
    }
}