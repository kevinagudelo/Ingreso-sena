<?php

use IngresoSENA\config\ExtendedController;
use ZoeSE\Request;
use IngresoSENA\model\Aprendiz;
use ZoeSE\Validate;

class ConsultaDato extends ExtendedController {

  public function main(Request $request) {

    $documento = new Aprendiz();
    $documento->setDocumento($request->getParam('documento'));
    $validar = array(
        'documento' => array(
            'value' => ($request->hasParam('documento')) ? $request->getParam('documento') : null,
            array(
                'type' => Validate::IS_NOT_NULL,
                'message' => 'El Documento es requerido'
            ),
            array(
                'type' => Validate::EXISTS_IN_DATABASE,
                'answer' => $documento->ValidateRegister(),
                'message' => 'Este Documento no se encuentra registrado'
            )
        )
    );

    $form = new Validate($validar);
    if ($form->isValid() === true) {
      $answer = $documento->ValidateDoc($request->getParam('documento'));
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
