<?php

use IngresoSENA\config\ExtendedController;
use ZoeSE\Request;
use IngresoSENA\model\EntradaSalida;

class entradasalida1 extends ExtendedController {

    public function main(Request $request) {
        $entradasalida = new EntradaSalida();
        $this->setParam('answer', $entradasalida->Consulta());
        $this->setView('printJSON');
    }

}
