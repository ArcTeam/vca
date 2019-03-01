<?php
session_start();
require("class/global.class.php");
$el = new Generic;
$dati=array();
if (isset($_POST['submit'])) {
  unset($_POST['submit']);
  $filter = array_filter($_POST);
  foreach ($filter as $key => $value) { $dati[$key]=$value; }
}
$list = $el->recordList($dati);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require('inc/metatag.php'); ?>
    <?php require('css/css.php'); ?>
    <style media="screen">
      /* #recordTable>thead>tr{display:block;}
      #recordTable>tbody{display:block; overflow:auto; height:600px; width:100%;} */
    </style>
  </head>
  <body>
    <?php require('inc/mainHeader.php'); ?>
    <?php require('inc/userNav.php'); ?>
    <div class="mainSection">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-8">
            <div id="map" style="width:100%; height:700px;"></div>
        </div>
        <div class="col-md-4">
          <table class="table table-sm bg-white" id="recordTable">
            <thead>
              <tr>
                <th class="all" width="50px">state</th>
                <th class="none">district</th>
                <th class="none">municipality</th>
                <th class="all" width="150px">name</th>
                <th class="all" width="40px">type</th>
                <th class="none">start</th>
                <th class="none">end</th>
                <th class="all" width="20px"></th>
                <th class="all" width="20px"></th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>
    <?php require('inc/mainFooter.php'); ?>
    <?php require('lib/lib.php'); ?>
    <script src="js/map.js" charset="utf-8"></script>
    <script type="text/javascript">
    initmap()
    </script>
  </body>
</html>
