//var contador=0;
var contador=0;
var preguntas = Array("¿Dónde debe tirarse el aceite usado de cocina?","¿Es totalmente pura el agua que bebemos?","¿Qué es el efecto invernadero?","¿Qué es el calentamiento global?","¿Qué es la lluvia ácida?","¿Qué es una marea negra?","¿Qué provoca la contaminación por detergentes?","¿Qué agua es mejor para lavarse?","¿Qué liberan al aire las algas y plantas en la fotosíntesis?");
var opciones = Array("Por el fregadero","En un contenedor específico para ello","En la basura","Por el váter","Si, porque es inodora","Si, porque es incolora"," Si, porque sino no la beberíamos","No, porque presenta sales minerales y micro-partículas","El cultivo de hortalizas","Encender la calefacción en invierno","Regar el jardín con una manguera","La acumulación de calor","La fiebre","El verano","El aumento de la temperatura media del planeta","El calor que dan los radiadores en invierno","Lluvia de vinagre","Lluvia caliente","Lluvia de agua salada","Lluvia con un pH ácido","Un vertido de petróleo en el mar","Una marea por la noche","Una carrera de barcos","Una playa de Tenerife","Que los ríos queden muy limpios","Que los peces se laven allí","Qué las aves aniden allí"," Que las aves mueran por ahogamiento o por frío, al disolver los detergentes la capa de grasa que cubre sus plumas","El agua salada","El agua con mucha cal","El agua dulce","El agua con gas","Azúcar","Oxígeno","Sal","Dióxido de carbono");
var indiceOpciones=0;
var respuestas = Array();//Guardaremos el valor de las respuestas selecionadas
var nombreEstudiante;
var puntosObtenidos=0;
var hora;
var inicioMinuto;
var finalMinuto;
var totalminutos;
var resultadoFinal;
var respuestasPrapreguntas="";
var fechaTemina;
function siguientePregunta() {
    document.getElementById("pregunta").innerHTML=(contador+2)+"- "+preguntas[contador]; 
    contador++;
    document.getElementById("aceptar").disabled=false;
    document.getElementById("correcta").innerHTML="";
    Asignaropciones();
    if(contador==9){
        document.getElementById("siguiente").style.display='none';
    }
    
    
}
sw=0;
var varloDeRespuestas;
function aceptarRespuesta() {
    //console.log("Inicio funcion"+contador);
    var respuesta = document.getElementById("formulario");
    nombreEstudiante=respuesta[0].value;
    if (sw==0) {//Controlar que sea la primiera pregunta
            document.getElementById("nombre").innerHTML="Nombre: "+respuesta[0].value;//Asignamos el nombre del que realiza la practica
            respuesta[0].hidden=true//Ocultamos el input de nombre
        if(contador==0&&respuesta[1].checked){//1
            varloDeRespuestas = respuesta[1].value;
            document.getElementById("correcta").innerHTML="Correcta ✔";
            puntosObtenidos++;
            sw=1;  
        }else{
            sw=1; 
            document.getElementById("correcta").innerHTML="Incorrecta ❌";
        }
    }else{//PARA EL FORMULARIO DESDE PHP
        //console.log("SW= "+sw);
        if(contador == 1 && respuesta[2].checked){//2
            document.getElementById("correcta").innerHTML="Correcta ✔"; 
            varloDeRespuestas = respuesta[2].value;
            puntosObtenidos++;
        }else if(contador == 2 && respuesta[4].checked){//3
            document.getElementById("correcta").innerHTML="Correcta ✔";
            puntosObtenidos++; 
        }else if(contador == 3 && respuesta[2].checked){//4
            document.getElementById("correcta").innerHTML="Correcta ✔";
            puntosObtenidos++; 
        }else if(contador == 4 && respuesta[3].checked){//5
            document.getElementById("correcta").innerHTML="Correcta ✔";
            puntosObtenidos++; 
        }else if(contador == 5 && respuesta[4].checked){//6
            document.getElementById("correcta").innerHTML="Correcta ✔";
            puntosObtenidos++; 
        }else if(contador == 6 && respuesta[1].checked){//7
            document.getElementById("correcta").innerHTML="Correcta ✔";
            puntosObtenidos++; 
        }else if(contador == 7 && respuesta[4].checked){//8
            document.getElementById("correcta").innerHTML="Correcta ✔";
            puntosObtenidos++; 
        }else if(contador == 8 && respuesta[3].checked){//9
            document.getElementById("correcta").innerHTML="Correcta ✔";
            puntosObtenidos++; 
        }else if(contador == 9 && respuesta[2].checked){//10
            document.getElementById("correcta").innerHTML="Correcta ✔";
            puntosObtenidos++; 
        }else{
            document.getElementById("correcta").innerHTML="Incorrecta ❌"; 
        }
    }
    RespuestaSelecionada();
    document.getElementById("aceptar").disabled=true;
    if (contador==9) {//Mostramos los resultados cuando haceptamos la ultima pregunta
        var hora2 = new Date();
        finalMinuto=hora2.getMinutes();
        totalminutos= finalMinuto-inicioMinuto;
        fechaTemina=hora2.getDay()+"/"+(hora2.getMonth()+1)+"/"+hora2.getFullYear();
        enviarValores(nombreEstudiante,respuestasPrapreguntas,puntosObtenidos,fechaTemina,totalminutos);
        document.getElementById("resultados").setAttribute("style","visibility=true");//Hacemos visible el div que contiene los resultados
        document.getElementById("pts").innerHTML=`Puntos obtenidos: ${puntosObtenidos}`;
        console.log(document.getElementById("tiempo").innerHTML=`Tiempo Total de la prueba: ${totalminutos}min`);
       /* console.log(inicioMinuto, finalMinuto);
        //----------------------------------------------------------------------
        //respuestas.forEach(element => respuestasPrapreguntas+=" ");
        resultadoFinal="Nombre: "+nombreEstudiante+" Puntos obtenidos: "+puntosObtenidos+" Minutos de prueba: "+totalminutos +" Respuestas "+respuestasPrapreguntas;
        console.log(resultadoFinal);
        //+" Puntos obtenidos: "+puntosObtenidos+" Minutos de prueba: "+finalMinuto-inicioMinuto;
        document.getElementById("caja_valor").value = resultadoFinal;*/
    }
}

