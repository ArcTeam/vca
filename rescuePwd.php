<?php
session_start();
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
      <div class="container">
        <div class="row">
          <div class="col">
            <form class="mx-auto p-5 bg-white shadow narrow" name="rescue">
              <input type="hidden" name="act" value="login">
              <div class="form-row justify-content-md-center">
                <div class="col">
                  <div class="form-group mb-3">
                    <h3 class="border-bottom pb-2 mb-3">Request new password</h3>
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-at"></i></span>
                    </div>
                    <input type="email" name="email" class="form-control" placeholder="Email" value="" required>
                  </div>
                  <div id="output"></div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="send">request new password</button>
                    <a href="index.php" class="btn btn-outline-secondary">cancel</a>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php require('inc/mainFooter.php'); ?>
    <?php require('lib/lib.php'); ?>
    <script type="text/javascript" src="js/rescuePwd.js"></script>
  </body>
</html>
