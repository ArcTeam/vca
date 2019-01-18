<?php
require ("db.class.php");
class Index extends Db{
    function __construct(){}
    public function statistic(){
      $out = array();
      $out['record'] = $this->simple("select count(*) from record;");
      $out['type'] = $this->simple("select count(*) from record where type is not null;");
      $out['municipality'] = $this->simple("select count(*) from localization where municipality is not null;");
      return $out;
    }

}

?>
