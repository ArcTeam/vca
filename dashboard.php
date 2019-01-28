<?php
session_start();
require("class/dashboard.class.php");
$dash = new Dashboard($_SESSION['class']);
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
    <style media="screen">
      .table-sm{font-size: 12px;}
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
                  <h5>Notepad <button type="button" class="btn btn-info btn-sm p-1 float-right" name="notedAdd"> <i class="fas fa-plus"></i> </button> </h5>
                </div>
              </div>
              <div class="card-body">
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
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
    <script src="js/dashboard.js"></script>
  </body>
  <?php require('lib/lib.php'); ?>
</html>
