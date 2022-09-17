var escAncho = screen.width;
var escAlto = screen.height;
var activeInfoWindow;
var map;
var marker;
var mapMarkers = new Array();

var escala = 6;
if (escAncho == 1920 && escAlto == 1080) escala = 6;
if (escAncho == 1680 && escAlto == 1050) escala = 6;
if (escAncho == 1600 && escAlto == 900) escala = 6;
if (escAncho == 1440 && escAlto == 900) escala = 6;
if (escAncho == 1400 && escAlto == 1050) escala = 6;
if (escAncho == 1366 && escAlto == 768) escala = 5;
if (escAncho == 1360 && escAlto == 768) escala = 5;
if (escAncho == 1280 && escAlto == 1024) escala = 6;
if (escAncho == 1024 && escAlto == 768) escala = 5;
if (escAncho == 800 && escAlto == 600) escala = 5;
var opt = {lat:  -9.318990, lng:-75.234375,zoom: escala};


function modalInfowindow(data){
	let hora = (data.hora).split(';');
	let horaevt = hora[0];
	var html =
	`<div class='info-card'>
          <div class='info-card-top'>
              <div class='info-card-meta'>
                  <div class='info-card-heading'>Evento N° ${data.numero_evento} - ${data.anio_evento}, ${data.evento}</div>
                  <div class='info-card-subheading'>${data.ubigeo_descripcion}</div>
              </div>
          </div>
		  <div class='info-card-bottom py-3'>
            <div class="row mx-2 px-2"><span style="font-weight:bold">TIPO DE EVENTO:</span><strong>&nbsp;&nbsp;${data.tipo_evento}</strong></div>
				<div class="row mx-2 px-2"><span style="font-weight:bold">DETALLE DEL EVENTO:</span><strong>&nbsp;&nbsp;${data.evento}</strong></div>
				<div class="row mx-2 px-2"><span style="font-weight:bold">FECHA:</span><strong>&nbsp;&nbsp;${data.fecha}</strong></div>
				<div class="row mx-2 px-2"><span style="font-weight:bold">FUENTE:</span><strong>&nbsp;&nbsp;${data.fuente_inicial}</strong></div>
				<div class="row mx-2 px-2"><span style="font-weight:bold">NIVEL:</span><strong>&nbsp;&nbsp;${data.nivel}</strong></div>
				<div class="row mx-2 px-2"><span style="font-weight:bold">DESCRIPCION:</span><strong>&nbsp;&nbsp;${data.descripcion}</strong></div>
            </ul>
        </div>
      </div>`
        /*<div class='info-card-bottom'>
            <ul class="nav nav-tabs nav-justified md-tabs" id="myTabJust" role="tablist">
                <li class="nav-item active">
                    <a class="nav-link active" id="home-tab-just" data-toggle="tab" href="#home-just" role="tab" aria-controls="home-just"aria-selected="true">DATOS DE EVENTO</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContentJust">
                <div class="tab-pane fade bg-white pa-20 active" id="home-just" role="tabpanel" aria-labelledby="home-tab-just">
                    <ul>
                        <li><strong>Tipo de Evento:</strong> ${data.tipo_evento} </li>
                        <li><strong>Detalle del Evento:</strong> ${data.evento} </li>
                        <li><strong>Fecha:</strong> ${data.fecha} ${data.fecha} ${horaevt}</li>
                        <li><strong>Fuente:</strong> ${data.fuente_inicial} </li>
                        <li><strong>Nivel:</strong> ${data.nivel} </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>*/

  return html;
}

function clearOverlays() {
  for (var i = 0; i < mapMarkers.length; i++) {
    mapMarkers[i].setMap(null);
  }
  mapMarkers = [];
}

function marcadores(data){
	clearOverlays();
	if(data.length === 0)return;
	
	var icono = URI + 'public/template/mapas/icons/ic_sanitario.png';
	var anime = google.maps.Animation.DROP;
	
	data.forEach(function(el){
		console.log(el.idregistroevento);
		//console.log(parseFloat(el.latitud)+',  '+parseFloat(el.longitud));
		var icon = {
			url: icono,
			size: new google.maps.Size(32, 32),
			origin: new google.maps.Point(0, 0),
			anchor: new google.maps.Point(0, 0),
			scaledSize: new google.maps.Size(20, 20)
		};
		marker = new google.maps.Marker({
			animation: anime,
			position: new google.maps.LatLng(parseFloat(el.latitud),parseFloat(el.longitud)),
			map: map,
			icon: icon,
		});
		marker.addListener("click", function(){
			var scope = this;
			if (activeInfoWindow) { activeInfoWindow.close(); }
			var iw = new google.maps.InfoWindow();
			activeInfoWindow = iw;
			iw.close();
			$.ajax({
				url: 'infoWindowEventos',
				data: {id: el.idregistroevento},
				method: "post",
				dataType: "json",
				success: function (data){
					console.log(data);
					html = modalInfowindow(data);
					iw.setContent(html);
					iw.open(map, scope);
				}
            });
		});
		mapMarkers.push(marker);
	});
}

function mapaMonitoreoEventos() {
	//alert(URI);
	//la macc recibida es un array de valores para setear el mapa
	var peru = new google.maps.LatLng(opt.lat, opt.lng);
	const divmap = document.getElementById('map');
	
	map = new google.maps.Map(divmap, {
		center: peru,
		zoom: opt.zoom,
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
	//marcadores();
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
}