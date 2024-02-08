<?php
    $server = 'brfklmgpnqsttdw8rtay-mysql.services.clever-cloud.com';
    $username = 'uulduxnuyspo3sa6';
    $password = 'xGySb2vEAXfT2kzpKcLf';
    $database = 'brfklmgpnqsttdw8rtay';

    try {
        $conn = new PDO("mysql:host=$server;dbname=$database;",$username,$password);
    } catch (PDOException $e) {
        die ('La conexión falló: '.$e ->getMessage());
    }

    /** Activa la presentación de errores */
	function MostrarErrores(){
		error_reporting(E_ALL);     // Comentar para noo mostrar errores
		ini_set('display_errors', '1'); // Comentar para noo mostrar errores
    }

    /** Limpieza de una cadena de texto */
	function LimpiarCadena($cadena){ 
		$patron = array('/<script>.*<\/script>/', '/..\\*/');
		$cadena = preg_replace($patron, '', $cadena);
		$cadena = htmlspecialchars($cadena);
		return $cadena;
	}

	/** Limpieza de parámetros de entrada */     
	function LimpiarEntradas($entradas){
		if (isset($entradas)) {
			foreach ($entradas as $key => $value) {
				$entradas[$key] = LimpiarCadena($value);
			}
			return $entradas;
		}
	}

	function removeExif($old, $new)
    {
        // Open the input file for binary reading
        $f1 = fopen($old, 'rb');
        // Open the output file for binary writing
        $f2 = fopen($new, 'wb');

        // Find EXIF marker
        while (($s = fread($f1, 2))) {
            $word = unpack('ni', $s)['i'];
            if ($word == 0xFFE1) {
                // Read length (includes the word used for the length)
                $s = fread($f1, 2);
                $len = unpack('ni', $s)['i'];
                // Skip the EXIF info
                fread($f1, $len - 2);
                break;
            } else {
                fwrite($f2, $s, 2);
            }
        }

        // Write the rest of the file
        while ($s = fread($f1, 4096)) {
            fwrite($f2, $s, strlen($s));
        }

        fclose($f1);
        fclose($f2);
    }

?>