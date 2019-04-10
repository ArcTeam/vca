<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['class'] < 3) { header("Location: login.php"); }
require("class/user.class.php");
$class = new User;
$msg='';
if (isset($_POST)) {
  $new = $class->createUser($_POST);
  if ($new['err']===0) {
    $msg .= "<h5 class='text-center'>Ok! The new user has been correctly created</h5>";
    $msg .= "<p class='text-center'>An email with new password has been sent</p>";
    $msg .= "<div class='my-5 py-5 border-top'>";
    $msg .= "<div class='btn-group' role='group' aria-label='Basic example'>";
    $msg .= "<a href='users.php' class='btn btn-outline-secondary border-0'><i class='fas fa-users'></i> view users list</a>";
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
