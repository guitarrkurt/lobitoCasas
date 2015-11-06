<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bienvenidos Unirenta</title>
    
    <!-- CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" /> <!-- Bootstrap -->
    <link href="css/style.css" rel="stylesheet" />
    
    <!-- Scripts -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-1.11.2.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </head>
  
  <?php
	include("php/mysql.php");
  ?>
  
  
  <body>
    <!-- Vínculos a redes sociales del encabezado -->
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
    
    <!-- Barra de menú y logo -->
    <nav class="navbar navbar-inverse navbar-static-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>          </button>
          <a href="index.php?page=1">Unirenta</a>
          <p class="navbar-text">Hospedajes cercanos a CU (BUAP)</p>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
          	<li class="active"><a href="index.php?page=1">Inicio</a></li>
          
		    
		    <li><a href="./contacto.php">Contacto</a></li>
            <li><a href="./acercade.php">Acerca de</a></li>
            <li><a href="./Login/">Login Admin</a></li>
<li><a href="./registro.php">Registrarse</a></li>

          </ul>
        </div>
      </div>
    </nav>
    <div id="left" class="container">
	
          <ul class="nav">
		  <li><a href="#">Busqueda por</a></li>
			<ul>
			     <li><a href="deposito.php?page=1">Deposito</a></li> 
				 <li><a href="costo.php?page=1">Costos Extras</a></li> 
				  <li><a href="mensualidad.php?page=1">Mensualidad</a></li>
				  <li><a href="genero.php?page=1">Genero</a></li>		  
			</ul>
		  </ul>
		  </div>
<form action="busqueda.php" method="post" name="busqued" id="busqued">
<div id="left" class="container" >

Seleccione el tipo de Busqueda:
<select name="tipobusq" id="tipobusq"required>
	        <option value="">--- Seleccione una opci&oacute;n ---</option>
                <option value="colonia">Colonia</option>
                <option value="municipio">Municipio</option>
		<option value="estado">Estado</option>
</select> 
<input type="text" name="busqueda">
<input type="submit" value="Buscar">

</div>
</form>
    <!-- Contenido de la página -->
    <div class="container">
      <div class="row">
      	<?php
		 $count = 0;
		
		
		 
		mysql_connect("localhost","root","");
		mysql_select_db("hospedaje_uni");
	     //$content_sql = ('SELECT * FROM hospedajes limit 0,3') ;
		 //$content = mysql_query($content_sql);
		$content=mysql_query("SELECT * FROM hospedajes");
        //$total =round(mysql_num_rows($content)/6)+2;
		
		 //Es la funcion para la paginacion
		if(is_numeric($_GET['page'])&& $_GET['page'] > 0 ){
		$page = $_GET['page']-1;
		$start = $page * 5; $end=9; 
		$prev=$page; $next=$page+2;
		
		} 
		else{
		$start=0; $end=3;
		$prev=1; $next=2;
		}
		
		//pones el limite de datos que veras en este caso son 6
		//$content=mysql_query("SELECT * FROM hospedajes order by  deposito limit $start,$end ");
		$content=mysql_query("SELECT * FROM hospedajes limit $start,$end ");

		//$paging = new PHPPaging;
		$latitud[0]=0.0;
                $longitud[0]=0.0;
     for($i=0;$i<10;$i++){
          $latitud[$i]=0.0;
          $longitud[$i]=0.0;

        }
		$dept=0;
		  while($row = mysql_fetch_assoc($content) )
		  {
			$count++;
			$token = strtok($row['imagenes'], ';');  

$latitud[$dept]=$row['lat'];
$longitud[$dept]=$row['long'];
//echo"Dept:$dept Latitud:$latitud[$dept] Longitud:$longitud[$dept] ";
$dept++;			
if ($count == 1)
echo '<div class="col-md-12">';
			  
echo '<div class="col-md-4">';
echo '<div id="info">';
echo '<h2></h2>';
echo '<div class="imgholder"><img src="'.$token.'" width="240" height="240" '.'" /></div>';

//echo '<p>'.$row['descripcion'].'</p>';
echo'<a href="deposito.php" title="Deposito">Deposito: </a>'.$row['deposito'].'      /   <a href="costo.php" title="Costo"> Costo: </a>'.$row['costosExtras'].'      /   <a href="mensualidad.php" title="Mensualidad">Mensualidad: </a>'.$row['mensualidad'].'      /   <a href="genero.php" title="Genero">Genero: </a>'.$row['generoHuesped'];
echo '<p class="more"><a href="./hospedaje.php?id='.$row['idHospedaje'].'">Ver más &raquo;</a></p>';
echo '</div>';
echo '</div>';

//Mantiene el formato cuando llega a 3 fotos da el enter
		  if ($count == 3){
		   echo '</div>';
			$count = 0;
			$page=3;
			}
			
		  }
		
		 echo("<br/>");
		 echo '<div class="col-md-12">';
                echo'<div id="mapa"></div>';
		echo("<a href=\"?page=".$prev."\">Prev</a> | <a href=\"?page=".$next."\">Next</a>");
		 
			
		  mysql_close($db_con);
		?>

      </div>
    </div>

	<!-- Pie de página -->
    <div class="footer">
      <div class="container"></div>
  </div>  
  </body>
