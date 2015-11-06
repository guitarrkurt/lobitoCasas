<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio</title>
    
    <!-- CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" /> <!-- Bootstrap -->
    <link href="css/style.css" rel="stylesheet" />
    
    <!-- Scripts -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-1.11.2.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
<form action="registro2.php" method="post" name="indice" id="indice">
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
          <a class="navbar-brand" href="" onClick="window.location.reload()">Unirenta</a>
          <p class="navbar-text">Hospedajes cercanos a CU (BUAP)</p>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
          	<li class="active"><a href="" onClick="window.location.reload()">Inicio</a></li>
            <li><a href="./contacto.html">Contacto</a></li>
            <li><a href="./acercade.html">Acerca de</a></li>
            <li><a href="./Login/">Login Admin</a></li>
          </ul>
        </div>
      </div>
    </nav>
    
    <!-- Contenido de la página -->
    <div class="container">
      <div class="row">
	  
		   <?php
		  $band=0;
		  $nom_usr=$_REQUEST['nomb_usr'];
		  $appater=$_REQUEST['ap_paterno'];
		  $apmater=$_REQUEST['ap_materno'];
		  $edad=$_REQUEST['edad'];
		  $user=$_REQUEST['nickname'];
		  $contr=$_REQUEST['contraseña'];
		  $tip_usr=$_REQUEST['t_usr'];
		  $direccion=$_REQUEST['direccion'];
		  $correo=$_REQUEST['correo'];
		  $cel=$_REQUEST['celular'];
		  $tel=$_REQUEST['telefono'];
		  		  
		  
          
		  
		  
		  
		  if(strlen($contr) < 6){
      print("La clave debe tener al menos 6 caracteres");
      $band=1;
   }
   if (!preg_match('`[A-Z]`',$contr)){
      print("La clave debe tener al menos una letra mayúscula");
      $band=1;
   }
		  
		  
		  if($band==1){
		  //header("Location:registro.php");
		  }
		  
		  $link=mysql_connect("localhost","root","");//Establece la conexion
          mysql_select_db("hospedaje_uni",$link);//Selecciona la BD a usar
         
$band2=true;	
		 
		 //************ fotos
$foto_u=$_FILES['uploadedfile1']['name'];		 
$msg="";
$msg2="";		 		 
$uploadedfileload="true";
$uploadedfile_size=$_FILES['uploadedfile1']['size'];
echo $_FILES['uploadedfile1']['name'];
if ($_FILES['uploadedfile1']['size']>900000)
{$msg=$msg."El archivo es mayor que 200KB, debes reduzcirlo antes de subirlo<BR>";
$uploadedfileload="false";$band2==false;}

if (!($_FILES['uploadedfile1']['type'] =="image/jpeg" OR $_FILES['uploadedfile1']['type'] =="image/gif"))
{$msg=$msg." Tu archivo tiene que ser JPG o GIF. Otros archivos no son permitidos<BR>";
$uploadedfileload="false";
$band2==false;}

$file_name=$_FILES['uploadedfile1']['name'];
$add="Fotos/$file_name";
if($uploadedfileload=="true"){

if(move_uploaded_file ($_FILES['uploadedfile1']['tmp_name'], $add)){
echo " Ha sido subido satisfactoriamente<br>";
}else{echo "Error al subir el archivo";}

}else{echo $msg;}
	 
		 
		 //*************

		 //************ IFE
		 
$uploadedfileload="true";
$uploadedfile_size=$_FILES['uploadedfile2']['size'];
echo $_FILES['uploadedfile2']['name'];
if ($_FILES['uploadedfile2']['size']>900000)
{$msg2=$msg2."El archivo es mayor que 900KB, debes reduzcirlo antes de subirlo<BR>";
$uploadedfileload="false";
$band2==false;}

if (!($_FILES['uploadedfile2']['type'] =="image/jpeg" OR $_FILES['uploadedfile2']['type'] =="image/gif"))
{$msg2=$msg2." Tu archivo tiene que ser JPG o GIF. Otros archivos no son permitidos<BR>";
$uploadedfileload="false";
$band2=false;
}

$file_name=$_FILES['uploadedfile2']['name'];
$add="IFE/$file_name";
if($uploadedfileload=="true"){

if(move_uploaded_file ($_FILES['uploadedfile2']['tmp_name'], $add)){
echo " Ha sido subido satisfactoriamente<br>";
}else{echo "Error al subir el archivo";}

}else{echo $msg2;}
	 
$result4;		 
		 
$ife_u=$_FILES['uploadedfile2']['name'];
		 //*************
		 
		 print("Contraseña:$contr");
		 
		 $contr=md5($contr);
		 
		 
		 if($band2==true){
		 $result4=mysql_query("INSERT INTO usuario(id_usuario,tipo_u,Nombre_u,Apellidop_u,Apellidom_u,Edad_u,Foto_u,Direccion_u,Celular_,Telefono_,Correo_u,IFE_u,Contrasena_u,Lat_u,Long_u) values('$user','$tip_usr','$nom_usr','$appater','$apmater','$edad','$foto_u','$direccion','$cel','$tel','$correo','$ife_u','$contr','12','23')",$link);}
		
		
		 else{print("No se pudo registrar en la Base de Datos Usuario Contraseña:$contr");}
           
		  /* if($result4=="True")
           {
		     print("Se ha registrado el Usuario: $nom_usr Correctamenta ");
		    }else{
			print("No se pudo registrar en la Base de Datos Usuario Contraseña:$contr");
			//print (" Celular $cel");
			}*/
          print("");
           
		 
		 
		  ?>
      </div>
    </div>
    	</form>
    <!-- Pie de página -->
    <div class="footer">
      <div class="container"></div>
    </div>  
  </body>
</html>