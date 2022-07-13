<?php

use IngresoSENA\config\ExtendedController;
use ZoeSE\Request;
use IngresoSENA\model\Aprendiz;
use ZoeSE\Validate;

class RegistroEquipo extends ExtendedController {

  public function main(Request $request) {

    $documento = new Aprendiz();
    $documento->setDocumento($request->getParam('documento'));
    $validar = array(
        'documento' => array(
            'value' => $documento->getDocumento(),
            array(
                'type' => Validate::IS_NOT_NULL,
                'message' => 'El Documento es requerido'
            ),
            array(
                'type' => Validate::EXISTS_IN_DATABASE,
                'answer' => $documento->ValidateRegister(($request->hasParam('documento')) ? $request->getParam('documento') : 0),
                'message' => 'El documento no esta registrado'
            )
        )
    );

    $form = new Validate($validar);
    if ($form->isValid() === true) {
      $answer = $documento->ValidateDoc();
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
