<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Unirenta - Datos de hospedaje</title>
    
    <!-- CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" /> <!-- Bootstrap -->
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/rateit.css" rel="stylesheet" />
    
    <!-- Scripts -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-1.11.2.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.rateit.min.js"></script>
    <script src="js/script.js"></script>
    
    <!-- Scripts de ajax -->
    <script src="ajax/funcionesAjax.js"></script><!-- Motor AJAX -->
    <script src="ajax/ajaxOpini?n.js"></script><!-- Funciones AJAX -->
	
	<!-- PAra las imagenes-->
	<link rel="stylesheet" href="css/jquery.bxslider.css" type="text/css">
 
	<script src="js/jquery.bxslider.js"></script>
  
	
	<script type="text/javascript">
	$(document).ready(function(){
    
	$('.bxslider').bxSlider({
	mode: 'fade',
	captions: true
	});
	});
	</script>
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.4";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php
 include("php/mysql.php");
        
        $id = $_REQUEST['id'];

$lng1=0;$lat1=0;
$result = mysql_query('SELECT * FROM hospedajes where idHospedaje = "'.$id.'"'); // consulta 1
                  while($row = mysql_fetch_array($result)){
                        $lng1 = $row['long'];
                        $lat1 = $row['lat'];
                  }
//echo("Latitud:$lat1 Longitud:$lng1 ");
$lat=19.00162938441272;
$lng=-98.20709664819333;
$lat=$lat1;
$lng=$lng1;


?>
<meta charset="UTF-8">
    <style type="text/css">
    #mapa { height: 500px; }
    </style>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
    var marker;
var map=null;
var infoWindow=null;

//Aqui obtenemos los valores latitud y longitud para guardar en la base de datos
function openInfoWindow(marker) {
  var markerLatLng = marker.getPosition();
 infoWindow.setContent([
 '<strong>La posicion del marcador es :</strong><br/>',
markerLatLng.lat(),
', ',
markerLatLng.lng(),
'<br/>'
].join(''));
infoWindow.open(map, marker);
}


function initMap() {
    var latitudd = "<?php echo $lat; ?>" ;
    var longitudd = "<?php echo $lng; ?>" ;
    map = new google.maps.Map(document.getElementById('mapa'), {
    zoom: 15,
    center: {lat: 18.997368759796615, lng: -98.21091611383054}
    <!--center: {lat: latitudd, lng: longitudd}//-->
  });
  
 
  var latitudd2 = "<?php echo $lat; ?>" ;
  var longitudd2 = "<?php echo $lng; ?>" ;
  <!--var myLatlng = new google.maps.LatLng(18.997368759796615,-98.21091611383054);//-->
  var myLatlng = new google.maps.LatLng(latitudd2,longitudd2);
infoWindow = new google.maps.InfoWindow();
  marker = new google.maps.Marker({
    map: map,
    draggable: false,
    animation: google.maps.Animation.DROP,
    position: myLatlng,
  });
  marker.addListener('click', toggleBounce);
openInfoWindow(marker);
  google.maps.event.addListener(marker, 'dragend', function(){ openInfoWindow(marker); });
	google.maps.event.addListener(marker, 'click', function(){ openInfoWindow(marker); });
	
  }

