<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require('inc/metatag.php'); ?>
    <?php require('css/css.php'); ?>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
  </head>
  <body>
    <?php require('inc/mainHeader.php'); ?>
    <?php require('inc/userNav.php'); ?>
    <div class="mainSection">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
              <div class="card">
                <div class="card-header">
                  <div class="card-title">
                    <h5>Check new records <span class="badge badge-info float-right">4</span></h5>
                  </div>
                </div>
                <div class="card-body">
                </div>
              </div>
              <div class="card mt-3">
                <div class="card-header">
                  <div class="card-title">
                    <h5>Last approved records <span class="badge badge-info float-right">4</span></h5>
                  </div>
                </div>
                <div class="card-body">
                </div>
              </div>
          </div>
          <div class="col-md-4">
              <div class="card mt-3 mt-md-0">
                <div class="card-header">
                  <div class="card-title">
                    <h5>New  account request <span class="badge badge-info float-right">4</span></h5>
                  </div>
                </div>
                <div class="card-body">
                </div>
              </div>
              <div class="card mt-3">
                <div class="card-header">
                  <div class="card-title">
                    <h5>User activities <span class="badge badge-info float-right">4</span></h5>
                  </div>
                </div>
                <div class="card-body">
                </div>
              </div>
          </div>
          <div class="col-md-4">
              <div class="card mt-3 mt-md-0">
                <div class="card-header">
                  <div class="card-title">
                    <h5>Notepad <span class="badge badge-info float-right">4</span></h5>
                  </div>
                </div>
                <div class="card-body">
                </div>
              </div>
              <div class="card mt-3">
                <div class="card-header">
                  <div class="card-title">
                    <h5>Address book <span class="badge badge-info float-right">4</span></h5>
                  </div>
                </div>
                <div class="card-body">
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
    <?php require('inc/mainFooter.php'); ?>
    <?php require('lib/lib.php'); ?>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
    <script src="js/dashboard.js"></script>
  </body>
</html>
