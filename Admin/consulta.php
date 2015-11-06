<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Unirenta - Consulta de dueños y hospedajes</title>
    
    <!-- CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" /> <!-- Bootstrap -->
    <link href="../css/style.css" rel="stylesheet" />
    <link href="css/admin.css" rel="stylesheet" />
    
    <!-- Scripts -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../js/jquery-1.11.2.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    
    <!-- Scripts de ajax -->
    <script src="ajax/funcionesAjax.js"></script><!-- Motor AJAX -->
    <script src="ajax/ajaxConsulta.js"></script><!-- Funciones AJAX -->
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <?php
	include("php/mysql.php");
		
	session_start();
	if(!isset($_SESSION['user'])) {
	  header("location:../Login/index.php");
	}
	else {
	  $user = $_SESSION['user'];
	}
  ?>
  
  <body>
    <!-- Barra de menú y logo -->
    <nav class="navbar navbar-inverse navbar-static-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>          </button>
          <a class="navbar-brand" href="./index.php">Unirenta</a>
          <p class="navbar-text">Hospedajes cercanos a CU (BUAP)</p>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
          	<li><a href="./index.php">Inicio</a></li>
            <li class="active"><a href="" onClick="window.location.reload()">Consultar hospedajes</a></li>
            <li><a href="./registro.php">Registrar hospedaje</a></li>
            <li><a href="./php/logout.php">Cerrar sesión</a></li>
          </ul>
        </div>
      </div>
    </nav>
    
    <!-- Contenido de la página -->
    <div class="container">    
      <div class="row">
        <div class="col-md-12">
          <div id="content">
            <h1>Consulta de dueños y hospedajes</h1>
            
            <div id="dueños">
              <?php
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
				  echo '<table id="consultas" class="table-bordered table-condensed table-hover" width="100%">
				    <thead>
					  <tr bgcolor="7777FF">
					    <th>No. de dueño</th>
					    <th>Nombre completo</th>
					    <th>Email</th>
					    <th>Teléfono(s)</th>
					    <th>Acciones</th>
					  </tr>
				    </thead>';
				  
				    echo '<tbody>';
				    for ($i = 0; $i < count($dueños); $i++){
				      $result3 = mysql_query('SELECT * FROM clientes WHERE idPersona="'.$dueños[$i].'"');
				      $row2 = mysql_fetch_array($result3);
									  		
					  $result4 = mysql_query('SELECT * FROM personas WHERE idPersona="'.$dueños[$i].'"');
					  $row3 = mysql_fetch_array($result4);
											
			   		  echo '<tr class="clientes">';
					    echo '<td onClick="javascript:mostrar_hos('.$row2['idCliente'].')">'.($i + 1).'</td>';
					    echo '<td onClick="javascript:mostrar_hos('.$row2['idCliente'].')">'.$row3['nombre'].' '.$row3['apellidos'].'</td>';
						
  					    if ($row3['email'] == "")
					      echo '<td onClick="javascript:mostrar_hos('.$row2['idCliente'].')">No especificado</td>';
					    else
						  echo '<td onClick="javascript:mostrar_hos('.$row2['idCliente'].')">'.$row3['email'].'</td>';
						
					    if ($row2['telefono2'] == "")
                          echo '<td onClick="javascript:mostrar_hos('.$row2['idCliente'].')">'.$row2['telefono1'].'</td>';
				        else
                          echo '<td onClick="javascript:mostrar_hos('.$row2['idCliente'].')">'.$row2['telefono1'].' ó '.$row2['telefono2'].'</td>';
					  
					    echo '<td><input type="button" class="btn btn-primary" id="modificar" value="Modificar" onClick="mostrar('.$row2['idPersona'].')"/>
						  <input type="button" class="btn btn-primary" id="eliminar" value="Eliminar" onClick="eliminar('.$row2['idPersona'].', '.$row2['idCliente'].')"/>
					    </td>';	  
					  echo '</tr>';				  
				    }
				    echo '<tbody>';
				  echo '</table><br />';
			    }
			    else {
			  	  echo '<span>No hay ningún dueño ni hospedaje registrado</span>';
			    }			  
			  			  
			    mysql_close($db_con);
		      ?>
            </div>
            
            <div id="hospedajes">            </div>
            
            <div id="modificaciones">            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Pie de página -->
    <div class="footer">
      <div class="container">
        <p class="text-muted">&nbsp;</p>
      </div>
    </div>  
  </body>
</html>