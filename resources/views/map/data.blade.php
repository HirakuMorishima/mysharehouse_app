<html>
<head>
    <title>Mapデータ</title>
</head>
<body>
    <h1>Map</h1>
    <!--マップ表示-->
    <div id="map" style="width:550px; height:300px;"></div>
    
    <!-- Map入力フォーム -->
    <form method="POST" action="/map"> 
    {{csrf_field()}}
     
    名称: <input type="text" name="name">
    <br>
    緯度: <input type="text" name="lat" id="show_lat">
    経度: <input type="text" name="lng" id="show_lng">
    <br>
    説明: <input type="text" name="description"> 
    <br>
    <input type="submit"> 
    </form> 
    <!-- 一覧表示 -->
    <table>
    <tr>
    <th>名称</th>
    <th>緯度</th>
    <th>経度</th>
    <th>説明</th>
    <th>作成日</th>
    <th>更新日</th>
    </tr>
    @foreach($list as $val)
    <tr>
        <td><a href="/show/{{$val->id}}">{{$val->name}}</a></td>
        <td>{{$val->lat}}</td>
        <td>{{$val->lng}}</td>
        <td>{{$val->description}}</td>
        <td>{{$val->created_at}}</td>
        <td>{{$val->updated_at}}</td>
    </tr>
    @endforeach
    </table>
    
    
    <!--mapsテーブルのデータを取得-->
    <?php $list = \App\Map::all()->toArray();
    // phpの配列をJavaScriptに渡すためにjsonファイルに変換する
    $json_list = json_encode($list);
    // ddメソッドで配列獲得ができているか確認
    // dd($list);  
    ?>
    
 
    <script type="text/javascript"> 
    
    var map;
    var marker = [];
    var infoWindow = [];
    var markersArray = [];
    // 
    var list = <?php echo $json_list ?>;
    // console.log(list[0]['lat']);
    // console.log(list[0]['description']);
    // var markerData = list;
    function initMap() {
        
        // mapLatLngで地図の作成
        
        // #mapに地図を埋め込む
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -31.92354200, lng: 115.90371700},
            zoom: 15
        });
        
        // forでlistのデータを取得
        for (var i = 0; i < list.length; i++) {
            // 緯度と傾度のデータ作成
            markerLatLng = {lat: parseFloat(list[i]['lat']), lng: parseFloat(list[i]['lng'])}; 
            // マーカーの追加
            marker[i] = new google.maps.Marker({
            position: markerLatLng,
            map: map
            });
        // 吹き出しの追加
        infoWindow[i] = new google.maps.InfoWindow({
            content: '<div class="map">' +
             list[i]['name'] +
             list[i]['description'] +
             '</div>'
        });
        
        // マーカーにinfoWindowがポップアップするクリックイベントを追加
        markerEvent(i);
        }
        
        // マーカー設置をするクリックイベントを追加
        markerSet();
        
        // マーカーを中心点にして地図を移動する
        // google.maps.e.addListener(map, "idele", function(){
        //     mylistener(map.getCenter());
        // });
    }
    
    // マーカーをクリックした時に吹き出しを表示されるfunctionを設定
    function markerEvent(i) {
        marker[i].addListener('click', function() {
            infoWindow[i].open(map, marker[i]);
        });
    }
    
    // mapをクリックした時のイベントを設定（マーカー設置）
    function markerSet() {
        google.maps.event.addListener(map, 'click', mylistener);
    }
    
    // クリックした時にマーカーが設置されるfunctionを設定
    function mylistener(e) {
        // clearOverlaysで設置したマーカーを最新のもの以外全て削除
        clearOverlays();
        // marker作成
        var marker = new google.maps.Marker({
            position:e.latLng,
            map:map
        });
        markersArray.push(marker);
        document.getElementById("show_lat").value = e.latLng.lat();
        document.getElementById("show_lng").value = e.latLng.lng();
    }
    
    // 設置したマーカーを最新のもの以外全て削除
    function clearOverlays() {
        for(var i = 0; i < markersArray.length; i++ ) {
            markersArray[i].setMap(null);
        }
    }
    
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDvn9d-e_XunRhPixNrbCx5Bz4wt28sCKE&callback=initMap"></script> 
</body>
</html>