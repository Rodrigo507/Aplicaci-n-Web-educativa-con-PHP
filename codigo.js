var contador=0;
var preguntas = Array("¿Es totalmente pura el agua que bebemos?","¿Qué es el efecto invernadero?","¿Qué es el calentamiento global?","¿Qué es la lluvia ácida?","¿Qué es una marea negra?","¿Qué provoca la contaminación por detergentes?","¿Qué agua es mejor para lavarse?","¿Qué liberan al aire las algas y plantas en la fotosíntesis?");
function siguientePregunta() {
    document.getElementById("pregunta").innerHTML=(contador+3)+"- "+preguntas[contador]; 
    contador++;
    document.getElementById("aceptar").disabled=false;
    document.getElementById("correcta").innerHTML="";
    if(contador==8){
        document.getElementById("siguiente").style.display='none';
    }
    
    
}
sw=0;
function aceptarRespuesta1() {
    console.log("Inicio funcion"+contador);
    var respuesta = document.getElementById("formulario");
    if (sw==0) {
        if(contador==0&&respuesta[1].checked){//1-html 2-php
            document.getElementById("correcta").innerHTML="Correcta";
            sw=1;  
        }else{
            sw=1; 
            document.getElementById("correcta").innerHTML="Incorrecta";
        }
    }else{//PARA EL FORMULARIO DESDE PHP
        console.log("SW= "+sw);
        if(contador == 1 && respuesta[3].checked){//3
            document.getElementById("correcta").innerHTML="Correcta"; 
        }else if(contador == 2 && respuesta[1].checked){//4
            document.getElementById("correcta").innerHTML="Correcta"; 
        }else if(contador == 3 && respuesta[2].checked){//5
            document.getElementById("correcta").innerHTML="Correcta"; 
        }else if(contador == 4 && respuesta[3].checked){//6
            document.getElementById("correcta").innerHTML="Correcta"; 
        }else if(contador == 5 && respuesta[0].checked){//7
            document.getElementById("correcta").innerHTML="Correcta"; 
        }else if(contador == 6 && respuesta[3].checked){//8
            document.getElementById("correcta").innerHTML="Correcta"; 
        }else if(contador == 7 && respuesta[2].checked){//9
            document.getElementById("correcta").innerHTML="Correcta"; 
        }else if(contador == 8 && respuesta[1].checked){//10
            document.getElementById("correcta").innerHTML="Correcta"; 
        }else{
            document.getElementById("correcta").innerHTML="Incorrecta"; 
        }
    }
    
    document.getElementById("aceptar").disabled=true;
    
}


window.onload = function () {
    document.getElementById("siguiente").onclick = siguientePregunta;
    document.getElementById("aceptar").onclick = aceptarRespuesta1;

}

