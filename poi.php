<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require('inc/metatag.php'); ?>
    <?php require('css/css.php'); ?>
  </head>
  <body data-poi="<?php echo $_GET['poi'] ?>">
    <?php require('inc/mainHeader.php'); ?>
    <?php require('inc/userNav.php'); ?>
    <div class="mainSection">
      <div class="container-fluid bg-white">
        <div class="row">
          <div class="col">
            <div class="bg-white p-3 rounded">
              <h4 class="border-bottom text-center namePoi"></h4>
            </div>
          </div>
        </div>
        <div class="row">
            <div class="col-md-6">
              <div id="mapPoi" style="width:100%; height:400px;"></div>
            </div>
            <div class="col-md-6">
              <div class="poiInfo">
                <p class="h5 bg-success text-white rounded p-2">POI info
                  <span class="float-right"><i class="fas fa-file-contract"></i></span>
                </p>
                <table class="table table-sm table-striped poiInfo">
                  <tbody>
                    <tr><td width="150px">Localization: </td>   <td class="position"></td></tr>
                    <tr><td>Toponym: </td>        <td class="toponym"></td></tr>
                    <tr><td>Address: </td>        <td class="address"></td></tr>
                    <tr><td>GPS: </td>            <td class="gps"></td></tr>
                    <tr><td>Category: </td>       <td class="category"></td></tr>
                    <tr><td>Chronology: </td>     <td class="chronology"></td></tr>
                    <tr><td>Chronology note: </td><td class="period"></td></tr>
                    <tr><td>Description: </td>    <td class="info"></td></tr>
                  </tbody>
                </table>
              </div>
              <div class="poiInfo">
                <p class="bg-info text-white rounded p-2">Bibliography
                  <span class="float-right"><i class="fas fa-bookmark"></i></span>
                </p>
              </div>
              <div class="poiTag mb-5">
                <p class="border-bottom">Tag
                  <span class="float-right"><i class="fas fa-hashtag"></i></span>
                </p>
              </div>
            </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="relRecByLatLon">
              <p class="border-bottom">Related poi by position
                <span class="float-right"><i class="fas fa-map-marker-alt"></i></span>
              </p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="relRecByTag">
              <p class="border-bottom">Related poi by tag
                <span class="float-right"><i class="fas fa-tag"></i></span>
              </p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col text-right font-italic">
            <small>Created by: <span class="compiler"></span></small>
          </div>
        </div>
      </div>
    </div>
    <?php require('inc/mainFooter.php'); ?>
    <?php require('lib/lib.php'); ?>
    <script src="js/poi.js" charset="utf-8"></script>
  </body>
</html>
