<div class="container-fluid mainHeader">
  <div class="row">
    <div class="col-md-9">
      <img src="img/layout/vca_logo.png" class="img-fluid" alt="">
      <h2 class="m-md-0 m-1">Virtual Heritage - Via Claudia Augusta</h2>
    </div>
    <div class="col-md-3 px-0 menuHeader">
      <nav class="navbar navbar-light bg-withe p-0 mainNav">
        <ul class="nav m-0 w-100">
          <li class="nav-item">
            <a href="index.php" class="nav-link animation">
              <i class="fas fa-home"></i>
              <span class="">home</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link animation">
              <i class="fas fa-book-reader"></i>
              <span class="">catalogue</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link animation">
              <i class="far fa-images"></i>
              <span class="">gallery</span>
            </a>
          </li>
          <li class="nav-item">
            <?php if (isset($_SESSION['id'])) {?>
              <a href="#" class="nav-link animation openMenu">
                <i class="fas fa-tachometer-alt"></i>
                <span class="">dashboard</span>
              </a>
            <?php } else { ?>
              <a href="login.php" class="nav-link animation">
                <i class="fas fa-sign-in-alt"></i>
                <span class="">sign-in</span>
              </a>
            <?php } ?>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</div>
