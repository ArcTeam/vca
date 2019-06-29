<?php
require('../class/db.class.php');
$db = new DB;
echo json_encode($db->simple("select * from list.publicationtype order by 2 asc;"));
?>
