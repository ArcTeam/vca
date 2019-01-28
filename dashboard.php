<?php
session_start();
require("class/dashboard.class.php");
$dash = new Dashboard($_SESSION['class']);
$arr = $dash->dash();
$ip = $_SERVER['REMOTE_ADDR'];
$data = file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip);
$data = json_decode($data);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require('inc/metatag.php'); ?>
    <?php require('css/css.php'); ?>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
    <style media="screen">
      .table-sm{font-size: 12px;}
    </style>
  </head>
  <body>
    <?php require('inc/mainHeader.php'); ?>
    <?php require('inc/userNav.php'); ?>
    <div class="mainSection">
      <?php require("inc/dashboard/".$arr['dash'].".php"); ?>
    </div>
    <?php require('inc/mainFooter.php'); ?>
    <?php require('lib/lib.php'); ?>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
    <script src="js/dashboard.js"></script>
  </body>
</html>
