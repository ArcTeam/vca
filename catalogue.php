<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require('inc/metatag.php'); ?>
    <?php require('css/css.php'); ?>
    <style media="screen">
    .wrapInfo{position:absolute;top:5px;right:5px;width:250px;z-index: 2000}
    .wrapInfo > div{ width: 100%; margin-bottom:5px; display:none;}
    #recordTable_filter label,#recordTable_filter input{width:100% !important;}
    </style>
  </head>
  <body>
    <?php require('inc/mainHeader.php'); ?>
    <?php require('inc/userNav.php'); ?>
    <div class="mainSection">
      <div class="container-fluid">
        <div class="row bg-white py-1 mb-2">
          <div class="col-6 col-lg-2 mb-2">
            <select class="form-control form-control-sm" name="state">
              <option value="" disabled selected>--state--</option>
            </select>
          </div>
          <div class="col-6 col-lg-2 mb-2">
            <select class="form-control form-control-sm" name="land">
              <option value="" disabled selected>--land--</option>
            </select>
          </div>
          <div class="col-6 col-lg-2 mb-2">
            <select class="form-control form-control-sm" name="municipality">
              <option value="" disabled selected>--municipality--</option>
            </select>
          </div>
          <div class="col-6 col-lg-2 mb-2">
            <select class="form-control form-control-sm" name="cronostart">
              <option value="" disabled selected>--chronology--</option>
            </select>
          </div>
          <div class="col-6 col-lg-2 mb-2">
            <select class="form-control form-control-sm" name="type">
              <option value="" disabled selected>--type--</option>
            </select>
          </div>
          <div class="col-6 col-lg-2 mb-2">
            <input type="text" class="form-control form-control-sm" name="keywords" value="" placeholder="--keywords--">
          </div>
        </div>
        <div class="row filterRow">
          <div class="col">
            <div class="bg-white py-1 px-3 mb-3 rounded">
              <div class="d-inline-block">record filtered by: </div>
              <div class="d-inline-block filterWrap"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6">
            <div id="map" class="map">
              <div class="wrapInfo">
                <div class="card">
                  <button type="button" class="btn btn-light bg-white btn-sm float-right pt-1 cardCloseBtn" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <div class="card-body pt-1"></div>
                </div>
                <div class="alert alert-danger fade show" role="alert">
                  <strong>Same location!</strong>
                  <button type="button" class="close alert-close alertCloseBtn" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
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
    </div>
    <?php require('inc/mainFooter.php'); ?>
    <?php require('lib/lib.php'); ?>
    <script src="js/map.js" charset="utf-8"></script>
  </body>
</html>
