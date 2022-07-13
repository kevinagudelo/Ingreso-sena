<?php

use IngresoSENA\config\ExtendedController;
use ZoeSE\Request;
use IngresoSENA\model\EntradaSalida;

class modalentrada extends ExtendedController {

    public function main(Request $request) {
        $modalentrada = new EntradaSalida();
        $id =$request->getParam("id");
        $this->setParam('answer', $modalentrada->info($id));
        $this->setView('printJSON');
    }

}