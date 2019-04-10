<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['class'] < 3) { header("Location: login.php"); }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require('inc/metatag.php'); ?>
    <?php require('css/css.php'); ?>
    <style media="screen">
    .list-group.list-group-root { padding: 0; overflow: hidden;}
    .list-group.list-group-root .list-group { margin-bottom: 0;}
    .list-group.list-group-root .list-group-item { border-radius: 0; border-width: 1px 0 0 0;}
    .list-group.list-group-root > .list-group-item:first-child { border-top-width: 0;}
    .list-group.list-group-root > .list-group > .list-group-item { padding-left: 30px;}
    .list-group.list-group-root > .list-group > .list-group > .list-group-item { padding-left: 45px;}
    .doc{position: relative; height: 80vh; margin-top: .5rem; overflow: auto;}
    .doc>div{min-height:500px;}
    </style>
  </head>
  <body>
    <?php require('inc/mainHeader.php'); ?>
    <?php require('inc/userNav.php'); ?>
    <div class="mainSection mx-5 mt-2">
      <div class="container-fluid">
        <div class="row">
          <div class="col-3 m-0 p-0 bg-white">
            <div class="bg-success text-white m-0 p-3">
              <h4>Index</h4>
            </div>
              <div class="list-group list-group-root" id="index">
                <a href="#home" class="list-group-item list-group-item-action">Home page</a>
                <!-- <div class="list-group">
                  <a href="#" class="list-group-item list-group-item-action">Item 1.1</a>
                  <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action">Item 1.1.1</a>
                    <a href="#" class="list-group-item list-group-item-action">Item 1.1.2</a>
                    <a href="#" class="list-group-item list-group-item-action">Item 1.1.3</a>
                  </div>
                  <a href="#" class="list-group-item list-group-item-action">Item 1.2</a>
                  <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action">Item 1.2.1</a>
                    <a href="#" class="list-group-item list-group-item-action">Item 1.2.2</a>
                    <a href="#" class="list-group-item list-group-item-action">Item 1.2.3</a>
                  </div>
                  <a href="#" class="list-group-item list-group-item-action">Item 1.3</a>
                  <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action">Item 1.3.1</a>
                    <a href="#" class="list-group-item list-group-item-action">Item 1.3.2</a>
                    <a href="#" class="list-group-item list-group-item-action">Item 1.3.3</a>
                  </div>
                </div> -->
                <a href="#catalogue" class="list-group-item list-group-item-action">Catalogue</a>
                <!-- <div class="list-group">
                  <a href="#" class="list-group-item list-group-item-action">Item 2.1</a>
                  <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action">Item 2.1.1</a>
                    <a href="#" class="list-group-item list-group-item-action">Item 2.1.2</a>
                    <a href="#" class="list-group-item list-group-item-action">Item 2.1.3</a>
                  </div>
                  <a href="#" class="list-group-item list-group-item-action">Item 2.2</a>
                  <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action">Item 2.2.1</a>
                    <a href="#" class="list-group-item list-group-item-action">Item 2.2.2</a>
                    <a href="#" class="list-group-item list-group-item-action">Item 2.2.3</a>
                  </div>
                  <a href="#" class="list-group-item list-group-item-action">Item 2.3</a>
                  <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action">Item 2.3.1</a>
                    <a href="#" class="list-group-item list-group-item-action">Item 2.3.2</a>
                    <a href="#" class="list-group-item list-group-item-action">Item 2.3.3</a>
                  </div>
                </div> -->
                <a href="#getmember" class="list-group-item list-group-item-action">Get member</a>
                <!-- <div class="list-group">
                  <a href="#" class="list-group-item list-group-item-action">Item 3.1</a>
                  <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action">Item 3.1.1</a>
                    <a href="#" class="list-group-item list-group-item-action">Item 3.1.2</a>
                    <a href="#" class="list-group-item list-group-item-action">Item 3.1.3</a>
                  </div>
                  <a href="#" class="list-group-item list-group-item-action">Item 3.2</a>
                  <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action">Item 3.2.1</a>
                    <a href="#" class="list-group-item list-group-item-action">Item 3.2.2</a>
                    <a href="#" class="list-group-item list-group-item-action">Item 3.2.3</a>
                  </div>
                  <a href="#" class="list-group-item list-group-item-action">Item 3.3</a>
                  <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action">Item 3.3.1</a>
                    <a href="#" class="list-group-item list-group-item-action">Item 3.3.2</a>
                    <a href="#" class="list-group-item list-group-item-action">Item 3.3.3</a>
                  </div>
                </div> -->
                <a href="#signin" class="list-group-item list-group-item-action">Sign in</a>
              </div>
          </div>
          <div class="col-9 m-0 p-3 bg-white border-left">
            <div data-spy="scroll" data-target="#index" data-offset="0" class="doc">
              <div id="home">
                <h4>Home page</h4>
              </div>
              <div id="catalogue">
                <h4>Catalogue</h4>

              </div>
              <div id="getmember">
                <h4>Get member</h4>

              </div>
              <div id="signin">
                <h4>Sign in</h4>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php require('inc/mainFooter.php'); ?>
    <?php require('lib/lib.php'); ?>
  </body>
</html>
