<?php
session_start();
if (!isset($_SESSION['id'])) { header("Location: login.php"); }
require("class/record.class.php");
$record = new Record;
if (isset($_POST)) { $test = $record->addPoi($_POST); }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require('inc/metatag.php'); ?>
    <?php require('css/css.php'); ?>
    <style media="screen">
      .output{ width: 50%; position: relative; margin: 10% 25% 35%; padding: 50px; background:#fff; border-radius: 5px;}
    </style>
  </head>
  <body>
    <?php require('inc/mainHeader.php'); ?>
    <?php require('inc/userNav.php'); ?>
    <div class="mainSection">
      <div class="output">
        <?php print_r($test); ?>
      </div>
    </div>
    <?php require('inc/mainFooter.php'); ?>
    <?php require('lib/lib.php'); ?>
  </body>
</html>
