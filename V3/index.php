<?php session_start() ?>

<?php

require('controller/Routeur.php');

use V3\Controller\Routeur;

$router = new Routeur();
$router->getRequest();