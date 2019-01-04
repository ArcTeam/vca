<?php
require ("db.class.php");
class Dashboard extends Db{
    function __construct(){}
    public function dash(){
      $out = array();
      $out['request'] = $this->request();
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
