<?php
require('../class/db.class.php');
$db = new DB;
echo json_encode($db->simple("select id, title, main, year from biblio order by 2 asc;"));
?>
