<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require('inc/metatag.php'); ?>
    <?php require('css/css.php'); ?>
  </head>
  <body>
    <?php require('inc/mainHeader.php'); ?>
    <?php require('inc/userNav.php'); ?>
    <div class="mainSection">
      <div class="container-fluid">
        <div class="row">
          <div class="col">
            <div class="alert alert-success text-center">
              <h4>Would you like collaborate with us?</h4>
              <a href="register.php" class="btn btn-primary">get a member</a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <h4>last added documents</h4>
              </div>
              <div class="card-body">

              </div>
              <div class="card-footer">
                <a href="#" class="btn btn-outline-secondary float-right topTip" title="view all documents">archive <i class="fas fa-angle-double-right"></i></a>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <h4>news</h4>
              </div>
              <div class="card-body">

              </div>
              <div class="card-footer">
                <a href="#" class="btn btn-outline-secondary float-right topTip" title="view all news">archive <i class="fas fa-angle-double-right"></i></a>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <h4>events</h4>
              </div>
              <div class="card-body">

              </div>
              <div class="card-footer">
                <a href="#" class="btn btn-outline-secondary float-right topTip" title="view all events">archive <i class="fas fa-angle-double-right"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col">
            <div class="bg-white p-5 shadow">
              <h3 class="border-bottom text-muted pb-3 mb-3">Goal of project</h3>
            </div>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col">
            <div class="bg-white p-5 shadow">
              <h3 class="border-bottom text-muted text-right pb-3 mb-3">Project partner</h3>
            </div>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col">
            <div class="bg-white p-5 shadow">
              <h3 class="border-bottom text-muted pb-3 mb-3">Something else to insert</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php require('inc/mainFooter.php'); ?>
    <?php require('lib/lib.php'); ?>
    <script type="text/javascript">
      removeLib()
    </script>
  </body>
</html>
