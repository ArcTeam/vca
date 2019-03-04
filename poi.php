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
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div id="mapPoi"></div>
          </div>
          <div class="col-md-6">

          </div>
        </div>
      </div>
      <?php require('inc/mainFooter.php'); ?>
      <?php require('lib/lib.php'); ?>
      <script src="js/poi.js" charset="utf-8"></script>
    </body>
</html>
