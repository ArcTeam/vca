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
        $out['draft'] = $this->draft();
      break;
      case 2:
        $out['dash'] = 'advanced';
        $out['draft'] = $this->draft();
      break;
      case 3:
        $out['dash'] = 'supervisor';
        $out['request'] = $this->request();
        $out['approved'] = $this->approved();
      break;
      case 4:
        $out['dash'] = 'admin';
        $out['request'] = $this->request();
      break;
    }
    $out['approved'] = $this->approved();
    $out['tovalidate'] = $this->tovalidate();
    $out['address'] = $this->address();
    return $out;
  }
  protected function request(){
    return $this->simple("select a.id, a.last_name, a.first_name, date(b.data) as data from addr_book a, request b where b.address = a.id order by 4,2;");
  }
  protected function address(){
    return $this->simple("select * from addr_book order by last_name,first_name,email asc;");
  }
  protected function tovalidate(){
    $filter = $_SESSION['class'] < 4 ? ' AND compiler = '.$_SESSION['id'] : '';
    $sql = "SELECT r.id, r.name, t.type, v.date::date, a.first_name||' '||a.last_name utente FROM addr_book a, record r, usr, validation v, list.recordtype t WHERE r.compiler = usr.id AND r.type = t.id AND usr.id = a.id AND v.record = r.id AND r.draft = false AND v.state = false ".$filter." order by date desc, name asc, type asc;";
    return $this->simple($sql);
  }
  protected function approved(){
    $filter = $_SESSION['class'] < 4 ? ' AND compilatore.id = '.$_SESSION['id'] : '';
    $limit = $_SESSION['class'] < 4 ? '' : ' LIMIT 10 ';
    $sql = "SELECT record.id, record.name, recordtype.type, validation.date::date, supervisore_info.first_name||' '||supervisore_info.last_name supervisor, compilatore_info.first_name||' '||compilatore_info.last_name compiler FROM record, usr compilatore, usr supervisore, validation, addr_book supervisore_info, addr_book compilatore_info, list.recordtype WHERE record.compiler = compilatore.id AND record.type = recordtype.id AND compilatore.id = compilatore_info.id AND supervisore.id = supervisore_info.id AND validation.record = record.id AND validation.supervisor = supervisore.id AND validation.state = true ".$filter." order by date desc, name asc, type asc ".$limit." ;";
    return $this->simple($sql);
  }
  protected function draft(){
    $sql = "select record.id, record.name, type.type, record.data from record inner join list.recordtype type on record.type = type.id where record.compiler = ".$_SESSION['id']." and record.draft = true;";
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
