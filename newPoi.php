<?php
session_start();
if (!isset($_SESSION['id'])) { header("Location: login.php"); }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require('inc/metatag.php'); ?>
    <?php require('css/css.php'); ?>
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/tagmanager.css">
  </head>
  <body>
    <?php require('inc/mainHeader.php'); ?>
    <?php require('inc/userNav.php'); ?>
    <div class="mainSection">
      <div class="container bg-white rounded p-3">
        <div class="row">
          <div class="col">
            <h3 class="border-bottom">Add new record</h3>
            <p class="font-weight-bold">* mandatory field</p>
          </div>
        </div>
        <form class="form" action="newPoiAdd.php" method="post" name="addPoiForm">
          <div id="localizationWrap" class="mb-3">
            <div class="form-row">
              <div class="col p-2 mb-3 bg-light">
                <h5>Localization</h5>
              </div>
            </div>
            <div class="form-row">
              <div class="col-lg-4">
                <div class="form-group">
                  <label for="state" class="font-weight-bold">*State</label>
                  <select class="form-control form-control-sm mb-1" id="state" name="state" required>
                    <option value="" selected disabled>--select state--</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label for="land">Land</label>
                  <select class="form-control form-control-sm mb-1" id="land" name="land" disabled>
                    <option value="">--select land--</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label for="municipality">Municipality</label>
                  <select class="form-control form-control-sm mb-1" id="municipality" name="municipality" disabled>
                    <option value="">--select municipality--</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-lg-4">
                <div class="form-group">
                  <label for="coo" class="d-block font-weight-bold">*Coordinates</label>
                  <input type="number" class="form-control form-control-sm mb-1 d-inline-block" name="lon" placeholder="--longitude--" step="0.01" min="10" max="12" style="width:49%" required>
                  <input type="number" class="form-control form-control-sm mb-1 d-inline-block" name="lat" placeholder="--latitude--" step="0.01" min="40" max="50" style="width:49%" required>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label for="toponym">Toponym</label>
                  <input type="text" class="form-control form-control-sm" id="toponym" name="toponym" value="" placeholder="--toponym--">
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label for="address">Address</label>
                  <input type="text" class="form-control form-control-sm" id="address" name="address" value="" placeholder="--address--">
                </div>
              </div>
            </div>
          </div>
          <div id="mainInfoWrap" class="mb-3">
            <div class="form-row">
              <div class="col p-2 mb-3 bg-light">
                <h5>Main information</h5>
              </div>
            </div>
            <div class="form-row">
              <div class="col-lg-4">
                <div class="form-group mb-1">
                  <label for="name" class="font-weight-bold">*Name</label>
                  <input type="text" id="name" name="name" class="form-control form-control-sm" placeholder="--name--" value="" required>
                </div>
                <div class="form-group mb-1">
                  <label for="type" class="font-weight-bold">*Type</label>
                  <select class="form-control form-control-sm" id="type" name="type">
                    <option value="" selected disabled required>--select type--</option>
                  </select>
                </div>
                <div class="form-group mb-1">
                  <label for="cronostart" class="font-weight-bold">*From</label>
                  <select class="form-control form-control-sm" id="cronostart" name="cronostart">
                    <option value="" selected disabled required>--select start chronology--</option>
                  </select>
                </div>
                <div class="form-group mb-1">
                  <label for="cronoend">To</label>
                  <select class="form-control form-control-sm" id="cronoend" name="cronoend">
                    <option value="" selected>--select end chronology--</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="period">Period</label>
                  <input type="text" id="period" name="period" class="form-control form-control-sm" placeholder="--define chronology--" value="">
                </div>
              </div>
              <div class="col-lg-8">
                <div class="form-group">
                  <label for="info" class="font-weight-bold">*Info</label>
                  <textarea id="info" name="info" class="form-control form-control-sm" rows="14" placeholder="--insert a brief descritpion --" required></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="tagWrap mb-3">
            <div class="form-row">
              <div class="col p-2 mb-3 bg-light">
                <h5>Add Tags</h5>
              </div>
            </div>
            <div class="form-row mb-2">
              <div class="col">
                <p class="font-weight-bold m-0">* you must enter at least one tag</p>
                <small>start to write, if term is already present in database select it from list then press enter to confirm the choice. If term is not present write it down and press enter to confirm the choice</small>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-2">
                <input type="search" value="" placeholder="--write a term--" class="form-control form-control-sm tm-input">
              </div>
              <div class="col-md-10">
                <div class="tagContainer"></div>
              </div>
            </div>
          </div>
          <div class="biblioWrap mb-3">
            <div class="form-row">
              <div class="col p-2 mb-3 bg-light">
                <h5>Add Bibliography</h5>
              </div>
            </div>
            <div class="form-row mb-2">
              <div class="col">
                <p class="font-weight-bold m-0">* you must enter at least one bibliographic reference</p>
              </div>
            </div>
            <div class="form-row">
              <div class="col">
                <select class="form-control form-control-sm" name="biblioList">
                  <option value="" disabled selected>--select a reference from list--</option>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="col">
                <ul class="biblioContainer list-group list-group-flush"></ul>
              </div>
            </div>
          </div>
          <div class="relatedRecordWrap mb-3">
            <div class="form-row">
              <div class="col p-2 mb-3 bg-light">
                <h5>Add related records</h5>
              </div>
            </div>
            <div class="form-row">
              <div class="col">
                <select class="form-control form-control-sm" name="recordList">
                  <option value="" disabled selected>--select a record from list--</option>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="col">
                <ul class="relatedContainer list-group list-group-flush"></ul>
              </div>
            </div>
          </div>
          <div class="form-row py-3 bg-light">
            <div class="col">
              <p class="m-0 font-weight-bold">Do you want to save the record as a draft?</p>
              <small>unchek if you want to save the record as "complete".<br>A record marked as "complete" means that it is ready to be validated by a supervisor and can no longer be modified.
