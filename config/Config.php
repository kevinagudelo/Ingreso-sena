<?php

use IngresoSENA\config\MyConfig;

$config = new MyConfig();

$config->setDriver('pgsql')
        ->setHost('localhost')
        ->setPort(5432)
        ->setUser('postgres')
        ->setPassword('comuna13')
        ->setDbname('ingreso');

$config->setHash('md5')
        ->setI18n('en')
        ->setPath('c:/xampp/htdocs/Ingreso-sena/')
        ->setUrl('http://localhost/Ingreso-sena/public/');

$config->setDbConfig(array(
    'driver' => $config->getDriver(),
    'host' => $config->getHost(),
    'port' => $config->getPort(),
    'db_name' => $config->getDbname(),
    'user' => $config->getUser(),
    'password' => $config->getPassword(),
    'hash' => $config->getHash()
));
