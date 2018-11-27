<?php
session_start();
require ("class/db.class.php");
$db = new Db;
$usr = $db->simple("select * from addr_book where id = ".$_SESSION['id'].";");
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
            <form class="mx-auto p-5 bg-white shadow narrow" name="accountInfo">
              <h3 class="border-bottom pb-2 mb-5">Update account details</h3>
              <div class="form-group">
                <label for="email">email</label>
                <input type="email" name="email" id="email" value="<?php echo $usr[0]['email']; ?>"  class="form-control" placeholder="email (required)" required>
              </div>
              <div class="form-group">
                <label for="first">First name</label>
                <input type="text" name="first" id="first" value="<?php echo $usr[0]['first_name']; ?>"  class="form-control" placeholder="First name" required>
              </div>
              <div class="form-group">
                <label for="last">Last name</label>
                <input type="text" name="last" id="last" value="<?php echo $usr[0]['last_name']; ?>"  class="form-control" placeholder="Last name" required>
              </div>
              <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" value="<?php echo $usr[0]['address']; ?>"  class="form-control"  placeholder="Address" required>
              </div>
              <div class="form-group">
                <label for="mobile">mobile number</label>
                <input type="text" name="cell" class="form-control" value="<?php echo $usr[0]['cell']; ?>" placeholder="mobile number with international prefix">
              </div>
              <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="8" cols="80" class="form-control" placeholder="Insert a brief description"><?php echo $usr[0]['description']; ?></textarea>
              </div>
              <div class="form-group">
                <div id="output"></div>
              </div>
              <div class="form-group">
                <button type="submit" name="update" class="btn btn-primary">update account</button>
                <a href="dashboard.php" class="btn btn-outline-secondary">cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php require('inc/mainFooter.php'); ?>
    <?php require('lib/lib.php'); ?>
    <script src="js/usrInfo.js"></script>
  </body>
</html>
