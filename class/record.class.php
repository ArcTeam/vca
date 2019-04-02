<?php
require ("global.class.php");
class Record extends Generic{
  private $id;
  private $step = 50;
  private $newRecord=0;
  private $record=[];
  private $localization=[];
  private $chronology=[];

  function __construct(){}

  public function poiInfo($id){
    $this->id = $id;
    $out['info'] = $this->info();
    $out['biblio'] = $this->biblio();
    $out['relPoiTag'] = $this->relPoiByTag();
    $out['relPoiCoo'] = $this->relPoiByLatLon($out['info'][0]['lat'],$out['info'][0]['lon']);
    return $out;
  }

  public function addPoi($dati = array()){
    $this->setRecordVal($dati);
    try {
      $this->begin();
      $this->goInsert('record',$this->record);
      $this->newRecord = $this->pdo()->lastInsertId('workrecord_id_seq');
      if ($this->record['draft']==='f') {
        $this->goInsert('validation',array("record"=>$this->newRecord));
      }
      $this->setLocalizationVal($dati);
      $this->setCronoVal($dati);
      $this->goInsert('localization',$this->localization);
      $this->goInsert('chronology',$this->chronology);
      if ($_SESSION['class']==2) {
        $this->checkUsrLevel();
      }
      $this->commitTransaction();
      return array("err"=>0,"newrec"=>$this->newRecord);
    } catch (Exception $e) {
      $this->rollBack();
      return array("err"=>1,"msg"=>$e->getMessage());
    } catch (PDOException $e) {
      $this->rollBack();
      return array("err"=>1,"msg"=>$e->getMessage());
    }

  }

  private function setRecordVal($dati = array()){
    $this->record['name']=trim($dati['name']);
    $this->record['type']=$dati['type'];
    $this->record['info']=trim($dati['info']);
    $this->record['tags']='{'.$dati['tag'].'}';
    if(isset($dati['related'])){$this->record['cf']='{'.implode(',',$dati['related']).'}';}
    $this->record['biblio']='{'.implode(',',$dati['biblio']).'}';
    $this->record['compiler'] = $_SESSION['id'];
    if(isset($dati['draft'])){$this->record['draft']=$dati['draft'];}
  }

  private function setLocalizationVal($dati = array()){
    $this->localization['record']=$this->newRecord;
    $this->localization['state']=$dati['state'];
    if(isset($dati['land'])){ $this->localization['land'] = $dati['land']; }
    if(isset($dati['municipality'])){ $this->localization['municipality'] = $dati['municipality']; }
    if(isset($dati['toponym'])){ $this->localization['toponym'] = trim($dati['toponym']); }
    if(isset($_POST['address'])){ $this->localization['address'] = trim($dati['address']); }
    $this->localization['lon']=trim($dati['lon']);
    $this->localization['lat']=trim($dati['lat']);
    $this->localization['geom'] = 'st_setSRID(st_MakePoint('.$dati['lon'].','.$dati['lat'].'),4326)';
  }

  private function setCronoVal($dati = array()){
    $this->chronology['record'] = $this->newRecord;
    $this->chronology['cronostart']=$dati['cronostart'];
    if(isset($dati['cronoend'])){ $this->chronology['cronoend'] = $dati['cronoend']; }
    if(isset($dati['period'])){ $this->chronology['period'] = trim($dati['period']); }
  }

  private function goInsert($tab,$dataset){
    $campi = [];
    foreach ($dataset as $key => $value) { $campi[] = ":".$key; }
    $sql = "insert into ".$tab."(".str_replace(":","",implode(",",$campi)).") values(".implode(",",$campi).");";
    $insert = $this->prepared('',$sql,$dataset);
    if (!$insert){
      throw new Exception("Errore durante l'inserimento del record", 1);
    }
  }

  private function checkUsrLevel(){
    $up = 0;
    $compilerRecord = $this->countRow("select id from record where compiler =".$_SESSION['id'].";");
    $compilerLevel = $this->simple("select level from usr where id = ".$_SESSION['id'].";");
    $level = $compilerLevel[0]['level'];
    if ($level <= 10) {
      switch (true) {
        case (($level = 5) && ($compilerRecord >= 50 && $compilerRecord < 100)) : $up = 6; break;
        case (($level = 6) && ($compilerRecord >= 100 && $compilerRecord < 150)) : $up = 7; break;
        case (($level = 7) && ($compilerRecord >= 150 && $compilerRecord < 200)) : $up = 8; break;
        case (($level = 8) && ($compilerRecord >= 200 && $compilerRecord < 250)) : $up = 9; break;
        case (($level = 9) && ($compilerRecord >= 250 && $compilerRecord <= 300)) : $up = 10; break;
      }
    }
    if ($up > 0) {
      $upSql = "update usr set level = :level where id = :id;";
      $upLevel = $this->prepared('', $upSql, array("level"=>$up,"id"=>$_SESSION['id']));
      if(!$upLevel){
        throw new Exception("Errore nella promozione del compilatore", 1);
      }
    }
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
    left join list.userlevel on usr.level = userlevel.id
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
