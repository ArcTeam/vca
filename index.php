<?php
session_start();
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
      .alert:before{position: absolute; font-family: 'FontAwesome'; top: 0; right: 5px; opacity:0.1;font-size: 40px;}
      .recordDiv:before{content: "\f1c0";}
      .municipalityDiv:before{content: "\f0ac";}
      .typeDiv:before{content: "\f022";}
    </style>
  </head>
  <body>
    <?php require('inc/mainHeader.php'); ?>
    <?php require('inc/userNav.php'); ?>
    <div class="mainSection">
      <div class="container bg-white p-5">
        <div class="row">
          <div class="col-md-4">
            <div class="alert alert-info recordDiv">
              <p class="h3"><strong><?php echo $stat['record'][0]['count']; ?></strong> <small>records</small> </p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="alert alert-info municipalityDiv">
              <p class="h3"><strong><?php echo $stat['municipality'][0]['count']; ?></strong> <small>municipalities</small> </p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="alert alert-info typeDiv">
              <p class="h3"><strong><?php echo $stat['type'][0]['count']; ?></strong> <small>objects types</small> </p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <p class="text-muted h3">Search records</p>
            <p class="text-muted">You can use one or more filters</p>
            <hr>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-md-6 col-lg-4">
            <form class="form" action="catalogue.php" method="post" name="areaForm" id="areaForm">
                <label class="d-block">search by area</label>
                <small>each choice is a filter for the other lists</small>
                <div class="form-group">
                  <select class="form-control" name="state">
                    <option value="" selected disabled>state</option>
                  </select>
                </div>
                <div class="form-group">
                  <select class="form-control" name="land">
                    <option value="" selected disabled>district</option>
                  </select>
                </div>
                <div class="form-group">
                  <select class="form-control" name="municipality">
                    <option value="" selected disabled>municipality</option>
                  </select>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="toponym" value="" placeholder="toponym">
                </div>
                <div class="form-group">
                  <button type="submit" name="submit" class="btn btn-primary form-control"> <i class="fas fa-search"></i> search</button>
                </div>
            </form>
          </div>
          <div class="col-xs-12 col-md-6 col-lg-4">
            <form class="form" action="catalogue.php" method="post" name="typeForm" id="typeForm">
              <label class="d-block">search by type</label>
              <div class="form-group">
                <select class="form-control" name="type">
                  <option value="" selected disabled>type</option>
                </select>
              </div>
              <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary form-control"> <i class="fas fa-search"></i> search</button>
              </div>
            </form>
          </div>
          <div class="col-xs-12 col-md-6 col-lg-4">
            <form class="form" action="catalogue.php" method="post" name="authorForm" id="authorForm">
              <label class="d-block">search by author</label>
              <div class="form-group">
                <select class="form-control" name="author" disabled>
                  <option value="" selected disabled>type</option>
                </select>
              </div>
              <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary form-control disabled"> <i class="fas fa-search"></i> search</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php require('inc/mainFooter.php'); ?>
    <?php require('lib/lib.php'); ?>
    <script type="text/javascript">

    </script>
  </body>
</html>
