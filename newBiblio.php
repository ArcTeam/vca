<?php
session_start();
if (!isset($_SESSION['id'])) { header("Location: login.php"); }
$year = date("Y");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require('inc/metatag.php'); ?>
    <?php require('css/css.php'); ?>
    <!-- <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/tagmanager.css"> -->
  </head>
  <body>
    <?php require('inc/mainHeader.php'); ?>
    <?php require('inc/userNav.php'); ?>
    <div class="mainSection">
      <div class="container bg-white rounded p-3">
        <div class="row">
          <div class="col">
            <h3 class="border-bottom">Add new bibliography</h3>
            <p class="font-weight-bold">* mandatory field</p>
          </div>
        </div>
        <form class="form" action="newBiblioAdd.php" method="post" name="addBiblioForm">
          <input type="hidden" name="compiler" value="<?php echo $_SESSION['id']; ?>">
          <div class="form-row mb-3">
            <div class="col-12 col-md-3 col-lg-2">
              <label for="type" class="font-weight-bold">* Publication type:</label>
            </div>
            <div class="col-12 col-md-9 col-lg-10">
              <select class="form-control" name="type" id="type" required></select>
            </div>
          </div>
          <div class="form-row mb-3">
            <div class="col-12 col-md-3 col-lg-2">
              <label for="title" class="font-weight-bold">* Title:</label>
            </div>
            <div class="col-12 col-md-9 col-lg-10">
              <input type="text" name="title" id="title" value="" class="form-control" required>
            </div>
          </div>
          <div class="form-row mb-3">
            <div class="col-12 col-md-3 col-lg-2">
              <label for="main" class="font-weight-bold">* Main author:</label>
            </div>
            <div class="col-12 col-md-9 col-lg-10">
              <input type="text" name="main" id="main" value="" class="form-control" required>
            </div>
          </div>
          <div class="form-row mb-3">
            <div class="col-12 col-md-3 col-lg-2">
              <label for="secondary">Secondary authors:</label>
            </div>
            <div class="col-12 col-md-9 col-lg-10">
              <input type="text" name="secondary" id="secondary" value="" class="form-control">
            </div>
          </div>
          <div class="form-row mb-3">
            <div class="col-12 col-md-3 col-lg-2">
              <label for="year">Publication year:</label>
            </div>
            <div class="col-12 col-md-9 col-lg-10">
              <input type="number" min="1500" max="<?php echo $year; ?>" name="year" id="year" value="" class="form-control w-auto">
            </div>
          </div>
          <div class="form-row mb-3">
            <div class="col-12 col-md-3 col-lg-2">
              <label for="publisher">Publisher:</label>
            </div>
            <div class="col-12 col-md-9 col-lg-10">
              <input type="text" name="publisher" id="publisher" value="" class="form-control">
            </div>
          </div>
          <div class="form-row mb-3">
            <div class="col-12 col-md-3 col-lg-2">
              <label for="place">Place:</label>
            </div>
            <div class="col-12 col-md-9 col-lg-10">
              <input type="text" name="place" id="place" value="" class="form-control">
            </div>
          </div>

          <!--
          journal      | character varying |             |                 |
          volume       | character varying |             |                 |
          page         | character varying |             |                 |
          info         | character varying |             |                 |
          exhibition   | character varying |             |                 |
          url          | character varying |             |                 |
          downloadable | boolean           |             |                 | false
          license      | character varying |             |                 |
          data         | date              |             |                 | now()
          type         | integer           |             |                 |
          reading      | integer[]         |             |                 |
        -->
        </form>
      </div>

    </div>
    <?php require('inc/mainFooter.php'); ?>
    <?php require('lib/lib.php'); ?>
    <script src="lib/jquery-ui.js"></script>
    <script src="lib/tagmanager.js" charset="utf-8"></script>
    <script type="text/javascript"></script>
  </body>
</html>
