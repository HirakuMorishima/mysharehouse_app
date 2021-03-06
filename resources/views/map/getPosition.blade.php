<!DOCTYPE html>
<html lang="ja">
<head>
  <title>Test Map</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
  <meta charset="utf-8">
  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }
    #map {
      height: 80%;
      width: 80%;
    }
  </style>
</head>
<body>
  <div id="map"></div>
  <ul>
    <li>lat: <span id="lat"></span></li>
    <li>lng: <span id="lng"></span></li>
  </ul>
  <script>
    function initMap() {

      // マップの初期化
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 13,
        center: {lat: 36.38992, lng: 139.06065}
      });

      // クリックイベントを追加
      map.addListener('click', function(e) {
        getClickLatLng(e.latLng, map);
      });
    }

    function getClickLatLng(lat_lng, map) {

      // 座標を表示
      document.getElementById('lat').textContent = lat_lng.lat();
      document.getElementById('lng').textContent = lat_lng.lng();

      // マーカーを設置
      var marker = new google.maps.Marker({
        position: lat_lng,
        map: map
      });

      // 座標の中心をずらす
      // http://syncer.jp/google-maps-javascript-api-matome/map/method/panTo/
      map.panTo(lat_lng);
    }
  </script>
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDvn9d-e_XunRhPixNrbCx5Bz4wt28sCKE&callback=initMap"></script> 
</body>
</html>
