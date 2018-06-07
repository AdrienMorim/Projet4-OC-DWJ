<?php
/**
 * Created by PhpStorm.
 * User: morimadrien
 * Date: 21/05/2018
 * Time: 19:17
 */

namespace V3\Model;


class UsersGroup
{
    /**
     * @var int             $id                 identifiant du groupe (généré automatiquement par le SGBDR donc pas de setter)
     */
    private $id;

    /**
     * @var string          $group_level        niveau d'administration de l'utilisateur
     */
    private $group_level;

    public function __construct()
    {

    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getGroupLevel()
    {
        return $this->group_level;
    }

    /**
     * @param string        $group_level
     */
    public function setGroupLevel($group_level)
    {
        $this->group_level = $group_level;
    }
}