<?php
## TODO: scrivere le funzioni per accettare o rifiutare una richiesta di accesso al sistema
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

  public function accept(){
    $usr = $this->usrInfo();
    return "Request sent from ".$usr[0]['first_name']." ".$usr[0]['last_name']." was accepted!<br/>A new account was created and a mail with access data information was sent to user.";
  }
  public function deny(){
    $usr = $this->usrInfo();

    return "Request sent from ".$usr[0]['first_name']." ".$usr[0]['last_name']." was denied";
  }
}

?>
