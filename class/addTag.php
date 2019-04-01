<?php
session_start();
require('../class/db.class.php');
$db = new Db;
$tag=strtolower($_POST['tag']);
$check = $db->countRow("select tag from list.tag where tag = '".$tag."';");
if($check == 0){
  $sql = "insert into list.tag(tag) values(:tag);";
  $dati = array("tag"=>$tag);
  return $db->prepared('',$sql,$dati);
}
?>
