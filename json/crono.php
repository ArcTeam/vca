<?php
require('../class/db.class.php');
$db = new DB;
$where = '';
if(isset($_GET['start'])){
  $where = "where id >= ".$_GET['start'];
}
echo json_encode($db->simple("select * from list.chronology ".$where." order by 1 asc;"));
?>
