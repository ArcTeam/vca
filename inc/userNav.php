<div class="userNavWrap animation closed d-print-none">
  <div class="alert alert-warning m-0 leftTip" title="check my activities" role="alert">
    <a href="dashboard.php" class="alert-link d-block"><i class="fas fa-tachometer-alt fa-lg fa-fw"></i> DASHBOARD</a>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item list-group-item-success list-title"><i class="fas fa-clipboard-list fa-lg fa-fw"></i> RECORDS</li>
    <li class="list-group-item leftTip" title="view full record list"><a href="catalogue.php" class="animation">view all</a></li>
    <?php if (isset($_SESSION['class']) && $_SESSION['class'] > 1) { ?>
    <li class="list-group-item leftTip" title="add new record"><a href="newPoi.php" class="animation">add new</a></li>
    <?php } ?>
  </ul>
  <ul class="list-group list-group-flush">
    <li class="list-group-item list-group-item-success list-title"><i class="fas fa-user fa-lg fa-fw"></i> ACCOUNT</li>
    <li class="list-group-item leftTip"  title="check or modify account details"><a href="usrInfo.php" class="animation ">account details</a></li>
    <li class="list-group-item leftTip" title="change password"><a href="usrPwd.php" class="animation">change password</a></li>
  </ul>
  <?php if (isset($_SESSION['class']) && $_SESSION['class']==4) { ?>
  <ul class="list-group list-group-flush">
    <li class="list-group-item list-group-item-success list-title"><i class="fas fa-cog fa-lg fa-fw"></i> SYSTEM SETTINGS</li>
    <li class="list-group-item leftTip" title="view full user list"><a href="users.php" class="animation">users list</a></li>
    <li class="list-group-item leftTip" title="add new user"><a href="addUsr.php" class="animation">add user</a></li>
    <!-- <li class="list-group-item leftTip" title="add, update or delete an item list"><a href="#" class="animation">manage value lists</a></li> -->
  </ul>
  <?php } ?>
  <!-- <div class="alert alert-warning m-0 leftTip border-top-0 border-left-0 border-right-0 border-secondary" title="user documentation" role="alert">
    <a href="documentation.php" class="alert-link d-block"><i class="fas fa-book fa-lg fa-fw"></i> DOCUMENTATION</a>
  </div> -->
  <div class="alert alert-warning m-0 leftTip" title="end work session" role="alert">
    <a href="logout.php" class="alert-link d-block"><i class="fas fa-sign-out-alt fa-lg fa-fw"></i> LOGOUT</a>
  </div>
</div>
