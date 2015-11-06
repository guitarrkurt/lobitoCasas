// Documento JavaScript
function registrar() {   
    tiempo = encodeURIComponent(new Date().getTime());//creacion de una variable tiempo para la anti-cache
    nombre = encodeURIComponent(document.getElementById("nombre").value);
    apellidos = encodeURIComponent(document.getElementById("apellidos").value);
	email = encodeURIComponent(document.getElementById("email").value);
	tel1 = encodeURIComponent(document.getElementById("tel1").value);
	tel2 = encodeURIComponent(document.getElementById("tel2").value);
	tipo = encodeURIComponent(document.getElementById("tipo").value);
	dir = encodeURIComponent(document.getElementById("dir").value);
	desc = encodeURIComponent(document.getElementById("desc").value);
	serv = encodeURIComponent(document.getElementById("serv").value);
	compartido = encodeURIComponent(document.getElementById("compartido").value);
	numPer = encodeURIComponent(document.getElementById("numPer").value);
	mensualidad = encodeURIComponent(document.getElementById("mensualidad").value);
	deposito = encodeURIComponent(document.getElementById("deposito").value);
	costos = encodeURIComponent(document.getElementById("costos").value);
	genero = encodeURIComponent(document.getElementById("genero").value);
	disponibilidad = encodeURIComponent(document.getElementById("disponibilidad").value);
	img = encodeURIComponent(document.getElementById("img").value);
	
	/*-----------------------------Configuacion y envio de la solicitud ASINCRONA : */
	objectXHR = creationXHR();//creacion de un objeto XHR multi-navegadores
	str = "anticache="+tiempo+"&nombre="+nombre+"&apellidos="+apellidos+"&email="+email+"&tel1="+tel1+"&tel2="+tel2+"&tipo="+tipo+"&dir="+dir+"&desc="+desc+"&serv="+serv+"&compartido="+compartido+"&numPer="+numPer+"&mensualidad="+mensualidad+"&deposito="+deposito+"&costos="+costos+"&genero="+genero+"&disponibilidad="+disponibilidad+"&img="+img;
	objectXHR.open("post","php/registrar.php", true); //Configuracion del objeto XHR
	objectXHR.onreadystatechange = registrarReply;//designacion de la funcion de llamada
	objectXHR.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objectXHR.send(str);//envio de la solicitud
	/*---------------------------------------- */
}

function registrarReply() {
	if (objectXHR.readyState == 4) { //prueba si el resultado esta disponible
		if (objectXHR.status == 200) {
			var response = objectXHR.responseText;//recuperacion del resultado reenviado por el servidor
			if (response == 1){
				alert("Se registró el hospedaje satisfactoriamente");
				window.location.reload();
			}
			else{
				alert("Error con el registro");
			}
	 	} else {
	 	  	//mensaje de error del servidor
	   		var errorServer="Error server : "+objectXHR.status+" – "+ objectXHR.statusText;
	   		remplazarContenido("reg_status", errorServer);
	   		document.getElementById("reg_status").style.visibility="visible";
	   		
	   		//anula la solicitud en progreso
	   		objectXHR.abort();
	   		objectXHR=null;
		}
	}
}