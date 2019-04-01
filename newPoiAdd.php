<?php
session_start();
require("class/db.class.php");
$db = new Db;

if (isset($_POST)) {
  $record=[];
  $localization=[];
  $chronology=[];

  $record['name']=trim($_POST['name']);
  $record['type']=$_POST['type'];
  $record['info']=trim($_POST['info']);
  $record['compiler'] = $_SESSION['id'];
  $record['tags']='{'.$_POST['tag'].'}';
  $record['biblio']='{'.implode(','$_POST['biblio']).'}';
  $record['cf']='{'.implode(','$_POST['related']).'}';
  if(!isset($_POST['draft'])){$record['draft']='f';}else {$record['draft']='t';}
  $recordQuery = "insert into record(name,type,info,tags,cf,biblio,compiler,draft) values(:name,:type,:info,:tags,:cf,:biblio,:compiler,:draft);";

  $localization['state']=$_POST['state'];
  if(!isset($_POST['land'])){ $localization['land'] = $_POST['land']; }
  if(!isset($_POST['municipality'])){ $localization['municipality'] = $_POST['municipality']; }
  if(!isset($_POST['toponym'])){ $localization['toponym'] = trim($_POST['toponym']); }
  if(!isset($_POST['address'])){ $localization['address'] = trim($_POST['address']); }
  $localization['lon']=trim($_POST['lon']);
  $localization['lat']=trim($_POST['lat']);
  $locField=[];
  $locVal=[];
  foreach ($localization as $key => $value) {
    $locField[]=":".$key;
    $locVal[$key]=$value;
  }

  $localizationQuery = "insert into localization(record,".str_replace(":","",implode(",",$locField)).") values( ".$this->pdo()->lastInsertId('workrecord_id_seq');." ".implode(",",$locField).");";


  $chronology['cronostart']=$_POST['cronostart'];
  if(!isset($_POST['cronoend'])){ $chronology['cronoend'] = $_POST['cronoend']; }
  if(!isset($_POST['period'])){ $chronology['period'] = trim($_POST['period']); }
}
?>

tag roman villa
biblio Array5,
related Array19,
