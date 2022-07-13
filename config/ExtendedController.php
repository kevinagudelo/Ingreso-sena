<?php

namespace IngresoSENA\config;

use IngresoSENA\config\MyConfig;
use ZoeSE\Controller;
use ZoeSE\Session;
use ZoeSE\i18n;

abstract class ExtendedController extends Controller {

  public function __construct(MyConfig $config, Session $session, i18n $i18n) {
    parent::__construct($config, $session, $i18n);
  }

  /**
   *
   * @return MyConfig
   */
  public function getConfig(): MyConfig {
    return parent::getConfig();
  }

}
