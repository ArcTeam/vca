<?php
require("db.class.php");
class Admin extends Db{
  function __construct(){}
  public function userList(){
    return $this->simple("select a.id,a.first_name,a.last_name,a.email,a.address,a.cell,a.description,l.id as idclass, l.class,u.act from addr_book a,list.usr_class l, usr u where u.id = a.id and u.class = l.id order by 3,4 asc;");
  }
  public function userMod($dati=array()){
    return $dati;
  }
}
?>
