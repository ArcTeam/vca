var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  maxZoom: 13
});
var latlng = L.latLng(-16.2000651, 116.7991297);
var map = L.map('map', {
  center: latlng,
  layers: [tiles]
});
var markers = L.markerClusterGroup();
var markersRef = {};

var theDatax = [{
  "LocId": 2,
  "Description": "P",
  "Name": "Palmerah",
  "Longitude": "106.789816",
  "Latitude": "-6.201802"
}, {
  "LocId": 3,
  "Description": "TB",
  "Name": "Tomang Barat",
  "Longitude": "106.793547",
  "Latitude": "-6.161361"
}, {
  "LocId": 4,
  "Description": "GI",
  "Name": "Grand Indonesia",
  "Longitude": "106.821949",
  "Latitude": "-6.193060"
}, {
  "LocId": 6,
  "Description": "MTA",
  "Name": "Mall Taman Anggrek",
  "Longitude": "106.792098",
  "Latitude": "-6.178768"
}, {
  "LocId": 16,
  "Description": "GST",
  "Name": "Grand Slipi Tower",
  "Longitude": "106.798522",
  "Latitude": "-6.200823"
}, {
  "LocId": 17,
  "Description": "T2 WA",
  "Name": "Tenant 2 Wisma Asia",
  "Longitude": "106.799212",
  "Latitude": "-6.185266"
}, {
  "LocId": 18,
  "Description": "T3 WA",
  "Name": "Tenant 3 Wisma Asia",
  "Longitude": "106.799212",
  "Latitude": "-6.185266"
}, {
  "LocId": 19,
  "Description": "T4 WA",
  "Name": "Tenant 4 Wisma Asia",
  "Longitude": "106.799212",
  "Latitude": "-6.185266"
}, {
  "LocId": 20,
  "Description": "T5 WA",
  "Name": "Tenant 5 Wisma Asia",
  "Longitude": "106.793098",
  "Latitude": "-6.181768"
}]

mapReload();

function mapReload() {
  // **Clear List**
  var ul = document.getElementById("list");
  ul.innerHTML = '';
  updateMapMarkerResult(theDatax);
  map.fitBounds(markers.getBounds());
}

function updateMapMarkerResult(data) {
  markers.clearLayers();
  for (var i = 0; i < data.length; i++) {
    var a = data[i];
    var myIcon = L.divIcon({
      className: 'prop-div-icon',
      html: a.Description
    });
    var marker = L.marker(new L.LatLng(a.Latitude, a.Longitude), {
      icon: myIcon
    }, {
      title: a.Name
    });
    marker.bindPopup('<div><div class="row"><h5>Name : ' + a.Name + '</h5></div><div class="row">Lat : ' + a.Latitude + '</div><div class="row">Lng : ' + a.Longitude + '</div>' + '</div>');
    marker.on('mouseover', function(e) {
      if (this._icon != null) {
        this._icon.classList.remove("prop-div-icon");
        this._icon.classList.add("prop-div-icon-shadow");
      }
    });
    marker.on('mouseout', function(e) {
      if (this._icon != null) {
        this._icon.classList.remove("prop-div-icon-shadow");
        this._icon.classList.add("prop-div-icon");
      }
    });
    markersRef[a.LocId] = marker;
    markers.addLayer(marker);

    updateMapListResult(a, i + 1);
  }
  map.addLayer(markers);
}

function updateMapListResult(data, totalData) {
  var ul = document.getElementById("list");
  var li = document.createElement("li");
  li.setAttribute('marker', data.LocId);
  li.setAttribute('class', 'prop-li-item');
  li.appendChild(document.createTextNode(data.Name));

  // ** Event : Mouse Over **
  li.addEventListener("mouseover", function(e) {
    jQuery(this).addClass("btn-info");
    //markersRef[this.getAttribute('marker')].fire('mouseover'); // --> Trigger Marker Event "mouseover"
    var marker = markersRef[this.getAttribute('marker')];
    _fireEventOnMarkerOrVisibleParentCluster(marker, 'mouseover');
    // TODO : Trigger ClusteredMarker Event "mouseover"
  });
  // ** Event : Mouse Over **
  li.addEventListener("mouseout", function(e) {
    jQuery(this).removeClass("btn-info");
    //markersRef[this.getAttribute('marker')].fire('mouseout'); // --> Trigger Marker Event "mouseout"
    var marker = markersRef[this.getAttribute('marker')];
    _fireEventOnMarkerOrVisibleParentCluster(marker, 'mouseout');
    // TODO : Trigger ClusteredMarker Event "mouseout"
  });
  // ** Event : Click **
  li.addEventListener("click", function(e) {
    markersRef[this.getAttribute('marker')].fire('click');
  });

  ul.appendChild(li);

  var spanTotalData = document.getElementById("totalData");
  spanTotalData.innerHTML = totalData;
}


function _fireEventOnMarkerOrVisibleParentCluster(marker, eventName) {
  if (eventName === 'mouseover') {
    var visibleLayer = markers.getVisibleParent(marker);

    if (visibleLayer instanceof L.MarkerCluster) {
    	// We want to show a marker that is currently hidden in a cluster.
      // Make sure it will get highlighted once revealed.
      markers.once('spiderfied', function() {
        marker.fire(eventName);
      });
      // Now spiderfy its containing cluster to reveal it.
      // This will automatically unspiderfy other clusters.
      visibleLayer.spiderfy();
    } else {
    	// The marker is already visible, unspiderfy other clusters if
      // they do not contain the marker.
    	_unspiderfyPreviousClusterIfNotParentOf(marker);
      marker.fire(eventName);
    }
  } else {
  	// For mouseout, marker is necessarily unclustered already.
    marker.fire(eventName);
  }
}

function _unspiderfyPreviousClusterIfNotParentOf(marker) {
	// Check if there is a currently spiderfied cluster.
  // If so and it does not contain the marker, unspiderfy it.
  var spiderfiedCluster = markers._spiderfied;

  if (
    spiderfiedCluster
    && !_clusterContainsMarker(spiderfiedCluster, marker)
  ) {
    spiderfiedCluster.unspiderfy();
  }
}

function _clusterContainsMarker(cluster, marker) {
  var currentLayer = marker;

  while (currentLayer && currentLayer !== cluster) {
    currentLayer = currentLayer.__parent;
  }

  // Say if we found a cluster or nothing.
  return !!currentLayer;
}
