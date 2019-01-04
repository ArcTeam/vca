<?php
session_start();
require("class/dashboard.class.php");
$dash = new Dashboard;
$arr = $dash->dash();
$ip = $_SERVER['REMOTE_ADDR'];
$data = file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip);
$data = json_decode($data);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require('inc/metatag.php'); ?>
    <?php require('css/css.php'); ?>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
  </head>
  <body>
    <?php require('inc/mainHeader.php'); ?>
    <?php require('inc/userNav.php'); ?>
    <div class="mainSection">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
              <div class="card">
                <div class="card-header">
                  <div class="card-title">
                    <h5>Check new records <span class="badge badge-info float-right">4</span></h5>
                  </div>
                </div>
                <div class="card-body">
                </div>
              </div>
              <div class="card mt-3">
                <div class="card-header">
                  <div class="card-title">
                    <h5>Last approved records <span class="badge badge-info float-right">4</span></h5>
                  </div>
                </div>
                <div class="card-body">
                </div>
              </div>
          </div>
          <div class="col-md-4">
              <div class="card mt-3 mt-md-0">
                <div class="card-header">
                  <div class="card-title">
                    <h5>New  account request <span class="badge badge-info float-right"><?php echo count($arr['request']) ?></span></h5>
                  </div>
                </div>
                <div class="card-body p-0">
                  <table class="table table-sm table-striped">
                    <tbody>
                      <?php foreach ($arr['request'] as $key => $value){ ?>
                        <tr>
                          <td class="p-2"><?php echo $value['last_name']." ".$value['first_name']; ?></td>
                          <td class="p-2"><?php echo $value['data']; ?></td>
                          <td class="p-2">
                            <form action="request.php" method="post">
                              <button type="submit" class="btn btn-link topTip" name="userid" title="view request" value="<?php echo $value['id']; ?>"><i class="fas fa-link"></i></button>
                            </form>
                          </td>
                        </tr>
                      <?php }; ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="card mt-3">
                <div class="card-header">
                  <div class="card-title">
                    <h5>User activities <span class="badge badge-info float-right">4</span></h5>
                  </div>
                </div>
                <div class="card-body">
                </div>
              </div>
          </div>
          <div class="col-md-4">
              <div class="card mt-3 mt-md-0">
                <div class="card-header">
                  <div class="card-title">
                    <h5>Notepad <span class="badge badge-info float-right">4</span></h5>
                  </div>
                </div>
                <div class="card-body">
                </div>
              </div>
              <div class="card mt-3">
                <div class="card-header">
                  <div class="card-title">
                    <h5>Address book <span class="badge badge-info float-right"><?php echo count($arr['address']) ?></span></h5>
                  </div>
                </div>
                <div class="card-body p-0">
                  <table class="table table-sm table-striped">
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
                          <td> <button type="button" class="btn btn-info topTip" title="view user info" name="usrInfo" data-toggle="popusr" data-usrinfo="<?php echo $info; ?>"><i class="fas fa-info"></i></button> </td>
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
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
    <script src="js/dashboard.js"></script>
  </body>
</html>
