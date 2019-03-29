<?php
session_start();
require ("db.class.php");
class Dashboard extends Db{
  function __construct(){}
  public function dash(){
    $out = array();
    switch ($_SESSION['class']) {
      case 1:
        $out['dash'] = 'user';
      break;
      case 2:
        $out['dash'] = 'advanced';
      break;
      case 3:
        $out['dash'] = 'supervisor';
        $out['request'] = $this->request();
        $out['draft'] = $this->draft();
        $out['approved'] = $this->approved();
      break;
      case 4:
        $out['dash'] = 'admin';
        $out['request'] = $this->request();
        $out['draft'] = $this->draft();
        $out['approved'] = $this->approved();
      break;
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
    $sql = "SELECT r.id, r.name, t.type, v.date::date, a.first_name||' '||a.last_name utente FROM addr_book a, record r, usr, validation v, list.recordtype t WHERE r.compiler = usr.id AND r.type = t.id AND usr.id = a.id AND v.record = r.id AND v.state = false order by date desc, name asc, type asc;";
    return $this->simple($sql);
  }
  protected function approved(){
    $sql = "SELECT r.id, r.name, t.type, v.date::date, a.first_name||' '||a.last_name utente FROM addr_book a, record r, usr, validation v, list.recordtype t WHERE r.compiler = usr.id AND r.type = t.id AND usr.id = a.id AND v.record = r.id AND v.state = true order by date desc, name asc, type asc limit 10;";
    return $this->simple($sql);
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
