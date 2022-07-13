<?php

namespace IngresoSENA\model\DAO;

use NogalSE\DataSource;

/**
 * Class UsuarioDatoDAO
 * @package MyApp\MyAppmodel\DAO
 * @author kevin muñoz <keder3009@gmail.com>
 */
class EquipoDAO extends DataSource {

  private $id;
  private $dispositivo_id;
  private $aprendiz_id;
  private $codigo;
  private $marca;
  private $serie;
  private $cargador;
  private $actived;
  private $created_at;
  private $upadated_at;
  private $deleted_at;

  public function __construct() {
    parent::__construct($GLOBALS['config']->getDbConfig());
  }

  function getId(): int {
    return $this->id;
  }

  function getDispositivo_id(): int {
    return $this->dispositivo_id;
  }

  function getAprendiz_id(): int {
    return $this->aprendiz_id;
  }

  function getCodigo(): string {
    return $this->codigo;
  }

  function getMarca(): string {
    return $this->marca;
  }

  function getSerie(): string {
    return $this->serie;
  }

  function getCargador(): string {
    return $this->cargador;
  }

  function getActived(): bol {
    return $this->actived;
  }

  function getCreated_at(): string {
    return $this->created_at;
  }

  function getUpadated_at(): string {
    return $this->upadated_at;
  }

  function getDeleted_at(): string {
    return $this->deleted_at;
  }

  function setId(int $id) {
    $this->id = $id;
  }

  function setDispositivo_id(int $dispositivo_id) {
    $this->dispositivo_id = $dispositivo_id;
  }

  function setAprendiz_id(int $aprendiz_id) {
    $this->aprendiz_id = $aprendiz_id;
  }

  function setCodigo(string $codigo) {
    $this->codigo = $codigo;
  }

  function setMarca(string $marca) {
    $this->marca = $marca;
  }

  function setSerie(string $serie) {
    $this->serie = $serie;
  }

  function setCargador(string $cargador) {
    $this->cargador = $cargador;
  }

  function setActived(bool $actived) {
    $this->actived = $actived;
  }

  function setCreated_at(string $created_at) {
    $this->created_at = $created_at;
  }

  function setUpadated_at(string $upadated_at) {
    $this->upadated_at = $upadated_at;
  }

  function setDeleted_at(string $deleted_at) {
    $this->deleted_at = $deleted_at;
  }

  public function SelectAll(): array {
    $sql = 'SELECT id, dispositivo_id,aprendiz_id,codigo,marca,serie,cargador,actived,created_at,updated_at,deleted_at FROM  equipo';
    $answer = $this->query($sql);
    return $answer;
  }

  public function SelectById(): array {
    $sql = 'SELECT id, dispositivo_id,aprendiz_id,codigo,marca,serie,cargador,actived,created_at,updated_at,deleted_at FROM  equipo WHERE id=:id';
    $this->setDbParam(':id', $this->getId(), \PDO::PARAM_INT);
    $answer = $this->query($sql);
    return $answer;
  }

  public function Update(): int {
    $sql = 'UPDATE equipo SET  aprendiz_id=:aprendiz,cargador=:cargador,actived:=actived,updated_at=NOW() WHERE id=:id';
    $this->setDbParam(':id', $this->getId(), \PDO::PARAM_INT);
    $this->setDbParam(':apremdiz_id', $this->getAprendiz_id(), \PDO::PARAM_INT);
    $this->setDbParam(':cargador', $this->getCargador(), \PDO::PARAM_STR);
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
    $sql = "INSERT INTO equipo (dispositivo_id, aprendiz_id, codigo, marca, serie, cargador,created_at) VALUES (:dispositivo_id, :aprendiz_id, :codigo, :marca, :serie, :cargador,NOW())";
    $this->setDbParam(':dispositivo_id', $this->getDispositivo_id(), \PDO::PARAM_INT);
    $this->setDbParam(':aprendiz_id', $this->getAprendiz_id(), \PDO::PARAM_INT);
    $this->setDbParam(':codigo', $this->getCodigo(), \PDO::PARAM_STR);
    $this->setDbParam(':marca', $this->getMarca(), \PDO::PARAM_STR);
    $this->setDbParam(':serie', $this->getSerie(), \PDO::PARAM_STR);
    $this->setDbParam(':cargador', $this->getCargador(), \PDO::PARAM_STR);
    $answer = $this->execute($sql);
    return $answer;
  }

}
