<?php
	//indica que el tipo de la respuesta reenviada al cliente sera de texto
	header("Content-Type: text/plain");
	//anti Cache para HTTP/1.1
	header("Cache-Control: no-cache , private");
	//anti Cache para HTTP/1.0
	header("Pragma: no-cache");
	
	include("mysql.php");
	
	session_start();
	$opcion = $_REQUEST['opcion'];
	
	switch($opcion)
	{
		case 1:
			$nombre = $_REQUEST['nombre'];
			$apellidos = $_REQUEST['apellidos'];
			$email = $_REQUEST['email'];
			modificar($nombre, $apellidos, $email);
			break;
		case 2:
			actualizar();
			break;
		case 3:
			mostrar($opcion);
			break;
		case 4:
			mostrar($opcion);
			break;
		case 5:
			$old_pass = $_REQUEST['old_pass'];
			$pass = $_REQUEST['pass'];
			passwords($old_pass, $pass);
			break;
	}
	
	function modificar($nombre, $apellidos, $email)
	{
		$id = $_REQUEST['idPersona'];
		
		$nom_sql = 'UPDATE personas SET nombre="'.$nombre.'" WHERE idPersona="'.$id.'"';
		$nom_qry = mysql_query($nom_sql);
		
		$ape_sql = 'UPDATE personas SET apellidos="'.$apellidos.'" WHERE idPersona="'.$id.'"';
		$ape_qry = mysql_query($ape_sql);
		
		$mail_sql = 'UPDATE personas SET email="'.$email.'" WHERE idPersona="'.$id.'"';
		$mail_qry = mysql_query($mail_sql);
		
		if(!$nom_qry || !$ape_qry || !$mail_qry)
			$id = 0;
		
		echo $id;
	}
	
	function actualizar()
	{
		$content_sql = 'SELECT * FROM personas WHERE idPersona="'.$_REQUEST['idPersona'].'"';
		$content = mysql_query($content_sql);
		$result = mysql_fetch_array($content);
		
		echo '<div id="content">';
		  	echo '<h2>Datos de usuario</h2><br /><br />';
		  	echo '<p><b>Usuario: </b>'.$_SESSION['user'].'</p> <br />';
		
		  	echo '<p><b>Nombre completo: </b>';
		  	if(!empty($result['nombre']))
				echo $result['nombre'].'&nbsp'.$result['apellidos'].'</p> <br />';
			else
				echo '<i>&ltSin datos&gt</i></p> <br />';
		
			echo '<p><b>Email: </b>';
			if(!empty($result['email']))
				echo $result['email'].'</p> <br />';
			else
				echo '<i>&ltSin datos&gt</i></p> <br />';
		
			echo '<input type="button" class="btn btn-primary" value="Modificar datos" onClick="mostrar(3)" /> <br />';
			echo '<input type="button" class="btn btn-primary" value="Modificar contraseña" onClick="mostrar(4)" />';
		echo '</div>';
	}
	
	function mostrar($opcion)
	{
		$content_sql = 'SELECT * FROM administradores WHERE usuario="'.$_SESSION['user'].'"';
		$content = mysql_query($content_sql);
		$result = mysql_fetch_array($content);
		
		$content_sql2 = 'SELECT * FROM personas WHERE idPersona="'.$result['idPersona'].'"';
		$content2 = mysql_query($content_sql2);
		$result2 = mysql_fetch_array($content2);
		
		if($opcion == 3)
		{
			echo '<div id="content">
				<form action="javascript:modificar('.$result['idPersona'].')">
					<h2>Modificar datos</h2><br /><br />
					
					<p>
						<label for="nombre">Nombre: </label>
						<input type="text" class="form-control" id="nombre" value="'.$result2['nombre'].'" />
					</p><br />							
					<p>
						<label for="apellidos">Apellidos: </label>
						<input type="text" class="form-control" id="apellidos" value="'.$result2['apellidos'].'" />
					</p><br />
					<p>
						<label for="email">Correo electrónico: </label>
						<input type="text" class="form-control" id="email" value="'.$result2['email'].'" />
					</p><br />
					<p>
						<input type="submit" class="btn btn-primary" value="Guardar cambios" />
						<input type="button" class="btn btn-primary" value="Cancelar" onClick="cancelar()" />
					</p>
				</form>
			</div>';
		}
		else if($opcion = 4)
		{
			echo '<div id="content">
				<form action="javascript:passwords()">
					<h2>Modificar contraseña</h2><br /><br />
					
					<p>
						<label for="old_pass">Contraseña anterior: </label>
						<input type="password" class="form-control" id="old_pass" />
					</p><br />							
					<p>
						<label for="pass1">Nueva contraseña: </label>
						<input type="password" class="form-control" id="pass1" />
					</p><br />
					<p>
						<label for="pass2">Confirmar contraseña: </label>
						<input type="password" class="form-control" id="pass2" />
					</p><br />
					<p>
						<input type="submit" class="btn btn-primary" value="Guardar cambios" />
						<input type="button" class="btn btn-primary" value="Cancelar" onClick="cancelar()" />
					</p>
				</form>
			</div>';
		}
	}
	
	function passwords($old_pass, $pass)
	{
		$out = 1;
		
		$old_pass = stripslashes($old_pass);
		$old_pass = mysql_real_escape_string($old_pass);
		$old_pass = md5($old_pass);
		
		$sql = 'SELECT * FROM administradores WHERE usuario="'.$_SESSION['user'].'" AND clave="'.$old_pass.'"';
		$qry = mysql_query($sql);
		$result = mysql_fetch_assoc($qry);
		$RecordCount = mysql_num_rows($qry);
		
		if($RecordCount == 1){ 
			$pass = strip_tags($pass);
			$pass = md5($pass);
			
			$pass_sql = 'UPDATE administradores SET clave="'.$pass.'" WHERE usuario="'.$_SESSION['user'].'"';
			$pass_qry = mysql_query($pass_sql);
			
			if(!$pass_qry)
				$out = 0;
		} 
		else
			$out = 0;
				
		echo $out;
	}
	
	mysql_close($db_con);
?>