<?php

declare(strict_types = 1);

require_once 'config.php';
require_once 'neo/DB.php';
require_once 'neo/Bootstrap.php';
require_once 'neo/Neo.php';
require_once 'neo/Router.php';
require_once 'neo/View.php';

try {
    $neo = new Neo();

    (new Bootstrap($neo));
} catch (Exception | PDOException $e) {

    print "Error!: " . $e->getMessage() . "<br/>";
    die();

}