to change a "complete" record must be unlocked by a supervisor and change the status to draft</small>
              <div class="custom-control custom-checkbox my-2">
                <input type="checkbox" class="custom-control-input mx-2" id="draftCheck" name="draft" value="true" checked>
                <label class="custom-control-label cursor" for="draftCheck">save as draft</label>
              </div>
            </div>
          </div>
          <div class="form-row mt-3 pt-3 border-top">
            <div class="form-group">
              <button type="submit" id="submit" class="btn btn-primary btn-sm">save record</button>
            </div>
          </div>
        </form>
      </div>

    </div>
    <?php require('inc/mainFooter.php'); ?>
    <?php require('lib/lib.php'); ?>
    <script src="lib/jquery-ui.js"></script>
    <script src="lib/tagmanager.js" charset="utf-8"></script>
    <script type="text/javascript">
    geodatiList('state');
    typeList()
    getval(1,crono);
    $('[name=state]').on('click', function() {
      geodatiList('land','state',$(this).val());
      $('[name=land]').prop('disabled',false);
    });
    $('[name=land]').on('click', function() {
      geodatiList('municipality','land',$(this).val());
      $('[name=municipality]').prop('disabled',false);
    });
    $("[name=cronostart]").on('click',function(){ getval($(this).val(),cronoend); })
    $(".tm-input").tagsManager({
        prefilled: '',
        AjaxPush: "class/addTag.php",
        hiddenTagListName: 'tag',
        deleteTagsOnBackspace: false,
        tagsContainer: '.tagContainer',
        tagCloseIcon: '×',
      }).autocomplete({
        source: "json/tags.php",
        minLength:2
      })

      $.getJSON('json/biblio.php',function(data){
        data.forEach(function(v){
          biblio = v.title.substring(0,100)+'... , '+v.main+', ('+v.year+')'
          $("<option/>",{value:v.id,text:biblio}).attr({'data-text':v.title,'data-author':v.main,'data-year':v.year}).appendTo('[name=biblioList]');
        })
      })
      $("body").on('click', '[name=biblioList]', function() {
        opt = $(this).find("option:selected");
        id = $(this).val()
        if(id){
          if($("#biblio"+id).length > 0){
            alert('Warning! An item with this title is already present in list!')
          }else {
            li = $("<li/>",{id:'biblio'+id, class:'list-group-item cursor', title:'click to remove item'})
            .appendTo('.biblioContainer')
            .tooltip({boundary:'window', container:'body', placement:'top', trigger:'hover' })
            .on('click',function(){$(this).remove()})

            p = $("<small/>",{class:'m-0'}).html('<i class="far fa-times-circle fa-fw text-danger"></i>'+opt.data('text')+', <strong>'+opt.data('author')+'</strong> ('+opt.data('year')+')').appendTo(li)
            input = $("<input/>",{type:'hidden',name:'biblio[]',value:id}).appendTo(li)
          }
        }
        $("[name=biblioList]")[0].selectedIndex = 0;
      });

      $.getJSON('json/record.php',function(data){
        data.forEach(function(v){
          record = v.id
          record += ' '+v.state
          if(v.land){record += ', '+v.land}
          if(v.municipality){record += ', '+ v.municipality;}
          record += ', '+ v.name;
          record += ', '+ v.type;
          $("<option/>",{value:v.id,text:record}).appendTo('[name=recordList]');
        })
      })
      $("body").on('click', '[name=recordList]', function() {
        opt = $(this).find("option:selected");
        id = $(this).val()
        if(id){
          if($("#record"+id).length > 0){
            alert('Warning! A record with this name is already present in list!')
          }else {
            li = $("<li/>",{id:'record'+id, class:'list-group-item cursor', title:'click to remove item'})
            .appendTo('.relatedContainer')
            .tooltip({boundary:'window', container:'body', placement:'top', trigger:'hover' })
            .on('click',function(){$(this).remove()})

            p = $("<small/>",{class:'m-0'}).html('<i class="far fa-times-circle fa-fw text-danger"></i>'+opt.text()).appendTo(li)
            input = $("<input/>",{type:'hidden',name:'related[]',value:id}).appendTo(li)
          }
        }
        $("[name=recordList]")[0].selectedIndex = 0;
      });
      $("#submit").on('click',function(e){
        if (!$("[name=tag]").val() || $("[name=tag]").val()=='') {
          alert("Warning! You must enter at least one tag");
          e.preventDefault()
          return false
        }
        if ($(".biblioContainer>li").length === 0) {
          alert("Warning! You must enter at least one bibliographic reference");
          e.preventDefault()
          return false
        }
        $("[name=addPoiForm]").submit();
      })

      function geodatiList(table,filter,value){
        geodati={}
        geodati.table=table;
        if (filter && filter !== '') {geodati.filter=filter}
        if (value && value !== '') {geodati.value=value}
        $.getJSON('json/geodati.php',geodati,function(data){
          data.forEach(function(v){
            $("<option/>",{value:v.id,text:v.name}).appendTo('[name='+table+']');
          })
        })
      }
    </script>
  </body>
</html>
