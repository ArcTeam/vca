<?php
session_start();
require ("class/db.class.php");
$db = new Db;
$u = intval(count($db->simple("select * from usr;")));
if ($u==0) {
  $title="Fill the form to create the administrator profile.";
  $required = '';
  $placeholder = "description";
  $func="admin";
}else {
  $title="Fill out the form to request the creation of your access profile, administrators will take charge of your request.";
  $required = 'required';
  $placeholder = "description (".$required.")";
  $func="request";
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require('inc/metatag.php'); ?>
    <?php require('css/css.php'); ?>
    <style media="screen">
      .alertWrap{position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,.35); z-index: 2000;display: none;}
      .outputMsg{margin: 200px auto; width: 300px;}

      @media (min-width: 576px) and (max-width: 767px) {
        form{width:100%;}
      }
      @media (min-width: 1200px) {
        form{width:50%;}
      }
    </style>
  </head>
  <body>
    <?php require('inc/mainHeader.php'); ?>
    <?php require('inc/userNav.php'); ?>
    <div class="mainSection">
      <div class="container">
        <div class="row">
          <div class="col">
            <form class="p-3 p-md-5 bg-white mx-auto shadow login" name="subscribe">
              <p class="text-center"><?php echo $title; ?></p>
              <p class="responseOk d-none">In the next 24 hours you will receive an email with the details of your new account.<br>If you do not receive an email check spam, otherwise send an email to the address</p>
              <div class="form-group">
                <input type="email" name="email" value="" class="form-control" placeholder="email (required)" required>
              </div>
              <div class="form-group">
                <input type="text" name="firstName" value="" class="form-control" placeholder="first name (required)" required>
              </div>
              <div class="form-group">
                <input type="text" name="lastName" value="" class="form-control" placeholder="last name (required)" required>
              </div>
              <div class="form-group">
                <input type="text" name="address" value="" class="form-control" placeholder="address (required)" required>
              </div>
              <div class="form-group">
                <input type="text" name="mobile" class="form-control" placeholder="mobile number with international prefix">
              </div>
              <div class="form-group">
                <textarea name="description" rows="8" cols="80" class="form-control" placeholder="<?php echo $placeholder; ?>" <?php echo $required; ?>></textarea>
              </div>
              <div class="form-group">
                <button type="submit" name="send" data-func="<?php echo $func; ?>" class="btn btn-primary form-control"><i class="fas fa-paper-plane"></i> send</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="alertWrap">
        <div class="outputMsg alert alert-success" role="alert"></div>
      </div>
    </div>
    <?php require('inc/mainFooter.php'); ?>
    <?php require('lib/lib.php'); ?>
    <script type="text/javascript" src="js/register.js"></script>
  </body>
</html>
