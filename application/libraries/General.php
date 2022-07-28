<?php

//require_once 'dompdf/autoload.inc.php';
	// reference the Dompdf namespace
//use Dompdf\Dompdf;

class General {

	public function saludo(){
		return 'Hello World';
	}
	
	#Funcion para guardar la imagen del mapa segun las coordenadas
	public function saveImageMap($path,$image,$lat,$lng,$zoom){
		$url = "https://maps.googleapis.com/maps/api/staticmap?language=es&center=" . trim($lat) ."," . trim($lng) . "&markers=color:red|label:|" . trim($lat) . "," . trim($lng) . "&zoom=" . $zoom . "&size=596x280&key=AIzaSyByPoOpv9DTDZfL0dnMxewn5RHnzC8LGpc";
		if(!file_exists($path)){
			$parts = explode('/', $path);
			array_pop($parts);
			$dir = implode( '/', $parts );;
			if( !is_dir( $dir ) )
				mkdir( $dir, 0777, true );
		}
		if(!file_put_contents($path . $image, file_get_contents($url),LOCK_EX) > 0)
			$image = '';
		
		return $image;
	}
	
	#Funcion para conectarse a la api de la RENIEC
	public function curl()
    {
        $tipo_documento = $this->input->post("type");
        $documento = $this->input->post("dni");
        $api = "http://mpi.minsa.gob.pe/api/v1/ciudadano/ver/";
        $token = "Bearer d90f5ad5d9c64268a00efaa4bd62a2a0";
        $handler = curl_init();

        curl_setopt($handler, CURLOPT_URL,  $api. $tipo_documento . "/" . $documento . "/");
        curl_setopt($handler, CURLOPT_HEADER, false);
        curl_setopt($handler, CURLOPT_HTTPHEADER, array(
            "Authorization: " . $token,
            "Content-Type: application/json"
        ));
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($handler);
        $code = curl_getinfo($handler, CURLINFO_HTTP_CODE);

        curl_close($handler);

        echo $data;
    }

}

?>