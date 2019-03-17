<?php
session_start();
$_SESSION['id'];
$_SESSION['pseudo'];
$_SESSION['id_group'];

require('src/controller/Routeur.php');

//ini_set( "error_reporting", E_ALL );
//ini_set( "display_errors", 1 );

use Alaska\Src\Controller\Routeur;

$router = new Routeur();
$router->getRequest();