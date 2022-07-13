<?php

use IngresoSENA\config\ExtendedController;
use ZoeSE\Request;
use IngresoSENA\model\EntradaSalida;

class modalsalida extends ExtendedController {

    public function main(Request $request) {
        $modalsalida = new EntradaSalida();
        $id =$request->getParam("id");
        $this->setParam('answer', $modalsalida->info($id));
        $this->setView('printJSON');
    }

}