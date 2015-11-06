<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Unirenta - Iniciar sesión</title>
    
    <!-- CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" /> <!-- Bootstrap -->
    <link href="../css/style.css" rel="stylesheet" />
    <link href="css/login.css" rel="stylesheet" />
    
    <!-- Scripts -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../js/jquery-1.11.2.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    
    <!-- Scripts de ajax -->
	<script src="ajax/funcionesAjax.js"></script><!-- Motor AJAX -->
    <script src="ajax/ajaxLogin.js"></script><!-- Funciones AJAX -->
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <?php
	include("php/mysql.php");
		
	session_start();
	if(isset($_SESSION['user']))
	{
	  $user = $_SESSION['user'];
   	  header("location:../Admin/index.php");
	}
  ?>
  
  <body>
    <!-- Vínculos a redes sociales del encabezado -->
    <div id="top" class="container">
      <div id="topbar" class="row">
        <div id="social" class="col-sm-8">
          <ul>
            <li><a href="#"><img src="../images/bookmarks/rss.jpg" width="25" height="25" alt="" /></a></li>
            <li><a href="#"><img src="../images/bookmarks/facebook.jpg" width="25" height="25" alt="Add to: Facebook" /></a></li>
            <li><a href="#"><img src="../images/bookmarks/delicious.jpg" width="25" height="25" alt="Del.icio.us" /></a></li>
            <li><a href="#"><img src="../images/bookmarks/stumbleupon.jpg" width="25" height="25" alt="Stumbleupon" /></a></li>
            <li><a href="#"><img src="../images/bookmarks/reddit.jpg" width="25" height="25" alt="reddit" /></a></li>
            <li><a href="#"><img src="../images/bookmarks/digg.jpg" width="25" height="25" alt="Digg" /></a></li>
            <li><a href="#"><img src="../images/bookmarks/yahoo.jpg" width="25" height="25" alt="Y! MyWeb" /></a></li>
            <li class="last"><a href="#"><img src="../images/bookmarks/google.jpg" width="25" height="25" alt="Google" /></a></li>
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
          <a class="navbar-brand" href="../index.php">Unirenta</a>
          <p class="navbar-text">Hospedajes cercanos a CU (BUAP)</p>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
          	<li><a href="../index.php">Inicio</a></li>
            <li><a href="../contacto.php">Contacto</a></li>
            <li><a href="../acercade.php">Acerca de</a></li>
            <li class="active"><a href="" onClick="window.location.reload()">Login Admin</a></li>
            <li><a href="../registro.php">Registrarse</a></li>
          </ul>
        </div>
      </div>
    </nav>
    
    <!-- Contenido de la página -->
    <div class="container">    
      <form class="form-login" role="form" action="javascript:login()">
        <h2 class="form-login-heading">Iniciar sesión</h2>
        <div class="form-group">
          <input type="text" placeholder="Usuario" class="form-control" id="user" required autofocus>
          <input type="password" placeholder="Contraseña" class="form-control" id="password" required>
        </div>
        <span class="pop" id="login_status"></span>
        <input type="submit" class="btn btn-lg btn-primary btn-block" value="Entrar" />
        <a href="javascript:window.history.back()">
          <input type="button" class="btn btn-lg btn-primary btn-block" value="Regresar" />
        </a>
      </form>
    </div>
    
    <!-- Pie de página -->
    <div class="footer">
      <div class="container">
        <p class="text-muted">&nbsp;</p>
      </div>
    </div>  
  </body>
</html>
