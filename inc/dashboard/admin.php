<div class="col-md-6 col-lg-4 mb-3">
  <div class="card">
    <div class="card-header">
      <div class="card-title">
        <h5>Validate new records <span class="badge badge-info float-right"><?php echo count($arr['tovalidate']) ?></span></h5>
      </div>
    </div>
    <div class="card-body p-0">
      <table class="table table-sm table-striped m-0">
        <thead>
          <tr>
            <th>record</th>
            <th>type</th>
            <th>compiler</th>
            <th>data</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($arr['tovalidate'] as $record): ?>
          <tr>
            <td><?php echo $record['name'] ?></td>
            <td><?php echo $record['type'] ?></td>
            <td><?php echo $record['utente'] ?></td>
            <td><?php echo $record['date'] ?></td>
            <td> <a href="poi.php?poi=<?php echo $record['id'] ?>"><i class="fa fa-link"></i></a></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="col-md-6 col-lg-5 mb-3">
  <div class="card">
    <div class="card-header">
      <div class="card-title">
        <h5>Last approved records</h5>
      </div>
    </div>
    <div class="card-body p-0">
      <table class="table table-sm table-striped m-0">
        <thead>
          <tr>
            <th>record</th>
            <th>type</th>
            <th>compiler</th>
            <th>supervisor</th>
            <th>data</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($arr['approved'] as $record): ?>
          <tr>
            <td><?php echo $record['name'] ?></td>
            <td><?php echo $record['type'] ?></td>
            <td><?php echo $record['compiler'] ?></td>
            <td><?php echo $record['supervisor'] ?></td>
            <td><?php echo $record['date'] ?></td>
            <td> <a href="poi.php?poi=<?php echo $record['id'] ?>"><i class="fa fa-link"></i></a></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
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
                  <button type="submit" class="btn btn-link btn-sm text-dark topTip" name="userid" title="view request" value="<?php echo $value['id']; ?>" style="font-size:12px;"><i class="fas fa-link"></i></button>
                </form>
              </td>
            </tr>
          <?php }; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
