<?php
session_start();
require("class/global.class.php");
$el = new Generic;
$dati=array();
if (isset($_POST['submit'])) {
  unset($_POST['submit']);
  foreach ($_POST as $key => $value) { $dati[$key]=$value; }
}
$list = $el->recordList($dati);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require('inc/metatag.php'); ?>
    <?php require('css/css.php'); ?>
    <style media="screen">

    </style>
  </head>
  <body>
    <?php require('inc/mainHeader.php'); ?>
    <?php require('inc/userNav.php'); ?>
    <div class="mainSection">
      <div class="container-fluid my-2">
        <div class="row">
          <div class="col">
            <table class="table table-sm bg-white" id="recordTable">
              <thead class="">
                <tr>
                  <th class="all">state</th>
                  <th class="desktop">district</th>
                  <th class="min-tablet">municipality</th>
                  <th class="all">type</th>
                  <th class="all">chrono start</th>
                  <th class="min-tablet">chrono end</th>
                  <th class="all"></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($list as $key => $v) {
                  echo "<tr>";
                  echo "<td>".$v['statename']."</td>";
                  echo "<td>".$v['landname']."</td>";
                  echo "<td>".$v['municipalityname']."</td>";
                  echo "<td>".$v['typedef']."</td>";
                  echo "<td>".$v['cronostartdef']."</td>";
                  echo "<td>".$v['cronoenddef']."</td>";
                  echo "<td><a href='#' class='tip' data-placement='left' title='view complete data'><i class='fas fa-angle-double-right'></i></a></td>";
                  echo "</tr>";
                } ?>
              </tbody>
              <tfoot class="hide-if-no-paging"></tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
    <?php require('inc/mainFooter.php'); ?>
    <?php require('lib/lib.php'); ?>
    <script type="text/javascript">
    disorder=[6];
    initTable(disorder);
    </script>
  </body>
</html>
