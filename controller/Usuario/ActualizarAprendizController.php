<?php

use IngresoSENA\config\ExtendedController;
use ZoeSE\Request;
use IngresoSENA\model\Aprendiz;
use ZoeSE\Validate;

class ActualizarAprendiz extends ExtendedController {

  public function main(Request $request) {
    $id = new Aprendiz();
    $user = new Aprendiz();

    $carnet = $request->getParam('carnet');
    $validar = array(
        'documento' => array(
            'value' => ($request->hasParam('documento')) ? $request->getParam('documento') : null,
            array(
                'type' => Validate::IS_NOT_NULL,
                'message' => 'El Documento es requerido'
            ),
            array(
                'type' => Validate::EXISTS_IN_DATABASE,
                'answer' => $user->ValidateActualizacion((($request->hasParam('documento')) ? $request->getParam('documento') : 0), (($request->hasParam('id')) ? $request->getParam('id') : 0)),
                'message' => 'Este documento ya existe'
            )
        ),
        'name' => array(
            'value' => ($request->hasParam('name')) ? $request->getParam('name') : null,
            array(
                'type' => Validate::IS_NOT_NULL,
                'message' => 'El nombre es requerido'
            )
        ),
        'foto' => array(
            'value' => ($request->hasParam('foto')) ? $request->getParam('foto') : null,
            array(
                'type' => Validate::IS_NOT_NULL,
                'message' => 'La fotografia es requerida'
            )
        )
    );
    if ($carnet !== '' && $carnet !== null) {
      $validar['carnet'] = array(
          'value' => $request->getParam('carnet'),
          array(
              'type' => $user->ValidateExistsCarnet($request->getParam('carnet'), $request->getParam('id')),
              'message' => 'Este carnet ya existe'
          )
      );
    }

    $form = new Validate($validar);
    if ($form->isValid() === true) {
      $dato = new Aprendiz();
//      $id = $user->ValidateActualizacionDoc(($request->getParam('documento')))[0]->id;
      $dato->setId($request->getParam('id'));
      $dato->setTipo_documento_id('1');
      $dato->setFoto($request->getParam('foto'));
      $dato->setNombre($request->getParam('name'));
      $dato->setDocumento($request->getParam('documento'));
      $dato->setCarnet(($request->hasParam('carnet')) ? $request->getParam('carnet') : null);
      $dato->setFicha(($request->hasParam('ficha')) ? $request->getParam('ficha') : null);
      $dato->setFormacion(($request->hasParam('formacion')) ? $request->getParam('formacion') : null);
      $dato->Update();
      $answer = $dato;
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
