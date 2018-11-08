<?php
session_start();
$ico = !isset($_SESSION['id']) ? 'fas fa-sign-in-alt' : 'fas fa-tachometer-alt';
$spanTxt = !isset($_SESSION['id']) ? 'login' : 'dashboard';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require('inc/metatag.php'); ?>
    <?php require('css/css.php'); ?>
    <style media="screen">
      @media (min-width: 576px) and (max-width: 767px) {
        .login{width:100%;}
      }
      @media (min-width: 1200px) {
        .login{width:50%;}
      }
    </style>
  </head>
  <body>
    <?php require('inc/mainHeader.php'); ?>
    <div class="mainSection">
      <div class="container">
        <div class="row">
          <div class="col">
            <form class="mx-auto p-5 bg-white shadow login" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
              <input type="hidden" name="act" value="login">
              <div class="form-row justify-content-md-center">
                <div class="col">
                  <div class="form-group mb-3">
                    <h5>Sign in to start your session</h5>
                  </div>
                  <div class="form-group mb-3">
                    <div class="alert alert-danger d-none" role="alert"></div>
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-at"></i></span>
                    </div>
                    <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $email; ?>" required>
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                    </div>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary form-control shadow-sm" name="submit">sign in</button>
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
  </body>
</html>
