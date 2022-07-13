<?php

use IngresoSENA\config\ExtendedController;
use ZoeSE\Request;
use IngresoSENA\model\Equipo;
use IngresoSENA\model\EntradaSalida;
use ZoeSE\Validate;

class InsertarEntrada extends ExtendedController {

  public function main(Request $request) {
//    var_dump($request->getParam('id_usuario'));
//
    $update = new Equipo();
    $update->setId($request->getParam('id_equipo'));
    $dato = new EntradaSalida();
    $dato->setEquipo_id($request->getParam('id_equipo'));
    $dato->setAprendiz_id_entrada($request->getParam('id_aprendiz'));
    $dato->setUsuario_id_entrada($request->getParam('id_usuario'));
    $dato->AddEntrada();
    $update->CambiarEstado();
    $answer = TRUE;
    $code = 200;
    $this->setParam('answer', $answer);
    $this->setResponseCode($code);
    $this->setView('printJSON');
    exit();
  }

}
