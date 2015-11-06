<?php
	header("Content-Type: text/html; charset=utf-8");

	// Connection's Parameters
	$db_host="localhost";
	$db_name="hospedaje_uni";
	$username="mario";	//Cambiar de acuerdo a su servidor
	$password="100004067";		//Cambiar de acuerdo a su servidor
	$db_con=mysql_connect($db_host,$username,$password);
	$connection_string=mysql_select_db($db_name);
	
	// Connection
	mysql_connect($db_host,$username,$password);
	if (!mysql_select_db($db_name, $db_con))
	{
		echo "Base de datos no hallada <br />";
		exit;
	};
	
	//Codificación para los acentos
	mysql_set_charset('utf8');
?>
