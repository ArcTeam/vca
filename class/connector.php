<?php
require($_POST['oop']['file']);
$class=new $_POST['oop']['classe'];
$funzione = $_POST['oop']['func'];
if(isset($funzione) && function_exists($funzione)) {
  $trigger = $funzione($class);
  echo $trigger;
}
## user function ##
function subscribe($class){return json_encode($class->subscribe($_POST['dati']));}
function login($class){return json_encode($class->login($_POST['dati']));}
function changePwd($class){return json_encode($class->changePwd($_POST['dati']));}
function rescuePwd($class){return json_encode($class->rescuePwd($_POST['dati']));}
function updateAccount($class){return json_encode($class->updateAccount($_POST['dati']));}
?>
