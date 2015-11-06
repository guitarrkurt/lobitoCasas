// Documento JavaScript

//Muestra la tabla de los hospedajes
function mostrar_hos(id) {
	tiempo = encodeURIComponent(new Date().getTime());//creacion de una variable tiempo para la anti-cache
	opcion = 1;
	
	/*-----------------------------Configuacion y envio de la solicitud ASINCRONA : */
	objectXHR = creationXHR();//creacion de un objeto XHR multi-navegadores
	str = "anticache="+tiempo+"&id="+id+"&opcion="+opcion;
	objectXHR.open("post","php/info.php", true); //Configuracion del objeto XHR
	objectXHR.onreadystatechange = mostrar_hosReply;//designacion de la funcion de llamada
	objectXHR.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objectXHR.send(str);//envio de la solicitud
	/*---------------------------------------- */
}

//Muestra el formulario para modificar algún hospedaje
function mostrar_form(id) {
	tiempo = encodeURIComponent(new Date().getTime());//creacion de una variable tiempo para la anti-cache
	opcion = 2;
	
	/*-----------------------------Configuacion y envio de la solicitud ASINCRONA : */
	objectXHR = creationXHR();//creacion de un objeto XHR multi-navegadores
	str = "anticache="+tiempo+"&id="+id+"&opcion="+opcion;
	objectXHR.open("post","php/info.php", true); //Configuracion del objeto XHR
	objectXHR.onreadystatechange = mostrar_formReply;//designacion de la funcion de llamada
	objectXHR.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objectXHR.send(str);//envio de la solicitud
	/*---------------------------------------- */
}

//Elimina el hospedaje de la base de datos
function eliminar_hos(var1, var2) {   
    tiempo = encodeURIComponent(new Date().getTime());//creacion de una variable tiempo para la anti-cache
	id = var1;
	id_cli = var2;
	opcion = 3;
	
	if(confirm("¿Desea eliminar este hospedaje?")){
		/*-----------------------------Configuacion y envio de la solicitud ASINCRONA : */
		objectXHR = creationXHR();//creacion de un objeto XHR multi-navegadores
		str = "anticache="+tiempo+"&id="+id+"&id_cli="+id_cli+"&opcion="+opcion;
		objectXHR.open("post","php/info.php", true); //Configuracion del objeto XHR
		objectXHR.onreadystatechange = eliminar_hosReply;//designacion de la funcion de llamada
		objectXHR.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		objectXHR.send(str);//envio de la solicitud
		/*---------------------------------------- */
	}
}

//Actualiza la tabla de hospedajes
function actualizar_hos(var1) {   
    tiempo = encodeURIComponent(new Date().getTime());//creacion de una variable tiempo para la anti-cache
	id = var1;
	opcion = 4;
	
	/*-----------------------------Configuacion y envio de la solicitud ASINCRONA : */
	objectXHR = creationXHR();//creacion de un objeto XHR multi-navegadores
	str = "anticache="+tiempo+"&id="+id+"&opcion="+opcion;
	objectXHR.open("post","php/info.php", true); //Configuracion del objeto XHR
	objectXHR.onreadystatechange = actualizar_hosReply;//designacion de la funcion de llamada
	objectXHR.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objectXHR.send(str);//envio de la solicitud
	/*---------------------------------------- */
}

//Modifica los datos del hospedaje con los datos del formulario
function modificar_hos(var1) {   
    tiempo = encodeURIComponent(new Date().getTime());//creacion de una variable tiempo para la anti-cache
	tipo = encodeURIComponent(document.getElementById("tipo").value);
	dir = encodeURIComponent(document.getElementById("direccion").value);
	desc = encodeURIComponent(document.getElementById("descripcion").value);
	serv = encodeURIComponent(document.getElementById("servicios").value);
	compartido = encodeURIComponent(document.getElementById("compartido").value);
	numPer = encodeURIComponent(document.getElementById("noPersonas").value);
	mensualidad = encodeURIComponent(document.getElementById("mensualidad").value);
	deposito = encodeURIComponent(document.getElementById("deposito").value);
	costos = encodeURIComponent(document.getElementById("costosExtras").value);
	genero = encodeURIComponent(document.getElementById("generoHuesped").value);
	disponibilidad = encodeURIComponent(document.getElementById("disponibilidad").value);
	img = encodeURIComponent(document.getElementById("imagenes").value);
	id_cli = encodeURIComponent(document.getElementById("idCliente").value);
	id = var1;
	opcion = 5;
	
	/*-----------------------------Configuacion y envio de la solicitud ASINCRONA : */
	objectXHR = creationXHR();//creacion de un objeto XHR multi-navegadores
	str = "anticache="+tiempo+"&tipo="+tipo+"&dir="+dir+"&desc="+desc+"&serv="+serv+"&compartido="+compartido+"&numPer="+numPer+"&mensualidad="+mensualidad+"&deposito="+deposito+"&costos="+costos+"&genero="+genero+"&disponibilidad="+disponibilidad+"&img="+img+"&id="+id+"&id_cli="+id_cli+"&opcion="+opcion;
	objectXHR.open("post","php/info.php", true); //Configuracion del objeto XHR
	objectXHR.onreadystatechange = modificar_hosReply;//designacion de la funcion de llamada
	objectXHR.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objectXHR.send(str);//envio de la solicitud
	/*---------------------------------------- */
}

