<?php
require("db.class.php");
class Admin extends Db{
  function __construct(){}
  public function userList(){
    return $this->simple("select a.id,a.first_name,a.last_name,a.email,a.address,a.cell,a.description,l.id as idclass, l.class,u.act from addr_book a,list.usr_class l, usr u where u.id = a.id and u.class = l.id order by 3,4 asc;");
  }
  public function userMod($dati=array()){
    if ($dati['field']=='class') {
      $out = $this->modClass(array("id"=>$dati['id'],"class"=>$dati['val']));
    }else {
      $out = $this->modStatus(array("id"=>$dati['id']));
    }
    return $out;
  }
  private function modClass($dati){
    switch ($dati['class']) {
      case 1: $dati['level']=1; break;
      case 2: $dati['level']=5; break;
      case 3: $dati['level']=11; break;
      case 4: $dati['level']=12; break;
    }
    $sql = "update usr set class = :class, level = :level where id = :id;";
    $update = $this->prepared('',$sql,$dati);
    if ($update) {
      return "ok, user class has been modified!";
    }else {
      return "sorry, something gone wrong";
    }
  }
  private function modStatus($dati){
    $status = $this->simple("select act from usr where id = ".$dati['id']);
    $dati['act'] = $status[0]['act'] == 't' ? 'f' : 't';
    $sql = "update usr set act = :act where id = :id;";
    $update = $this->prepared('',$sql,$dati);
    if ($update) {
      return "ok, user status has been modified!";
    }else {
      return "sorry, something gone wrong";
    }
  }
}
?>
