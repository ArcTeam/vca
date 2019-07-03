<?php
session_start();
if (!isset($_SESSION['id'])) { header("Location: login.php"); }
require("class/biblio.class.php");
$record = new Biblio;
$msg='';
if (isset($_POST)) {
  $test = $record->itemAdd($_POST);
  if ($test['err']===0) {
    $msg .= "<h5 class='text-center'>Ok! The new record has been correctly saved</h5>";
    $msg .= "<div class='my-5 py-5 border-top'>";
    $msg .= "<div class='btn-group' role='group' aria-label='Basic example'>";
    $msg .= "<a href='newBiblio.php' class='btn btn-outline-secondary border-0'><i class='fas fa-plus-circle'></i> add new biblio</a>";
    $msg .= "<a href='biblio.php?biblio=".$test['newrec']."' class='btn btn-outline-secondary border-0'><i class='fas fa-clipboard-list'></i> view new bibliography item</a>";
    $msg .= "<a href='dashboard.php' class='btn btn-outline-secondary border-0'><i class='fas fa-tachometer-alt'></i> back to dashboard</a>";
    $msg .= "</div>";
    $msg .= "</div>";
  }else {
    foreach ($test as $key => $err) {$msg .= $key.": ".$err."<br>";}
  }
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require('inc/metatag.php'); ?>
    <?php require('css/css.php'); ?>
    <style media="screen">
      .output{ width: 50%; position: relative; margin: 10% 25% 35%; padding: 50px; background:#fff; border-radius: 5px;}
      @media (max-width: 767px) {
        .output{ width: 80%; position: relative; margin: 10% 10% 35%; padding: 50px; background:#fff; border-radius: 5px;}
      }
    </style>
  </head>
  <body>
    <?php require('inc/mainHeader.php'); ?>
    <?php require('inc/userNav.php'); ?>
    <div class="mainSection">
      <div class="output">
        <?php echo $msg; ?>
      </div>
    </div>
    <?php require('inc/mainFooter.php'); ?>
    <?php require('lib/lib.php'); ?>
    <script type="text/javascript">
      if (screen.width < 769 ) {
        $(".output").find('.btn-group').addClass('btn-group-vertical w-100')
      }
    </script>
  </body>
</html>
