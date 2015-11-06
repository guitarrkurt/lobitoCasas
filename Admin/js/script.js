// JavaScript Document
$(document).ready(function(){
	$(".readonly").keydown(function(e){
		e.preventDefault();
	});
});

function personas(){
	var mostrar = document.getElementById("compartido").value;

	if (mostrar == "si")
		document.getElementById("numPer").style.display = "block";
	else
		document.getElementById("numPer").style.display = "none";
}