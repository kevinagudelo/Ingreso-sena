<?php

use IngresoSENA\config\ExtendedController;
use ZoeSE\Request;
use IngresoSENA\model\Usuario;
use ZoeSE\Validate;

class crearusuario extends ExtendedController {

  public function main(Request $request) {
//    var_dump($request->getParam('contrasena1'));
//    exit();

    $usuario = new Usuario();
//    $usuario->setContrasena($request->getParam('contrasena1'));
//    var_dump($usuario->getContrasena());
//    exit();
    $usuario->setUsuario(($request->hasParam('usuario')) ? $request->getParam('usuario') : null);

    $validar = array(
        'usuario' => array(
            'value' => $usuario->getUsuario(),
            array(
                'type' => Validate::IS_NOT_NULL,
                'message' => 'El usuario es requerido'
            ),
            array(
                'type' => Validate::EXISTS_IN_DATABASE,
                'answer' => $usuario->ValidateExists(),
                'message' => 'El usuario ya existe'
            )
        ),
        'nombre' => array(
            'value' => ($request->hasParam('nombre')) ? $request->getParam('nombre') : null,
            array(
                'type' => Validate::IS_NOT_NULL,
                'message' => 'El nombre es requerido'
            )
        ),
        'contrasena1' => array(
            'value' => ($request->hasParam('contrasena1')) ? $request->getParam('contrasena1') : null,
            array(
                'type' => Validate::IS_NOT_NULL,
                'message' => 'La contraseña es requerida'
            ),
            array(
                'type' => Validate::IS_EQUAL,
                'message' => 'Las contraseñas no coinciden',
                'otherValue' => ($request->hasParam('contrasena2')) ? $request->getParam('contrasena2') : null,
            )
        ),
        'contrasena2' => array(
            'value' => ($request->hasParam('contrasena2')) ? $request->getParam('contrasena2') : null,
            array(
                'type' => Validate::IS_NOT_NULL,
                'message' => 'La contraseña es requerida'
            ),
        )
            //'name' => array(),
//            'surname' => array(),
//            'born' => array(),
//            'email' => array()
    );

    $form = new Validate($validar);
    if ($form->isValid() === true) {
      $dato = new Usuario();
      $dato->setRol('1');
      $dato->setUsuario($request->getParam('usuario'));
      $dato->setNombre($request->getParam('nombre'));

      $contrasena = password_hash($request->getParam('contrasena1'), PASSWORD_ARGON2I);
      $dato->setContrasena($contrasena);
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
