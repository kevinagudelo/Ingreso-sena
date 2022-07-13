<?php

use IngresoSENA\config\ExtendedController;
use ZoeSE\Request;
use IngresoSENA\model\Equipo;
use IngresoSENA\model\EntradaSalida;

class InsertarSalida extends ExtendedController {

  public function main(Request $request) {
//    var_dump($request->getParam('id_equipo'));
//    exit();
    $updateEquipo = new Equipo();
    $updateEquipo->setId($request->getParam('id_codigo'));
    $update = new EntradaSalida();
    $update->setId($request->getParam('id_equipo'));
    $update->setAprendiz_id_salida($request->getParam('aprendiz_id'));
    $update->setUsuario_id_salida($request->getParam('id_usuario'));
    $answer = $update->ActualizarSalida();
    $updateEquipo->CambiarEstadoSalida();
    $code = 200;
    $this->setParam('answer', $answer);
    $this->setResponseCode($code);
    $this->setView('printJSON');
  }

}
