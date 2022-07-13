<?php

namespace IngresoSENA\model;

use IngresoSENA\model\DAO\UsuarioDAO;
use NogalSE\NQL;

class Usuario extends UsuarioDAO {

  public function ValidateExists() {
    $nql = new NQL($this->getDbDriver());
    $sql = $nql->select('id')->from('usuario')->where('usuario', false);
    // $sql = 'SELECT id FROM usuario WHERE nickname = :nickname';
    $this->setDbParam(':usuario', $this->getUsuario(), \PDO::PARAM_STR);
    $data = $this->query($sql);
    if (count($data) > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function ValidatePassword() {
    $nql = new NQL($this->getDbDriver());
    $sql = $nql->select('id, usuario, rol,contrasena')->from('usuario')->where('usuario', false);
    $this->setDbParam(':usuario', $this->getUsuario(), \PDO::PARAM_STR);
    $data = $this->query($sql);
    if (count($data) > 0) {
      return array('data' => $data, 'bol' => TRUE);
    } else {
      return array('data' => $data, 'bol' => FALSE);
    }
  }

  public function ValidateUsername() {
    $nql = new NQL($this->getDbDriver());
    $sql = $nql->select('id')->from('usuario')->where('usuario', false);
    $this->setDbParam(':usuario', $this->getUsuario(), \PDO::PARAM_STR);
    $data = $this->query($sql);
    if (count($data) > 0) {
      return false;
    } else {
      return true;
    }
  }

  public function ValidatePasswordExistent($contra, $id) {
    $sql = 'SELECT id FROM usuario WHERE contrasena = :contrasena AND id =:id';
    $this->setDbParam(':contrasena', $contra, \PDO::PARAM_STR);
    $this->setDbparam(':id', $id, \PDO::PARAM_INT);
    $data = $this->query($sql);
    if (count($data) > 0) {
      return false;
    } else {
      return true;
    }
  }

}
