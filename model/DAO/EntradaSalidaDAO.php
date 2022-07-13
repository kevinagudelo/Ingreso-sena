<?php

namespace IngresoSENA\model\DAO;

use NogalSE\DataSource;

/**

 * @author kevin arley agudelo <kevinosoriohh@gmail.com>
 */
class EntradaSalidaDAO extends DataSource {

  private $id;
  private $equipo_id;
  private $aprendiz_id_entrada;
  private $aprendiz_id_salida;
  private $usuario_id_entrada;
  private $usuario_id_salida;
  private $entrada;
  private $salida;
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

  function getEquipo_id(): int {
    return $this->equipo_id;
  }

  function getAprendiz_id_entrada(): int {
    return $this->aprendiz_id_entrada;
  }

  function getAprendiz_id_salida(): int {
    return $this->aprendiz_id_salida;
  }

  function getUsuario_id_entrada(): int {
    return $this->usuario_id_entrada;
  }

  function getUsuario_id_salida(): int {
    return $this->usuario_id_salida;
  }

  function getEntrada(): string {
    return $this->entrada;
  }

  function getSalida(): string {
    return $this->salida;
  }

  function getActived(): bool {
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

  function setEquipo_id(int $equipo_id) {
    $this->equipo_id = $equipo_id;
  }

  function setAprendiz_id_entrada(int $aprendiz_id_entrada) {
    $this->aprendiz_id_entrada = $aprendiz_id_entrada;
  }

  function setAprendiz_id_salida(int $aprendiz_id_salida) {
    $this->aprendiz_id_salida = $aprendiz_id_salida;
  }

  function setUsuario_id_entrada(int $usuario_id_entrada) {
    $this->usuario_id_entrada = $usuario_id_entrada;
  }

  function setUsuario_id_salida(int $usuario_id_salida) {
    $this->usuario_id_salida = $usuario_id_salida;
  }

  function setEntrada(string $entrada) {
    $this->entrada = $entrada;
  }

  function setSalida(string $salida) {
    $this->salida = $salida;
  }

  function setActived(bool$actived) {
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
    $sql = 'SELECT id, equipo_id, aprendiz_id_entrada,aprendiz_id_salida,usuario_id_entrada,usuario_id_salida,entrada,salida,actived,created_at,updated_at,deleted_at FROM  entrada_salida';
    $answer = $this->query($sql);
    return $answer;
  }

  public function SelectById(): array {
    $sql = 'SELECT id, equipo_id, aprendiz_id_entrada,aprendiz_id_salida,usuario_id_entrada,usuario_id_salida,entrada,salida,actived,created_at,updated_at,deleted_at FROM  entrada_salida WHERE id=:id';
    $this->setDbParam(':id', $this->getId(), \PDO::PARAM_INT);
    $answer = $this->query($sql);
    return $answer;
  }

  public function Update(): int {
    $sql = 'UPDATE entrada_salida SET  actived=:actived,updated_at=NOW() WHERE id=:id';
    $this->setDbParam(':id', $this->getId(), \PDO::PARAM_INT);
    $this->setDbParam(':actived', $this->getActived(), \PDO::PARAM_BOOL);
    $answer = $this->execute($sql);
    return $answer;
  }

  public function Delete(): int {
    $sql = 'UPDATE entrada_salida SET deleted_at=NOW() WHERE  id=:id';
    $this->setDbParam(':id', $this->getId(), \PDO::PARAM_INT);
    $answer = $this->execute($sql);
    return $answer;
  }

  public function AddEntrada(): int {
    $sql = "INSERT INTO entrada_salida (equipo_id, aprendiz_id_entra, usuario_id_entrada, entrada,created_at) VALUES (:equipo_id, :aprendiz_id_entra,:usuario_id_entrada,NOW(),NOW())";
    $this->setDbParam(':equipo_id', $this->getEquipo_id(), \PDO::PARAM_INT);
    $this->setDbParam(':aprendiz_id_entra', $this->getAprendiz_id_entrada(), \PDO::PARAM_INT);
    $this->setDbParam(':usuario_id_entrada', $this->getUsuario_id_entrada(), \PDO::PARAM_INT);
    $answer = $this->execute($sql);
    return $answer;
  }

  public function AddSalida(): int {
    $sql = "INSERT INTO entrada_salida (aprendiz_id_salida, usuario_id_salida, salida) VALUES (:aprendiz_id_salida,:usuario_id_salida,NOW())";

    $this->setDbParam(':aprendiz_id_salida', $this->getAprendiz_id_salida(), \PDO::PARAM_INT);
    $this->setDbParam(':usuario_id_salida', $this->getUsuario_id_salida(), \PDO::PARAM_INT);
    $answer = $this->execute($sql);
    return $answer;
  }

}
