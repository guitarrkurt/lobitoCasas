<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro de hospedajes</title>
    
    <!-- CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" /> <!-- Bootstrap -->
    <link href="../css/style.css" rel="stylesheet" />
    <link href="css/signin.css" rel="stylesheet" />
    
    <!-- Scripts -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../js/jquery-1.11.2.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>    
    
    <!-- Scripts de ajax -->
    <script src="ajax/funcionesAjax.js"></script><!-- Motor AJAX -->
	<script src="ajax/ajaxRegistro.js"></script><!-- Funciones AJAX -->
    <script src="ajax/ajaxImagen.js"></script><!-- Funciones AJAX -->
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
 '<strong>La posicion del marcador es:</strong><br/>',
markerLatLng.lat(),
', ',
markerLatLng.lng(),
'<br/>Arr?strame para actualizar la posici?n.'
].join(''));
infoWindow.open(map, marker);
}


function initMap() {
    map = new google.maps.Map(document.getElementById('mapa'), {
    zoom: 15,
    center: {lat: 19.0014265, lng: -98.20108849999997}
  });
  
 
  
  var myLatlng = new google.maps.LatLng(19.0014265,-98.20108849999997);
infoWindow = new google.maps.InfoWindow();
  marker = new google.maps.Marker({
    map: map,
    draggable: true,
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
		
	session_start();
  ?>
  
  <body>
    <!-- Barra de menú y logo -->
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
            <li><a href="./consulta.php" >Consultar hospedajes</a></li>
            <li class="active"><a href="" onClick="window.location.reload()">Registrar hospedaje</a></li>
            <li><a href="./php/logout.php">Cerrar sesión</a></li>
          </ul>
        </div>
      </div>
    </nav>
    
    <!-- Contenido de la página -->
    <div class="container">    
      <div class="row">
        <div class="col-md-6">
          <form class="form-signin" role="form" action="javascript:registrar()" >
            <h2 class="form-signin-heading">Registro de hospedajes</h2>
            <div class="form-group">
              <input type="text" id="nombre" placeholder="Nombre del propietario *" class="form-control" required autofocus />            
              <input type="text" id="apellidos" placeholder="Apellidos *" class="form-control" required />            
              <input type="text" id="email" placeholder="Correo electrónico" class="form-control" />
              <input type="text" id="tel1" placeholder="Teléfono 1" class="form-control" />
              <input type="text" id="tel2" placeholder="Teléfono 2 (opcional)" class="form-control" />
              <label for="tipo" id="comp">Tipo de Hospedaje *:</label>
              <select id="tipo" class="form-control" onChange="tipos()" required>
                <option value="">--- Seleccione una opción ---</option>
                <option value="casa">Casa Completa</option>
                <option value="Solo por cuartos">Solo por cuartos</option>
				<option value="Pension">Pension</option>
				<option value="Zona Residencial">Zona Residencial</option>
              </select> 
              
			  
			  <!--input type="text" id="tipo" placeholder="Tipo de hospedaje *" class="form-control" required /-->
              <input type="text" id="dir" placeholder="Dirección *" class="form-control" required />
              <textarea id="desc" placeholder="Descripción * Ej. (Buen establecimiento a 5 min de la Fac de Medicina, puertos ambulantes cercanos) " class="form-control" required ></textarea> 
              <textarea id="serv" placeholder="Servicios * Ej. (Luz, Agua, Telefono, Internet, Comida)" class="form-control" required ></textarea>

              
			  
			  <label for="compartido" id="comp">Cuarto Compartido *:</label><br>
              <select id="compartido" class="form-control" onChange="personas()" required>
                <option value="">--- Seleccione una opción ---</option>
                <option value="si">Si</option>
                <option value="no">No</option>
              </select> 
              
			  
			  <input type="text" id="numPer" placeholder="Número de personas" class="form-control" />
              <input type="text" id="mensualidad" placeholder="$00.00 MXN - Mensualidad (solo y/o compartido)*" class="form-control" required />
              <input type="text" id="deposito" placeholder="$00.00 MXN - Deposito" class="form-control" />            
              <input type="text" id="costos" placeholder="$00.00 MXN - Costos extras" class="form-control" />            
			  <label for="genero" id="comp">Genero del Huesped *:</label>
              <select id="genero" class="form-control" onChange="generos()" required>
                <option value="">--- Seleccione una opción ---</option>
                <option value="Femenino">Femenino</option>
                <option value="Masculino">Masculino</option>
				<option value="Mixto">Mixto</option>
              </select> 
              
              <!--input type="text" id="genero" placeholder="Género del huesped *" class="form-control" required /-->
              <!--input type="text" id="disponibilidad" placeholder="Disponibilidad *" class="form-control" required /-->
			  <br>
			  <label for="disponibilidad" id="comp">Dsoponible*:</label><br>
              <select id="disponibilidad" class="form-control" onChange="disponible()" required>
                <option value="">--- Seleccione una opción ---</option>
                <option value="Disponible">Si</option>
                <option value="No Disponible">No</option>
              </select> 
                            
              <textarea id="img" placeholder="Imágenes *" class="form-control readonly" required >
			  </textarea>
            </div>
            <p>* Campos obligatorios</p>
            <input type="submit" class="btn btn-lg btn-primary btn-block" value="Registrar" >
            <a href="javascript:window.history.back()">
              <input type="button" class="btn btn-lg btn-primary btn-block" value="Regresar" />
            </a>
          </form>
        </div>
      
        <div class="col-md-6">
          <form class="form-img" role="form" method="post" enctype="multipart/form-data" action="javascript:subirImagen()" >
            <h2 class="form-img-heading">Subir imágenes</h2>
            <div class="form-group">
	          <input type="text" id="carpeta" placeholder="Nombre de la carpeta *" class="form-control" 
              	onkeyup="this.value = this.value.replace(/[^A-z, 0-9]/, '')"required />  
              <input type="file" id="imgFile" name="imgFile" value="Seleccionar imagen" />
              <input type="submit" class="btn btn-success pull-right" id="btnImg" name="btnImg" value="Agregar" />
 
             
            </div>
             <div id="mapa"></div>
          </form>
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
