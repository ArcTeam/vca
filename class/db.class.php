<?php
require("conn.class.php");
class Db extends Conn{
  private $string = PDO::PARAM_STR;
  private $integer = PDO::PARAM_INT;
  public function simple($sql){
    try {
      $pdo = $this->pdo();
      $exec = $pdo->prepare($sql);
      $exec->execute();
      return $exec->fetchAll(PDO::FETCH_ASSOC);
    } catch (\PDOException $e) {
      return  "error: ".$e->getMessage();
    }
  }
  public function prepared($action, $sql, $dati=array()){
    try {
      $pdo = $this->pdo();
      $exec = $pdo->prepare($sql);
      $exec->execute($dati);
      return true;
    } catch (\PDOException $e) {
      return $e->getMessage();
    }
  }
  protected function countRow($sql){
    try {
      $pdo = $this->pdo();
      $row = $pdo->query($sql)->rowCount();
      return $row;
    } catch (\PDOException $e) {
      $this->msg =  "errore: ".$e->getMessage();
    }
  }
  protected function begin(){$this->pdo()->beginTransaction();}
  protected function commitTransaction(){$this->pdo()->commit();}
  protected function rollback(){$this->pdo()->rollBack();}
}
?>
