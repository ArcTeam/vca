<div class="container-fluid">
  <div class="row">
    <div class="col-md-6 col-lg-4 mb-3">
      <div class="card">
        <div class="card-header">
          <div class="card-title">
            <h5>Draft record<span class="badge badge-info float-right"></span></h5>
          </div>
        </div>
        <div class="card-body">
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-3">
      <div class="card">
        <div class="card-header">
          <div class="card-title">
            <h5>Record awaiting approval <span class="badge badge-info float-right"></span></h5>
          </div>
        </div>
        <div class="card-body">
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-3">
      <div class="card">
        <div class="card-header">
          <div class="card-title">
            <h5>My record archive <span class="badge badge-info float-right"></span></h5>
          </div>
        </div>
        <div class="card-body">
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12 col-lg-6 mb-3">
      <div class="card">
        <div class="card-header">
          <div class="card-title">
            <h5>Notepad <span class="badge badge-info float-right">4</span></h5>
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
