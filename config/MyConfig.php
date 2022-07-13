<?php

namespace IngresoSENA\config;

use ZoeSE\Config;

class MyConfig extends Config {

  private $db_config;

  public function getDbConfig() {
    return $this->db_config;
  }

  public function setDbConfig($db_config) {
    $this->db_config = $db_config;
    return $this;
  }

}
