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
         	<li ><a href="index.php?page=1">Inicio</a></li>
            <li><a href="./contacto.php">Contacto</a></li>
            <li><a href="./acercade.php">Acerca de</a></li>
			<li class="active"><a href="./registro.php">Registro Usuario</a></li>
            <li><a href="./Login/">Login Admin</a></li>
          </ul>
        </div>
      </div>
    </nav>
    
    <!-- Contenido de la página -->
    <div class="container">
      <div class="row">
 <form action="registro2.php" method="post" name="indice" id="indice" enctype="multipart/form-data">
  	  
	  <!--formulario para el registro de usuario!-->
   	 <p class="Estilo3">Datos de Usuario </p>
				
				<p>Nombre Completo:</p>
				<p>
                <input type="text" name="nomb_usr" required>
			   * <br>
  <br><!--Salto para dar formato al formulario-->
				<p>Apellido Paterno:</p>
				<p>
                <input type="text" name="ap_paterno" required>
			    * </p>
				<p>Apellido Materno:</p>
				<p>
                 <input type="text" name="ap_materno" required>
				* <br>
  <br>
				 Edad:</p>
				 <p>
                 <input type="text" name="edad" required>
				 * </p>
 <br>			 
				 <p>Nombre de Usuario:</p>
				 <p>
                 <input type="text" name="nickname" required>
				 *</p>
				 <p>Contrase&ntilde;a:</p>
				 <p>
                  <input type="password" name="contraseña" required>
				  * </p>
				  <p>(Debe tener alemenos 6 caracteres y una Mayuscula) </p>
				  <p>Tipo de Usuario: </p>
				  <p>
				  
                   <!--seleccionas si es usuario o arrendatario-->
				   <select name="t_usr">
                   <option value="Arrendatario" >Arrendatario
                   <option value="Normal" selected>Usuario
                   </select>
				   *</p>
					
				   <p>Foto:</p>
				   <p>
                   <label>
                   <input name="uploadedfile1" type="file" required/>
                   </label>
					* <br>
  <br>
  
                     </p>
					 <p >Datos de Contacto</p>
					 <p><br>
					 Direccion:</p>
					 <p>
                     <input type="text" name="direccion" required>
					  * <br>
  <br>
					  Correo:</p>
					 <p>
                       <input type="email" name="correo" required>
					   * <br>
  <br>
					  Celular:</p>
					 <p>
                     <input type="text" name="celular" required>
					 * </p>
					 <p> Telefono:</p>
					 <p>
                       <input type="text" name="telefono" required>
					   * <br>
                     </p>
					 <p>IFE</p>
					 <p>
                       <label>
                       <input name="uploadedfile2" type="file" required/>
                       </label>
					   * <br>
  <br>
  <br>
                     </p>
					 <p>Campos requeridos(*) 
			        <p>                      .</p>
                     <p>
                       <input type="submit" name="enviar" id="enviar" value="Enviar" >
                     </p>
		 	</form>
      </div>
    </div>
   
    <!-- Pie de página -->
    <div class="footer">
      <div class="container"></div>
    </div>  
  </body>
</html>
