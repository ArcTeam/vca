<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require('inc/metatag.php'); ?>
    <?php require('css/css.php'); ?>
    <style media="screen">
      @media (max-width: 767px) {
        .dataTables_length,.dataTables_info{text-align:center !important;}
        .dataTables_info{ padding-bottom: 0.85em;}
        ul.pagination{justify-content: center !important;}
      }
    </style>
  </head>
  <body>
    <?php require('inc/mainHeader.php'); ?>
    <?php require('inc/userNav.php'); ?>
    <div class="mainSection">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="filter-input">

            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <table class="table bg-white" id="recordTable">
              <thead>
                <tr>
                  <th class="all" width="150px">Main author</th>
                  <th class="all">Year</th>
                  <th class="min-tablet">Title</th>
                  <th class="min-tablet">Type</th>
                  <th class="all"></th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <?php require('inc/mainFooter.php'); ?>
    <?php require('lib/lib.php'); ?>
    <script type="text/javascript">
    $.getJSON('json/biblio.php',function(data){
      table = $("#recordTable>tbody");
      data.forEach(function(v,k){
        tr=$("<tr/>").appendTo(table);
        link = $("<a/>",{href:'biblioItem.php?item='+v.id, class:'btn btn-sm btn-light border-0 bg-white text-success', title:'view complete item data'}).tooltip({boundary:'window', container:'body', placement:'top', trigger:'hover'})
        ico = $("<i/>",{class:'fas fa-link'}).appendTo(link)
        $("<td/>",{text:v.main}).appendTo(tr);
        $("<td/>",{text:v.year}).appendTo(tr);
        $("<td/>",{text:v.title}).appendTo(tr);
        $("<td/>",{text:v.type}).appendTo(tr);
        $("<td/>").append(link).appendTo(tr);
      })
      tableBiblioInit('#recordTable')
    })
    function tableBiblioInit(el){
      table = $(el).removeAttr('width').DataTable({
        retrieve:true,
        dom:'<"col-12 col-md-6 d-inline-block"l>'+ //righe visibili
            '<"col-12 col-md-6 d-inline-block"f>'+ //filtro ricerca
            't'+ //tabella
            '<"col-12 col-md-4 d-inline-block"i>'+ //informazioni numero record
            '<"col-12 col-md-8 d-inline-block"p>' //pagination
        ,
        responsive: true,
        order: [[ 2, "asc" ]],
        scrollCollapse: true,
        paging: true,
        oLanguage: {
          sInfo: "_MAX_ records",
          sInfoFiltered: " / _TOTAL_ filtered",
          sInfoEmpty: "No record to show",
          sSearch: "_INPUT_",
          sSearchPlaceholder: "Search records..."
        }
      });
    }
    window.addEventListener("orientationchange", function() {
      window.setTimeout(function() {
        $('#recordTable').DataTable().destroy();
        tableBiblioInit('#recordTable')
      }, 200);
    }, false);
    </script>
  </body>
</html>
