<?php

use IngresoSENA\config\ExtendedController;
use ZoeSE\Request;
use IngresoSENA\model\Aprendiz;
use ZoeSE\Validate;

class Entrada extends ExtendedController {

  public function main(Request $request) {
    $id = new Aprendiz();
    $id->setId($request->getParam('aprendiz_id'));
    $answer = $id->TraerDatosPropietario();
    $code = ($answer['bol'] === true) ? 200 : 401;
    $this->setParam('answer', $answer);
    $this->setResponseCode($code);
    $this->setView('printJSON');
  }

}
