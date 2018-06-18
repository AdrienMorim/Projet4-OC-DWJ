<?php

namespace V3\Controller;

class Autoload
{
    static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    static function autoload($className)
    {
        var_dump($className);
        require $className . '.php';
    }
}