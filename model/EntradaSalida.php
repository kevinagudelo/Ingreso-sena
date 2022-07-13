<?php

namespace IngresoSENA\model;

use IngresoSENA\model\DAO\EntradaSalidaDAO;
use NogalSE\NQL;

class EntradaSalida extends EntradaSalidaDAO {

  public function TraerDatosIngreso() {
//    $nql = new NQL($this->getDbDriver());
    $sql = ('SELECT entrada_salida.id as reg_id,entrada_salida.entrada,aprendiz.id,aprendiz.nombre,aprendiz.foto  FROM entrada_salida INNER JOIN aprendiz ON aprendiz.id = aprendiz_id_entra  WHERE entrada_salida.equipo_id = :equipo_id AND entrada_salida.salida IS NULL ');
    $this->setDbParam(':equipo_id', $this->getEquipo_id(), \PDO::PARAM_INT);
    $data = $this->query($sql);
    if (count($data) > 0) {
      return array('data' => $data, 'bol' => TRUE);
    } else {
      return array('data' => $data, 'bol' => FALSE);
    }
  }

  public function ActualizarSalida() {
    $sql = 'UPDATE entrada_salida SET aprendiz_id_salida = :Aprendizsalida, usuario_id_salida = :UsuarioSalida, salida = NOW() WHERE id = :id';
    $this->setDbParam(':id', $this->getId(), \PDO::PARAM_INT);
    $this->setDbParam(':Aprendizsalida', $this->getAprendiz_id_salida(), \PDO::PARAM_INT);
    $this->setDbParam(':UsuarioSalida', $this->getUsuario_id_salida(), \PDO::PARAM_INT);
    $this->query($sql);

    return (TRUE);
  }

  public function Consulta() {
    $sql = "SELECT b.codigo, c.documento, d.nombre AS quien_entra, e.nombre AS quien_sale, a.entrada, a.salida, f.usuario AS guardia_entra, g.usuario AS guardia_sale, a.aprendiz_id_entra, a.aprendiz_id_salida
                FROM entrada_salida AS a
                JOIN equipo AS b ON a.equipo_id = b.id
                JOIN aprendiz AS c ON b.aprendiz_id = c.id
                JOIN aprendiz AS d ON a.aprendiz_id_entra = d.id
                JOIN aprendiz AS e ON a.aprendiz_id_salida = e.id
                JOIN usuario AS f ON a.usuario_id_entrada = f.id
                JOIN usuario AS g ON a.usuario_id_salida = g.id";
    return $this->query($sql);
  }

  public function info($id) {
    $sql = "SELECT foto, nombre, documento, ficha, formacion
                FROM aprendiz WHERE id = :id";
    $this->setDbParam(':id', $id, \PDO::PARAM_INT);
    return $this->query($sql);
  }

}
