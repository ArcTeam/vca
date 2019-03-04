<?php
require ("global.class.php");
class Record extends Generic{
  private $id;
  function __construct(){}
  public function poiInfo($id){
    $this->id = $id;
    $out['info'] = $this->info();
    $out['biblio'] = $this->biblio();
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
      array_to_json(record.tag) tag,
      addr_book.first_name,
      addr_book.last_name,
      record.data,
      record.relatedrecord
    FROM  record
    inner join localization on localization.record = record.id
    inner join geodati.state on localization.state = state.id
    inner join geodati.land on localization.land = land.id
    inner join geodati.municipality on localization.municipality = municipality.id
    inner join list.recordtype on record.type = recordtype.id
    inner join public.addr_book on record.compiler = addr_book.id
    inner join public.chronology on chronology.record = record.id
    inner join list.chronology cronostart on chronology.cronostart = cronostart.id
    inner join list.chronology cronoend on chronology.cronoend = cronoend.id
    WHERE record.id = ".$this->id;
    return $this->simple($sql);
  }
  private function biblio(){
    $biblioList = [];
    $arr = $this->simple("select unnest(biblio) biblio from record where id = ".$this->id);
    foreach ($arr as $idx=>$biblio) {
      $sql = "select b.id, b.title, b.journal, b.volume, b.page, b.place, b.publisher, b.year, b.info, b.exhibition, b.url, b.downloadable, b.license, t.type, a.lastname||' '||a.firstname as author, b.secondauth from bibliography b inner join list.publicationtype t on b.type = t.id inner join author a on b.mainauth = a.id where b.id = ".$biblio['biblio']. "order by b.title asc";
      $biblioList[] = $this->simple($sql);

      $sql = "select a.lastname||' '||a.firstname as author from (select id, unnest(secondauth) idauth from bibliography) sa inner join author a on sa.idauth = a.id where sa.id = ".$biblio['biblio']." order by author asc;";
      $biblioList['secondauth'] = $this->simple($sql);
    }
    return $biblioList;
  }
  private function relPoiByTag(){}
  private function relPoiByLatLon(){}

}

?>
