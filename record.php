<?php
session_start();
require("class/record.class.php");
$view = new Record(3);
$info = $view->info();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require('inc/metatag.php'); ?>
    <?php require('css/css.php'); ?>
    <style media="screen">
    .tableInfo>tbody>tr>td:nth-child(1){font-weight: bold;}
    </style>
  </head>
  <body>
    <?php require('inc/mainHeader.php'); ?>
    <?php require('inc/userNav.php'); ?>
    <div class="mainSection">
      <div class="container bg-white p-5">
        <div class="row">
          <div class="col">
            <div class="bg-info text-white text-center rounded px-5 py-2 mb-3">
              <p class="h3">
              <?php
              foreach ($info as $k => $v) {
                echo $v['state'];
                if ($v['land']) { echo " - ".$v['land']; }
                if ($v['municipality']) { echo " - ".$v['municipality']; }
                if ($v['gps']) { echo "<small class='d-block'>(".$v['gps'].")"; }else{echo "<small class='d-block'>(no coordinates)";}
              }
              ?>
              </p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-md-4 col-lg-6 d-print-none">
            <div class="map border text-center h-75"> <p class="h1 mt-5">map view</p> </div>
            <div class="tagDiv mt-3">
              <?php
              foreach ($info as $k => $v) {
                $tags = explode(",",$v['tag']);
                foreach ($tags as $tag) {
                  echo "<span class='bg-primary text-white rounded text-center mr-2 px-2 py-1'>".$tag."</span>";
                }
              }
              ?>
            </div>
          </div>
          <div class="col-xs-12 col-md-8 col-lg-6 tableInfoWrap">
            <table class="table table-condensed tableInfo">
              <tbody>
                <tr><td colspan="2" class="bg-success text-white"><p class='h5'>Record information</p></td></tr>
                <?php
                foreach ($info as $k => $v) {
                  echo "<tr><td>Toponym:</td><td>".$v['toponym']."</td></tr>";
                  echo "<tr><td>Address:</td><td>".$v['address']."</td></tr>";
                  echo "<tr><td>Type:</td><td>".$v['type']."</td></tr>";
                  echo "<tr><td>Type info:</td><td>".$v['type_spec']."</td></tr>";
                  echo "<tr><td>Start chrono:</td><td>".$v['start']."</td></tr>";
                  echo "<tr><td>End chrono:</td><td>".$v['end']."</td></tr>";
                  echo "<tr><td>Chrono info:</td><td>".$v['chronospec']."</td></tr>";
                  echo "<tr><td>Finds:</td><td>".nl2br(trim($v['find']))."</td></tr>";
                  echo "<tr><td>Building:</td><td>".nl2br(trim($v['building']))."</td></tr>";
                  echo "<tr><td>Reconstruction:</td><td>".nl2br(trim($v['reconstruction']))."</td></tr>";
                  echo "<tr><td>Info:</td><td>".nl2br(trim($v['info']))."</td></tr>";
                  echo "<tr><td>Period:</td><td>".nl2br(trim($v['period2']))."</td></tr>";
                }
                ?>
                <tr><td colspan="2" class="bg-success text-white"><p class='h5'>Bibliography</p></td></tr>
                <?php
                foreach ($info as $k => $v) {
                  echo "<tr><td>Title:</td><td>".nl2br(trim($v['title']))."</td></tr>";
                  echo "<tr><td>Author:</td><td>".nl2br(trim($v['author']))."</td></tr>";
                  echo "<tr><td>Year:</td><td>".nl2br(trim($v['year']))."</td></tr>";
                  echo "<tr><td>Place:</td><td>".nl2br(trim($v['place']))."</td></tr>";
                  echo "<tr><td>Info:</td><td>".nl2br(trim($v['info_biblio']))."</td></tr>";
                  echo "<tr><td>Reading:</td><td>".nl2br(trim($v['reading']))."</td></tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <?php require('inc/mainFooter.php'); ?>
    <?php require('lib/lib.php'); ?>
    <script type="text/javascript">
      $(document).ready(function() {

      });
    </script>
  </body>
</html>
