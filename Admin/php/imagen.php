<?php
	//indica que el tipo de la respuesta reenviada al cliente sera de texto
	header("Content-Type: text/plain");
	//anti Cache para HTTP/1.1
	header("Cache-Control: no-cache , private");
	//anti Cache para HTTP/1.0
	header("Pragma: no-cache");
	
	date_default_timezone_set("Mexico/General");
	setLocale(LC_ALL, "esp");
	
	if (isset($_FILES['image'])) {
		//Variables para los directorios
		$new_dir = $_REQUEST['carpeta'] . '/';
		$dir = '../../Imagenes/' . $new_dir;
		$bd_dir = 'Imagenes/' . $new_dir;
		
		//recuperar los datos de archivo
		$archivo = $dir . basename($_FILES['image']['name']);
		$archivo_bd = $bd_dir . basename($_FILES['image']['name']);
		$tmp = $_FILES['image']['tmp_name'];
		$ext = pathinfo($dir, PATHINFO_EXTENSION);
		
		// is_dir - tells whether the filename is a directory
		if (!is_dir($dir)) {
			//mkdir - tells that need to create a directory
			mkdir($dir);
		}
		
		if (file_exists($archivo)) {
			echo '0';
		}
		else {
			//mover el archivo del folder temporal a nueva ruta
			move_uploaded_file($tmp, $archivo); //Se mueve la imagen seleccionada al directorio del servidor
			
			echo $archivo_bd;
		}
	}
	else {
		echo '0';
	}
?>