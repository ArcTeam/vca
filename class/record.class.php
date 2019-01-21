<?php
require ("global.class.php");
class Record extends Generic{
  public $id;
  function __construct($id){
    $this->id=$id;
  }
  public function info(){
    return $this->simple("select * from recordview where id = ".$this->id.";");

  }
}

?>
