<div class="container-fluid mainHeader">
  <div class="row">
    <div class="col-2 col-md-7 col-lg-9">
      <img src="img/layout/vca_logo.png" class="img-fluid" alt="">
      <h2 class="m-md-0 m-1 d-none d-md-inline-block">Virtual Heritage - Via Claudia Augusta</h2>
    </div>
    <div class="col-10 col-md-5 col-lg-3 px-0 menuHeader float-right">
      <nav class="navbar navbar-light bg-withe p-0 mainNav">
        <ul class="nav m-0 w-100">
          <li class="nav-item">
            <a href="index.php" class="nav-link animation tip" data-placement="bottom" title="back to home">
              <i class="fas fa-home"></i>
              <span class="">home</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="catalogue.php" class="nav-link animation tip catalogueLink" data-placement="bottom" title="view all records">
              <i class="fas fa-book-reader"></i>
              <span class="">catalogue</span>
            </a>
          </li>
          <?php if (isset($_SESSION['id'])) {?>
          <li class="nav-item">
            <a href="dashboard.php" class="nav-link animation openMenu tip" data-placement="bottom" title="advanced menu">
              <i class="fas fa-tachometer-alt"></i>
              <span class="">dashboard</span>
            </a>
          </li>
          <?php } else { ?>
          <li class="nav-item">
            <a href="register.php" class="nav-link animation tip" data-placement="bottom" title="would you like collaborate with us?<br>send us a request">
              <i class="fas fa-handshake"></i>
              <span class="">get member</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="login.php" class="nav-link animation tip" data-placement="bottom" title="start work session">
              <i class="fas fa-sign-in-alt"></i>
              <span class="">sign-in</span>
            </a>
          </li>
          <?php } ?>
        </ul>
      </nav>
    </div>
  </div>
</div>
