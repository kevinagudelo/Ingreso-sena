<?php

namespace IngresoSENA\model;

use IngresoSENA\model\DAO\EquipoDAO;
use NogalSE\NQL;

class Equipo extends EquipoDAO {

  public function ValidateExists($codigo) {
    $nql = new NQL($this->getDbDriver());
    $sql = $nql->select('id')->from('equipo')->where('codigo', false);
    $this->setDbParam(':codigo', $codigo, \PDO::PARAM_STR);
    $data = $this->query($sql);
    if (count($data) > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function ValidateCode($codigo) {
    $nql = new NQL($this->getDbDriver());
    $sql = $nql->select('id')->from('equipo')->where('codigo', false);
    $this->setDbParam(':codigo', $codigo, \PDO::PARAM_STR);
    $data = $this->query($sql);
    if (count($data) > 0) {
      return false;
    } else {
      return true;
    }
  }

  public function ValidateCodeData($codigo) {
    $sql = 'SELECT equipo.id as equi_id,equipo.actived, dispositivo.nombre as dispo_nombre,aprendiz.nombre,aprendiz.foto,equipo.codigo,equipo.marca,equipo.serie,equipo.cargador, aprendiz.id FROM equipo INNER JOIN dispositivo ON dispositivo.id = equipo.dispositivo_id INNER JOIN aprendiz ON aprendiz.id = equipo.aprendiz_id WHERE equipo.codigo = :codigo ';
    $this->setDbParam(':codigo', $codigo, \PDO::PARAM_STR);
    $data = $this->query($sql);
    if (count($data) > 0) {
      return array('data' => $data, 'bol' => TRUE);
    } else {
      return array('data' => $data, 'bol' => FALSE);
    }
  }

  public function traerDispositivo() {
    $nql = new NQL($this->getDbDriver());
    $sql = $nql->select('nombre')->from('dispositivo')->where('id', false);
    $this->setDbParam(':id', $this->getDispositivo_id(), \PDO::PARAM_INT);
    $data = $this->query($sql);
    if (count($data) > 0) {
      return array('data' => $data, 'bol' => TRUE);
    } else {
      return array('data' => $data, 'bol' => FALSE);
    }
  }

  public function CambiarEstado() {
    $sql = 'UPDATE equipo SET actived = TRUE WHERE id = :id';
    $this->setDbParam(':id', $this->getId(), \PDO::PARAM_INT);
    $this->query($sql);
  }

  public function CambiarEstadoSalida() {
    $sql = 'UPDATE equipo SET actived = FALSE WHERE id = :id';
    $this->setDbParam(':id', $this->getId(), \PDO::PARAM_INT);
    $this->query($sql);
  }

}
