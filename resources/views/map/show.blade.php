<html> 
<head> 
    <title>Map</title>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDvn9d-e_XunRhPixNrbCx5Bz4wt28sCKE"></script> 
<script type="text/javascript"> 
  function init() { 
    var latlng = new google.maps.LatLng('{{ $map->lat }}','{{ $map->lng }}'); 
    var myOptions = { 
      zoom: 15, 
      center: latlng, 
      mapTypeId: google.maps.MapTypeId.ROADMAP 
    }; 
    var map = new google.maps.Map(document.getElementById("map"), myOptions);  


        // Javascriptのfor文で一覧表示
        var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h1 id="firstHeading" class="firstHeading">{{ $map->name }}</h1>'+
            '<p>{{ $map->description }}</p>'+
            '<div id="bodyContent">'+
            '</div>'+
            '</div>';
            
        var infowindow = new google.maps.InfoWindow({
          content: contentString
        });

        var marker = new google.maps.Marker({
           position: latlng,
           map: map,
           title:"{{ $map->name }}"
        });
        marker.addListener('click', function() {
          infowindow.open(map, marker);
        });
  } 
  
</script> 
</head> 
<body onload="init()"> 
<div id="map" style="width:550px; height:300px;"></div>
</body> 
</html>