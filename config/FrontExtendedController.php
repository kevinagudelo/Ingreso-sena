<?php

namespace IngresoSENA\config;

use IngresoSENA\config\MyConfig;
use ZoeSE\FrontController;

class FrontExtendedController extends FrontController {

  public function __construct(MyConfig $config) {
    parent::__construct($config);
  }

}
