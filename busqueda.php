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
<ul class="nav">
Seleccione el tipo de Busqueda:
<select id="tipobusq" name="tipobusq" required>
	        <option value="">--- Seleccione una opci&oacute;n ---</option>
                <option value="colonia">Colonia</option>
                <option value="municipio">Municipio</option>
		<option value="estado">Estado</option>
</select> 
<input type="text" name="busqueda">

<input type="submit" value="Buscar">
</ul>
</div>
</form>
    <!-- Contenido de la página -->
    <div class="container">
      <div class="row">
      	<?php
		 $count = 0;
                
		$tipo_b=$_REQUEST['tipobusq'];
		$busq=$_REQUEST['busqueda'];
               
		 
		mysql_connect("localhost","root","");
		mysql_select_db("hospedaje_uni");
	     //$content_sql = ('SELECT * FROM hospedajes limit 0,3') ;
		 //$content = mysql_query($content_sql);
                if($tipo_b=="colonia"){    
$content=mysql_query("SELECT * FROM hospedajes where Colonia like '%$busq%'");
                 }
                 if($tipo_b=="municipio"){
$content=mysql_query("SELECT * FROM hospedajes where Municipio like '%$busq%'");
                 }
                  if($tipo_b=="estado"){
$content=mysql_query("SELECT * FROM hospedajes where Estado like '%$busq%'");
                 }

        //$total =round(mysql_num_rows($content)/6)+2;
		
		 //Es la funcion para la paginacion
		if(is_numeric($_GET['page'])&& $_GET['page'] > 0 ){
		$page = $_GET['page']-1;
		$start = $page * 5; $end=9; 
		$prev=$page; $next=$page+2;
		$tipo_b=$_GET['tipo_bu'];
                $busq=$_GET['busqu']; 
                
		} 
		else{
		$start=0; $end=3;
		$prev=1; $next=2;
		}
		
		//pones el limite de datos que veras en este caso son 6
		//$content=mysql_query("SELECT * FROM hospedajes order by  deposito limit $start,$end ");
if($tipo_b=="colonia"){
echo("tipo:$tipo_b busqueda:$busq");
$content=mysql_query("SELECT * FROM hospedajes where Colonia like '%$busq%'limit $start,$end ");
}
if($tipo_b=="municipio"){
echo("tipo:$tipo_b busqueda:$busq");
$content=mysql_query("SELECT * FROM hospedajes where Municipio like '%$busq%'limit $start,$end ");
}
if($tipo_b=="estado")
{
echo("tipo:$tipo_b busqueda:$busq");
$content=mysql_query("SELECT * FROM hospedajes where Estado like '%$busq%'limit $start,$end ");
}
		//$paging = new PHPPaging;
		
		
		  while($row = mysql_fetch_assoc($content) )
		  {
			$count++;
			$token = strtok($row['imagenes'], ';');  
			
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
		echo("<a href=\"?page=".$prev."&tipo_bu=".$tipo_b."&busqu=".$busq."\">Prev</a> | <a href=\"?page=".$next."&tipo_bu=".$tipo_b."&busqu=".$busq."\">Next</a>");
		 
			
		  mysql_close($db_con);
		?>

      </div>
    </div>

	<!-- Pie de página -->
    <div class="footer">
      <div class="container"></div>
  </div>  
  </body>
</html>
