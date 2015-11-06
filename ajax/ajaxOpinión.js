// Documento JavaScript
function opinar(var1) {   
    tiempo = encodeURIComponent(new Date().getTime());//creacion de una variable tiempo para la anti-cache
    nombre = encodeURIComponent(document.getElementById("nombre").value);
    comentario = encodeURIComponent(document.getElementById("comentario").value);
	valor = encodeURIComponent($('#rateit').rateit('value'));
	id = var1;
	opcion = 1;	
	
	if (valor > 0){
		/*-----------------------------Configuacion y envio de la solicitud ASINCRONA : */
		objectXHR = creationXHR();//creacion de un objeto XHR multi-navegadores
		str = "anticache="+tiempo+"&nombre="+nombre+"&comentario="+comentario+"&valor="+valor+"&id="+id+"&opcion="+opcion;
		objectXHR.open("post","php/opinar.php", true); //Configuracion del objeto XHR
		objectXHR.onreadystatechange = opinarReply;//designacion de la funcion de llamada
		objectXHR.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		objectXHR.send(str);//envio de la solicitud
		/*---------------------------------------- */
	}
	else
		alert("No ha valorado el hospedaje");
}

function actualizar(var1) {   
    tiempo = encodeURIComponent(new Date().getTime());//creacion de una variable tiempo para la anti-cache
	id = var1;
	opcion = 2;	
	
	/*-----------------------------Configuacion y envio de la solicitud ASINCRONA : */
	objectXHR = creationXHR();//creacion de un objeto XHR multi-navegadores
	str = "anticache="+tiempo+"&id="+id+"&opcion="+opcion;
	objectXHR.open("post","php/opinar.php", true); //Configuracion del objeto XHR
	objectXHR.onreadystatechange = actualizarReply;//designacion de la funcion de llamada
	objectXHR.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objectXHR.send(str);//envio de la solicitud
	/*---------------------------------------- */
}

function opinarReply() {
	if (objectXHR.readyState == 4) { //prueba si el resultado esta disponible
		if (objectXHR.status == 200) {
			var response = objectXHR.responseText;//recuperacion del resultado reenviado por el servidor
			if (response != 0){
				alert("Se agregó su opinión");
				document.getElementById("nombre").value = "";
				document.getElementById("comentario").value = "";
				$('#rateit').rateit('value', 0);
				actualizar(response);
			}
			else
				alert("Error al procesar la solicitud");
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
			document.getElementById('comments').innerHTML = response;
	 	} else {
	   		//anula la solicitud en progreso
	   		objectXHR.abort();
	   		objectXHR=null;
		}
	}
}