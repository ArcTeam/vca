<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['class'] < 3) { header("Location: login.php"); }
require ("class/request.class.php");
$req = new Request($_POST['userid']);
$usr = $req->usrInfo();
$class = $req->usrClass();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require('inc/metatag.php'); ?>
    <?php require('css/css.php'); ?>
    <style media="screen">
      .userGrant{padding:10px; border: 1px solid #ced4da; border-radius: .25rem;}
    </style>
  </head>
  <body>
    <?php require('inc/mainHeader.php'); ?>
    <?php require('inc/userNav.php'); ?>
    <div class="mainSection">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12 col-md-9 col-lg-5 mx-auto p-5 bg-white shadow">
            <?php if ($_SESSION['class'] < 4) {
              echo "<h4>Permission denied</h4><p>You do not have sufficient permissions to access this page</p>";
            }else{ ?>
            <h4 class="text-muted mb-5">Request sent on <?php echo $usr[0]['data']; ?> at <?php echo explode('.',$usr[0]['hour'])[0]; ?></h4>
            <h3 class="border-bottom pb-2">User info</h3>
            <ul class="addrInfo mb-5">
              <li>
                <span>Name:</span>
                <span><?php echo $usr[0]['last_name']." ".$usr[0]['first_name']; ?></span>
              </li>
              <li>
                <span>Email:</span>
                <span><?php echo $usr[0]['email']; ?></span>
              </li>
              <li>
                <span>Mobile:</span>
                <span><?php echo $usr[0]['cell']; ?></span>
              </li>
              <li>
                <span>Address:</span>
                <span><?php echo $usr[0]['address']; ?></span>
              </li>
              <li>
                <span>Description:</span>
                <span><?php echo nl2br($usr[0]['description']); ?></span>
              </li>
            </ul>
            <h3 class="border-bottom pb-2">Process new account request</h3>
            <form class="form" action="requestResult.php" method="post">
              <input type="hidden" name="usr" value="<?php echo $usr[0]['id']; ?>">
              <div class="form-row">
                <div class="col">
                  <p>To accept the request and enable account you must select user grant</p>
                </div>
              </div>
              <div class="form-row">
                <div class="col">
                  <ul class='userGrant'>
                    <?php foreach ($class as $key => $val) {
                      $checked = $val['id'] === 1 ? 'checked':'';
                    ?>
                    <li><label for="<?php echo $val['class']; ?>" class="cursor tip" data-placement="right" title="<?php echo $val['def']; ?>"><input type="radio" class="mr-3" id="<?php echo $val['class']; ?>" name="class" value="<?php echo $val['id']; ?>" <?php echo $checked; ?> ><?php echo $val['class']; ?></label></li>
                    <?php } ?>
                  </ul>
                </div>
              </div>
              <div class="form-row mt-3">
                <div class="col">
                  <hr>
                  <button type="submit" name="submit" class="btn btn-primary topTip" title="accept request and create a new account for the user">accept</button>
                  <button type="submit" name="deny" class="btn btn-danger topTip" title="deny request">deny</button>
                  <a href="dashboard.php" class="btn btn-secondary topTip" title="process request later">process later</a>
                </div>
              </div>
            </form>
          <?php } ?>
          </div>
        </div>
      </div>
    </div>
    <?php require('inc/mainFooter.php'); ?>
    <?php require('lib/lib.php'); ?>
  </body>
</html>
