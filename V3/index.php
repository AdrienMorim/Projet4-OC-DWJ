<?php
session_start();
$_SESSION['id'];
$_SESSION['pseudo'];
$_SESSION['id_group'];

require('controller/Routeur.php');

ini_set( "error_reporting", E_ALL );
ini_set( "display_errors", 1 );

use V3\Controller\Routeur;

$router = new Routeur();
$router->getRequest();