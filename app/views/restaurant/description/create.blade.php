@extends('restaurant._layouts.default')

@section('login')

<h1 class="page-header text-center">Create Restaurant Information</h1>

@if ($errors->any())
	<div class="alert alert-error">
		{{ implode('<br>', $errors->all()) }}
	</div>
@endif
{{Notification::showAll()}}
<div class="container">
	{{ Form::open(array(
		'url'	=> URL::route('r.description.store'),
		'class' => 'form-horizontal',
		'role'	=> 'form',
		'method'=> 'post'
	))}}
		<div class="form-group form-group-lg">
			<label class="col-sm-2 control-label">Restaurants Name</label>
			<div class="col-sm-10">
				{{Form::text('name', null, array(
					'class'			=> 'form-control',
					'placeholder'	=> 'Restaurant Name'
				))}}
			</div>
		</div>
		<div class="form-group form-group-lg">
			<label class="col-sm-2 control-label">Telephone</label>
			<div class="col-sm-10">
				{{Form::text('telephone', null, array(
					'class'			=> 'form-control',
					'placeholder'	=> 'Telephone'
				))}}
			</div>
		</div>
		<div class="form-group form-group-lg">
			<label class="col-sm-2 control-label">Service Scale</label>
			<div class="col-sm-10">
				{{Form::text('scale', null, array(
					'class'			=> 'form-control',
					'placeholder'	=> 'Scale'
				))}}
			</div>
		</div>
		<div class="form-group form-group-lg">
			<label class="col-sm-2 control-label">Location</label>
			<div class="col-sm-10">
				{{Form::text('location_label', null, array(
					'id'			=> 'location_label',
					'class'			=> 'form-control',
					'placeholder'	=> 'Location'
				))}}
				<input type="button" class="btn btn-mini btn-primary" value="Search in the map" onclick="geocoder()"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Map</label>
			<div class="col-sm-10" >
				<div id="map-container"></div>
				<input type="hidden" id="lat" name="locationX"/>
				<input type="hidden" id="lng" name="locationY"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Description</label>
			<div class="col-sm-10">
				{{Form::textarea('description', null, array(
					'rows'			=> '5',
					'class'			=> 'form-control',
					'placeholder'	=> 'Description'
				))}}
			</div>
		</div>
		<div class="form-actions text-center">
			{{Form::submit('Create', array(
				'class'		=> 'btn btn-lg btn-info',
			))}}
		</div>
	{{Form::close()}}
</div>
<script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key=e49f8034fc251d9c705f5833fbd2c99b"></script>
<style type="text/css">
	#map-container{height: 400px}
</style>
<script type="text/javascript">
	var mapObj;
	var click_marker;
	var seacher_markers = new Array();
	var windowsArr		= new Array();
	var initlnglatXY	= null;

	$(function(){
		if(!$('#lat').val() || !$('#lng').val())
			initlnglatXY = new AMap.LngLat(113.263986,23.125041);
		else
			initlnglatXY = new AMap.LngLat($('#lng').val(), $('#lat').val());
			mapObj		= new AMap.Map("map-container", {
					view : new AMap.View2D({
					center : initlnglatXY,
					zoom: 15,
					rotation: 0
				}),
				lang: 'zh_en'
			});

			addSingleMarker(initlnglatXY);
		//add single marker

		var listener = new AMap.event.addListener(mapObj, 'click', function(e){
			addSingleMarker(e.lnglat);
		});
	});

	$("[name='status']").bootstrapSwitch();

	$("[name='status']").on('switch-change', function(e, data){
			    var $el = $(data.el)
  				, value = data.value;
				console.log(e, $el, value);
	});

	//get the latitude and longitude from the location label
	function geocoder(){
		var MGeocoder;
		AMap.service(["AMap.Geocoder"], function(){
			MGeocoder 		= new AMap.Geocoder();
			var location 	= $('#location_label').val();
			MGeocoder.getLocation(location, function(status, result){
				if(status === 'complete' && result.info === 'OK'){
					geocoder_CallBack(result);
				}
			});
		});
	}

	function geocoder_CallBack(data){
		var geocoders 	= new Array();
		geocoders 		= data.geocodes;
		click_marker.setMap(null);
		seacher_markers.forEach(function(marker){
			marker.setMap(null);
		});
		seacher_markers.splice(0, seacher_markers.length);
		for(var i = 0; i < geocoders.length; i++){
			addmarker(i, geocoders[i]);
		}
		mapObj.setFitView();
	}

	function addmarker(index, geocoder){
		var lngX 		= geocoder.location.getLng();
		var latY		= geocoder.location.getLat();

		var markerOption= {
			map: mapObj,
			icon: "http://webapi.amap.com/images/"+(index+1)+".png",
			position: new AMap.LngLat(lngX, latY)
		};

		var mar 		= new AMap.Marker(markerOption);
		// seacher_markers.push(new AMap.LngLat(lngX, latY));
		seacher_markers.push(mar);
		// set longitude and latitude in to the form
		if(index === 1)
			setLngLat(lngX, latY);

		//set the marker information
		var infoWindow	= new AMap.InfoWindow({
			content: geocoder.formattedAddress,
			autoMove: true,
			size: 	new AMap.Size(150, 0),
			offset: {x: 0, y: -30}
		});

		windowsArr.push(infoWindow);

		var aa = function(e){
			infoWindow.open(mapObj, mar.getPosition());
			setLngLat(lngX, latY);
		};

		AMap.event.addListener(mar, 'click', aa);
	}

	function anti_geocoder(lnglatXY){
		var MGeocoder;
		AMap.service(['AMap.Geocoder'], function(){
			MGeocoder 	= new AMap.Geocoder();
		});
		MGeocoder.getAddress(lnglatXY, function(status, result){
			if(status === 'complete' && result.info === 'OK'){
				anti_geocoder_CallBack(result);
			}
		});
	}

	function anti_geocoder_CallBack(data){
		var near_road	= "";
		var address 	= "";

		var mini_direction;
		var near_road	= "";
		address 		= data.regeocode.formattedAddress;
		setLocation(address);
	}

	function addSingleMarker(lnglatXY){
		if(click_marker){
			click_marker.setMap(null);
		}
		seacher_markers.forEach(function(marker){
			marker.setMap(null);
		});
		click_marker = new AMap.Marker({
			map: mapObj,
			position: lnglatXY,
			icon: "http://webapi.amap.com/images/marker_sprite.png",
			offset: new AMap.Pixel(-12, -35)
		});
		setLngLat(lnglatXY.getLng(), lnglatXY.getLat());
		mapObj.setCenter(lnglatXY);
		//get the information about longitude and latitude
		anti_geocoder(lnglatXY);
	}

	function setLngLat(x, y){
		$('#lng').val(x);
		$('#lat').val(y);
	}

	function setLocation(location){
		$('#location_label').val(location);
	}
</script>
@stop
