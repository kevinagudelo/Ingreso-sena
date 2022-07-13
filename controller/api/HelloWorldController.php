<?php

use IngresoSENA\config\ExtendedController;
use ZoeSE\Request;

class HelloWorld extends ExtendedController {

  public function main(Request $request) {
    $this->setParam('answer', array('msg' => $this->i18n()->__('HelloWorld')));
    $this->setResponseCode(200);
    $this->setView('printJSON');
  }

}
