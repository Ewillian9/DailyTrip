<?php

require_once 'src/utils/Router.php';
require_once './bdd.php';
require_once './data.php';

$router = new Router();
$router->start();
?>