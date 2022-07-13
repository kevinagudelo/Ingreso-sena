<?php

use IngresoSENA\config\ExtendedController;
use ZoeSE\Request;
use IngresoSENA\model\Aprendiz;
use ZoeSE\Validate;

class Nuevo extends ExtendedController {

  public function main(Request $request) {

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
                'answer' => $user->ValidateExists(($request->hasParam('documento')) ? $request->getParam('documento') : 0),
                'message' => 'El Documento ya existe'
            )
        ),
        'name' => array(
            'value' => ($request->hasParam('name')) ? $request->getParam('name') : null,
            array(
                'type' => Validate::IS_NOT_NULL,
                'message' => 'El usuario es requerido'
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
              'type' => Validate::EXISTS_IN_DATABASE,
              'answer' => $user->ValidateExistsCarnetNuevo($request->getParam('carnet')),
              'message' => 'Este carnet ya existe'
          )
      );
    }

    $form = new Validate($validar);
    if ($form->isValid() === true) {
      $dato = new Aprendiz();
      $dato->setCarnet(($request->hasParam('carnet')) ? $request->getParam('carnet') : null);

      $dato->setTipo_documento_id('1');
      $dato->setFoto($request->getParam('foto'));
//      $dato->setFoto(substr($request->getParam('foto'), 21));
      $dato->setNombre($request->getParam('name'));
      $dato->setDocumento($request->getParam('documento'));
      $dato->setFicha(($request->hasParam('ficha')) ? $request->getParam('ficha') : null);
      $dato->setFormacion(($request->hasParam('formacion')) ? $request->getParam('formacion') : null);
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
