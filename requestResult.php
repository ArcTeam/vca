<?php
session_start();
require ("class/request.class.php");
$req = new Request($_POST['usr']);
if (isset($_POST['submit'])) {$msg = $req->accept($_POST['class']);}else {$msg = $req->deny();}
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
          <div class="col-sm-12 col-md-9 col-lg-6 mx-auto p-5 bg-white shadow text-center">
            <?php echo $msg; ?>
            <p class="border-top mt-3"><small>Back to the dasboard in <span id="countdowntimer" class="font-weight-bold"></span> seconds</small></p>
          </div>
        </div>
      </div>
    </div>
    <?php require('inc/mainFooter.php'); ?>
    <?php require('lib/lib.php'); ?>
    <script type="text/javascript">
      countdown(5,'dashboard.php');
    </script>
  </body>
</html>
