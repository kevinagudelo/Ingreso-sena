<?php

use IngresoSENA\config\ExtendedController;
use ZoeSE\Request;
use IngresoSENA\model\Equipo;
use ZoeSE\Validate;

class RegistroEquipo2 extends ExtendedController {

  public function main(Request $request) {
    $equipo = new Equipo();

    $validar = array(
        'id' => array(
            'value' => ($request->hasParam('id')) ? $request->getParam('id') : null,
            array(
                'type' => Validate::IS_NOT_NULL,
                'message' => 'Ingrese el propietario'
            )
        ),
        'codigo' => array(
            'value' => ($request->hasParam('codigo')) ? $request->getParam('codigo') : null,
            array(
                'type' => Validate::IS_NOT_NULL,
                'message' => 'El codigo es requerido'
            ),
            array(
                'type' => Validate::EXISTS_IN_DATABASE,
                'answer' => $equipo->ValidateExists(($request->hasParam('codigo')) ? $request->getParam('codigo') : 0),
                'message' => 'El Codigo ya esta en uso'
            ),
        ),
        'serie' => array(
            'value' => ($request->hasParam('codigo')) ? $request->getParam('codigo') : null,
            array(
                'type' => Validate::IS_NOT_NULL,
                'message' => 'El codigo es requerido'
            ),
            array(
                'type' => Validate::EXISTS_IN_DATABASE,
                'answer' => $equipo->ValidateExists(($request->hasParam('documento')) ? $request->getParam('documento') : 0),
                'message' => 'El Codigo ya esta en uso'
            ),
        ),
        'dispositivo' => array(
            'value' => ($request->hasParam('dispositivo')) ? $request->getParam('dispositivo') : null,
            array(
                'type' => Validate::IS_NOT_NULL,
                'message' => 'El dispositivo es requerido'
            )
        ),
        'marca' => array(
            'value' => ($request->hasParam('marca')) ? $request->getParam('marca') : null,
            array(
                'type' => Validate::IS_NOT_NULL,
                'message' => 'Seleccione una opcion de marca'
            )
        ),
        'cargador' => array(
            'value' => ($request->hasParam('cargador')) ? $request->getParam('cargador') : null,
            array(
                'type' => Validate::IS_NOT_NULL,
                'message' => 'Complete el campo cargador'
            )
        )
    );

    $form = new Validate($validar);
    if ($form->isValid() === true) {
      $dato = new Equipo();
      $dato->setAprendiz_id($request->getParam('id'));
      $dato->setDispositivo_id($request->getParam('dispositivo'));
      $dato->setCodigo($request->getParam('codigo'));
      $dato->setMarca($request->getParam('marca'));
      $dato->setSerie($request->getParam('serie'));
      $dato->setCargador($request->getParam('cargador'));
      $dato->Add();
      $answer = array(true);
      $code = 200;
    } else {
      $code = 300;
      $answer = array(
          'error' => $form->getErrors()
      );
    }

    $this->setParam('answer', $answer);
    $this->setResponseCode($code);
    $this->setView('printJSON');
  }

}