//Muestra el formulario para modificar algún cliente
function mostrar(id) {
	tiempo = encodeURIComponent(new Date().getTime());//creacion de una variable tiempo para la anti-cache
	opcion = 6;
	
	/*-----------------------------Configuacion y envio de la solicitud ASINCRONA : */
	objectXHR = creationXHR();//creacion de un objeto XHR multi-navegadores
	str = "anticache="+tiempo+"&id="+id+"&opcion="+opcion;
	objectXHR.open("post","php/info.php", true); //Configuracion del objeto XHR
	objectXHR.onreadystatechange = mostrarReply;//designacion de la funcion de llamada
	objectXHR.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objectXHR.send(str);//envio de la solicitud
	/*---------------------------------------- */
}

//Modifica los datos del dueño con los datos del formulario
function modificar(var1) {   
    tiempo = encodeURIComponent(new Date().getTime());//creacion de una variable tiempo para la anti-cache
	nombre = encodeURIComponent(document.getElementById("nombre").value);
	apellidos = encodeURIComponent(document.getElementById("apellidos").value);
	email = encodeURIComponent(document.getElementById("email").value);
	tel1 = encodeURIComponent(document.getElementById("telefono1").value);
	tel2 = encodeURIComponent(document.getElementById("telefono2").value);
	id = var1;
	opcion = 7;
	
	/*-----------------------------Configuacion y envio de la solicitud ASINCRONA : */
	objectXHR = creationXHR();//creacion de un objeto XHR multi-navegadores
	str = "anticache="+tiempo+"&nombre="+nombre+"&apellidos="+apellidos+"&email="+email+"&tel1="+tel1+"&tel2="+tel2+"&id="+id+"&opcion="+opcion;
	objectXHR.open("post","php/info.php", true); //Configuracion del objeto XHR
	objectXHR.onreadystatechange = modificarReply;//designacion de la funcion de llamada
	objectXHR.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objectXHR.send(str);//envio de la solicitud
	/*---------------------------------------- */
}

//Actualiza la tabla de los dueños
function actualizar() {   
    tiempo = encodeURIComponent(new Date().getTime());//creacion de una variable tiempo para la anti-cache
	opcion = 8;
	
	/*-----------------------------Configuacion y envio de la solicitud ASINCRONA : */
	objectXHR = creationXHR();//creacion de un objeto XHR multi-navegadores
	str = "anticache="+tiempo+"&opcion="+opcion;
	objectXHR.open("post","php/info.php", true); //Configuracion del objeto XHR
	objectXHR.onreadystatechange = actualizarReply;//designacion de la funcion de llamada
	objectXHR.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objectXHR.send(str);//envio de la solicitud
	/*---------------------------------------- */
}

//Elimina al dueño de la base de datos
function eliminar(var1, var2) {   
    tiempo = encodeURIComponent(new Date().getTime());//creacion de una variable tiempo para la anti-cache
	id = var1;
	id_cli = var2;
	opcion = 9;
	
	if(confirm("¿Desea eliminar a este dueño y sus hospedajes?")){
		/*-----------------------------Configuacion y envio de la solicitud ASINCRONA : */
		objectXHR = creationXHR();//creacion de un objeto XHR multi-navegadores
		str = "anticache="+tiempo+"&id="+id+"&id_cli="+id_cli+"&opcion="+opcion;
		objectXHR.open("post","php/info.php", true); //Configuracion del objeto XHR
		objectXHR.onreadystatechange = eliminarReply;//designacion de la funcion de llamada
		objectXHR.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		objectXHR.send(str);//envio de la solicitud
		/*---------------------------------------- */
	}
}

