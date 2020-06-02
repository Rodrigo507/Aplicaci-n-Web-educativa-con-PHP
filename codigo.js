var contador=0;
var preguntas = Array("¿Dónde debe tirarse el aceite usado de cocina?","¿Es totalmente pura el agua que bebemos?","¿Qué es el efecto invernadero?","¿Qué es el calentamiento global?","¿Qué es la lluvia ácida?","¿Qué es una marea negra?","¿Qué provoca la contaminación por detergentes?","¿Qué agua es mejor para lavarse?","¿Qué liberan al aire las algas y plantas en la fotosíntesis?");
var respuestas= Array();
function siguientePregunta() {
    document.getElementById("pregunta").innerHTML=(contador+2)+"- "+preguntas[contador]; 
    contador++;
    document.getElementById("aceptar").disabled=false;
    document.getElementById("correcta").innerHTML="";
    if(contador==9){
        document.getElementById("siguiente").style.display='none';
    }
    
    
}
sw=0;
function aceptarRespuesta1() {
    console.log("Inicio funcion"+contador);
    var respuesta = document.getElementById("formulario");
    if (sw==0) {
        console.log("Eliminacion de nombre");
            document.getElementById("nombre").innerHTML="Nombre: "+respuesta[0].value;
            respuesta[0].hidden=true//Ocultamos el input de nombre
        if(contador==0&&respuesta[1].checked){//1
            document.getElementById("correcta").innerHTML="Correcta";
            sw=1;  
        }else{
            sw=1; 
            document.getElementById("correcta").innerHTML="Incorrecta";
        }
    }else{//PARA EL FORMULARIO DESDE PHP
        console.log("SW= "+sw);
        if(contador == 1 && respuesta[2].checked){//2
            document.getElementById("correcta").innerHTML="Correcta ✔"; 
        }else if(contador == 2 && respuesta[4].checked){//3
            document.getElementById("correcta").innerHTML="Correcta ✔"; 
        }else if(contador == 3 && respuesta[2].checked){//4
            document.getElementById("correcta").innerHTML="Correcta ✔"; 
        }else if(contador == 4 && respuesta[3].checked){//5
            document.getElementById("correcta").innerHTML="Correcta ✔"; 
        }else if(contador == 5 && respuesta[4].checked){//6
            document.getElementById("correcta").innerHTML="Correcta ✔"; 
        }else if(contador == 6 && respuesta[1].checked){//7
            document.getElementById("correcta").innerHTML="Correcta ✔"; 
        }else if(contador == 7 && respuesta[4].checked){//8
            document.getElementById("correcta").innerHTML="Correcta ✔"; 
        }else if(contador == 8 && respuesta[3].checked){//9
            document.getElementById("correcta").innerHTML="Correcta ✔"; 
        }else if(contador == 9 && respuesta[2].checked){//10
            document.getElementById("correcta").innerHTML="Correcta ✔"; 
        }else{
            document.getElementById("correcta").innerHTML="Incorrecta ❌"; 
        }
    }
    document.getElementById("aceptar").disabled=true;
    
}


window.onload = function () {
    document.getElementById("siguiente").onclick = siguientePregunta;
    document.getElementById("aceptar").onclick = aceptarRespuesta1;

}

