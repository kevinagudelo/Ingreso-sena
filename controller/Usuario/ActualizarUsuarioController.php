<?php

use IngresoSENA\config\ExtendedController;
use ZoeSE\Request;
use IngresoSENA\model\Usuario;
use ZoeSE\Validate;

class ActualizarUsuario extends ExtendedController {

  public function main(Request $request) {

    $user = new Usuario();
    $user->setId($request->getParam('id'));
    $validar = array(
        'contra' => array(
            'value' => ($request->hasParam('contra')) ? $request->getParam('contra') : null,
            array(
                'type' => Validate::IS_NOT_NULL,
                'message' => 'El Documento es requerido'
            ),
            array(
                'type' => Validate::EXISTS_IN_DATABASE,
                'answer' => $user->ValidatePasswordExistent((($request->hasParam('contra')) ? $request->getParam('contra') : 0), (($request->hasParam('id')) ? $request->getParam('id') : 0)),
                'message' => 'Contraseña actual incorrecta'
            )
        ),
        'nuevacontra' => array(
            'value' => ($request->hasParam('nuevacontra')) ? $request->getParam('nuevacontra') : null,
            array(
                'type' => Validate::IS_NOT_NULL,
                'message' => 'Ingrese  la nueva contraseña'
            )
        )
    );

    $form = new Validate($validar);
    if ($form->isValid() === true) {
      $dato = new Usuario();
      $dato->setId($request->getParam('id'));
      $dato->Update($request->getParam('nuevacontra'));
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
