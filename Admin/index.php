<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Unirenta - Panel de administrador</title>
    
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
    <script src="ajax/ajaxAdmin.js"></script><!-- Funciones AJAX -->
    
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
          <a class="navbar-brand" href="" onClick="window.location.reload()">Unirenta</a>
          <p class="navbar-text">Hospedajes cercanos a CU (BUAP)</p>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
          	<li class="active"><a href="" onClick="window.location.reload()">Inicio</a></li>
            <li><a href="./consulta.php">Consultar hospedajes</a></li>
            <li><a href="./registro.php">Registrar hospedaje</a></li>
            <li><a href="./php/logout.php">Cerrar sesión</a></li>
          </ul>
        </div>
      </div>
    </nav>
    
    <!-- Contenido de la página -->
    <div class="container">    
      <div class="row">
        <?php
          if(isset($_SESSION['user']))
          {
            $content_sql = 'SELECT * FROM administradores WHERE usuario="'.$user.'"';
            $content = mysql_query($content_sql);
            $result = mysql_fetch_array($content);
			
			$content_sql2 = 'SELECT * FROM personas WHERE idPersona="'.$result['idPersona'].'"';
            $content2 = mysql_query($content_sql2);
            $result2 = mysql_fetch_array($content2);
                        
			echo '<div id="datos" class="col-md-6">';
			  echo '<div id="content">';
		  	    echo '<h2>Datos de usuario</h2><br /><br />';
			    echo '<p><b>Usuario: </b>'.$result['usuario'].'</p> <br />';
					
			    echo '<p><b>Nombre completo: </b>';
			    if(!empty($result2['nombre']))
			      echo $result2['nombre'].'&nbsp'.$result2['apellidos'].'</p> <br />';
			    else
				  echo '<i>&ltSin datos&gt</i></p> <br />';		
							
			    echo '<p><b>Email: </b>';
			    if(!empty($result2['email']))
				  echo $result2['email'].'</p> <br />';
			    else
				  echo '<i>&ltSin datos&gt</i></p> <br />';
							
		        echo '<input type="button" class="btn btn-primary" value="Modificar datos" onClick="mostrar(3)" /> <br />';
		        echo '<input type="button" class="btn btn-primary" value="Modificar contraseña" onClick="mostrar(4)" />';
			  echo '</div>';
			echo '</div>';
                        
            echo '<div id="collapsed" class="col-md-6">
			</div>';
						
			mysql_close($db_con);
          }
        ?>
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