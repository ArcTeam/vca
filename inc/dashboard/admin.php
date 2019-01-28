<div class="container-fluid">
  <div class="row">
    <div class="col-md-6 col-lg-3 mb-3">
      <div class="card">
        <div class="card-header">
          <div class="card-title">
            <h5>Check new records <span class="badge badge-info float-right">4</span></h5>
          </div>
        </div>
        <div class="card-body">
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-3">
      <div class="card">
        <div class="card-header">
          <div class="card-title">
            <h5>Last approved records <span class="badge badge-info float-right">4</span></h5>
          </div>
        </div>
        <div class="card-body">
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-3">
      <div class="card">
        <div class="card-header">
          <div class="card-title">
            <h5>New  account request <span class="badge badge-info float-right"><?php echo count($arr['request']) ?></span></h5>
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-sm table-striped m-0">
            <tbody>
              <?php foreach ($arr['request'] as $key => $value){ ?>
                <tr>
                  <td><?php echo $value['last_name']." ".$value['first_name']; ?></td>
                  <td><?php echo $value['data']; ?></td>
                  <td>
                    <form action="request.php" method="post">
                      <button type="submit" class="btn btn-link btn-sm text-dark topTip" name="userid" title="view request" value="<?php echo $value['id']; ?>"><i class="fas fa-link"></i></button>
                    </form>
                  </td>
                </tr>
              <?php }; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-3">
      <div class="card">
        <div class="card-header">
          <div class="card-title">
            <h5>User activities <span class="badge badge-info float-right">4</span></h5>
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
