<?php
session_start();
if (isset($_SESSION['login'])) {
  $time=time();
  $duration= 30;
  $inactive = time() - $_SESSION['login'];
  if ($inactive >= $duration) { header("Location: logout.php"); }
}
?>
