<?php
require ("db.class.php");
class Index extends Db{
    function __construct(){}
    public function statistic(){
      $out = array();
      $out['record'] = $this->simple("select count(*) from record;");
      $out['type'] = $this->simple("select distinct type from record;");
      $out['municipality'] = $this->simple("select count(*) from localization where municipality is not null;");
      $out['biblio'] = $this->simple("select count(*) from biblio;");
      return $out;
    }

}

?>
