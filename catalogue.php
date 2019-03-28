<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require('inc/metatag.php'); ?>
    <?php require('css/css.php'); ?>
    <style media="screen">
    .wrapInfo{position:absolute;top:10px;right:5px;width:250px;z-index: 2003}
    .filterWrap{position:absolute;top:10px;left:50px;padding:10px; background:#fff;z-index: 2004}
    .wrapInfo > div{ width: 100%; margin-bottom:5px; display:none;}
    #recordTable_filter label,#recordTable_filter input{width:100% !important;}
    #noPoi{position:absolute;z-index:2002;display:none}
    </style>
  </head>
  <body>
    <?php require('inc/mainHeader.php'); ?>
    <?php require('inc/userNav.php'); ?>
    <div class="mainSection">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-8">
            <div id="map" class="map">
              <div id='loader' class="flex-center w-100 h-100"><i class="fas fa-spinner fa-spin fa-7x"></i></div>
              <div class="text-center flex-center w-100 h-100" id="noPoi">
                <div class="alert alert-danger w-75 h-auto">
                  <h3>No record available!</h3>
                  <h6>Reset or change search filter</h6>
                </div>
              </div>
              <div class="filterWrap bg-withe rounded">filter by: <div class="d-inline-block w-auto"></div></div>
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
          <div class="col-lg-4">
            <div class="filter-input">
              <form class="form" name="filterForm" id="areaForm">
                <select class="form-control form-control-sm mb-1" name="state">
                  <option value="" selected disabled>--search state--</option>
                </select>
                <select class="form-control form-control-sm mb-1" name="land">
                  <option value="" selected disabled>--search land--</option>
                </select>
                <select class="form-control form-control-sm mb-1" name="municipality">
                  <option value="" selected disabled>--search municipality--</option>
                </select>
                <select class="form-control form-control-sm mb-1" name="type">
                  <option value="" selected disabled>--search type--</option>
                </select>
                <select class="form-control form-control-sm mb-1" name="cronostart">
                  <option value="" selected disabled>--search start chronology--</option>
                </select>
                <input type="text" class="form-control form-control-sm mb-1" name="keywords" value="" placeholder="type multiple words separated by space">
                <button type="button" class="btn btn-sm btn-danger mb-1 filterMsg disabled" name="button">you must select a value from the available filters</button>
                <div class="btn-group mb-1" role="group">
                  <button type="submit" name="submit" class="btn btn-sm btn-primary"> <i class="fas fa-search"></i> search</button>
                  <button type="button" name="reset" class="btn btn-sm btn-warning"> <i class="fas fa-trash-alt"></i> reset filter</button>
                </div>
              </form>
            </div>
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
