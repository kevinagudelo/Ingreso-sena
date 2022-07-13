<?php

use IngresoSENA\config\ExtendedController;
use ZoeSE\Request;
use IngresoSENA\model\Equipo;
use ZoeSE\Validate;

class Dispositivo extends ExtendedController {

  public function main(Request $request) {
    $dispositivo = new Equipo();
    $dispositivo->setDispositivo_id($request->getParam('dispositivo_id'));
    $answer = $dispositivo->traerDispositivo();
    $code = ($answer['bol'] === true) ? 200 : 401;
    $this->setParam('answer', $answer);
    $this->setResponseCode($code);
    $this->setView('printJSON');
  }

}
