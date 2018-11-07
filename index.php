<?php
session_start();
$ico = !isset($_SESSION['id']) ? 'fas fa-sign-in-alt' : 'fas fa-tachometer-alt';
$spanTxt = !isset($_SESSION['id']) ? 'login' : 'dashboard';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require('inc/metatag.php'); ?>
    <?php require('css/css.php'); ?>
  </head>
  <body>
    <?php require('inc/mainHeader.php'); ?>
    <div class="mainSection">

    </div>
    <?php require('inc/mainFooter.php'); ?>
    <?php require('lib/lib.php'); ?>
  </body>
</html>
