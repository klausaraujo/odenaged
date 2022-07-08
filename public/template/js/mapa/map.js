function mapa(macc) {
	//la macc recibida es un array de valores para setear el mapa
	var place;
	
	const map = new google.maps.Map(document.getElementById("map"), {
		//center: { lat: lati, lng: longi },
		center: {lat: macc.lat,lng: macc.lng},
		zoom: macc.zoom,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});
			  
	const card = document.getElementById("pac-card");
	const input = document.getElementById("pac-input");
	const options = {
		componentRestrictions: { country: "pe" },
		fields: ["formatted_address", "geometry", "name"],
		strictBounds: false,
		types: ["establishment"],
	};
	map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);
	const autocomplete = new google.maps.places.Autocomplete(input, options);
	// Bind the map's bounds (viewport) property to the autocomplete object,
	// so that the autocomplete requests use the current map bounds for the
	// bounds option in the request.
	autocomplete.bindTo("bounds", map);
	const infowindow = new google.maps.InfoWindow();
	const geocoder = new google.maps.Geocoder();
	const infowindowContent = document.getElementById("infowindow-content");
	infowindow.setContent(infowindowContent);
	const marker = new google.maps.Marker({
		map,
		anchorPoint: new google.maps.Point(0, -29),
		draggable: true,
		position: new google.maps.LatLng(macc.lat, macc.lng)
	});
		  
	autocomplete.addListener("place_changed", () => {
		infowindow.close();
		marker.setVisible(false);
		place = autocomplete.getPlace();
		if (!place.geometry || !place.geometry.location) {
			// User entered the name of a Place that was not suggested and
			// pressed the Enter key, or the Place Details request failed.
			window.alert("No details available for input: '" + place.name + "'");
			return;
		}
			// If the place has a geometry, then present it on a map.
		if (place.geometry.viewport) {
			map.fitBounds(place.geometry.viewport);
		}else {
			map.setCenter(place.geometry.location);
			map.setZoom(12);
		}
		marker.setPosition(place.geometry.location);
		marker.setVisible(true);
		infowindowContent.children["place-name"].textContent = place.name;
		infowindowContent.children["place-address"].textContent = place.formatted_address;
		infowindow.open(map, marker);
	});
		  
	google.maps.event.addListener(marker, "dragend", function (event) {
		var lat = marker.getPosition().lat();
		var lng = marker.getPosition().lng();
		console.log(lat+",  "+lng);
		
		//document.getElementById("latitud").value = lat;
		//document.getElementById("longitud").value = lng;
		geocoder.geocode({'latLng': marker.getPosition()},function (results, status) {
			
			if (status == google.maps.GeocoderStatus.OK) {
				//console.log  (results[0].address_components);
				//var address = results[0]['formatted_address'];
				//infowindowContent.children["place-name"].textContent = results[0].geometry.location;
				//infowindowContent.children["place-address"].textContent = results[0]['formatted_address'];
				//infowindow.open(map, marker);
			}
		});
	});
}