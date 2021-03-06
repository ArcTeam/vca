<?php
session_start();
require ("global.class.php");
class Biblio extends Generic{
  private $newRecord=0;
  public $record=[];

  function __construct(){}

  public function itemAdd($dati = array()){
    $this->setRecordVal($dati);
    try {
      $this->begin();
      $this->goInsert('biblio',$this->record);
      $this->newRecord = $this->pdo()->lastInsertId('biblio_id_seq');
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

  public function itemUpdate($dati=array()){
    $this->setUpdateVal($dati);
    try {
      $this->begin();
      $this->goUpdate();
      $this->commitTransaction();
      return array("err"=>0,"newrec"=>$dati['id']);
    } catch (\Exception $e) {
      $this->rollBack();
      return array("err"=>1,"msg"=>$e->getMessage());
    }

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

  private function goUpdate(){
    $campi = [];
    foreach ($this->record as $key => $value) { $campi[] = $key."=:".$key; }
    $sql = "update biblio set ".implode(",",$campi)." where id=:id;";
    $update = $this->prepared('',$sql,$this->record);
    if (!$update){
      throw new Exception("Errore durante l'aggiornamento del record", 1);
    }
  }

  public function itemDel($id){
    $sql = "delete from biblio where id = :id;";
    $del = $this->prepared('',$sql, array("id"=>$id));
    if ($del) { return "ok"; }else {  return "error"; }
  }

  public function bibliography($id=null){
    //if $id is null get list
    $filter = $id !== null ? 'where id = '.$id : ' ';
    $item = $this->simple("select * from bibliography ".$filter." order by title, main, year asc;");
    if ($id !== null) {
      $item['readingList'] = $this->getReading($id);
    }
    return $item;
  }

  private function getReading($id){
    $sql = "select b.id,b.main, b.title, b.year from (select unnest(reading) idrel from biblio where id = ".$id.") rel left join biblio b on rel.idrel = b.id order by title asc;";
    return $this->simple($sql);
  }

  private function setRecordVal($dati = array()){
    $dati = array_filter($dati);
    $this->record['main']=trim($dati['main']);
    $this->record['title']=trim($dati['title']);
    $this->record['type']=$dati['type'];
    $this->record['year']=$dati['year'];
    $this->record['downloadable']=$dati['downloadable'];
    $this->record['compiler'] = $_SESSION['id'];
    if(isset($dati['secondary'])){$this->record['secondary']=trim($dati['secondary']);}
    if(isset($dati['journal'])){$this->record['journal']=trim($dati['journal']);}
    if(isset($dati['volume'])){$this->record['volume']=trim($dati['volume']);}
    if(isset($dati['page'])){$this->record['page']=trim($dati['page']);}
    if(isset($dati['place'])){$this->record['place']=trim($dati['place']);}
    if(isset($dati['publisher'])){$this->record['publisher']=trim($dati['publisher']);}
    if(isset($dati['info'])){$this->record['info']=trim($dati['info']);}
    if(isset($dati['exhibition'])){$this->record['exhibition']=trim($dati['exhibition']);}
    if(isset($dati['url'])){$this->record['url']=trim($dati['url']);}
    if(isset($dati['license'])){$this->record['license']=trim($dati['license']);}
    if(isset($dati['reading'])){$this->record['reading']='{'.implode(',',$dati['reading']).'}';}
  }
  private function setUpdateVal($dati = array()){
    $this->record['id'] = $dati['id'];
    $this->record['main']=trim($dati['main']);
    $this->record['title']=trim($dati['title']);
    $this->record['type']=$dati['type'];
    $this->record['year']=$dati['year'];
    $this->record['downloadable']=$dati['downloadable'];
    $this->record['compiler'] = $_SESSION['id'];
    $this->record['secondary']=trim($dati['secondary']);
    if ($dati['type']==1) {
      $this->record['journal']='';
      $this->record['volume']='';
      $this->record['page']='';
    }else {
      $this->record['journal']=trim($dati['journal']);
      $this->record['volume']=trim($dati['volume']);
      $this->record['page']=trim($dati['page']);
    }
    $this->record['place']=trim($dati['place']);
    $this->record['publisher']=trim($dati['publisher']);
    $this->record['info']=trim($dati['info']);
    $this->record['exhibition']=trim($dati['exhibition']);
    if ($dati['downloadable']==false) {
      $this->record['url']='';
      $this->record['license']='';
    }else {
      $this->record['url']=trim($dati['url']);
      $this->record['license']=trim($dati['license']);
    }
    $this->record['reading']='{'.implode(',',$dati['reading']).'}';
  }
}

?>
