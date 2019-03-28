<?php
require('sessionHandle.php');
require("class/index.class.php");
$el = new Index;
$stat = $el->statistic();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require('inc/metatag.php'); ?>
    <?php require('css/css.php'); ?>
    <style media="screen">
      .formWrap{min-height:75%;height:auto;}
      .recordDiv{overflow:hidden;}
      .alert small{display:block;}
      .fasBg:before{position: absolute; font-family: 'FontAwesome';opacity:0.1;}
      .alert:before{top: 0; right: 5px; font-size: 60px;}
      .recordDiv:before{content: "\f1c0";}
      .municipalityDiv:before{content: "\f0ac";}
      .typeDiv:before{content: "\f022";}
      .bookDiv:before{content: "\f02d";}
      .filterMsg{display: none;}
    </style>
  </head>
  <body>
    <?php require('inc/mainHeader.php'); ?>
    <?php require('inc/userNav.php'); ?>
    <div class="mainSection">
      <div class="container-fluid bg-white p-5">
        <div class="row">
          <div class="col-md-6 col-lg-3">
            <div class="alert alert-info fasBg recordDiv">
              <p class="h3"><strong><?php echo $stat['record'][0]['count']; ?></strong> <small class="border-top">records</small> </p>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="alert alert-info fasBg municipalityDiv">
              <p class="h3"><strong><?php echo $stat['municipality'][0]['count']; ?></strong> <small>municipalities</small> </p>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="alert alert-info fasBg typeDiv">
              <p class="h3"><strong><?php echo count($stat['type']); ?></strong> <small>categories</small> </p>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="alert alert-info fasBg bookDiv">
              <p class="h3"><strong><?php echo $stat['biblio'][0]['count']; ?></strong> <small>publications</small> </p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <p class="text-muted h3">Search records</p>
            <hr>
          </div>
        </div>
        <form class="form" name="filterForm" id="areaForm">
        <div class="row">
          <div class="col-xs-12 col-md-6 col-lg-3">
                <label class="d-block">search by area <i class="fas fa-question-circle tip" title="each choice is a filter for the other lists" data-placement="top"></i></label>
                <div class="form-group">
                  <select class="form-control" name="state">
                    <option value="" selected disabled>--state--</option>
                  </select>
                </div>
                <div class="form-group">
                  <select class="form-control" name="land">
                    <option value="" selected disabled>--district--</option>
                  </select>
                </div>
                <div class="form-group">
                  <select class="form-control shortSel" name="municipality">
                    <option value="" selected disabled>--municipality--</option>
                  </select>
                </div>
          </div>
          <div class="col-xs-12 col-md-6 col-lg-3">
              <label class="d-block">search by type</label>
              <div class="form-group">
                <select class="form-control shortSel" name="type" >
                  <option value="" selected disabled>--type--</option>
                </select>
              </div>
          </div>
          <div class="col-xs-12 col-md-6 col-lg-3">
              <label class="d-block">search by chronology</label>
              <div class="form-group">
                <select class="form-control" name="cronostart" >
                  <option value="" selected disabled>--period--</option>
                </select>
              </div>
          </div>
          <div class="col-xs-12 col-md-6 col-lg-3">
              <label class="d-block">search by keywords</label>
              <div class="form-group">
                <input type="text" class="form-control" name="keywords" value="" placeholder="type multiple words separated by space">
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="alert alert-danger text-center filterMsg">
              you must select a value from the available filters
            </div>
            <div class="form-group">
              <button type="submit" name="submit" class="btn btn-primary"> <i class="fas fa-search"></i> search</button>
            </div>
          </div>
        </div>
      </form>
      </div>
    </div>
    <?php require('inc/mainFooter.php'); ?>
    <?php require('lib/lib.php'); ?>
    <script src="js/index.js"></script>
  </body>
</html>
