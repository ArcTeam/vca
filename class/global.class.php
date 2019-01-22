<?php
require ("db.class.php");
class Generic extends Db{
    function __construct(){}
    public function areaList(){
      $out = array();
      $out['state'] = $this->stateList();
      $out['land'] = $this->landList();
      $out['municipality'] = $this->municipalityList();
      return $out;
    }
    public function stateList(){
      return $this->simple('select distinct a.state, b.name from localization a, geodati.state b where a.state = b.id order by 2 asc;');
    }
    public function landList($state=null){
      $filter = !$state['state'] ? '' : 'and b.state = '.$state['state'];
      return $this->simple('select distinct a.land, b.name from geodati.land b, localization a where a.land = b.id '.$filter.' order by 2 asc;');
    }
    public function municipalityList($state=null,$land=null){
      $filter = '';
      if ($state != null) { $filter .= ' and gs.id = '.$state; }
      if ($land != null) { $filter .= ' and gl.id = '.$land; }
      return $this->simple('select distinct l.municipality, gm.name from geodati.land gl, localization l, geodati.state gs, geodati.municipality gm where gl.state = gs.id and l.municipality = gm.id and gm.land = gl.id '.$filter.' order by 2 asc;');
    }
    public function typeList(){
      return $this->simple('select distinct r.type id, t.type from record r, list.type t where r.type = t.id order by 2 asc;');
    }
    public function cronoList(){
      return $this->simple('select distinct r.chronostart id, c.period from record r, list.chronology c where r.chronostart = c.id order by 1 asc;');
    }
    public function recordList($dati=array()){
      $sql='';
      if (empty(array_filter($dati))) {
        $sql = "select id, statename, landname, municipalityname, typedef, cronostartdef, cronoenddef from catalogue order by 2,3,4,5,6,7 asc;";
      }else {
        $sql = "select id, statename, landname, municipalityname, typedef, cronostartdef, cronoenddef from catalogue where ";
        $where = array();
        if (isset($dati['keywords'])) {
          $keywords=$dati['keywords'];
          $ilike = "(find ilike '%".$keywords."%' or building ilike '%".$keywords."%' or reconstruction ilike '%".$keywords."%' or info ilike '%".$keywords."%')";
          unset($dati['keywords']);
          if (count($dati)>1) {
            $ilike .= " and ";
          }
        }
        foreach ($dati as $key => $val) {

          $where[]= $key." = ".$val;
        }
        $filter = implode(' and ', $where);
        $sql .= $ilike;
        $sql .= $filter;
        $sql .=" order by 2,3,4,5,6,7 asc;";
      }
      return $this->simple($sql);
      // return $sql;
    }

}

?>
