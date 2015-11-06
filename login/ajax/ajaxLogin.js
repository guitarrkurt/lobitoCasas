// Documento JavaScript
function login() {   
    tiempo = encodeURIComponent(new Date().getTime());//creacion de una variable tiempo para la anti-cache
    user = encodeURIComponent(document.getElementById("user").value);
    pass = encodeURIComponent(document.getElementById("password").value);
	/*-----------------------------Configuacion y envio de la solicitud ASINCRONA : */
	objectXHR = creationXHR();//creacion de un objeto XHR multi-navegadores
	str = "anticache="+tiempo+"&usuario="+user+"&password="+pass;
	objectXHR.open("post","php/login.php", true); //Configuracion del objeto XHR
	objectXHR.onreadystatechange = loginReply;//designacion de la funcion de llamada
	objectXHR.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objectXHR.send(str);//envio de la solicitud
	/*---------------------------------------- */
}

function loginReply() {
	if (objectXHR.readyState == 4) { //prueba si el resultado esta disponible
		if (objectXHR.status == 200) {
			var response = objectXHR.responseText;//recuperacion del resultado reenviado por el servidor 
			remplazarContenido("login_status", response);
			if (response == '0'){
				data = "Fallo de autenticación. Verifique nombre de usuario y/o contraseña";
				remplazarContenido("login_status", data);
				document.getElementById("login_status").style.visibility="visible";
			}
			else{
				data = "";
				remplazarContenido("login_status", data);
				document.getElementById("login_status").style.visibility="hidden";
				window.open("../Admin/", "_self");
			}
	 	} else {
	 	  	//mensaje de error del servidor
	   		var errorServer="Error server : "+objectXHR.status+" – "+ objectXHR.statusText;
	   		remplazarContenido("login_status", errorServer);
	   		document.getElementById("login_status").style.visibility="visible";
	   		
	   		//anula la solicitud en progreso
	   		objectXHR.abort();
	   		objectXHR=null;
		}
	}
}