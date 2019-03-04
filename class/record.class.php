<?php
require ("global.class.php");
class Record extends Generic{
  private $id;
  function __construct(){}
  public function poiInfo($id){
    $this->id = $id;
    $out=[];
  }
  private function biblio(){}
  private function relPoiByTag(){}
  private function relPoiByLatLon(){}

}

?>