function toggleBounce() {
  if (marker.getAnimation() !== null) {
    marker.setAnimation(null);
  } else {
    marker.setAnimation(google.maps.Animation.BOUNCE);
  }
}

    google.maps.event.addDomListener(window, 'load', initMap);
    </script>
  </head>
  
  <?php
    include("php/mysql.php");
	
	$id = $_REQUEST['id'];
  ?>
  
  <body>
    <!-- V�nculos a redes sociales del encabezado -->
    <div id="top" class="container">
      <div id="topbar" class="row">
        <div id="social" class="col-sm-8">
          <ul>
            <li></li>
          </ul>
        </div>
        <div id="search" class="col-sm-4">
          <form action="#" method="post" class="form-inline" role="form">
            <div class="form-group">
              <legend>Site Search</legend>
              <input type="text" class="form-control" placeholder="Buscar" />
              <input type="submit" name="go" id="go" class="btn btn-default" value="IR" />
            </div>
          </form>
        </div>
      </div>
    </div>
    
    <!-- Barra de men� y logo -->
    <nav class="navbar navbar-inverse navbar-static-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="./index.php">Unirenta</a>
          <p class="navbar-text">Hospedajes cercanos a CU (BUAP)</p>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
          	<li><a href="./index.php">Inicio</a></li>
            <li><a href="./contacto.php">Contacto</a></li>
            <li><a href="./acercade.php">Acerca de</a></li>
            <li><a href="./Login/">Login Admin</a></li>
          </ul>
        </div>
      </div>
    </nav>
    
    <!-- Contenido de la p�gina -->
    <div class="container">
      <div class="row">      
        <div class="col-md-12">
          <div id="content">
            <?php
              echo '<h1>Hospedaje '.$id.'</h1>';
			?>
          </div>
        </div>
        
        <?php		  
		  $result = mysql_query('SELECT * FROM hospedajes where idHospedaje = "'.$id.'"'); // consulta 1
		  while($row = mysql_fetch_array($result)){
			$id_hospedaje = $row['idHospedaje'];
			$tipo = $row['tipo'];
			$direccion = $row['direccion'];
			$descripcion = $row['descripcion'];
			$servicios = $row['servicios'];
			$compartido = $row['compartido'];
			$numPer = $row['noPersonas'];
			$mensualidad = $row['mensualidad'];
			$deposito = $row['deposito'];
			$costos = $row['costosExtras'];
			$img = $row['imagenes'];
			$genero = $row['generoHuesped'];
			$disponibilidad = $row['disponibilidad'];
			$idcliente = $row['idCliente'];
                        $estado=$row['Estado'];
                        $municipio=$row['Municipio'];
                        $colonia=$row['Colonia'];
		  }
		  
		  $result2 = mysql_query('SELECT * FROM clientes WHERE idCliente = "'.$idcliente.'"'); // consulta 2
		  while($row = mysql_fetch_array($result2)){	
		    $id_cliente = $row['idCliente'];
			$telefono1 = $row['telefono1'];
			$telefono2 = $row['telefono2'];
			$idpersona = $row['idPersona'];
		  }
		  
		  $result3 = mysql_query('SELECT * FROM personas WHERE idPersona = "'.$idpersona.'"'); // consulta 3
		  while($row = mysql_fetch_array($result3)){
			$id_persona = $row['idPersona'];
			$nombre = $row['nombre'];
			$apellidos = $row['apellidos'];
			$email = $row['email'];
		  }
		  
		  $token = strtok($img, ';');
		  
		  echo '<ul class="bxslider">';
			
		  while (($token != false) and ($token != " ")){
		    
				  echo '<li style="position: center;"><img src="'.$token.'" width="240" height="240" alt="" /></li>';
			    
			
		    $token = strtok(';');
		  }
		  echo '</ul>';

		?>
        
        <div class="col-md-12">
          <div id="content">
            <h2>Información del Hospedaje</h2>
            <table id="tabla-hos" class="table table-hover table-bordered">
              <tr>
                <th>Nombre del dueño</th>
                <?php
                  echo '<td>'. $nombre . ' ' . $apellidos .'</td>';
				?>
              </tr>  
              <tr>
                <th>Correo Electrónico</th>
                <?php
				  if ($email == "")
				    $email = "No especificado";
                  echo '<td>'. $email .'</td>';
				?>     
              </tr>            
              <tr>
                <th>Teléfonos</th>
                <?php
				  if ($telefono2 == "")
                    echo '<td>'. $telefono1 .'</td>';
				  else
                    echo '<td>'. $telefono1 .' � ' . $telefono2 . '</td>';
				?>     
              </tr>  
              <tr>
                <th>Tipo de hospedaje</th>
                <?php
                  echo '<td>'. $tipo .'</td>';
				?>    
              </tr>
              <tr>
                <th>Dirección</th>
                <?php
                  echo '<td>'. $direccion .'</td>';
				?>
              </tr>    
              <tr>
                <th>Descripción</th>
                <?php
                  echo '<td>'. $descripcion .'</td>';
				?>    
              </tr>       
              <tr>
                <th>Servicios</th>
                <?php
                  echo '<td>'. $servicios .'</td>';
				?>
              </tr>
              <tr>
                <th>Compartido</th>
                <?php
				  if ($compartido < 1) {
				    $compartido = "No";
					if (($numPer > 0))
  					  echo '<td>'. $compartido .', con '.$numPer.' personas</td>';
					else
					  echo '<td>'. $compartido ;
				  }
				  else { 
				  	$compartido = "No";
					echo '<td>'. $compartido .'</td>';
				  }                  
				?>
              </tr>
              <tr>
                <th>Mensualidad</th>
                <?php
                  echo '<td>'. $mensualidad .'</td>';
				?>
              </tr>
              <tr>
                <th>Deposito</th>
                <?php
                  echo '<td>$'. $deposito .'</td>';
				?>
              </tr>
              <tr>
              <th>Colonia</th>
              <?php
                  echo '<td>'. $colonia .'</td>';
                  ?>
              </tr>
              <tr>
              <th>Estado</th>
              <?php
                  echo '<td>'. $estado .'</td>';
                  ?>
              </tr>
              <tr>
              <th>Municipio</th>
              <?php
                  echo '<td>'. $municipio .'</td>';
                  ?>
              </tr>
              <tr>
                <th>Costos extras</th>
                <?php
                  echo '<td>$'. $costos .'</td>';
				?>
              </tr>
              <tr>
                <th>Género del huesped</th>
                <?php
                  echo '<td>'. $genero  .'</td>';
				?>    
              </tr>
              <tr>
                <th>Disponibilidad</th>
                <?php
				  if ($disponibilidad == "Disponible")	
				    echo '<td id="disponibilidad" class="verde">'. $disponibilidad  .'</td>';
				  else	
				    echo '<td id="disponibilidad" class="rojo">'. $disponibilidad  .'</td>';
                                    
				?>
              </tr>
             <tr>
              <th>Mapa</th>
              <td id="mapa" >
               </td>
             </tr> 
            </table>
          </div>
        </div>
        <div class="col-md-12">
          <div id="content">
            <h2>Opiniones sobre el hospedaje</h2>
            
            <div id="comments">
              <?php
				$content_sql = 'SELECT * FROM opiniones WHERE idHospedaje="'.$id.'"';
				$content = mysql_query($content_sql);
				$num_rows = mysql_num_rows($content);
				
				if ($num_rows == 0){
				  echo '<p id="no-comment">No hay comentarios</p>';
				}
				else{
				  while($row = mysql_fetch_assoc($content)){
					echo '<div class="comment-post">
					  <p id="nom">'.$row['nombre'].'</p>
					  <p id="valor">Valoración: '.$row['valoracion'].'</p>
					  <p id="text">'.$row['comentarios'].'</p>
					  <p id="fecha">'.$row['fecha'].'</p>
					   
					  <p id="promedio">'.$row['promedio'].'</p>
					</div>';
				  }
			
			
				}				
			
			
			 
			  
	
			  ?>
            </div>
            
            <!--<div class="comment-post">
              <p id="nom">Anónimo</p>
              <p id="valor">Valoración</p>
              <p id="text">Prueba de comentario</p>
              <p id="fecha">Fecha</p>
            </div>-->
		 
			  
<div class="comment">
<form class="comment-form" role="form" action="javascript:opinar(<?php echo $id; ?>)">
<div class="form-group">

<input type="text" class="form-control" placeholder="Nombre" id="nombre" required />
<textarea class="form-control" placeholder="Deja un comentario" id="comentario" required></textarea>
<label for="rateit" class="label pull-left">Califica este hospedaje:</label>
<div id="rateit" class="rateit bigstars" data-rateit-starwidth="24" data-rateit-starheight="24"></div>
               

   
			   <input type="submit" class="btn btn-primary pull-right" value="Comentar"/>
                </div>
              </form>

			  
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <?php
	  mysql_close($db_con);
	?>
    
    <!-- Pie de p�gina -->
    <div class="footer">
      <div class="container">
        <p class="text-muted">&nbsp;</p>
      </div>
    </div>  
  </body>
</html>
