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
            <form class="mx-auto p-5 bg-white shadow narrow" name="changePwd">
              <h3 class="border-bottom pb-2 mb-5">Change your password</h3>
              <div class="form-group">
                <label for="old">Old password</label>
                <input type="password" id="old" name="old" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="new">New password</label>
                <input type="password" id="new" name="new" class="form-control" required pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
                <div class="alert alert-warning mt-2 pwdTip"><small>Password must be 8 characters min and contains at least 1 uppercase, 1 lowercase and 1 number/special character</small></div>
              </div>
              <div class="form-group">
                <label for="check">Retype new password</label>
                <input type="password" id="check" name="check" class="form-control" required>
              </div>
              <div class="form-group">
                <div id="output"></div>
              </div>
              <div class="form-group">
                <button type="submit" name="change" class="btn btn-primary form-control">change password</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php require('inc/mainFooter.php'); ?>
    <?php require('lib/lib.php'); ?>
    <script src="js/usrPwd.js"></script>
  </body>
</html>
