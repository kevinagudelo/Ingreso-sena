<?php

namespace IngresoSENA\model;

use IngresoSENA\model\DAO\AprendizDAO;
use NogalSE\NQL;

class Aprendiz extends AprendizDAO {

  public function ValidateExists($documento) {
    $nql = new NQL($this->getDbDriver());
    $sql = $nql->select('id')->from('aprendiz')->where('documento', false);
    $this->setDbParam(':documento', $documento, \PDO::PARAM_STR);
    $data = $this->query($sql);
    if (count($data) > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function ValidateExistsCarnet($carnet, $id) {

    $sql = 'SELECT id FROM aprendiz WHERE carnet = :carnet AND id <> :id';
    $this->setDbParam(':carnet', $carnet, \PDO::PARAM_STR);
    $this->setDbParam(':id', $id, \PDO::PARAM_INT);
    $data = $this->query($sql);
    if (count($data) > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function ValidateExistsCarnetNuevo($carnet) {

    $sql = 'SELECT id FROM aprendiz WHERE carnet = :carnet ';
    $this->setDbParam(':carnet', $carnet, \PDO::PARAM_STR);

    $data = $this->query($sql);
    if (count($data) > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function ValidateActualizacion($documento, $id) {
//    $nql = new NQL($this->getDbDriver());
//    $sql = $nql->select('id')->from('aprendiz')->where('documento', false);
    $sql = 'SELECT id FROM aprendiz WHERE documento = :documento AND id <> :id';
    $this->setDbParam(':documento', $documento, \PDO::PARAM_STR);
    $this->setDbParam(':id', $id, \PDO::PARAM_INT);
    $data = $this->query($sql);
    if (count($data) > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function ValidateActualizacionDoc($documento) {
    $nql = new NQL($this->getDbDriver());
    $sql = $nql->select('id')->from('aprendiz')->where('documento', false);
    $this->setDbParam(':documento', $documento, \PDO::PARAM_STR);
    $data = $this->query($sql);
    if (count($data) > 0) {
      return $data;
    } else {
      return true;
    }
  }

  public function ValidateDoc() {
    $nql = new NQL($this->getDbDriver());
    $sql = $nql->select('id,nombre,foto,carnet,ficha,formacion,documento')->from('aprendiz')->where('documento', false);
    $this->setDbParam(':documento', $this->getDocumento(), \PDO::PARAM_STR);
    $data = $this->query($sql);
    if (count($data) > 0) {
      return array('data' => $data, 'bol' => TRUE);
    } else {
      $sql = $nql->select('id,nombre,foto,carnet,ficha,formacion,documento')->from('aprendiz')->where('carnet', false);
      $this->setDbParam(':carnet', $this->getDocumento(), \PDO::PARAM_STR);
      $data = $this->query($sql);
      if (count($data > 0)) {
        return array('data' => $data, 'bol' => TRUE);
      }
      return array('data' => $data, 'bol' => FALSE);
    }
  }

  public function ValidateRegister() {
    $nql = new NQL($this->getDbDriver());
    $sql = $nql->select('id')->from('aprendiz')->where('documento', false);
    $this->setDbParam(':documento', $this->getDocumento(), \PDO::PARAM_STR);
    $data = $this->query($sql);
    if (count($data) > 0) {
      return false;
    } else {
      $sql = $nql->select('id')->from('aprendiz')->where('carnet', false);
      $this->setDbParam(':carnet', $this->getDocumento(), \PDO::PARAM_STR);
      $data = $this->query($sql);
      if (count($data) > 0) {
        return false;
      } else {
        return true;
      }
    }
  }

  public function TraerDatosPropietario() {
    $nql = new NQL($this->getDbDriver());
    $sql = $nql->select('id,nombre,foto,carnet')->from('aprendiz')->where('id', false);
    $this->setDbParam(':id', $this->getId(), \PDO::PARAM_INT);
    $data = $this->query($sql);
    if (count($data) > 0) {
      return array('data' => $data, 'bol' => TRUE);
    } else {
      return array('data' => $data, 'bol' => FALSE);
    }
  }

}
