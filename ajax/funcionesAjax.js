// Documento JavaScript
 function creationXHR() {
   var resultat=null;
   try {//prueba para los navegadores : Mozilla, Opera, ...
	    resultat= new XMLHttpRequest();
     } 
     catch (Error) {
     try {//prueba para los navegadores Internet Explorer > 5.0
     resultat= new ActiveXObject("Msxml2.XMLHTTP");
     }
     catch (Error) {
         try {//prueba para los navegadores Internet Explorer 5.0
         resultat= new ActiveXObject("Microsoft.XMLHTTP");
         }
         catch (Error) {
            resultat= null;
         }
     }
  }
  return resultat;
}
//------------Funciones de gestion del DOM (solucion alternativa a innerHTML)
function remplazarContenido(id, texto) {
  var element = document.getElementById(id);
  if (element != null) {
    suprimirContenido(element);
    var nuevoContenido = document.createTextNode(texto);
    element.appendChild(nuevoContenido);
  }
}
function suprimirContenido(element) {
if (element != null) {
    while(element.firstChild)
        element.removeChild(element.firstChild);
   }
}