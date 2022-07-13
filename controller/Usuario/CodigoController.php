<?php

use IngresoSENA\config\ExtendedController;
use ZoeSE\Request;
use IngresoSENA\model\Equipo;
use ZoeSE\Validate;

class Codigo extends ExtendedController {

  public function main(Request $request) {

    $codigo = new Equipo();

    $validar = array(
        'codigo' => array(
            'value' => $request->hasParam('codigo') ? $request->getParam('codigo') : null,
            array(
                'type' => Validate::IS_NOT_NULL,
                'message' => 'El codigo es requerido'
            ),
            array(
                'type' => Validate::EXISTS_IN_DATABASE,
                'answer' => $codigo->ValidateCode(($request->hasParam('codigo')) ? $request->getParam('codigo') : 0),
                'message' => 'El codigo no esta registrado'
            )
        )
    );

    $form = new Validate($validar);
    if ($form->isValid() === true) {
      $answer = $codigo->ValidateCodeData(($request->hasParam('codigo')) ? $request->getParam('codigo') : 0);
      $code = ($answer['bol'] === true) ? 200 : 401;
    } else {
      $code = 401;
      $answer = array(
          'error' => $form->getErrors()
      );
    }

    $this->setParam('answer', $answer);
    $this->setResponseCode($code);
    $this->setView('printJSON');
  }

}
