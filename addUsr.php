<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['class'] < 3) { header("Location: login.php"); }
require ("class/user.class.php");
$obj = new User();
$class = $obj->usrClass();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require('inc/metatag.php'); ?>
    <?php require('css/css.php'); ?>
    <style media="screen">
      .userGrant{padding:14px 10px; border: 1px solid #ced4da; border-radius: .25rem;}
    </style>
  </head>
  <body>
    <?php require('inc/mainHeader.php'); ?>
    <?php require('inc/userNav.php'); ?>
    <div class="mainSection">
      <div class="container">
        <div class="row">
          <div class="col">
            <form class="mx-auto p-5 bg-white shadow" name="addUsrForm" action="addUsrRes.php" method="post">
              <h3 class="border-bottom">Create new user</h3>
              <h6 class="m-0 p-0 text-muted">* mandatory field</h6>
              <div class="form-row mt-3">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="email">*email</label>
                    <input type="email" name="email" id="email" value=""  class="form-control" placeholder="email (required)" required>
                    <small class="text-danger" id="emailError">Email already present.<br>Check if there is a pending request or if already exists an user with the same email.</small>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="first">*first name</label>
                    <input type="text" name="first" id="first" value=""  class="form-control" placeholder="First name" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="last">*last name</label>
                    <input type="text" name="last" id="last" value=""  class="form-control" placeholder="Last name" required>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="address">*address</label>
                    <input type="text" name="address" id="address" value=""  class="form-control"  placeholder="Address" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="mobile">mobile number</label>
                    <input type="text" name="cell" class="form-control" value="" placeholder="mobile number with international prefix">
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="class">*user class</label>
                    <ul class='userGrant'>
                      <?php
                      foreach ($class as $key => $opt) {
                        $checked = $opt['id'] === 1 ? 'checked':'';
                        echo "<li>";
                        echo "<label for='".$opt['class']."' class='cursor tip' data-placement='right' title='".$opt['def']."'>";
                        echo "<input type='radio' class='mr-3' id='".$opt['class']."' name='class' value='".$opt['id']."' ".$checked.">";
                        echo $opt['class'];
                        echo "</label>";
                        echo "</li>";
                      }
                      ?>
                    </ul>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label for="description">description</label>
                    <textarea name="description" id="description" rows="6" class="form-control" placeholder="Insert a brief description"></textarea>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col">
                  <div class="form-group">
                    <button type="submit" id="update" class="btn btn-primary">create account</button>
                    <a href="dashboard.php" class="btn btn-outline-secondary">cancel</a>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php require('inc/mainFooter.php'); ?>
    <?php require('lib/lib.php'); ?>
    <script type="text/javascript">
      dati['oop']={file:'db.class.php',classe:'Db',func:'checkEmail'}
      $("#emailError").hide();
      $("[name=email]").on('change',function(){
        dati['dati']={email:$(this).val()}
        getdata(dati,function(data){
          if (data > 0) {
            $("[name=email]").addClass('is-invalid');
            $("#emailError").fadeIn(500);
          }else {
            $("[name=email]").removeClass('is-invalid');
            $("#emailError").fadeOut(500);
          }
        })
      })
      $("#update").on('click', function(e){
        dati['dati']={email:$("[name=email]").val()}
        getdata(dati,function(data){
          if (data > 0) {
            e.preventDefault();
            $("[name=email]").addClass('is-invalid');
            $("#emailError").fadeIn(500);
            console.log('no submit');
          }else {
            console.log('submit');
            $("[name=email]").removeClass('is-invalid');
            $("#emailError").fadeOut(500);
            form = $("form[name=addUsrForm]");
            isvalidate = $(form)[0].checkValidity();
            //if (isvalidate) { form.submit() }
          }
        })
      })
    </script>
  </body>
</html>
