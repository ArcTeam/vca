initmap()
var punti;
window.addEventListener("orientationchange", function() {
  window.setTimeout(function() {
    $('#recordTable').DataTable().destroy();
    initTable('#recordTable')
  }, 200);
}, false);
