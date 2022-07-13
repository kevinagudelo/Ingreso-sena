<?php

namespace InfinityWars\model\DAO;

use NogalSE\DataSource;

/**
 * Class UsuarioDatoDAO
 * @package MyApp\MyAppmodel\DAO
 * @author kevin muñoz <keder3009@gmail.com>
 */
class DispositivoDAO extends DataSource {

  private $id;
  private $nombre;
  private $actived;
  private $created_at;
  private $upadated_at;
  private $deleted_at;

  public function __construct() {
    parent::__construct($GLOBALS['config']->getDbConfig());
  }
  function getId() {
      return $this->id;
  }

  function getNombre() {
      return $this->nombre;
  }

  function getActived() {
      return $this->actived;
  }

  function getCreated_at() {
      return $this->created_at;
  }

  function getUpadated_at() {
      return $this->upadated_at;
  }

  function getDeleted_at() {
      return $this->deleted_at;
  }

  function setId($id) {
      $this->id = $id;
  }

  function setNombre($nombre) {
      $this->nombre = $nombre;
  }

  function setActived($actived) {
      $this->actived = $actived;
  }

  function setCreated_at($created_at) {
      $this->created_at = $created_at;
  }

  function setUpadated_at($upadated_at) {
      $this->upadated_at = $upadated_at;
  }

  function setDeleted_at($deleted_at) {
      $this->deleted_at = $deleted_at;
  }
  
      public function SelectAll(): array {
    $sql = 'SELECT id, nombre,actived,created_at,updated_at,deleted_at FROM  dispositivo';
    $answer = $this->query($sql);
    return $answer;
  }

  public function SelectById(): array {
    $sql = 'SELECT id, nombre,actived,created_at,updated_at,deleted_at FROM  dispositivo WHERE id=:id';
    $this->setDbParam(':id', $this->getId(), \PDO::PARAM_INT);
    $answer = $this->query($sql);
    return $answer;
  }

  public function Update(): int {
    $sql = 'UPDATE dispositivo SET nombre=:nombre,actived:=actived,updated_at=NOW() WHERE id=:id';
    $this->setDbParam(':id', $this->getId(), \PDO::PARAM_INT);
    $this->setDbParam(':nombre', $this->getNombre(), \PDO::PARAM_INT);
    $this->setDbParam(':actived', $this->getActived(), \PDO::PARAM_BOOL);
    $answer = $this->execute($sql);
    return $answer;
  }

  public function Delete(): int {
    $sql = 'UPDATE equipo SET deleted_at=NOW() WHERE  id=:id';
    $this->setDbParam(':id', $this->getId(), \PDO::PARAM_INT);
    $answer = $this->execute($sql);
    return $answer;
  }

  public function Add(): int {
    $sql = "INSERT INTO dispositivo (nombre) VALUES (:nombre)";
    $this->setDbParam(':nombre', $this->getNombre(), \PDO::PARAM_INT);
    $answer = $this->execute($sql);
    return $answer;
  }

}