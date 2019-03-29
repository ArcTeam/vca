<?php
require ("global.class.php");
class Record extends Generic{
  private $id;
  function __construct(){}
  public function poiInfo($id){
    $this->id = $id;
    $out['info'] = $this->info();
    $out['biblio'] = $this->biblio();
    $out['relPoiTag'] = $this->relPoiByTag();
    $out['relPoiCoo'] = $this->relPoiByLatLon($out['info'][0]['lat'],$out['info'][0]['lon']);
    return $out;
  }
  private function info(){
    $sql = "SELECT
      record.id,
      record.biblio,
      record.name,
      state.name AS state,
      land.name AS land,
      municipality.name AS municipality,
      localization.toponym,
      localization.address,
      localization.lon,
      localization.lat,
      recordtype.type,
      cronostart.definition AS cronostart,
      cronoend.definition AS cronoend,
      chronology.period,
      record.info,
      array_to_json(record.tags) tag,
      addr_book.first_name||' '||addr_book.last_name compiler,
      userlevel.level,
      record.data,
      record.cf
    FROM  record
    left join localization on localization.record = record.id
    left join geodati.state on localization.state = state.id
    left join geodati.land on localization.land = land.id
    left join geodati.municipality on localization.municipality = municipality.id
    left join list.recordtype on record.type = recordtype.id
    left join usr on record.compiler = usr.id
    left join list.userlevel on usr.class = userlevel.userclass
    left join public.addr_book on usr.id = addr_book.id
    left join public.chronology on chronology.record = record.id
    left join list.chronology cronostart on chronology.cronostart = cronostart.id
    left join list.chronology cronoend on chronology.cronoend = cronoend.id
    WHERE record.id = ".$this->id;
    return $this->simple($sql);
  }
  private function biblio(){
    $biblioList = [];
    $arr = $this->simple("select unnest(biblio) biblio from record where id = ".$this->id);
    foreach ($arr as $idx=>$biblio) {
      $sql = "select b.id, b.title, b.journal, b.volume, b.page, b.place, b.publisher, b.year, b.info, b.exhibition, b.url, b.downloadable, b.license, t.type, b.main, b.secondary from biblio b inner join list.publicationtype t on b.type = t.id where b.id = ".$biblio['biblio']. "order by b.title asc";
      $biblioList[] = $this->simple($sql);
    }
    return $biblioList;
  }
  private function relPoiByTag(){
    $sql = "select r.id,r.name from (select unnest(cf) idrel from record where id = ".$this->id.") rel left join record r on rel.idrel=r.id order by name asc;";
    return $this->simple($sql);
  }
  private function relPoiByLatLon($lat,$lon){
    $sql = "select r.id,r.name from record r, localization l where l.record = r.id and l.lon=".$lon." and l.lat =".$lat." and r.id != ".$this->id." order by r.name asc;";
    return $this->simple($sql);
  }

}

?>
