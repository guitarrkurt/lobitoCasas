<?php
	//indica que el tipo de la respuesta reenviada al cliente sera de texto
	header("Content-Type: text/plain");
	//anti Cache para HTTP/1.1
	header("Cache-Control: no-cache , private");
	//anti Cache para HTTP/1.0
	header("Pragma: no-cache");
	
	include("mysql.php");
	
	date_default_timezone_set("Mexico/General");
	setLocale(LC_ALL, "esp");
		
	$opc = $_REQUEST['opcion'];
	
	switch($opc){
		case 1:
			$nombre = $_REQUEST['nombre'];
			$comentario = $_REQUEST['comentario'];
			$valor = $_REQUEST['valor'];
			
			$id = $_REQUEST['id'];
				$promedio = $_REQUEST['valor'];
			agregar($nombre, $comentario, $valor, $id,$promedio);
			break;
		case 2:
			$id = $_REQUEST['id'];
			actualizar($id);
			break;
	}
	
	function agregar($nombre, $comentario, $valor, $id,$promedio){
		$fecha = date("d/m/Y h:i:s a", time()); //Formato de fecha y tiempo al momento
		
		$insert_sql = "INSERT INTO opiniones(nombre, comentarios, valoracion, fecha, idHospedaje) VALUES ('$nombre', '$comentario', '$valor', '$fecha', '$id','$promedio')";
		$insert = mysql_query($insert_sql);
		
		if (!$insert)
			echo 0;
		else
			echo $id;
	}
	
	function actualizar($id){		
		$sql = 'SELECT * FROM opiniones WHERE idHospedaje="'.$id.'"';
		$qry = mysql_query($sql);
		$num_rows = mysql_num_rows($qry);
		
		if ($num_rows == 0){
			echo '<p id="no-comment">No hay comentarios</p>';
		}
		else{
			while($row = mysql_fetch_assoc($qry)){
				echo '<div class="comment-post">
				  <p id="nom">'.$row['nombre'].'</p>
				  <p id="valor">Valoración: '.$row['valoracion'].'</p>
				  <p id="text">'.$row['comentarios'].'</p>
				  <p id="fecha">'.$row['fecha'].'</p>
				   <p id="promedio">Promedio: '.$row['promedio'].'</p>
				
				</div>';
			}
		}	
	}
	
	mysql_close($db_con);
?>