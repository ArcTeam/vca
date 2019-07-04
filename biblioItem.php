<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['class'] < 3) { header("Location: login.php"); }
require("class/biblio.class.php");
$obj = new Biblio;
$item = $obj->bibliography($_GET['item']);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require('inc/metatag.php'); ?>
    <?php require('css/css.php'); ?>
    <style media="screen">
      .card>ul>li>span:first-child{width:200px;}
    </style>
  </head>
  <body>
    <?php require('inc/mainHeader.php'); ?>
    <?php require('inc/userNav.php'); ?>
    <div class="mainSection">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><?php echo $item[0]['title']; ?></h3>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <span class="d-inline-block font-weight-bold">Type:</span>
                  <span><?php echo $item[0]['type']; ?></span>
                </li>
                <li class="list-group-item">
                  <span class="d-inline-block font-weight-bold">Main author:</span>
                  <span><?php echo $item[0]['main']; ?></span>
                </li>
                <?php if ($item[0]['secondary']) {?>
                <li class="list-group-item">
                  <span class="d-inline-block font-weight-bold">Secondary authors:</span>
                  <span><?php echo $item[0]['secondary']; ?></span>
                </li>
                <?php } ?>
                <li class="list-group-item">
                  <span class="d-inline-block font-weight-bold">Year:</span>
                  <span><?php echo $item[0]['year']; ?></span>
                </li>
                <?php if ($item[0]['typeid'] > 1) {?>
                  <li class="list-group-item">
                    <span class="d-inline-block font-weight-bold">Appears in:</span>
                    <span><?php echo $item[0]['journal'].", ".$item[0]['volume'].", ".$item[0]['page']; ?></span>
                  </li>
                <?php } ?>
                <?php if ($item[0]['publisher']) {?>
                <li class="list-group-item">
                  <span class="d-inline-block font-weight-bold">Publisher:</span>
                  <span><?php echo $item[0]['publisher']; ?></span>
                </li>
                <?php } ?>
                <?php if ($item[0]['place']) {?>
                <li class="list-group-item">
                  <span class="d-inline-block font-weight-bold">Place:</span>
                  <span><?php echo $item[0]['place']; ?></span>
                </li>
                <?php } ?>
                <?php if ($item[0]['info']) {?>
                <li class="list-group-item">
                  <span class="d-inline-block font-weight-bold">Abstract:</span>
                  <span><?php echo $item[0]['info']; ?></span>
                </li>
                <?php } ?>
                <?php if ($item[0]['exhibition']) {?>
                <li class="list-group-item">
                  <span class="d-inline-block font-weight-bold">Available at:</span>
                  <span><?php echo $item[0]['exhibition']; ?></span>
                </li>
                <?php } ?>
                <?php if ($item[0]['downloadable'] == true) {?>
                <li class="list-group-item">
                  <span class="d-inline-block font-weight-bold">Resource link:</span>
                  <span><a href="<?php echo $item[0]['url']; ?>" target="_blank" title="resource available for download"><?php echo $item[0]['url']; ?></a></span>
                </li>
                <li class="list-group-item">
                  <span class="d-inline-block font-weight-bold">License:</span>
                  <span><?php echo $item[0]['license']; ?></span>
                </li>
                <?php } ?>
              </ul>
              <?php if(count($item['readingList']) > 0){ ?>
              <div class="card-body">
                <h4 class="font-weight-bold">Related bibliography</h4>
                <ol style="list-style: decimal outside;">
                  <?php foreach ($item['readingList'] as $key => $value) {
                    echo "<li class='mb-3'><a href='biblioItem.php?item=".$value['id']."' title='view resource'>".$value['main'].", ".$value['year'].", ".$value['title']."</a></li>";
                  } ?>
                </ol>
              </div>
            <?php } ?>
              <?php if(isset($_SESSION['id'])){ ?>
              <div class="card-footer">
                <a href="updateBiblio.php?item=<?php echo $_GET['item']; ?>" class="btn btn-primary updateItem">update</a>
                <button type="button" class="btn btn-danger" name="delItem" value="<?php echo $_GET['item']; ?>">delete</button>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php require('inc/mainFooter.php'); ?>
    <?php require('lib/lib.php'); ?>
    <script type="text/javascript">
      $("[name=delItem]").on('click', function() {
        if (confirm('You are deleting a record!\nIf you confirm, the record will be permanently deleted and the data will no longer be available.')) {
          itemDel($(this).val())
        }
      });
      function itemDel(id){
        dati['oop']={file:'biblio.class.php',classe:'Biblio',func:'itemDel'}
        dati['dati']={item:id}
        $.ajax({ url: connector, type: type, dataType: dataType, data: dati})
        .done(function(data) {
          if (data && data=='ok') {
            alert("Success! Record permanently deleted");
            window.location.href='biblio.php';
          }else {
            alert("Error! Something gone wrong!");
          }
        })
        .fail(function(response) { alert("error: "+response) });
      }
    </script>
  </body>
</html>
