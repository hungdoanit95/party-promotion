@extends('components.layout')
@section('content')
<style>
    .note-map{
        position: absolute;
        z-index: 99;
        background: #fff;
        right: 0;
    }
    .note-map ul{
        list-style: none;
        padding: 0;
        margin: 0;
        padding: 10px
    }
    .note-map ul li + li{
        margin-top: 10px;
    }
</style>
<div class="col-sm-12" style="margin-top:30px;padding-left: 0;padding-right: 0;display: inline-block;width:100%;position: relative">
    <div class="note-map">
        <ul>
            <li>
                <img src="http://omafox.com/public/assets/img/mk-blue.png" style="width: 20px" alt=""> <span>Chưa làm</span>
            </li>
            <li>
                <img src="http://omafox.com/public/assets/img/mk-green.png" style="width: 20px" alt=""> <span>Thành công</span>
            </li>
            <li>
                <img src="http://omafox.com/public/assets/img/mk-pink.png" style="width: 20px" alt=""> <span>Không thành công</span>
            </li>
        </ul>
    </div>
    <div class="bg-map" style="position: relative">
        <div id="map" style="height: 800px;width: 100%; background: '#ccc'"></div>
    </div>
</div>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASCY1j5-2fywcJdpPHmhR5WAKhnDS2ovc"></script>
<script type="text/javascript" src="{{ asset('public/assets/js/markerclusterer.js') }}"></script>
<script type="text/javascript">
    var total = '{{ $total_data }}';
    if (total >= 12000) {
        alert('Dữ liệu quá lớn để hiển thị trên bản đồ');
    }
    var zoom_level = 9;
    var latitude = '10.5884833';
    var longitude = '106.2390283';
    var plan_edit = 'http://omafox.com/get-info-plan/';
    var server_url = 'http://omafox.com/';
    var marker_url = 'storage/app/';
    var SpeedMap = {};
    const data_map = {!! $data_map !!};
    SpeedMap.store_info = [];
    SpeedMap.ping_info = null;
    SpeedMap.map = null;
    SpeedMap.markerClusterer = {};
    SpeedMap.markers = [];
    SpeedMap.infoWindow = null;
    SpeedMap.init = function() {
        var latlng = new google.maps.LatLng(latitude, longitude);
        var options = {
            'zoom': zoom_level,
            'center': latlng,
            'gestureHandling': "greedy"
        };
        SpeedMap.map = new google.maps.Map(document.getElementById('map'), options);
        SpeedMap.store_info = data_map;
        SpeedMap.infoWindow = new google.maps.InfoWindow();
        SpeedMap.showMarkers();

    };
    SpeedMap.showMarkers = function() {
    SpeedMap.markers = [];
    var type = 1;

    // if (SpeedMap.markerClusterer) {
    //     SpeedMap.markerClusterer.clearMarkers();
    // }
    var numMarkers = total; 
    for (var j = 0; j < total; j++) {
        var titleText = SpeedMap.store_info[j].name_store;
        if (titleText == '') {
        titleText = 'No title';
        }
        var title = document.createElement('a');
        title.href = '#';
        title.className = 'title';
        title.innerHTML = titleText;
        let lat_map = 0;
        let long_map = 0;
        if(typeof SpeedMap.store_info[j].plan_lat !== undefined && SpeedMap.store_info[j].plan_lat !== null && SpeedMap.store_info[j].plan_lat !== ''){
            lat_map = SpeedMap.store_info[j].plan_lat
        }
        if(typeof SpeedMap.store_info[j].plan_long !== undefined && SpeedMap.store_info[j].plan_long !== null && SpeedMap.store_info[j].plan_long !== ''){
            long_map = SpeedMap.store_info[j].plan_long
        }
        if(typeof SpeedMap.store_info[j].store_lat !== undefined && SpeedMap.store_info[j].store_lat !== null && SpeedMap.store_info[j].store_lat !== ''){
            lat_map = SpeedMap.store_info[j].store_lat
        }
        if(typeof SpeedMap.store_info[j].store_long !== undefined && SpeedMap.store_info[j].store_long !== null && SpeedMap.store_info[j].store_long !== ''){
            long_map = SpeedMap.store_info[j].store_long
        }
        var latLng = new google.maps.LatLng(lat_map, long_map);
        var imageUrl = 'http://omafox.com/public/assets/img/mk-blue.png';
        if(SpeedMap.store_info[j].plan_status == 1){
            var imageUrl = 'http://omafox.com/public/assets/img/mk-green.png';
        }else if(SpeedMap.store_info[j].plan_status == 2){
            var imageUrl = 'http://omafox.com/public/assets/img/mk-pink.png';
        }

        var markerImage = new google.maps.MarkerImage(imageUrl, new google.maps.Size(40, 40));

        var marker = new google.maps.Marker({
        'position': latLng,
        'icon': markerImage
        });
        var fn = SpeedMap.markerClickFunction(SpeedMap.store_info[j], latLng);
        google.maps.event.addListener(marker, 'click', fn);
        google.maps.event.addDomListener(title, 'click', fn);
        SpeedMap.markers.push(marker);
        let makertotal = SpeedMap.markers;
        let mapinit = SpeedMap.map;
        SpeedMap.markerClusterer = new MarkerClusterer({makertotal,mapinit});
    }
    window.setTimeout(SpeedMap.time, 0);
    };
    SpeedMap.markerClickFunction = function(sinfo, latlng) {
    return function(e) {
    e.cancelBubble = true;
    e.returnValue = false;
    if (e.stopPropagation) {
        e.stopPropagation();
        e.preventDefault();
    }
    var infoHtml = '<div class="info" style="width: 255px;">';
    if (typeof sinfo.overview_img != "undefined") {
        infoHtml += '<div class="info-body text-center">';
        infoHtml += '<a style="display: inline-block; height: auto; margin-top:0;" href="' + plan_edit + sinfo.plan_id + '" target="_blank"><img style="max-height:150px" src="' + server_url + marker_url + sinfo.overview_img + '" class="info-img"/></a>';
        infoHtml + '</div>';
    }
    infoHtml += '<ul style="display:flex;flex-wrap:wrap;justify-content: space-between;text-align:left;margin-top: 5px;position: relative;">';
    if (typeof sinfo.store_name != "undefined") {
        infoHtml += '<li style="width:50%;margin-bottom:5px;font-size:11px;font-weight: bold;"><i class="bi bi-shop"></i>: '+sinfo.store_name+'</li>';
    }
    if (typeof sinfo.address != "undefined") {
        infoHtml += '<li style="width:50%;margin-bottom:5px;font-size:11px;"><i class="bi bi-geo-fill"></i>: '+sinfo.store_name+'</li>';
    }
    if (typeof sinfo.store_phone != "undefined") {
        infoHtml += '<li style="width:50%;margin-bottom:5px;font-size:11px;"><i class="bi bi-phone"></i>: '+sinfo.store_phone+'</li>';
    }
    infoHtml += '</ul>';
    infoHtml + '</div>';
    SpeedMap.infoWindow.setContent(infoHtml);
    SpeedMap.infoWindow.setPosition(latlng);
    SpeedMap.infoWindow.open(SpeedMap.map);
};

};

SpeedMap.clear = function() {
    for (var i = 0, marker; marker = SpeedMap.markers[i]; i++) {
        marker.setMap(null);
    }
};
SpeedMap.change = function() {
    SpeedMap.clear();
    SpeedMap.showMarkers();
};

SpeedMap.time = function() {
    for (var i = 0, marker; marker = SpeedMap.markers[i]; i++) {
    marker.setMap(SpeedMap.map);
    }
};

google.maps.event.addDomListener(window, 'load', SpeedMap.init);
</script>
@endsection