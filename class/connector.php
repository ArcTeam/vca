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
function rescuePwd($class){return json_encode($class->rescuePwd($_POST['email']));}
function updateAccount($class){return json_encode($class->updateAccount($_POST['dati']));}

## admin function ##
function userList($class){return json_encode($class->userList());}
function userMod($class){return json_encode($class->userMod($_POST['dati']));}
function checkEmail($class){
  $sql = "select id from addr_book where email = '".$_POST['dati']['email']."';";
  return json_encode($class->countRow($sql));
}

## list ##
function areaList($class){return json_encode($class->areaList());}
function landList($class){return json_encode($class->landList($_POST['dati']));}
function municipalityList($class){return json_encode($class->municipalityList($_POST['dati']['state'],$_POST['dati']['land']));}
function typeList($class){return json_encode($class->typeList());}
function recordList($class){return $class->recordList();}
function cronoList($class){return json_encode($class->cronoList());}
function chronology($class){return json_encode($class->chronology($_POST['dati']['start']));}

## poi ##
function poiInfo($class){return json_encode($class->poiInfo($_POST['dati']['id']));}

## dashboard ##
function note($class){return json_encode($class->note());}
function addNote($class){return json_encode($class->addNote($_POST['dati']));}
function delNote($class){return json_encode($class->delNote($_POST['dati']));}

## record ##
function closeRecord($class){return json_encode($class->closeRecord($_POST['dati']['record']));}
function unlockRecord($class){return json_encode($class->unlockRecord($_POST['dati']['record']));}
function approveRecord($class){return json_encode($class->approveRecord($_POST['dati']['record']));}
function deleteRecord($class){return json_encode($class->deleteRecord($_POST['dati']['record']));}

## bibliography ##
function itemDel($class){return json_encode($class->itemDel($_POST['dati']['item']));}
?>
