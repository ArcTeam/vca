<?php
session_start();
require ("db.class.php");
class Dashboard extends Db{
  function __construct(){}
  public function dash(){
    $out = array();
    if ($_SESSION['class']===1) {
      $out['dash'] = 'user';
    }

    if ($_SESSION['class']===2) {
      $out['dash'] = 'advanced';
    }

    if ($_SESSION['class'] > 2) {
      $out['dash'] = 'supervisor';
      $out['request'] = $this->request();
    }

    if ($_SESSION['class']===4) {
      $out['dash'] = 'admin';
    }

    $out['address'] = $this->address();
    return $out;
  }
  protected function request(){
    return $this->simple("select a.id, a.last_name, a.first_name, date(b.data) as data from addr_book a, request b where b.address = a.id order by 4,2;");
  }
  protected function address(){
    return $this->simple("select * from addr_book order by last_name,first_name,email asc;");
  }
  protected function draft(){
    return $this->simple("select name from addr_book order by last_name,first_name,email asc;");
  }




  /***** note  ****/
  public function note(){
    return $this->simple("select * from note where usr = ".$_SESSION['id']." order by data desc;");
  }
  public function addNote($dati){
    $dati['usr'] = $_SESSION['id'];
    $sql = "insert into note(usr,note) values(:usr,:note);";
    return $this->prepared('',$sql,$dati);
  }
  public function delNote($dati){
    $sql = "delete from note where id = :id;";
    return $this->prepared('',$sql,$dati);
  }
  /*********************/
}

?>
