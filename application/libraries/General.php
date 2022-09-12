<?php

//require_once 'dompdf/autoload.inc.php';
	// reference the Dompdf namespace
//use Dompdf\Dompdf;

class General {

	private $c = 0;
	
	#Funcion para guardar la imagen del mapa segun las coordenadas
	/*public function saveImageMap($path,$image,$lat,$lng,$zoom){
		$url = "https://maps.googleapis.com/maps/api/staticmap?language=es&center=".trim($lat).",".trim($lng)."&markers=color:red|label:|".trim($lat).",".trim($lng)."&zoom=".$zoom."&size=596x280&key=AIzaSyByPoOpv9DTDZfL0dnMxewn5RHnzC8LGpc";
		if(!file_exists($path)){
			$parts = explode('/', $path);
			array_pop($parts);
			$dir = implode( '/', $parts );;
			if( !is_dir( $dir ) )
				mkdir( $dir, 0777, true );
		}
		if(!file_put_contents($path.$image, file_get_contents($url)) > 0)
			$image = '';
		
		return $image;
	}*/
	
	public function saveImage($path,$data){
		$this->c++;
		// We need to remove the "data:image/png;base64,"
		$base_to_php = explode(',', $data);
		// the 2nd item in the base_to_php array contains the content of the image
		$img = base64_decode($base_to_php[1]);
		$name = date('Ymdhis');
		$filename = $name.$this->c.'.png';
		if(!file_put_contents($path.$filename,$img) > 0)
			$filename = '';
		
		return $filename;
	}
	public function saveImage1($path,$data,$name){
		$img = base64_decode($data);
		$filename = $name;
		if(!file_put_contents($path.$filename,$img) > 0)
			$filename = '';
		
		return $filename;
	}
	
	#Funcion para conectarse a la api de la RENIEC
	public function curl($tipo,$doc)
    {
        $api = "http://mpi.minsa.gob.pe/api/v1/ciudadano/ver/";
        $token = "Bearer d90f5ad5d9c64268a00efaa4bd62a2a0";
        $handler = curl_init();

        curl_setopt($handler, CURLOPT_URL,  $api.$tipo."/".$doc."/");
        curl_setopt($handler, CURLOPT_HEADER, false);
        curl_setopt($handler, CURLOPT_HTTPHEADER, array("Authorization: " . $token, "Content-Type: application/json" ));
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($handler);
        $code = curl_getinfo($handler, CURLINFO_HTTP_CODE);

        curl_close($handler);

        return $data;
    }
	
	public function guardarMapaCurl($path,$image,$lat,$lng,$zoom)
	{
		$url = "https://maps.googleapis.com/maps/api/staticmap?language=es&center=".trim($lat).",".trim($lng)."&markers=color:red|label:|".trim($lat).",".trim($lng)."&zoom=".$zoom."&size=596x280&key=AIzaSyByPoOpv9DTDZfL0dnMxewn5RHnzC8LGpc";

		if(!file_exists($path)){
			$parts = explode('/', $path);
			array_pop($parts);
			$dir = implode( '/', $parts );
			if( !is_dir( $dir ) ) mkdir( $dir, 0777, true );
		}
		
		$ch = curl_init();
		$fp = fopen($path.$image, 'wb');
		curl_setopt($ch, CURLOPT_URL, trim($url));
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, false);
		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($ch, CURLOPT_FILE, $fp);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // <-- don't forget this
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // <-- and this
		$result = curl_exec($ch);
		curl_close($ch);
		//fwrite($fp, $result);
		fclose($fp);
		
		return(($result === true)? $image : '');
	}
}