<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require('inc/metatag.php'); ?>
    <?php require('css/css.php'); ?>
    <style media="screen">
      .moduser:hover{background: #c1c8ce;}
    </style>
  </head>
  <body>
    <?php require('inc/mainHeader.php'); ?>
    <?php require('inc/userNav.php'); ?>
    <div class="mainSection">
      <div class="container-fluid">
        <input type="hidden" name="sessionClass" value="<?php echo $_SESSION['class']; ?>">
        <div class="row">
          <div class="col">
            <table class="table bg-white" id="usrtable">
              <thead class="thead-dark">
                <tr>
                  <th>User</th>
                  <th class="min-tablet">Email</th>
                  <th class="min-tablet">Address</th>
                  <th class="min-tablet">Mobile</th>
                  <th class="desktop">Description</th>
                  <?php if (isset($_SESSION['class']) && $_SESSION['class'] > 2) {?>
                  <th class="all" width="20px">Class</th>
                  <th class="all" width="20px">Active</th>
                  <th class="all" width="20px"></th>
                  <?php } ?>
                </tr>
              </thead>
              <tbody></tbody>
              <tfoot class="hide-if-no-paging"></tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div id="legend" class="d-inline">
      <div class="btn-group border" role="group" aria-label="legend">
        <button type="button" class="btn btn-dark disabled">user class:</button>
        <button type="button" class="btn btn-light tip" data-placement="bottom" title="<p class='h5 border-bottom'>simple user</p><p>can do advanced research and download data as the list of records resulting from the search, with main data or complete data sheet</p>"><i class="fas fa-user fa-lg text-success"></i></button>
        <button type="button" class="btn btn-light tip" data-placement="bottom" title="<p class='h5 border-bottom'>advanced user</p><p>can performs all the research, he can add new record, modify or delete his own</p>"><i class="fas fa-user-edit fa-lg text-primary"></i></button>
        <button type="button" class="btn btn-light tip" data-placement="bottom" title="<p class='h5 border-bottom'>supervisor</p><p>same advanced user privileges, can manage all records, can approve records created by advanced users, can create new users, can manage list values</p>"><i class="fas fa-user-cog fa-lg text-warning"></i></button>
        <button type="button" class="btn btn-light tip" data-placement="bottom" title="<p class='h5 border-bottom'>administrator</p><p>same supervisor privileges, can create new supervisors</p>"><i class="fas fa-user-secret fa-lg text-danger"></i></button>
      </div>
    </div>

    <div class="alertModalWrap" id="alertDelWrap">
      <div class="alert alert-light" role="alert">
        <h4>You are about to <span class="usrstatustitle"></span> a user!</h4>
        <hr>
        <p class="usrstatusp"></p>
        <hr>
        <div class=""></div>
        <input type="hidden" name="idusr" value="">
        <input type="hidden" name="statususr" value="">
        <button type="button" name="status" class="btn btn-danger" title="confirm">confirm</button>
        <button type="button" class="btn btn-secondary" title="cancel" name="closeAlert">cancel</button>
      </div>
    </div>

    <div class="alertModalWrap" id="alertClassWrap">
      <div class="alert alert-light" role="alert">
        <h4>Change current user class</h4>
        <hr>
        <div class="btn-group-vertical btn-group-toggle d-block usrclasschecklist" data-toggle="buttons">
          <label class="btn btn-light text-left">
            <input type="radio" name="usrlistval" id="checkSimple" value="1" autocomplete="off">
            <i class='fas fa-user fa-fw fa-2x text-success'></i>
            <span class="ml-3">Simple user</span>
          </label>
          <label class="btn btn-light text-left">
            <input type="radio" name="usrlistval" id="checkAdvanced" value="2" autocomplete="off">
            <i class='fas fa-user-edit fa-fw fa-2x text-primary'></i>
            <span class="ml-3">Advanced user</span>
          </label>
          <label class="btn btn-light text-left">
            <input type="radio" name="usrlistval" id="checkSupervisor" value="3" autocomplete="off">
            <i class='fas fa-user-cog fa-fw fa-2x text-warning'></i>
            <span class="ml-3">Supervisor</span>
          </label>
          <label class="btn btn-light text-left">
            <input type="radio" name="usrlistval" id="checkAdmin" value="4" autocomplete="off" checked>
            <i class='fas fa-user-secret fa-fw fa-2x text-danger'></i>
            <span class="ml-3">Administrator</span>
          </label>
        </div>
        <hr>
        <input type="hidden" name="idusr" value="">
        <button type="button" name="modclass" class="btn btn-danger" title="confirm">confirm</button>
        <button type="button" class="btn btn-secondary" title="cancel" name="closeAlert">cancel</button>
      </div>
    </div>
    <?php require('inc/mainFooter.php'); ?>
    <?php require('lib/lib.php'); ?>
    <script src="js/users.js"></script>
  </body>
</html>
