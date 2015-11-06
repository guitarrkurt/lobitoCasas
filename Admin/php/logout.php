<?php
	//indica que el tipo de la respuesta reenviada al cliente sera de texto
	header("Content-Type: text/plain");
	//anti Cache para HTTP/1.1
	header("Cache-Control: no-cache , private");
	//anti Cache para HTTP/1.0
	header("Pragma: no-cache");
	
	session_start();
	session_destroy();
	
	header("location:../../index.php");
?>