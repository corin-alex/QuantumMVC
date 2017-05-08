<?php

require_once 'Libraries/autoload.php';
require_once 'config.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/Entities/"), true);

$conn = [
'driver'   => 'pdo_' . DB_DRIVER,
'host'     => DB_HOST,
'dbname'   => DB_NAME,
'user'     => DB_USER,
'password' => DB_PWD
];

// obtaining the entity manager
$em =  EntityManager::create($conn, $config);
return  ConsoleRunner::createHelperSet($em);