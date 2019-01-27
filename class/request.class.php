<?php
require("user.class.php");
class Request extends User{
  private $usr;
  function __construct(int $id){ $this->usr = $id; }

  public function usrInfo(){
    return $this->simple("select a.id, a.last_name, a.first_name, a.cell, a.description, a.address, a.email, b.data::date as data, b.data::time as hour from addr_book a, request b where b.address = a.id and a.id=".$this->usr.";");
  }

  public function usrClass(){
    return $this->simple("select * from list.usr_class where id <= ".$_SESSION['class'].";");
  }

  public function accept($class){
    $out=array();
    $info = $this->usrInfo();
    //array for usr table
    $usr['id'] = $this->usr;
    $usr['pwd'] = $this->createPwd();
    $usr['class']= $class;
    //array for email
    $email[]=$info[0]['email'];
    $email[]=$this->getUsername($info[0]['email']);
    $email[]=$usr['pwd'];
    $email[]='user';
    $this->begin();
    try {
      $out[]=$this->addUser($usr);
      $this->sendMail($email);
      $this->simple("delete from request where address=".$this->usr.";");
      $this->commitTransaction();
      return "<h5 class='text-success'>Request sent from ".$info[0]['first_name']." ".$info[0]['last_name']." was accepted!</h5><p>".implode("<br>",$out)."</P>";
    } catch (\PDOException $e) {
      $this->rollback();
      return array("error",$e);
    }
  }
  public function deny(){
    $usr = $this->usrInfo();
    try {
      $this->simple("delete from request where address=".$usr[0]['id']);
      return "Request sent from ".$usr[0]['first_name']." ".$usr[0]['last_name']." was denied";
    } catch (\Exception $e) {
      return "error: ".$e->getMessage()."\n".$e->getLine();
    }

  }
}

?>
