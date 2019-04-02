<?php
require('../class/db.class.php');
$db = new DB;
$where = '';
if (isset($_GET['filter'])) { $where = "where ".$_GET['filter']." = ".$_GET['value']; }
echo json_encode($db->simple("select id,name from geodati.".$_GET['table']." ".$where." order by name asc;"));
?>
