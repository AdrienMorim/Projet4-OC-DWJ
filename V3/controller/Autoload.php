<?php

namespace V3\Controller;

/**
 * Class Autoload
 * @package V3\Controller
 */
class Autoload
{
    /**
     *
     */
    static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload')); // Récupération de la class de façon dynamique, appelle de la fonction
    }

    /**
     * @param $class
     */
    static function autoload($class)
    {
        $class = str_replace( __NAMESPACE__ . '\\' , '', $class);
        $class = str_replace('\\', '/', $class);
        //require '../V3/controller/' . $class . '.php';
        require __DIR__ . '/' . $class . '.php';
    }
}