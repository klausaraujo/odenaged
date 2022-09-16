function mapaMonitoreoEventos(macc) {
	//la macc recibida es un array de valores para setear el mapa
	var peru = new google.maps.LatLng(macc.lat, macc.lng);
	const divmap = document.getElementById('map');
	
	const map = new google.maps.Map(divmap, {
		center: peru,
		zoom: macc.zoom,
		minZoom: 5, streetViewControl: false,
		mapTypeControlOptions: {
			style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
		},
		zoomControlOptions: {
			style: google.maps.ZoomControlStyle.SMALL
		}
	});
	
	var strictBounds = new google.maps.LatLngBounds(new google.maps.LatLng(
    -18.309, -81.342), new google.maps.LatLng(-0.08, -68.704));
	
	/*var control = document.getElementById('form-flotante');
	map.controls[google.maps.ControlPosition.BOTTOM_LEFT].push(control);*/
	
	const geocoder = new google.maps.Geocoder();
	google.maps.event.addListener(map,'dragend',function () {
		if (strictBounds.contains(map.getCenter())) return;
		var c = map.getCenter(), x = c.lng(), y = c.lat(), maxX = strictBounds.getNorthEast().lng(), maxY = strictBounds.getNorthEast().lat();
		var	minX = strictBounds.getSouthWest().lng(), minY = strictBounds.getSouthWest().lat();
		if (x < minX) x = minX;
		if (x > maxX) x = maxX;
		if (y < minY) y = minY;
		if (y > maxY) y = maxY;
		map.setCenter(new google.maps.LatLng(y, x));
	});
	
	return map;
}