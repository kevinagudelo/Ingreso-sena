<?php

namespace IngresoSENA\model\DAO;

use NogalSE\DataSource;

/**
 * Class UsuarioDAO
 * @author Kevin Agudelo <Kevinosoriohh@gmail.com>
 */
class UsuarioDAO extends DataSource {

  private $id;
  private $rol;
  private $usuario;
  private $contrasena;
  private $nombre;
  private $actived;
  private $created_at;
  private $upadated_at;
  private $deleted_at;

  public function __construct() {
    parent::__construct($GLOBALS['config']->getDbConfig());
  }

  /**
   * @return mixed
   */
  public function getId(): int {
    return $this->id;
  }

  public function getRol(): string {
    return $this->rol;
  }

  public function getUsuario(): string {
    return $this->usuario;
  }

  public function getContrasena(): string {
    return $this->contrasena;
  }

  public function getNombre(): string {
    return $this->nombre;
  }

  public function getActived(): bool {
    return $this->actived;
  }

  public function getCreated_at(): string {
    return $this->created_at;
  }

  public function getUpadated_at(): string {
    return $this->upadated_at;
  }

  public function getDeleted_at(): string {
    return $this->deleted_at;
  }

  public function setId(int $id) {
    $this->id = $id;
    return $this;
  }

  public function setRol(string $rol) {
    $this->rol = $rol;
    return $this;
  }

  public function setUsuario(string $usuario) {
    $this->usuario = $usuario;
    return $this;
  }

  public function setContrasena(string $contrasena) {
    $this->contrasena = $contrasena;
    return $this;
  }

  public function setNombre(string $nombre) {
    $this->nombre = $nombre;
    return $this;
  }

  public function setActived(bool $actived) {
    $this->actived = $actived;
    return $this;
  }

  public function setCreated_at(string $created_at) {
    $this->created_at = $created_at;
    return $this;
  }

  public function setUpadated_at(string $upadated_at) {
    $this->upadated_at = $upadated_at;
    return $this;
  }

  public function setDeleted_at(string $deleted_at) {
    $this->deleted_at = $deleted_at;
    return $this;
  }

  public function SelectAll(): array {
    $sql = 'SELECT id, usuario,contrasena,rol,nombre,actived,created_at,updated_at,deleted_at FROM
usuario';
    return $answer = $this->query($sql);
  }

  public function SelectById(): array {
    $sql = 'SELECT id, usuario,contrasena,rol,nombre,actived,created_at,updated_at,deleted_at FROM
usuario WHERE id=:id';
    $this->setDbParam(':id', $this->getId(), \PDO::PARAM_INT);
    $answer = $this->query($sql);
    return $answer;
  }

  public function Update(): bool {
    $sql = 'UPDATE usuario SET  contrasena:=contrasena,actived:=actived,updated_at=NOW() WHERE id=:id';
    $this->setDbParam(':id', $this->getId(), \PDO::PARAM_INT);
    $this->setDbParam(':contrasena', $this->getContrasena(), \PDO::PARAM_STR);
    $this->setDbParam(':actived', $this->getActived(), \PDO::PARAM_BOOL);
    $answer = $this->execute($sql);
    return $answer;
  }

  public function Delete($logical = true): bool {
    if ($logical === true) {
      $sql = 'UPDATE usuario SET delete_at=NOW() WHERE  id=:id';
    } else if ($logical === false) {
      $sql = 'DELETE FROM usuario WHERE id = :id';
    }

    $this->setDbParam(':id', $this->getId(), \PDO::PARAM_INT);
    $answer = $this->execute($sql);
    return $answer;
  }

  public function Add(): int {
    $sql = "INSERT INTO usuario (rol, usuario, contrasena, nombre, created_at) VALUES (:rol, :usuario, :contrasena, :nombre, NOW())";
    $this->setDbParam(':rol', $this->getRol(), \PDO::PARAM_INT);
    $this->setDbParam(':usuario', $this->getUsuario(), \PDO::PARAM_STR);
    $this->setDbParam(':nombre', $this->getNombre(), \PDO::PARAM_STR);
    $this->setDbParam(':contrasena', $this->getContrasena(), \PDO::PARAM_STR);
    $answer = $this->execute($sql);
    return $answer;
  }

}
