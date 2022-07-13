<?php

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../vendor/autoload.php';
//require '../config/MyConfig.php';
//require '../config/ExtendedController.php';
//require '../config/FrontExtendedController.php';
require '../config/Config.php';

use IngresoSENA\config\FrontExtendedController;

try {
  $app = new FrontExtendedController($config);
  $app->run();
} catch (\Exception $exc) {
  echo '<pre>';
  echo $exc->getMessage();
  echo $exc->getTraceAsString();
  echo '</pre>';
}
