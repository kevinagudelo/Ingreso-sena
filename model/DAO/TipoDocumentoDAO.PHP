<?php

namespace IngresoSENA\MyAppmodel\DAO;

use IngresoSENA\model\DataSource;

/**
 * Class UsuarioDAO
 * @package MyApp\MyAppmodel\DAO
 * @author Kevin Agudelo <Kevinosoriohh@gmail.com>
 */
class TipoDocumento extends DataSource {

  private $id;
  private $nombre;
  private $activated;
  private $created_at;
  private $deleted_at;

  public function __construct() {
    parent::__construct($GLOBALS['config']->getDbConfig());
  }

  public function getId(): int {
    return $this->id;
  }

  public function getNombre(): string {
    return $this->nombre;
  }

  public function getActivated(): bool {
    return $this->activated;
  }

  public function getCreated_at(): string {
    return $this->created_at;
  }

  public function getDeleted_at(): string {
    return $this->deleted_at;
  }

  public function setId(int $id) {
    $this->id = $id;
    return $this;
  }

  public function setNombre(string $nombre) {
    $this->nombre = $nombre;
    return $this;
  }

  public function setActivated(string $activated) {
    $this->activated = $activated;
    return $this;
  }

  public function setCreated_at(string$created_at) {
    $this->created_at = $created_at;
    return $this;
  }

  public function setDeleted_at(string $deleted_at) {
    $this->deleted_at = $deleted_at;
    return $this;
  }

  public function SelectById(): array {
    $sql = 'SELECT id, nombre,actived,created_at FROM tipo_documento WHERE id=:id';
    $this->setDbParam(':id', $this->getId(), \PDO::PARAM_INT);
    $answer = $this->query($sql);
    return $answer;
  }

  /**
   *
   * @return array
   */
  public function SelectAll(): array {
    $sql = 'SELECT id, nombre,actived, created_at FROM tipo_documento ';
    $answer = $this->query($sql);
    return $answer;
  }

  /**
   * Actualiza un tipo_documento y retorna su id
   * @return int
   */
  public function Update(): int {
    $sql = 'UPDATE tipo_documento SET  nombre=:nombre,actived=:actived WHERE rol_id=:id';
    $this->setDbParam(':id', $this->getId(), \PDO::PARAM_INT);
    $this->setDbParam(':nombre', $this->getRolname(), \PDO::PARAM_STR);
    $this->setDbParam(':actived', $this->getActivated(), \PDO::PARAM_BOOL);
    $answer = $this->execute($sql);
    return $answer;
  }

  /**
   * borra un rol y retorna 0
   * @return int
   */
  public function Delete(): int {
    $sql = 'UPDATE tipo_documento SET delete_at=NOW() WHERE id=:id';
    $this->setDbParam(':id', $this->getId(), \PDO::PARAM_INT);
    $answer = $this->execute($sql);
    return $answer;
  }

  /*   * c
   * agrega un rol y reorna 0
   * @return int
   */

  public function Add(): int {
    $sql = "INSERT INTO tipo_documento  (nombre,actived, created_at) VALUES(:nombre,:actived,NOW())";
    $this->setDbParam(':nombre', $this->getRolname(), \PDO::PARAM_STR);
    $this->setDbParam(':actived', $this->getActivated(), \PDO::PARAM_BOOL);
    $answer = $this->execute($sql);
    return $answer;
  }

}
