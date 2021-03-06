<?php
session_start();
if (!isset($_SESSION['id'])) { header("Location: login.php"); }
$year = date("Y");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require('inc/metatag.php'); ?>
    <?php require('css/css.php'); ?>
  </head>
  <body>
    <?php require('inc/mainHeader.php'); ?>
    <?php require('inc/userNav.php'); ?>
    <div class="mainSection">
      <div class="container bg-white rounded p-3">
        <div class="row">
          <div class="col">
            <h3 class="border-bottom">Add new bibliography</h3>
            <p class="font-weight-bold">* mandatory field</p>
          </div>
        </div>
        <form class="form" action="newBiblioAdd.php" method="post" name="addBiblioForm">
          <input type="hidden" name="compiler" value="<?php echo $_SESSION['id']; ?>">
          <div class="form-row mb-3">
            <div class="col-12 col-md-3 col-lg-2">
              <label for="type" class="font-weight-bold">* Publication type:</label>
            </div>
            <div class="col-12 col-md-9 col-lg-10">
              <select class="form-control w-auto" name="type" id="type" required>
                <option value="" selected disabled>-- select publication type --</option>
              </select>
            </div>
          </div>
          <div class="form-row mb-3">
            <div class="col-12 col-md-3 col-lg-2">
              <label for="title" class="font-weight-bold">* Title:</label>
            </div>
            <div class="col-12 col-md-9 col-lg-10">
              <input type="text" name="title" id="title" value="" class="form-control" placeholder="-- insert title --" required>
            </div>
          </div>
          <div class="form-row mb-3">
            <div class="col-12 col-md-3 col-lg-2">
              <label for="main" class="font-weight-bold">* Main author:</label>
            </div>
            <div class="col-12 col-md-9 col-lg-10">
              <input type="text" name="main" id="main" value="" class="form-control" placeholder="-- main author --" required>
            </div>
          </div>
          <div class="form-row mb-3">
            <div class="col-12 col-md-3 col-lg-2">
              <label for="secondary">Secondary authors:</label>
            </div>
            <div class="col-12 col-md-9 col-lg-10">
              <input type="text" name="secondary" id="secondary" value="" placeholder="-- other authors --" class="form-control">
            </div>
          </div>
          <div class="form-row mb-3">
            <div class="col-12 col-md-3 col-lg-2">
              <label for="year">Publication year:</label>
            </div>
            <div class="col-12 col-md-9 col-lg-10">
              <input type="number" min="1500" max="<?php echo $year; ?>" name="year" id="year" value="<?php echo $year; ?>" class="form-control w-auto">
            </div>
          </div>
          <div class="form-row mb-3">
            <div class="col-12 col-md-3 col-lg-2">
              <label for="publisher">Publisher:</label>
            </div>
            <div class="col-12 col-md-9 col-lg-10">
              <input type="text" name="publisher" id="publisher" value="" class="form-control" placeholder="-- publisher --">
            </div>
          </div>
          <div class="form-row mb-3">
            <div class="col-12 col-md-3 col-lg-2">
              <label for="place">Place:</label>
            </div>
            <div class="col-12 col-md-9 col-lg-10">
              <input type="text" name="place" id="place" value="" class="form-control" placeholder="-- where the book was published --">
            </div>
          </div>
          <div class="articleInfoWrap">
            <div class="form-row mb-3">
              <div class="col-12 col-md-3 col-lg-2">
                <label for="journal" class="font-weight-bold">* Journal / proceedings:</label>
              </div>
              <div class="col-12 col-md-9 col-lg-10">
                <input type="text" name="journal" id="journal" value="" class="form-control" placeholder="-- publication in which the article is present --">
              </div>
            </div>
            <div class="form-row mb-3">
              <div class="col-12 col-md-3 col-lg-2">
                <label for="volume" class="font-weight-bold">* Volume / number:</label>
              </div>
              <div class="col-12 col-md-9 col-lg-10">
                <input type="text" name="volume" id="volume" value="" class="form-control w-50" placeholder="-- publication volume or number --">
              </div>
            </div>
            <div class="form-row mb-3">
              <div class="col-12 col-md-3 col-lg-2">
                <label for="page" class="font-weight-bold">* Page:</label>
              </div>
              <div class="col-12 col-md-9 col-lg-10">
                <input type="text" name="page" id="page" value="" class="form-control w-auto" placeholder="-- e.g. 130, 15-40 --">
              </div>
            </div>
          </div>
          <div class="form-row mb-3">
            <div class="col-12 col-md-3 col-lg-2">
              <label for="info">Abstract:</label>
            </div>
            <div class="col-12 col-md-9 col-lg-10">
              <textarea name="info" class="form-control" rows="4" placeholder="-- brief description of publication --"></textarea>
            </div>
          </div>
          <div class="form-row mb-3">
            <div class="col-12 col-md-3 col-lg-2">
              <label for="exhibition">Exhibition:</label>
            </div>
            <div class="col-12 col-md-9 col-lg-10">
              <input type="text" name="exhibition" id="exhibition" value="" class="form-control" placeholder="-- where the publication is kept --">
            </div>
          </div>
          <div class="form-row mb-3">
            <div class="col-12 col-md-3 col-lg-2">
              <label>Downloadable:</label>
            </div>
            <div class="col-12 col-md-9 col-lg-10">
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="downloadFalse" name="downloadable" value="false" class="custom-control-input" checked>
                <label class="custom-control-label cursor" for="downloadFalse">no</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="downloadTrue" name="downloadable" class="custom-control-input">
                <label class="custom-control-label cursor" for="downloadTrue">yes</label>
              </div>
            </div>
          </div>
          <div class="downloadInfoWrap">
            <div class="form-row mb-3">
              <div class="col-12 col-md-3 col-lg-2">
                <label for="url" class="font-weight-bold">* Url:</label>
              </div>
              <div class="col-12 col-md-9 col-lg-10">
                <input type="url" name="url" id="url" value="" class="form-control" placeholder="-- e.g. http://www.publicationsite.com --">
              </div>
            </div>
            <div class="form-row mb-3">
              <div class="col-12 col-md-3 col-lg-2">
                <label for="license">License:</label>
              </div>
              <div class="col-12 col-md-9 col-lg-10">
                <input type="text" name="license" id="license" value="" class="form-control" placeholder="-- e.g. CC-BY-SA or CC0 or closed license --">
              </div>
            </div>
          </div>
          <div class="form-row mb-3">
            <div class="col-12 col-md-3 col-lg-2">
              <label for="readingLlist">Reading:</label>
            </div>
            <div class="col-12 col-md-9 col-lg-10">
              <div class="alert alert-info alert-dismissible fade show" role="alert">
                <small><i class="fas fa-lightbulb"></i> select other publications in the database that deal with the same topic or that are useful to read</small>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <select class="form-control" id="readingList">
                <option value="">-- select reading publication --</option>
              </select>
              <ul class="readingContainer list-group list-group-flush mt-3"></ul>
            </div>
          </div>
          <div class="form-row mb-3">
            <div class="col-12 col-md-3 col-lg-2"></div>
            <div class="col-12 col-md-9 col-lg-10">
              <button type="submit" id="saveBiblio" class="btn btn-primary">save record</button>
            </div>
          </div>
        </form>
      </div>

    </div>
    <?php require('inc/mainFooter.php'); ?>
    <?php require('lib/lib.php'); ?>
    <script type="text/javascript">
      $(".articleInfoWrap, .downloadInfoWrap").hide()
      $("[name=downloadable]").on('change', function() {
        // $(".downloadInfoWrap").slideToggle('fast')
        t = $(this).val()
        if (t == 'false') {
          $(".downloadInfoWrap").slideUp('fast').find('#url').prop('required', false)
        }else {
          $(".downloadInfoWrap").slideDown('fast').find('#url').prop('required', true)
        }
      });
      $.getJSON('json/publicationType.php', function(json, textStatus) {
        json.forEach(function(type,i){ $("<option/>",{value:type.id,text:type.type}).appendTo('#type') })
      });
      $.getJSON('json/biblio.php', function(json, textStatus) {
        json.forEach(function(biblio,i){
          optionText = biblio.title.substring(0, 100) + ' ... ,' + biblio.main + ', (' + biblio.year + ')'
          $("<option/>",{value:biblio.id,text:optionText}).attr({'data-text':biblio.title,'data-author':biblio.main,'data-year':biblio.year}).appendTo('#readingList')
        })
      });

      $("[name=type]").on('change', function() {
        t = $(this).val()
        if (t == 1) {
          $(".articleInfoWrap").slideUp('fast').find('input').prop('required', false)
        }else {
          $(".articleInfoWrap").slideDown('fast').find('input').prop('required', true)
        }
      });

      $("body").on('click', '#readingList', function() {
        opt = $(this).find("option:selected");
        id = $(this).val()
        if(id){
          if($("#reading"+id).length > 0){
            alert('Warning! An item with this title is already present in list!')
          }else {
            li = $("<li/>",{id:'reading'+id, class:'list-group-item cursor', title:'click to remove item'})
            .appendTo('.readingContainer')
            .tooltip({boundary:'window', container:'body', placement:'top', trigger:'hover' })
            .on('click',function(){
              $(this).tooltip('hide')
              $(this).remove()
            })

            p = $("<small/>",{class:'m-0'}).html('<i class="far fa-times-circle fa-fw text-danger"></i>'+opt.data('text')+', <strong>'+opt.data('author')+'</strong> ('+opt.data('year')+')').appendTo(li)
            input = $("<input/>",{type:'hidden',name:'reading[]',value:id}).appendTo(li)
          }
        }
        $("#readingList")[0].selectedIndex = 0;
      });

    </script>
  </body>
</html>
