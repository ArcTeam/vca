<?php
session_start();
require("class/dashboard.class.php");
$dash = new Dashboard();
$arr = $dash->dash();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require('inc/metatag.php'); ?>
    <?php require('css/css.php'); ?>
    <style media="screen">
      .table-sm{font-size: 12px;}
      .card-title{margin:0;}
    </style>
  </head>
  <body>
    <?php require('inc/mainHeader.php'); ?>
    <?php require('inc/userNav.php'); ?>
    <div class="mainSection">
      <div class="container-fluid">
        <div class="row"><?php require("inc/dashboard/".$arr['dash'].".php"); ?></div>
        <div class="row">
          <div class="col-12 col-lg-6 mb-3">
            <div class="card">
              <div class="card-header">
                <div class="card-title">
                  <div class="d-inline-block m-0 p-0" style="width:75%">
                    <h5 class="">Notepad</h5>
                  </div>
                  <div class="d-inline-block text-right m-0 p-0" style="width:24%">
                    <button type="button" name="toggleNoteForm" class="btn btn-info btn-sm" data-toggle="collapse" data-target="#noteForm"><i class="fas fa-plus"></i></button>
                  </div>
                </div>
              </div>
              <div class="card-body p-0">
                <ul class="list-group list-group-flush m-0" id="noteList"></ul>
              </div>
              <div class="card-footer collapse" id="noteForm">
                <form class="form" name="noteForm">
                  <textarea name="note" rows="4" class="form-control rounded-0" placeholder="...write note" required></textarea>
                  <button type="submit" name="addNoteBtn" class="btn btn-primary btn-sm form-control rounded-0">save</button>
                </form>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-6 mb-3">
            <div class="card">
              <div class="card-header">
                <div class="card-title">
                  <h5>Address book <span class="badge badge-info float-right"><?php echo count($arr['address']) ?></span></h5>
                </div>
              </div>
              <div class="card-body p-0">
                <table class="table table-sm table-striped m-0">
                  <tbody>
                    <?php
                      foreach ($arr['address'] as $key => $value){
                        $info = "<ul class='addrInfo'>";
                        $info .= "<li><span>mobile:</span><span>".$value['cell']."</span></li>";
                        $info .= "<li><span>address:</span><span>".$value['address']."</span></li>";
                        $info .= "<li><span>description:</span><span>".nl2br($value['description'])."</span></li>";
                        $info .= "</ul>";
                    ?>
                    <tr>
                      <td><?php echo $value['last_name']." ".$value['first_name']; ?></td>
                      <td><?php echo $value['email']; ?></td>
                      <td><button type="button" class="btn btn-link btn-sm text-dark topTip" title="view user info" name="usrInfo" data-toggle="popusr" data-usrinfo="<?php echo $info; ?>"><i class="fas fa-info"></i></button> </td>
                    </tr>
                    <?php }; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    <?php require('inc/mainFooter.php'); ?>
    <?php require('lib/lib.php'); ?>
    <script src="js/dashboard.js"></script>
  </body>
</html>