<meta charset="UTF-8">
    <style type="text/css">
    #mapa { height: 350px;width:1100px; }
    </style>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
    function initialize() {
      //Lectura desde la base de datos!! 
	  var marcadores= new Array();
           marcadores = [
        ['Departamento 1', 19.00609277889847, -98.20297677514645],
        ['Departamento 2', 18.99805858261185, -98.20413548944089],
        ['Departamento 3', 19.00016861111954, -98.19061715600583],
	['Departamento 4', 19.00726947204238, -98.20563752648923],
	['Departamento 5', 19.006052203124355, -98.21520764825436]
		];
 marcadores = [
        ['Departamento 1', 0, 0],
        ['Departamento 2', 0, 0],
        ['Departamento 3', 0, 0],
        ['Departamento 4', 0, 0],
        ['Departamento 5', 0, 0],
        ['Departamento 6', 0, 0],
        ['Departamento 7', 0, 0],
        ['Departamento 8', 0, 0],
        ['Departamento 9', 0, 0]
                ];

marcadores[1][1] = "<?php echo $latitud[0]; ?>" ;
marcadores[1][2] = "<?php echo $longitud[0]; ?>" ;
marcadores[2][1] = "<?php echo $latitud[1]; ?>" ;
marcadores[2][2] = "<?php echo $longitud[1]; ?>" ;
marcadores[3][1] = "<?php echo $latitud[2]; ?>" ;
marcadores[3][2] = "<?php echo $longitud[2]; ?>" ;
marcadores[4][1] = "<?php echo $latitud[3]; ?>" ;
marcadores[4][2] = "<?php echo $longitud[3]; ?>" ;
marcadores[5][1] = "<?php echo $latitud[4]; ?>" ;
marcadores[5][2] = "<?php echo $longitud[4]; ?>" ;
marcadores[6][1] = "<?php echo $latitud[5]; ?>" ;
marcadores[6][2] = "<?php echo $longitud[5]; ?>" ;
marcadores[7][1] = "<?php echo $latitud[6]; ?>" ;
marcadores[7][2] = "<?php echo $longitud[6]; ?>" ;
marcadores[8][1] = "<?php echo $latitud[7]; ?>" ;
marcadores[8][2] = "<?php echo $longitud[7]; ?>" ;






       var x = new Array();
      <?php
        // for ($i = 0;$i<count($latitud-1); $i++){
          //echo 'marcadores['. $i+1 .'][1] = '. $latitud($i) .';\n';
          //echo 'marcadores['. $i+1 .'][2] = '. $longitud($i) .';\n';
          // }
       ?>
      var map = new google.maps.Map(document.getElementById('mapa'), {
        zoom: 15,
        center: new google.maps.LatLng(19.0014265,-98.20108849999997),
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });
      var infowindow = new google.maps.InfoWindow();
	
    var marker, i;
      for (i = 0; i < marcadores.length; i++) {  
        marker = new google.maps.Marker({
          position: new google.maps.LatLng(marcadores[i][1], marcadores[i][2]),
          map: map
        });
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
            infowindow.setContent(marcadores[i-1][0]);
            infowindow.open(map, marker);
          }
        })(marker, i));
      }
	 

    }

    //var markerCluster = new MarkerClusterer(map,marker);

    google.maps.event.addDomListener(window, 'load', initialize);
    </script>
</html>
