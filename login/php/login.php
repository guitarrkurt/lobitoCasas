<?php
	//indica que el tipo de la respuesta reenviada al cliente sera de texto
	header("Content-Type: text/plain");
	//anti Cache para HTTP/1.1
	header("Cache-Control: no-cache , private");
	//anti Cache para HTTP/1.0
	header("Pragma: no-cache");
	
	include("mysql.php");
	
	if(isset($_REQUEST['usuario']) && isset($_REQUEST['password'])){
		$user = $_REQUEST['usuario'];
		$pass = $_REQUEST['password'];	
		
		// To protect MySQL injection
		$user = stripslashes($user);
		$pass = stripslashes($pass);
		$user = mysql_real_escape_string($user);
		$pass = mysql_real_escape_string($pass);
		$pass = md5($pass);
		
		$getUser_sql = 'SELECT * FROM administradores WHERE usuario="'. $user . '" AND clave="'. $pass .'"';
		$getUser = mysql_query($getUser_sql);
		$getUser_result = mysql_fetch_assoc($getUser);
		$getUser_RecordCount = mysql_num_rows($getUser);
		
		if($getUser_RecordCount == 1){ 
			session_start();
			$_SESSION['user'] = $user;
			echo $getUser_result['usuario'];
		} 
		else { 
			echo '0';
		}
		
		mysql_close($db_con);
	}
?>