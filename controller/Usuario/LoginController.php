<?php

use IngresoSENA\config\ExtendedController;
use ZoeSE\Request;
use IngresoSENA\model\Usuario;
use ZoeSE\Validate;

class Login extends ExtendedController {

  public function main(Request $request) {
    $user = new Usuario();
    $user->setUsuario($request->getParam('user'));
    $user->setContraseña($request->getParam('password'));
    $validar = array(
        'user' => array(
            'value' => $user->getUsuario(),
            array(
                'type' => Validate::IS_NOT_NULL,
                'message' => 'El usuario es requerido'
            )
        ),
        'password' => array(
            'value' => $user->getContraseña(),
            array(
                'type' => Validate::IS_NOT_NULL,
                'message' => 'Contraseña requerida'
            )
        )
    );

    $form = new Validate($validar);
    if ($form->isValid() === true) {
      $answer = $user->ValidatePassword();
//      var_dump($answer);
//      exit();
      $true = password_verify(($request->getParam('password')), $answer['data']['0']->contrasena);
      unset($answer['data']['0']->contrasena);
      $code = ($true === false) ? 200 : 401;
    } else {
      $code = 401;
      $answer = array(
          'error' => $form->getError()
      );
    }

    $this->setParam('answer', $answer);
    $this->setResponseCode($code);
    $this->setView('printJSON');
  }

}
