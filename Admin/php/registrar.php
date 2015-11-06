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
	
	$nombre = $_REQUEST['nombre'];
	$apellidos = $_REQUEST['apellidos'];
	$email = $_REQUEST['email'];
	$tel1 = $_REQUEST['tel1'];
	$tel2 = $_REQUEST['tel2'];
	$tipo = $_REQUEST['tipo'];
	$dir = $_REQUEST['dir'];
	$desc = $_REQUEST['desc'];
	$serv = $_REQUEST['serv'];
	$compartido = $_REQUEST['compartido'];
	$numPer = $_REQUEST['numPer'];
	$mensualidad = $_REQUEST['mensualidad'];
	$deposito = $_REQUEST['deposito'];
	$costos = $_REQUEST['costos'];
	$genero = $_REQUEST['genero'];
	$disponibilidad = $_REQUEST['disponibilidad'];
	$img = $_REQUEST['img'];
	
	$sql = 'SELECT * FROM personas WHERE nombre="'.$nombre.'" AND apellidos="'.$apellidos.'"';
	$qry = mysql_query($sql);
	$result = mysql_fetch_assoc($qry);
	$num_rows = mysql_num_rows($qry);
	
	if($num_rows == 0)	//Si no existe la persona
	{
		$insert_sql_per = "INSERT INTO personas(nombre, apellidos, email) VALUES ('$nombre', '$apellidos', '$email')";
		$insert_per = mysql_query($insert_sql_per);
		
		$per_sql = 'SELECT * FROM personas WHERE nombre="'.$nombre.'" AND apellidos="'.$apellidos.'"';
		$per_qry = mysql_query($per_sql);
		$per_result = mysql_fetch_assoc($per_qry);
		
		$id = $per_result['idPersona'];
	}
	else
	{	
		$id = $result['idPersona'];
	}
	
	$sql = 'SELECT * FROM clientes WHERE idPersona="'.$id.'"';
	$qry = mysql_query($sql);
	$result = mysql_fetch_assoc($qry);
	$num_rows = mysql_num_rows($qry);
	
	if ($num_rows == 0) //Si no existe el cliente
	{
		$insert_sql_cli = "INSERT INTO clientes(telefono1, telefono2, idPersona) VALUES ('$tel1', '$tel2', '$id')";
		$insert_cli = mysql_query($insert_sql_cli);
		
		$cli_sql = 'SELECT * FROM clientes WHERE idPersona="'.$id.'"';
		$cli_qry = mysql_query($cli_sql);
		$cli_result = mysql_fetch_assoc($cli_qry);
		
		$id2 = $cli_result['idCliente'];
	}
	else
	{
		$id2 = $result['idCliente'];
	}
	
	$sql = 'SELECT * FROM hospedajes WHERE idCliente="'.$id2.'"';
	$qry = mysql_query($sql);
	$result = mysql_fetch_assoc($qry);
	$num_rows = mysql_num_rows($qry);
	
	if ($compartido == "si")
		$compartido = 1;
	else
		$compartido = 0;
	
	if ($num_rows == 0) //Si no existe el hospedaje
	{
		$insert_sql_hos = "INSERT INTO hospedajes(tipo, direccion, descripcion, servicios, compartido, noPersonas, mensualidad, deposito, costosExtras, imagenes, generoHuesped, disponibilidad, idCliente) VALUES ('$tipo', '$dir', '$desc', '$serv', '$compartido', '$numPer', '$mensualidad', '$deposito', '$costos', '$img', '$genero', '$disponibilidad', '$id2')";
		$insert_hos = mysql_query($insert_sql_hos);
	}
	
	echo $insert_hos;
	
	mysql_close($db_con);
?>