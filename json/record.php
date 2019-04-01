<?php
require('../class/db.class.php');
$db = new DB;
echo json_encode($db->simple("select record.id, state.name as state, land.name as land, municipality.name as municipality, record.name, type.type
from record
left join localization l on l.record = record.id
left join geodati.state on l.state = state.id
left join geodati.land on l.land = land.id
left join geodati.municipality on l.municipality = municipality.id
left join list.recordtype type on record.type = type.id
order by 2,3,4,5,6,1 asc;"));
?>
