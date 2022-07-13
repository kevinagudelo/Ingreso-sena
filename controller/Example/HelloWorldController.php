<?php

use IngresoSENA\config\ExtendedController;
use ZoeSE\Request;

class HelloWorld extends ExtendedController {

  public function main(Request $request) {
    $this->setParam('name', $this->i18n()->__('hi', 'World'));
    $this->setView('HelloWorld');
  }

}