function mostrar_hosReply() {
	if (objectXHR.readyState == 4) { //prueba si el resultado esta disponible
		if (objectXHR.status == 200) {
			var response = objectXHR.responseText;//recuperacion del resultado reenviado por el servidor 
			document.getElementById("hospedajes").innerHTML = response;
			document.getElementById("hospedajes").style.visibility = "visible";
	 	} else {
	   		//anula la solicitud en progreso
	   		objectXHR.abort();
	   		objectXHR=null;
		}
	}
}

function mostrar_formReply() {
	if (objectXHR.readyState == 4) { //prueba si el resultado esta disponible
		if (objectXHR.status == 200) {
			var response = objectXHR.responseText;//recuperacion del resultado reenviado por el servidor 
			document.getElementById("modificaciones").innerHTML = response;
			document.getElementById("modificaciones").style.visibility = "visible";
	 	} else {
	   		//anula la solicitud en progreso
	   		objectXHR.abort();
	   		objectXHR=null;
		}
	}
}

function eliminar_hosReply() {
	if (objectXHR.readyState == 4) { //prueba si el resultado esta disponible
		if (objectXHR.status == 200) {
			var response = objectXHR.responseText;//recuperacion del resultado reenviado por el servidor 
			if (response != 0){
				alert("Se ha eliminado el hospedaje");		
				actualizar_hos(response);
			}
			else
				alert("No se pudo eliminar el hospedaje");
	 	} else {
	   		//anula la solicitud en progreso
	   		objectXHR.abort();
	   		objectXHR=null;
		}
	}
}

function actualizar_hosReply() {
	if (objectXHR.readyState == 4) { //prueba si el resultado esta disponible
		if (objectXHR.status == 200) {
			var response = objectXHR.responseText;//recuperacion del resultado reenviado por el servidor 
			document.getElementById("hospedajes").innerHTML = response;
			document.getElementById("hospedajes").style.visibility = "visible";
	 	} else {
	   		//anula la solicitud en progreso
	   		objectXHR.abort();
	   		objectXHR=null;
		}
	}
}

function modificar_hosReply() {
	if (objectXHR.readyState == 4) { //prueba si el resultado esta disponible
		if (objectXHR.status == 200) {
			var response = objectXHR.responseText;//recuperacion del resultado reenviado por el servidor 
			if (response != 0){
				alert("Cambios realizados");
				document.getElementById("modificaciones").innerHTML = "";
				document.getElementById("modificaciones").style.visibility = "hidden";
				actualizar_hos(response);
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

function mostrarReply() {
	if (objectXHR.readyState == 4) { //prueba si el resultado esta disponible
		if (objectXHR.status == 200) {
			var response = objectXHR.responseText;//recuperacion del resultado reenviado por el servidor 
			document.getElementById("modificaciones").innerHTML = response;
			document.getElementById("modificaciones").style.visibility = "visible";
	 	} else {
	   		//anula la solicitud en progreso
	   		objectXHR.abort();
	   		objectXHR=null;
		}
	}
}

function modificarReply() {
	if (objectXHR.readyState == 4) { //prueba si el resultado esta disponible
		if (objectXHR.status == 200) {
			var response = objectXHR.responseText;//recuperacion del resultado reenviado por el servidor 
			if (response != 0){
				alert("Cambios realizados");
				document.getElementById("modificaciones").innerHTML = "";
				document.getElementById("modificaciones").style.visibility = "hidden";
				actualizar();
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
			document.getElementById("dueños").innerHTML = response;
	 	} else {
	   		//anula la solicitud en progreso
	   		objectXHR.abort();
	   		objectXHR=null;
		}
	}
}

function eliminarReply() {
	if (objectXHR.readyState == 4) { //prueba si el resultado esta disponible
		if (objectXHR.status == 200) {
			var response = objectXHR.responseText;//recuperacion del resultado reenviado por el servidor 
			if (response != 0){
				alert("Se ha eliminado al dueño");
				document.getElementById("hospedajes").innerHTML = "";
				document.getElementById("hospedajes").style.visibility = "hidden";		
				actualizar();
			}
			else
				alert("No se pudo eliminar al dueño");
	 	} else {
	   		//anula la solicitud en progreso
	   		objectXHR.abort();
	   		objectXHR=null;
		}
	}
}

function cancelar() {
	document.getElementById("modificaciones").innerHTML = "";
	document.getElementById("modificaciones").style.visibility = "hidden";
}