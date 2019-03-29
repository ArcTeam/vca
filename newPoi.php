<?php
session_start();
if (!isset($_SESSION['id'])) { header("Location: login.php"); }
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
      <div class="container bg-white rounded p-3">
        <div class="row">
          <div class="col">
            <h3 class="border-bottom">Add new record</h3>
            <p class="font-weight-bold">* mandatory field</p>
          </div>
        </div>
        <form class="form">
          <div id="localizationWrap">
            <div class="form-row">
              <div class="col p-2 mb-3 bg-light">
                <h5>Localization</h5>
              </div>
            </div>
            <div class="form-row">
              <div class="col-lg-4">
                <div class="form-group">
                  <label for="state" class="font-weight-bold">*State</label>
                  <select class="form-control form-control-sm mb-1" id="state" name="state">
                    <option value="" selected disabled required>--select state--</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label for="land">Land</label>
                  <select class="form-control form-control-sm mb-1" id="land" name="land">
                    <option value="" selected>--select land--</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label for="municipality">Municipality</label>
                  <select class="form-control form-control-sm mb-1" id="municipality" name="municipality">
                    <option value="" selected disabled>--select municipality--</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-lg-4">
                <div class="form-group">
                  <label for="coo" class="d-block font-weight-bold">*Coordinates</label>
                  <input type="number" class="form-control form-control-sm mb-1 d-inline-block" placeholder="--longitude--" step="0.01" min="10" max="12" style="width:49%" required>
                  <input type="number" class="form-control form-control-sm mb-1 d-inline-block" placeholder="--latitude--" step="0.01" min="40" max="42" style="width:49%" required>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label for="toponym">Toponym</label>
                  <input type="text" class="form-control form-control-sm" id="toponym" name="toponym" value="" placeholder="--toponym--">
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label for="address">Address</label>
                  <input type="text" class="form-control form-control-sm" id="address" name="address" value="" placeholder="--address--">
                </div>
              </div>
            </div>
          </div>
          <div id="mainInfoWrap">
            <div class="form-row">
              <div class="col p-2 mb-3 bg-light">
                <h5>Main information</h5>
              </div>
            </div>
            <div class="form-row">
              <div class="col-lg-4">
                <div class="form-group mb-1">
                  <label for="name" class="font-weight-bold">*Name</label>
                  <input type="text" id="name" name="name" class="form-control form-control-sm" placeholder="--name--" value="" required>
                </div>
                <div class="form-group mb-1">
                  <label for="type" class="font-weight-bold">*Type</label>
                  <select class="form-control form-control-sm" id="type" name="type">
                    <option value="" selected disabled required>--select type--</option>
                  </select>
                </div>
                <div class="form-group mb-1">
                  <label for="cronostart" class="font-weight-bold">*From</label>
                  <select class="form-control form-control-sm" id="cronostart" name="cronostart">
                    <option value="" selected disabled required>--select start chronology--</option>
                  </select>
                </div>
                <div class="form-group mb-1">
                  <label for="cronoend">To</label>
                  <select class="form-control form-control-sm" id="cronoend" name="cronoend">
                    <option value="" selected>--select end chronology--</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="period">Period</label>
                  <input type="text" id="period" name="period" class="form-control form-control-sm" placeholder="--define chronology--" value="">
                </div>
              </div>
              <div class="col-lg-8">
                <div class="form-group">
                  <label for="info" class="font-weight-bold">*Info</label>
                  <textarea id="info" name="info" class="form-control form-control-sm" rows="14" placeholder="--insert a brief descritpion --" required></textarea>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>

    </div>
    <?php require('inc/mainFooter.php'); ?>
    <?php require('lib/lib.php'); ?>
  </body>
</html>
