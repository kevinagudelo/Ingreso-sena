<?php

use IngresoSENA\config\ExtendedController;
use ZoeSE\Request;
use IngresoSENA\model\EntradaSalida;
use ZoeSE\Validate;

class DatosIngreso extends ExtendedController {

  public function main(Request $request) {
    $id = new EntradaSalida();
    $id->setEquipo_id($request->getParam('equi_id'));
    $answer = $id->TraerDatosIngreso();
    $code = ($answer['bol'] === true) ? 200 : 401;
    $this->setParam('answer', $answer);
    $this->setResponseCode($code);
    $this->setView('printJSON');
  }

}
