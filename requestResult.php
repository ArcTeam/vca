<?php
session_start();
require ("class/request.class.php");
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
          <div class="col-sm-12 col-md-9 col-lg-7 mx-auto p-5 bg-white shadow">
            <ul>
            <?php
              if (isset($_POST['deny'])) {
                echo "<p>richiesta rifiutata</p>";
              }else {
                echo "<p>richiesta accettata</p>";
              }
              foreach ($_POST as $key => $value) {
                echo "<li>".$key." ".$value."</li>";
              }
            ?>
          </div>
        </div>
      </div>
    </div>
    <?php require('inc/mainFooter.php'); ?>
    <?php require('lib/lib.php'); ?>
  </body>
</html>
