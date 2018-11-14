<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require('inc/metatag.php'); ?>
    <?php require('css/css.php'); ?>
    <style media="screen">
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
    <div class="mainSection">
      <div class="container">
        <div class="row">
          <div class="col">
            <form class="p-5 bg-white mx-auto shadow login">
              <p>Fill out the form to request the creation of your access profile, administrators will take charge of your request.</p>
              <p class="responseOk d-none">In the next 24 hours you will receive an email with the details of your new account.<br>If you do not receive an email check spam, otherwise send an email to the address</p>
              <div class="form-group">
                <input type="email" name="email" value="" class="form-control" placeholder="email" required>
              </div>
              <div class="form-group">
                <input type="text" name="firstName" value="" class="form-control" placeholder="first name" required>
              </div>
              <div class="form-group">
                <input type="text" name="lastName" value="" class="form-control" placeholder="last name" required>
              </div>
              <div class="form-group">
                <input type="text" name="address" value="" class="form-control" placeholder="address" required>
              </div>
              <div class="form-group">
                <textarea name="description" rows="8" cols="80" class="form-control" placeholder="description" required></textarea>
              </div>
              <div class="form-group">
                <button type="submit" name="send" class="btn btn-primary form-control"><i class="fas fa-paper-plane"></i> send</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php require('inc/mainFooter.php'); ?>
    <?php require('lib/lib.php'); ?>
  </body>
  <script type="text/javascript">
    removeLib()
  </script>
</html>
