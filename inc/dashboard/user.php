<div class="col-md-6 col-lg-4 mb-3">
  <div class="card">
    <div class="card-header">
      <div class="card-title">
        <h5>Draft record <span class="badge badge-info float-right"><?php echo count($arr['draft']); ?></span></h5>
      </div>
    </div>
    <div class="card-body p-0">
      <?php if (count($arr['draft'])==0) {?>
        <ul class="list-group list-group-flush m-0" id="noteList">
          <li class='list-group-item text-center'>No draft available</li>
        </ul>
      <?php }else{ ?>
      <table class="table table-sm table-striped m-0">
        <thead>
          <tr>
            <th>record</th>
            <th>type</th>
            <th>data</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($arr['draft'] as $record): ?>
          <tr>
            <td><?php echo $record['name'] ?></td>
            <td><?php echo $record['type'] ?></td>
            <td><?php echo $record['date'] ?></td>
            <td> <a href="modPoi.php?poi=<?php echo $record['id'] ?>"><i class="fa fa-link"></i></a></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php } ?>
    </div>
  </div>
</div>
<div class="col-md-6 col-lg-4 mb-3">
  <div class="card">
    <div class="card-header">
      <div class="card-title">
        <h5>Record awaiting approval <span class="badge badge-info float-right"><?php echo count($arr['tovalidate']); ?></span></h5>
      </div>
    </div>
    <div class="card-body p-0">
      <?php if (count($arr['tovalidate'])==0) {?>
        <ul class="list-group list-group-flush m-0" id="noteList">
          <li class='list-group-item text-center'>No draft available</li>
        </ul>
      <?php }else{ ?>
      <table class="table table-sm table-striped m-0">
        <thead>
          <tr>
            <th>record</th>
            <th>type</th>
            <th>data</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($arr['tovalidate'] as $record): ?>
          <tr>
            <td><?php echo $record['name'] ?></td>
            <td><?php echo $record['type'] ?></td>
            <td><?php echo $record['date'] ?></td>
            <td> <a href="modPoi.php?poi=<?php echo $record['id'] ?>"><i class="fa fa-link"></i></a></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php } ?>
    </div>
  </div>
</div>
<div class="col-md-6 col-lg-4 mb-3">
  <div class="card">
    <div class="card-header">
      <div class="card-title">
        <h5>My record archive <span class="badge badge-info float-right"><?php echo count($arr['approved']); ?></span></h5>
      </div>
    </div>
    <div class="card-body p-0">
      <table class="table table-sm table-striped m-0">
        <thead>
          <tr>
            <th>record</th>
            <th>type</th>
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
