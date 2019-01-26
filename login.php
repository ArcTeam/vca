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
            <form class="mx-auto p-5 bg-white shadow narrow" name="login">
              <input type="hidden" name="act" value="login">
              <div class="form-row justify-content-md-center">
                <div class="col">
                  <div class="form-group mb-3">
                    <h3 class="border-bottom pb-3 mb-5">Sign in to start your session</h3>
                  </div>
                  <div class="form-group mb-3">
                    <div class="alert alert-danger d-none" role="alert"></div>
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-at"></i></span>
                    </div>
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                    </div>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                  </div>
                  <div class="form-group">
                    <!-- <p class="text-danger text-center d-none output"></p> -->
                    <div id="output"></div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary form-control shadow-sm" name="loginBtn">sign in</button>
                  </div>
                  <div class="form-group">
                    <a href="rescuePwd.php" title="Forgotten your password?">Forgotten your password?</a>
                  </div>
                  <hr>
                  <div class="form-group">
                    <h5>Would you like to collaborate with us?</h5>
                    <a href="register.php" title="Get a member" class="btn btn-info">Get a member</a>
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
    <script type="text/javascript" src="js/login.js"></script>
  </body>
</html>
