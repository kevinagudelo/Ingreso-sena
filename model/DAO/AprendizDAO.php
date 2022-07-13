<?php

namespace IngresoSENA\model\DAO;

use NogalSE\DataSource;

/**
 * Class UsuarioDatoDAO
 * @package MyApp\MyAppmodel\DAO
 * @author Kevin Agudelo <Kevinosoriohh@gmail.com>
 */
class AprendizDAO extends DataSource {

  private $id;
  private $tipo_documento_id;
  private $foto;
  private $nombre;
  private $documento;
  private $carnet;
  private $ficha;
  private $formacion;
  private $actived;
  private $created_at;
  private $upadated_at;
  private $deleted_at;

  public function __construct() {
    parent::__construct($GLOBALS['config']->getDbConfig());
  }

  public function getId() {
    return $this->id;
  }

  public function getTipo_documento_id() {
    return $this->tipo_documento_id;
  }

  public function getFoto() {
    return $this->foto;
  }

  public function getNombre() {
    return $this->nombre;
  }

  public function getDocumento() {
    return $this->documento;
  }

  public function getCarnet() {
    return $this->carnet;
  }

  public function getFicha() {
    return $this->ficha;
  }

  public function getFormacion() {
    return $this->formacion;
  }

  public function getActived() {
    return $this->actived;
  }

  public function getCreated_at() {
    return $this->created_at;
  }

  public function getUpadated_at() {
    return $this->upadated_at;
  }

  public function getDeleted_at() {
    return $this->deleted_at;
  }

  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  public function setTipo_documento_id($tipo_documento_id) {
    $this->tipo_documento_id = $tipo_documento_id;
    return $this;
  }

  public function setFoto($foto) {
    $this->foto = $foto;
    return $this;
  }

  public function setNombre($nombre) {
    $this->nombre = $nombre;
    return $this;
  }

  public function setDocumento($documento) {
    $this->documento = $documento;
    return $this;
  }

  public function setCarnet($carnet) {
    $this->carnet = $carnet;
    return $this;
  }

  public function setFicha($ficha) {
    $this->ficha = $ficha;
    return $this;
  }

  public function setFormacion($formacion) {
    $this->formacion = $formacion;
    return $this;
  }

  public function setActived($actived) {
    $this->actived = $actived;
    return $this;
  }

  public function setCreated_at($created_at) {
    $this->created_at = $created_at;
    return $this;
  }

  public function setUpadated_at($upadated_at) {
    $this->upadated_at = $upadated_at;
    return $this;
  }

  public function setDeleted_at($deleted_at) {
    $this->deleted_at = $deleted_at;
    return $this;
  }

  public function SelectAll(): array {
    $sql = 'SELECT id, tipo_documento_id,foto,nombre,documento,carnet,ficha,formacion,actived,created_at,updated_at,deleted_at FROM  aprendiz';
    $answer = $this->query($sql);
    return $answer;
  }

  public function SelectById(): array {
    $sql = 'SELECT id, tipo_documento_id,foto,nombre,documento,carnet,ficha,formacion,actived,created_at,updated_at,deleted_at FROM  aprendiz WHERE id=:id';
    $this->setDbParam(':id', $this->getId(), \PDO::PARAM_INT);
    $answer = $this->query($sql);
    return $answer;
  }

  public function Update(): int {
    $sql = 'UPDATE aprendiz SET  nombre = :nombre ,tipo_documento_id=:tipo_documento_id,foto=:foto,documento=:documento,carnet=:carnet,ficha=:ficha,formacion=:formacion, updated_at=NOW() WHERE id=:id';
    $this->setDbParam(':id', $this->getId(), \PDO::PARAM_INT);
    $this->setDbParam(':tipo_documento_id', $this->getTipo_documento_id(), \PDO::PARAM_INT);
    $this->setDbParam(':foto', $this->getFoto(), \PDO::PARAM_STR);
    $this->setDbParam(':documento', $this->getDocumento(), \PDO::PARAM_STR);
    $this->setDbParam(':carnet', $this->getCarnet(), \PDO::PARAM_STR);
    $this->setDbParam(':nombre', $this->getNombre(), \PDO::PARAM_STR);
    $this->setDbParam(':ficha', $this->getFicha(), \PDO::PARAM_STR);
    $this->setDbParam(':formacion', $this->getFormacion(), \PDO::PARAM_STR);
    $answer = $this->execute($sql);
    return $answer;
  }

  public function Delete(): int {
    $sql = 'UPDATE aprendiz SET delete_at = NOW() WHERE id = :id';
    $this->setDbParam(':id', $this->getId(), \PDO::PARAM_INT);
    $answer = $this->execute($sql);
    return $answer;
  }

  public function Add(): int {
    $sql = "INSERT INTO aprendiz (tipo_documento_id,foto,documento,carnet,ficha,formacion,nombre,created_at) VALUES (:tipo_documento_id,:foto,:documento,:carnet,:ficha,:formacion,:nombre,NOW())";
    $this->setDbParam(':tipo_documento_id', $this->getTipo_documento_id(), \PDO::PARAM_INT);
    $this->setDbParam(':foto', $this->getFoto(), \PDO::PARAM_STR);
    $this->setDbParam(':documento', $this->getDocumento(), \PDO::PARAM_STR);
    $this->setDbParam(':carnet', $this->getCarnet(), \PDO::PARAM_STR);
    $this->setDbParam(':nombre', $this->getNombre(), \PDO::PARAM_STR);
    $this->setDbParam(':ficha', $this->getFicha(), \PDO::PARAM_STR);
    $this->setDbParam(':formacion', $this->getFormacion(), \PDO::PARAM_STR);
    $answer = $this->execute($sql);
    return $answer;
  }

}
