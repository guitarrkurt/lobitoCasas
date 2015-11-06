// Documento JavaScript
function modificar(var1) {   
    tiempo = encodeURIComponent(new Date().getTime());//creacion de una variable tiempo para la anti-cache
    nombre = encodeURIComponent(document.getElementById("nombre").value);
    apellidos = encodeURIComponent(document.getElementById("apellidos").value);
	email = encodeURIComponent(document.getElementById("email").value);	
	idPersona = var1;
	opcion = 1;
	/*-----------------------------Configuacion y envio de la solicitud ASINCRONA : */
	objectXHR = creationXHR();//creacion de un objeto XHR multi-navegadores
	str = "anticache="+tiempo+"&nombre="+nombre+"&apellidos="+apellidos+"&email="+email+"&idPersona="+idPersona+"&opcion="+opcion;
	objectXHR.open("post","php/cambios.php", true); //Configuracion del objeto XHR
	objectXHR.onreadystatechange = modificarReply;//designacion de la funcion de llamada
	objectXHR.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objectXHR.send(str);//envio de la solicitud
	/*---------------------------------------- */
}

function actualizar(var1) {   
    tiempo = encodeURIComponent(new Date().getTime());//creacion de una variable tiempo para la anti-cache
	idPersona = var1;
	opcion = 2;
	/*-----------------------------Configuacion y envio de la solicitud ASINCRONA : */
	objectXHR = creationXHR();//creacion de un objeto XHR multi-navegadores
	str = "anticache="+tiempo+"&idPersona="+idPersona+"&opcion="+opcion;
	objectXHR.open("post","php/cambios.php", true); //Configuracion del objeto XHR
	objectXHR.onreadystatechange = actualizarReply;//designacion de la funcion de llamada
	objectXHR.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objectXHR.send(str);//envio de la solicitud
	/*---------------------------------------- */
}

function mostrar(var1) {   
    tiempo = encodeURIComponent(new Date().getTime());//creacion de una variable tiempo para la anti-cache
	opcion = var1;
	/*-----------------------------Configuacion y envio de la solicitud ASINCRONA : */
	objectXHR = creationXHR();//creacion de un objeto XHR multi-navegadores
	str = "anticache="+tiempo+"&opcion="+opcion;
	objectXHR.open("post","php/cambios.php", true); //Configuracion del objeto XHR
	objectXHR.onreadystatechange = mostrarReply;//designacion de la funcion de llamada
	objectXHR.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objectXHR.send(str);//envio de la solicitud
	/*---------------------------------------- */
}

function passwords() {   
    tiempo = encodeURIComponent(new Date().getTime());//creacion de una variable tiempo para la anti-cache
	old_pass = encodeURIComponent(document.getElementById("old_pass").value);
    pass1 = encodeURIComponent(document.getElementById("pass1").value);
	pass2 = encodeURIComponent(document.getElementById("pass2").value);	
	opcion = 5;
	if (pass1 == pass2)
	{
		/*-----------------------------Configuacion y envio de la solicitud ASINCRONA : */
		objectXHR = creationXHR();//creacion de un objeto XHR multi-navegadores
		str = "anticache="+tiempo+"&old_pass="+old_pass+"&pass="+pass1+"&opcion="+opcion;
		objectXHR.open("post","php/cambios.php", true); //Configuracion del objeto XHR
		objectXHR.onreadystatechange = passwordsReply;//designacion de la funcion de llamada
		objectXHR.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		objectXHR.send(str);//envio de la solicitud
		/*---------------------------------------- */
	}
	else
		alert("Las contraseñas no coinciden");
}

function modificarReply() {
	if (objectXHR.readyState == 4) { //prueba si el resultado esta disponible
		if (objectXHR.status == 200) {
			var response = objectXHR.responseText;//recuperacion del resultado reenviado por el servidor
			if (response != 0){
				alert("Cambios realizados");
				actualizar(response);
			}
			else
				alert("Errores en algunas modificaciones");
	 	} else {
	   		//anula la solicitud en progreso
	   		objectXHR.abort();
	   		objectXHR=null;
		}
	}
}

function actualizarReply() {
	if (objectXHR.readyState == 4) { //prueba si el resultado esta disponible
		if (objectXHR.status == 200) {
			var response = objectXHR.responseText;//recuperacion del resultado reenviado por el servidor
			document.getElementById("datos").innerHTML = response;
			document.getElementById("collapsed").style.visibility = "hidden";
	 	} else {
	   		//anula la solicitud en progreso
	   		objectXHR.abort();
	   		objectXHR=null;
		}
	}
}

function mostrarReply() {
	if (objectXHR.readyState == 4) { //prueba si el resultado esta disponible
		if (objectXHR.status == 200) {
			var response = objectXHR.responseText;//recuperacion del resultado reenviado por el servidor
			document.getElementById("collapsed").innerHTML = response;
			document.getElementById("collapsed").style.visibility = "visible";
	 	} else {
	   		//anula la solicitud en progreso
	   		objectXHR.abort();
	   		objectXHR=null;
		}
	}
}

function passwordsReply() {
	if (objectXHR.readyState == 4) { //prueba si el resultado esta disponible
		if (objectXHR.status == 200) {
			var response = objectXHR.responseText;//recuperacion del resultado reenviado por el servidor
			if (response == 1){
				alert("Cambios realizados");
				document.getElementById("collapsed").style.visibility = "hidden";
			}
			else
				alert("No se pudo modificar la contraseña");
	 	} else {
	   		//anula la solicitud en progreso
	   		objectXHR.abort();
	   		objectXHR=null;
		}
	}
}

function cancelar() {
	document.getElementById("collapsed").style.visibility = "hidden";
}