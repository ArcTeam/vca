<?php
require ("db.class.php");
class Dashboard extends Db{
  public $class;
  function __construct($class){$this->class=$class;}
  public function dash(){
    $out = array();
    if ($this->class===1) {
      $out['dash'] = 'user';
    }
    if ($this->class===2) {
      $out['dash'] = 'advanced';
    }
    if ($this->class > 2) {
      $out['dash'] = 'supervisor';
      $out['request'] = $this->request();
    }

    if ($this->class===4) {
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
}

?>
