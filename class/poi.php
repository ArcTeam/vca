<?php
require ("db.class.php");
$db=new Db;
$where = '';
if (isset($_GET)) {
  $filter=[];
  foreach (array_filter($_GET) as $key => $value) {
    $filter[]=$key."=".$value;
  }
  $where = " where ".join(' AND ',$filter);
}
$sql="
  SELECT row_to_json(poi.*) AS geometrie
  FROM (
    SELECT 'FeatureCollection'::text AS type, array_to_json(array_agg(features.*)) AS features
    FROM (
      SELECT 'Feature'::text AS type, st_asgeojson(localization.geom)::json AS geometry, row_to_json(prop.*) AS properties
      FROM localization
      JOIN (
        SELECT state.id state, state.name statename, land.id land, land.name landname, municipality.id municipality, municipality.name municipalityname, localization.lon, localization.lat, record.id, record.name, cronostart.cronostart, cronoend.cronoend, cronostartlist.definition cronostartdef, cronoendlist.definition cronoenddef, type.id as type, type.type typedef
        FROM record
        left join localization on localization.record = record.id
        left join geodati.state state on localization.state = state.id
        left join geodati.land land on localization.land = land.id
        left join geodati.municipality municipality on localization.municipality = municipality.id
        left join chronology cronostart on cronostart.record = record.id
        left join chronology cronoend on cronoend.record = record.id
        left join list.chronology cronostartlist on cronostart.cronostart = cronostartlist.id
        left join list.chronology cronoendlist on cronoend.cronoend = cronoendlist.id
        left join list.recordtype type on record.type = type.id ".$where."
      ) prop ON localization.record = prop.id
    ) features
  ) poi;
";
// $arr = $db->simple($sql);
echo $sql;
// echo $arr[0]['geometrie'];

?>