function RespuestaSelecionada() {//Funcion que obtiene el valor del Radio buttons
    var formularioRespuestas = document.forms[0].respuesta;//Obtenemos la cantidad de elemtentos del formulario con name "Respuesta"
    for (let index = 0; index < formularioRespuestas.length; index++) {//Recorremos todos los elementos
        if (formularioRespuestas[index].checked) {//Verificamos cual tiene el atributo cheked("Selecionado")
            respuestasPrapreguntas+=formularioRespuestas[index].value; 
            break;
            }
    } 
}
function enviarValores(nm,resp,pts,fech,tiemT) {
    document.getElementById("nombre_php").value = nm;//Nombre
    document.getElementById("respuestas_php").value = resp;//Nombre
    document.getElementById("puntos_php").value = pts;//Nombre
    document.getElementById("fechatemina_php").value = fech;//Nombre
    document.getElementById("tiempotrascurido_php").value = tiemT;//Nombre
}
function Asignaropciones() {
    document.getElementById("r1").innerHTML=opciones[indiceOpciones];
    document.getElementById("r2").innerHTML=opciones[indiceOpciones+1];
    document.getElementById("r3").innerHTML=opciones[indiceOpciones+2];
    document.getElementById("r4").innerHTML=opciones[indiceOpciones+3];
    indiceOpciones+=4;
}

window.onload = function () {
    hora = new Date();
    inicioMinuto=hora.getMinutes();
    document.getElementById("siguiente").onclick = siguientePregunta;//Para el boton Siguiete pregunta
    document.getElementById("aceptar").onclick = aceptarRespuesta;//Para el boton Aceptar Respuesta 
}