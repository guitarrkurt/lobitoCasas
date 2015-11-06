// Documento JavaScript

//Función para añadir archivos al vector de archivos
function subirImagen() {
	var imgFile = document.getElementById("imgFile");
	var dir = document.getElementById("carpeta").value;	
	var data = new FormData();
	
	data.append("carpeta", dir);
	data.append("image", imgFile.files[0]);
	imagen(data);
}

function imagen(data) {   
    tiempo = encodeURIComponent(new Date().getTime());//creacion de una variable tiempo para la anti-cache
	
	/*-----------------------------Configuacion y envio de la solicitud ASINCRONA : */
	objectXHR = creationXHR();//creacion de un objeto XHR multi-navegadores
	str = "anticache="+tiempo;
	objectXHR.open("post","php/imagen.php", true); //Configuracion del objeto XHR
	objectXHR.onreadystatechange = imagenReply;//designacion de la funcion de llamada
	//objectXHR.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objectXHR.send(data);//envio de la solicitud
	/*---------------------------------------- */
}

function imagenReply() {
	if (objectXHR.readyState == 4) { //prueba si el resultado esta disponible
		if (objectXHR.status == 200) {
			var response = objectXHR.responseText;//recuperacion del resultado reenviado por el servidor
			if (response != 0){
				var obj = document.getElementById("img");
				var text = document.createTextNode(response + "; ");
				
				alert("Se agregó la imagen " + response);
				obj.appendChild(text);
			}
			else {
				alert("Error al subir la imagen");
			}
	 	} else {
	   		//anula la solicitud en progreso
	   		objectXHR.abort();
	   		objectXHR=null;
		}
	}
}