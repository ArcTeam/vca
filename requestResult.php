<?php
session_start();
require ("class/request.class.php");
$req = new Request($_POST['usr']);
if (isset($_POST['submit'])) {
  $msg = $req->accept();
}else {
  $msg = $req->deny();
}
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
          <div class="col-sm-12 col-md-9 col-lg-5 mx-auto p-5 bg-white shadow">
            <h4><?php echo $msg; ?></h4>
            <p>Back to the dasboard in <span id="countdowntimer"></span> seconds</p>
          </div>
        </div>
      </div>
    </div>
    <?php require('inc/mainFooter.php'); ?>
    <?php require('lib/lib.php'); ?>
    <script src="js/function.js"></script>
    <script type="text/javascript">
      countdown(5,'dashboard.php');
    </script>
  </body>
</html>
