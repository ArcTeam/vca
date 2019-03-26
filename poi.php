<?php
session_start();
require("class/record.class.php");
$poi = new Record;
$poiInfo = $poi->poiInfo($_GET['poi']);

$info = $poiInfo['info'][0];
$position=array($info['state'],$info['land'],$info['municipality']);
$chrono = "from ".$info['cronostart'];
$chrono .= $info['cronoend'] ? " to ".$info['cronoend'] : "";
$compiler = $info['first_name']." ".$info['last_name']." (".$info['data'].")";

$biblio = $poiInfo['biblio'];
$listBiblio='';
foreach ($biblio as $value) {
  foreach ($value as $book) {
    $listBiblio .= "<li class='list-group-item'>";
    $listBiblio .= "<div class='d-inline-block align-top' style='width:30px;'>";
    $listBiblio .= "<a href='#".$book['id']."' class='text-info pr-1' title='view full record'>";
    $listBiblio .= "<i class='fas fa-link fa-fw'></i>";
    $listBiblio .= "</a>";
    $listBiblio .= "</div>";
    $listBiblio .= "<div class='d-inline-block' style='width:calc(100% - 30px);'>";
    $listBiblio .= "<strong>".$book['title']."</strong>";
    $listBiblio .= ", ".$book['main'];
    $listBiblio .= ", ".$book['year'];
    $listBiblio .= ", ".$book['type'];
    $listBiblio .= "</div>";
  }
}

$tags = $poiInfo['relPoiTag'];
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require('inc/metatag.php'); ?>
    <?php require('css/css.php'); ?>
    <style media="screen">
    .listBiblio > li:nth-of-type(odd) { background-color: rgba(0,0,0,.05);}
    </style>
  </head>
  <body>
    <?php require('inc/mainHeader.php'); ?>
    <?php require('inc/userNav.php'); ?>
    <div class="mainSection">
      <div class="container rounded bg-white">
        <div class="row">
          <div class="col">
            <div class="bg-white p-3 rounded">
              <h4 class="border-bottom text-center namePoi"><?php echo $info['name']; ?></h4>
            </div>
          </div>
        </div>
        <div class="row">
            <div class="col-md-6">
              <input type="hidden" name="lat" value="<?php echo $info['lat']; ?>">
              <input type="hidden" name="lon" value="<?php echo $info['lon']; ?>">
              <div id="mapPoi" style="width:100%; height:400px;"></div>
              <div class="poiTag mb-2">
                <p class="border-bottom">Tag
                  <span class="float-right"><i class="fas fa-hashtag"></i></span>
                </p>
                <?php foreach (json_decode($info['tag']) as $tag) {
                  echo "<a href='#".$tag."' title='search POI by tag' class='btn btn-outline-info btn-sm py-1 px-2 mr-1 mb-1 d-inline-block' style='font-size:80%;'>".$tag."</a>";
                }
                ?>
              </div>
              <div class="relRecByTag">
                <p class="border-bottom">Related records
                  <span class="float-right"><i class="fas fa-tag"></i></span>
                </p>
                <?php
                foreach ($tags as $tag) {
                  echo "<a href='poi.php?poi=".$tag['id']."' title='link to POI page' class='btn btn-outline-secondary btn-sm py-1 px-2 mr-1 mb-1 d-inline-block' style='font-size:80%;'>".$tag['name']."</a>";
                }
                ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="poiInfo">
                <p class="h5 bg-success text-white rounded p-2">POI info
                  <span class="float-right"><i class="fas fa-file-contract"></i></span>
                </p>
                <table class="table table-sm table-striped poiInfo">
                  <tbody>
                    <tr>
                      <td width="150px">Localization: </td>
                      <td class="position"><?php echo implode(', ',$position); ?></td>
                    </tr>
                    <tr>
                      <td>Toponym: </td>
                      <td class="toponym"><?php echo $info['toponym']; ?></td>
                    </tr>
                    <tr>
                      <td>Address: </td>
                      <td class="address"><?php echo $info['address']; ?></td>
                    </tr>
                    <tr>
                      <td>GPS: </td>
                      <td class="gps"><?php echo $info['lat'].",".$info['lon']." (EPSG:4326)"; ?></td>
                    </tr>
                    <tr>
                      <td>Category: </td>
                      <td class="category"><?php echo $info['type']; ?></td>
                    </tr>
                    <tr>
                      <td>Chronology: </td>
                      <td class="chronology"><?php echo $chrono; ?></td>
                    </tr>
                    <tr>
                      <td>Chronology note: </td>
                      <td class="period"><?php echo $info['period']; ?></td>
                    </tr>
                    <tr>
                      <td>Description: </td>
                      <td class="info"><?php echo nl2br($info['info']); ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="poiInfo">
                <p class="bg-info text-white rounded p-2">Bibliography
                  <span class="float-right"><i class="fas fa-bookmark"></i></span>
                  <ul class="list-group list-group-flush listBiblio" style="font-size:80%;">
                    <?php echo $listBiblio; ?>
                  </ul>
                </p>
              </div>
            </div>
        </div>
        <div class="row">
          <div class="col text-right font-italic">
            <small>Created by: <span class="compiler"><?php echo $compiler; ?></span></small>
          </div>
        </div>
      </div>
    </div>
    <?php require('inc/mainFooter.php'); ?>
    <?php require('lib/lib.php'); ?>
    <script src="js/poi.js" charset="utf-8"></script>
  </body>
</html>
