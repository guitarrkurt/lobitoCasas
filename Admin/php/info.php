<?php
	header("Content-Type: text/html; charset=utf-8");
	
	include("mysql.php");
	
	session_start();
	$opc = $_REQUEST['opcion'];
	
	switch($opc) {
		case 1:
			$id = $_REQUEST['id'];
			mostrar_hos($id);
			break;
		case 2:
			$id = $_REQUEST['id'];
			mostrar_form($id);
			break;
		case 3:
			$id = $_REQUEST['id'];
			$id_cli = $_REQUEST['id_cli'];
			eliminar_hos($id, $id_cli);
			break;
		case 4:
			$id = $_REQUEST['id'];
			actualizar_hos($id);
			break;
		case 5:			
			$id = $_REQUEST['id'];
			modificar_hos($id);
			break;
		case 6:
			$id = $_REQUEST['id'];
			mostrar($id);
			break;
		case 7:
			$id = $_REQUEST['id'];
			modificar($id);
			break;
		case 8:
			actualizar();
			break;
		case 9:
			$id = $_REQUEST['id'];
			$id_cli = $_REQUEST['id_cli'];
			eliminar($id, $id_cli);
			break;
	}
	
	function mostrar_hos($id) {		
		$str = '<h2>Hospedajes</h2>';
		$hos_result = mysql_query('SELECT * FROM hospedajes WHERE idCliente="'.$id.'"');
		$hos_row_count = mysql_num_rows($hos_result);

		if($hos_row_count > 0) {			
			$str = $str . '<table id="consultas" class="table-bordered table-condensed" width="100%">
				<thead>
					<tr bgcolor="#7777FF">
						<th>Hospedaje No.</th>
						<th>Tipo</th>
						<th>Dirección</th>
						<th>Mensualidad</th>
						<th>Género del huesped</th>
						<th>Disponibilidad</th>
						<th>Imagen</th>
						<th>Acciones</th>
					</tr>
				</thead>';

			$str = $str . '<tbody>';					  
			while ($hos_row = mysql_fetch_array($hos_result)) {
				$cli_result = mysql_query('SELECT * FROM clientes WHERE idCliente="'.$hos_row['idCliente'].'"');
				$cli_row = mysql_fetch_array($cli_result);

				$per_result = mysql_query('SELECT * FROM personas WHERE idPersona="'.$cli_row['idPersona'].'"');
				$per_row = mysql_fetch_array($per_result);

				$img = '../'.strtok($hos_row['imagenes'],';');				  
				
				$str = $str . '<tr>';
					$str = $str . '<td>'.$hos_row['idHospedaje'].'</td>';
					$str = $str . '<td>'.$hos_row['tipo'].'</td>';
					$str = $str . '<td>'.$hos_row['direccion'].'</td>';
					$str = $str . '<td>'.$hos_row['mensualidad'].'</td>';
					$str = $str . '<td>'.$hos_row['generoHuesped'].'</td>';

					if ($hos_row['disponibilidad'] == "Disponible")	
						$str = $str . '<td class="verde">'.$hos_row['disponibilidad'].'</td>';
					else	
						$str = $str . '<td class="rojo">'.$hos_row['disponibilidad'].'</td>';

					$str = $str . '<td><img src="'.$img.'" alt="Hospedaje '.$hos_row['idHospedaje'].'" /></td>';
					$str = $str . '<td><input type="button" class="btn btn-primary" id="modificar" value="Modificar" onClick="mostrar_form('.$hos_row['idHospedaje'].')"/> <br/>
						<input type="button" class="btn btn-primary" id="eliminar" value="Eliminar" onClick="eliminar_hos('.$hos_row['idHospedaje'].', '.$hos_row['idCliente'].')"/>
					</td>';
				$str = $str . '</tr>';				    
			}
			$str = $str . '</tbody>';
			$str = $str . '</table><br />';
			
			echo $str;
		}
		else
			echo '<span>No hay ningún hospedaje registrado de ese dueño</span>';
	}
	
	function mostrar_form($id)
	{
		$result = mysql_query('SELECT * FROM hospedajes WHERE idHospedaje="'.$id.'"');
		$row = mysql_fetch_array($result);
		
		if ($row['compartido'] == 1)
			$comp = "Si";
		else
			$comp = "No";
		
		echo '<form action="javascript:modificar_hos('.$row['idHospedaje'].')">
			<h2>Modificar datos del hospedaje</h2><br />
			
			<p>
				<label for="tipo">Tipo: </label>
				<input type="text" class="form-control" id="tipo" value="'.$row['tipo'].'" />
			</p><br />							
			<p>
				<label for="direccion">Dirección: </label>
				<input type="text" class="form-control" id="direccion" value="'.$row['direccion'].'" />
			</p><br />
			<p>
				<label for="descripcion">Descripción: </label>
				<textarea class="form-control" id="descripcion">'.$row['descripcion'].'</textarea>
			</p><br />
			<p>
				<label for="servicios">Servicios: </label>
				<textarea class="form-control" id="servicios">'.$row['servicios'].'</textarea>
			</p><br />
			<p>
				<label for="compartido">Compartido: </label>
				<input type="text" class="form-control" id="compartido" value="'.$comp.'" />
			</p><br />
			<p>
				<label for="noPersonas">Número de personas: </label>
				<input type="text" class="form-control" id="noPersonas" value="'.$row['noPersonas'].'" />
			</p><br />
			<p>
				<label for="mensualidad">Mensualidad: </label>
				<input type="text" class="form-control" id="mensualidad" value="'.$row['mensualidad'].'" />
			</p><br />
			<p>
				<label for="deposito">Depósito: </label>
				<input type="text" class="form-control" id="deposito" value="'.$row['deposito'].'" />
			</p><br />
			<p>
				<label for="costosExtras">Costos extras: </label>
				<input type="text" class="form-control" id="costosExtras" value="'.$row['costosExtras'].'" />
			</p><br />
			<p>
				<label for="imagenes">Imágenes: </label>
				<textarea class="form-control" id="imagenes">'.$row['imagenes'].'</textarea>
			</p><br />
			<p>
				<label for="generoHuesped">Género del huesped: </label>
				<input type="text" class="form-control" id="generoHuesped" value="'.$row['generoHuesped'].'" />
			</p><br />
			<p>
				<label for="disponibilidad">Disponibilidad: </label>
				<input type="text" class="form-control" id="disponibilidad" value="'.$row['disponibilidad'].'" />
			</p><br />
			<p>
				<label for="idCliente">ID del cliente: </label>
				<input type="text" class="form-control" id="idCliente" value="'.$row['idCliente'].'" />
			</p><br />
			<p>
				<input type="submit" class="btn btn-primary" value="Guardar cambios" />
				<input type="button" class="btn btn-primary" value="Cancelar" onClick="cancelar()" />
			</p>
		</form>';
	}
				
	function eliminar_hos($id, $id_cli)
	{
		$result = mysql_query('DELETE FROM hospedajes WHERE idHospedaje="'.$id.'"');
		
		if (!$result)
			echo 0;
		else
			echo $id_cli;
	}
	
	function actualizar_hos($id)
	{
		mostrar_hos($id);
	}
	
	function modificar_hos($id)
	{
		$tipo = $_REQUEST['tipo'];
		$dir = $_REQUEST['dir'];
		$desc = $_REQUEST['desc'];
		$serv = $_REQUEST['serv'];
		$compartido = $_REQUEST['compartido'];
		$numPer = $_REQUEST['numPer'];
		$mensualidad = $_REQUEST['mensualidad'];
		$deposito = $_REQUEST['deposito'];
		$costos = $_REQUEST['costos'];
		$img = $_REQUEST['img'];
		$genero = $_REQUEST['genero'];
		$disponibilidad = $_REQUEST['disponibilidad'];
		$id_cli = $_REQUEST['id_cli'];
		
		if ($compartido == "Si")
			$compartido = 1;
		else
			$compartido = 0;
		
		$tipo_qry = mysql_query('UPDATE hospedajes SET tipo="'.$tipo.'" WHERE idHospedaje="'.$id.'"');		
		$dir_qry = mysql_query('UPDATE hospedajes SET direccion="'.$dir.'" WHERE idHospedaje="'.$id.'"');		
		$desc_qry = mysql_query('UPDATE hospedajes SET descripcion="'.$desc.'" WHERE idHospedaje="'.$id.'"');		
		$serv_qry = mysql_query('UPDATE hospedajes SET servicios="'.$serv.'" WHERE idHospedaje="'.$id.'"');		
		$comp_qry = mysql_query('UPDATE hospedajes SET compartido="'.$compartido.'" WHERE idHospedaje="'.$id.'"');
		
		$num_qry = mysql_query('UPDATE hospedajes SET noPersonas="'.$numPer.'" WHERE idHospedaje="'.$id.'"');		
		$men_qry = mysql_query('UPDATE hospedajes SET mensualidad="'.$mensualidad.'" WHERE idHospedaje="'.$id.'"');		
		$dep_qry = mysql_query('UPDATE hospedajes SET deposito="'.$deposito.'" WHERE idHospedaje="'.$id.'"');		
		$costos_qry = mysql_query('UPDATE hospedajes SET costosExtras="'.$costos.'" WHERE idHospedaje="'.$id.'"');		
		$img_qry = mysql_query('UPDATE hospedajes SET imagenes="'.$img.'" WHERE idHospedaje="'.$id.'"');
		
		$gen_qry = mysql_query('UPDATE hospedajes SET generoHuesped="'.$genero.'" WHERE idHospedaje="'.$id.'"');		
		$disp_qry = mysql_query('UPDATE hospedajes SET disponibilidad="'.$disponibilidad.'" WHERE idHospedaje="'.$id.'"');
		$id_qry = mysql_query('UPDATE hospedajes SET idCliente="'.$id_cli.'" WHERE idHospedaje="'.$id.'"');
		
		if(!$tipo_qry || !$dir_qry || !$desc_qry || !$serv_qry || !$comp_qry || !$num_qry || !$men_qry || !$dep_qry || 
				!$costos_qry || !$img_qry || !$gen_qry || !$disp_qry || !$id_qry)
			$id_cli = 0;
		
		echo $id_cli;
	}
	
	function mostrar($id)
	{
		$result = mysql_query('SELECT * FROM personas WHERE idPersona="'.$id.'"');
		$row = mysql_fetch_array($result);
		
		$result2 = mysql_query('SELECT * FROM clientes WHERE idPersona="'.$id.'"');
		$row2 = mysql_fetch_array($result2);
				
		echo '<form action="javascript:modificar('.$row['idPersona'].')">
			<h2>Modificar datos del dueño</h2><br />
			
			<p>
				<label for="nombre">Nombre: </label>
				<input type="text" class="form-control" id="nombre" value="'.$row['nombre'].'" />
			</p><br />	
			<p>
				<label for="apellidos">Apellidos: </label>
				<input type="text" class="form-control" id="apellidos" value="'.$row['apellidos'].'" />
			</p><br />							
			<p>
				<label for="email">Email: </label>
				<input type="text" class="form-control" id="email" value="'.$row['email'].'" />
			</p><br />
			<p>
				<label for="telefono1">Teléfono 1: </label>
				<input type="text" class="form-control" id="telefono1" value="'.$row2['telefono1'].'" />
			</p><br />
			<p>
				<label for="telefono2">Teléfono 2: </label>
				<input type="text" class="form-control" id="telefono2" value="'.$row2['telefono2'].'" />
			</p><br />
			<p>
				<input type="submit" class="btn btn-primary" value="Guardar cambios" />
				<input type="button" class="btn btn-primary" value="Cancelar" onClick="cancelar()" />
			</p>
		</form>';
	}
	
	function modificar($id)
	{
		$nombre = $_REQUEST['nombre'];
		$apellidos = $_REQUEST['apellidos'];
		$email = $_REQUEST['email'];
		$tel1 = $_REQUEST['tel1'];
		$tel2 = $_REQUEST['tel2'];
		
		$nom_qry = mysql_query('UPDATE personas SET nombre="'.$nombre.'" WHERE idPersona="'.$id.'"');		
		$ape_qry = mysql_query('UPDATE personas SET apellidos="'.$apellidos.'" WHERE idPersona="'.$id.'"');		
		$email_qry = mysql_query('UPDATE personas SET email="'.$email.'" WHERE idPersona="'.$id.'"');		
		$tel1_qry = mysql_query('UPDATE clientes SET telefono1="'.$tel1.'" WHERE idPersona="'.$id.'"');		
		$tel2_qry = mysql_query('UPDATE clientes SET telefono2="'.$tel2.'" WHERE idPersona="'.$id.'"');
		
		if(!$nom_qry || !$ape_qry || !$email_qry || !$tel1_qry || !$tel2_qry)
			$id = 0;
		
		echo $id;
	}
	
	function actualizar()
	{
		$dueños = array();
		$count = 0;
		
		//Se cuenta el número de dueños que existen en la base de datos		  
		$result = mysql_query('SELECT * FROM personas');
		$row_count = mysql_num_rows($result);
		
		while($row = mysql_fetch_array($result)){
			$result2 = mysql_query('SELECT * FROM administradores WHERE idPersona="'.$row['idPersona'].'"');
			$row_count2 = mysql_num_rows($result2);
			
			if ($row_count2 > 0){
				continue;
			}
			else{
				$dueños[$count] = $row['idPersona'];
				$count++;
			}
		}

		//Se crea la tabla si es que hay dueños existentes en la base de datos			  
		if (($count != 0) && (count($dueños) != 0)) {
			$str = '<table id="consultas" class="table-bordered table-condensed table-hover" width="100%">
				<thead>
					<tr bgcolor="7777FF">
						<th>No. de dueño</th>
						<th>Nombre completo</th>
						<th>Email</th>
						<th>Teléfono(s)</th>
						<th>Acciones</th>
					</tr>
				</thead>';
			
				$str = $str . '<tbody>';
				for ($i = 0; $i < count($dueños); $i++){
					$result3 = mysql_query('SELECT * FROM clientes WHERE idPersona="'.$dueños[$i].'"');
					$row2 = mysql_fetch_array($result3);
						
					$result4 = mysql_query('SELECT * FROM personas WHERE idPersona="'.$dueños[$i].'"');
					$row3 = mysql_fetch_array($result4);
						
					$str = $str . '<tr class="clientes">';
						$str = $str . '<td onClick="javascript:mostrar_hos('.$row2['idCliente'].')">'.($i + 1).'</td>';
						$str = $str . '<td onClick="javascript:mostrar_hos('.$row2['idCliente'].')">'.$row3['nombre'].' '.$row3['apellidos'].'</td>';
						
						if ($row3['email'] == "")
							$str = $str . '<td onClick="javascript:mostrar_hos('.$row2['idCliente'].')">No especificado</td>';
						else
							$str = $str . '<td onClick="javascript:mostrar_hos('.$row2['idCliente'].')">'.$row3['email'].'</td>';
						
						if ($row2['telefono2'] == "")
							$str = $str . '<td onClick="javascript:mostrar_hos('.$row2['idCliente'].')">'.$row2['telefono1'].'</td>';
						else
							$str = $str . '<td onClick="javascript:mostrar_hos('.$row2['idCliente'].')">'.$row2['telefono1'].' ó '.$row2['telefono2'].'</td>';
						
						$str = $str . '<td><input type="button" class="btn btn-primary" id="modificar" value="Modificar" onClick="mostrar('.$row2['idPersona'].')"/>
							<input type="button" class="btn btn-primary" id="eliminar" value="Eliminar" onClick="eliminar('.$row2['idPersona'].', '.$row2['idCliente'].')"/>
						</td>';	  
					$str = $str . '</tr>';				  
				}
				$str = $str . '<tbody>';
			$str = $str . '</table><br />';
			
			echo $str;
		}
		else {
			echo '<span>No hay ningún dueño ni hospedaje registrado</span>';
		}			  
	}
	
	function eliminar($id, $id_cli)
	{
		$result = mysql_query('DELETE FROM hospedajes WHERE idCliente="'.$id_cli.'"');
		$result2 = mysql_query('DELETE FROM clientes WHERE idCliente="'.$id_cli.'"');
		$result3 = mysql_query('DELETE FROM personas WHERE idPersona="'.$id.'"');
		
		if (!$result || !$result2 || !$result3)
			echo 0;
		else
			echo 1;
	}
?>