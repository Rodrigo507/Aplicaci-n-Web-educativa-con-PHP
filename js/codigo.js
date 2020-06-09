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
        console.log("siguiente"+contador);
        if (!document.getElementById("aceptar")) {//para el php
            document.getElementById("pregunta").innerHTML=(contador+2)+"- "+preguntas[contador]; 
            mostrarResultado(contador)
            Asignaropciones(contador);
            contador++;
        }else{//html
            if (document.getElementById("aceptar").disabled == true) {//Si ya se acepto la respuesta
            document.getElementById("pregunta").innerHTML=(contador+2)+"- "+preguntas[contador];//Asignamos el contenido de la pregunta
            document.getElementById("correcta").innerHTML="";//Limpiamos el parrafo que contiene si es correcta o no 
            document.getElementById("aceptar").disabled=false;//Habilitamos el boton de haceptar
            uncheck();//Limpiamos los radio buton 
            Asignaropciones(contador);//Cambiamos a las siguientes opciones de la pregunta
            contador++;
            }else{
                alert("Antes debes aceptar la respuesta ")
            }
        }
        if(contador==9){//Al llegar a la 10 pregunta
            document.getElementById("siguiente").style.display='none';//Ocultamos el boton de siguiente pregunta - En la pregunta 10 no aparece
            if (document.getElementById("exit")) {//Si existe el id exit en el documento tratadatos php
                document.getElementById("exit").removeAttribute('style');//Habilitamos el form para mostrar el boton de salir 
            }
        } 
    
}
sw=0;
function aceptarRespuesta() {
    if (verificarSelecion()==true) {//Comprobamos que un radio buton se ha selecionado        
        var respuesta = document.getElementById("formulario");//Obtenemos los datos del form
        nombreEstudiante=respuesta[0].value;//Guardamos el nombre del estudiante
        if (sw==0) {//Solo para la primera pregunta
            document.getElementById("nombre").innerHTML="Nombre: "+respuesta[0].value;//Asignamos el nombre del que realiza la practica
            respuesta[0].hidden=true//Ocultamos el input de nombre
            sw=1;
        }
        //Verificamos si la respueta que seleciono es correcta o no
        if(contador==0&&respuesta[1].checked){//1
            document.getElementById("correcta").innerHTML="Correcta ✔";
            puntosObtenidos++;
        }else if(contador == 1 && respuesta[2].checked){//2
            document.getElementById("correcta").innerHTML="Correcta ✔"; 
            puntosObtenidos++;
        }else if(contador == 2 && respuesta[4].checked){//3
            document.getElementById("correcta").innerHTML="Correcta ✔";
            puntosObtenidos++; 
        }else if(contador == 3 && respuesta[4].checked){//4
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
        RespuestaSelecionada();//Asignamos la respuesta a la variable respuestasPrapreguntas
        document.getElementById("aceptar").disabled=true;//Deshabilitamos el boton aceptar
        if (contador==9) {//Mostramos los resultados cuando haceptamos la ultima pregunta
            document.getElementById("aceptar").style.display='none';//Ocultamos el boton de aceptar en la ultima pregunta
            var hora2 = new Date();
            finalMinuto=hora2.getMinutes();//Obtenemos los minutos
            totalminutos= finalMinuto-inicioMinuto;
            fechaTemina=hora2.getDate()+"/"+(hora2.getMonth()+1)+"/"+hora2.getFullYear();
            var amPm = hora2.getHours() >= 12 ? ' pm' : ' am';//Verificamos si es PM o AM
            horaTemina =((hora2.getHours() + 11) % 12 + 1)+":"+hora2.getMinutes()+amPm;
            enviarValores(nombreEstudiante,respuestasPrapreguntas,puntosObtenidos,fechaTemina,horaTemina,totalminutos);
            document.getElementById("resultados").setAttribute("style","visibility=true");//Hacemos visible el div que contiene los resultados
            document.getElementById("pts").innerHTML=`Puntos obtenidos: ${puntosObtenidos}`;//Mostramos los resultados 
            document.getElementById("tiempo").innerHTML=`Tiempo Total de la prueba: ${totalminutos}min`;
        }
    }else{
    alert("Debe seleccionar una opción antes de aceptar su respuesta")
    }
}
function RespuestaSelecionada() {//Funcion que obtiene el valor del Radio buttons y se le asignamos a la variable de respuesta
    var formularioRespuestas = document.forms[0].respuesta;//Obtenemos la cantidad de elemtentos del formulario con name "Respuesta"
    for (let index = 0; index < formularioRespuestas.length; index++) {//Recorremos todos los elementos
        if (formularioRespuestas[index].checked) {//Verificamos cual tiene el atributo cheked("Selecionado")
            respuestasPrapreguntas+=formularioRespuestas[index].value+" ";
            break;
            }
    } 
}
function enviarValores(nm,resp,pts,fech,horaT,tiemT) {//nombre,opciones selecionadas, pts obtenidos, fecha que termini, horra que termini , tiempo en que realizo la prueba
    document.getElementById("nombre_php").value = nm;//Nombre
    document.getElementById("respuestas_php").value = resp;//Respuesta
    document.getElementById("puntos_php").value = pts;//Puntos
    document.getElementById("fechatemina_php").value = fech;//Fecha
    document.getElementById("horatemina_php").value = horaT;//Horra
    document.getElementById("tiempotrascurido_php").value = tiemT;//Tiempo que realizo
}
function Asignaropciones() {
    document.getElementById("r1").innerHTML=opciones[indiceOpciones];
    document.getElementById("r2").innerHTML=opciones[indiceOpciones+1];
    document.getElementById("r3").innerHTML=opciones[indiceOpciones+2];
    document.getElementById("r4").innerHTML=opciones[indiceOpciones+3];
    indiceOpciones+=4;
}
function uncheck(){//Cambiamos el atributo checked a false 
    if (document.getElementById("formulario")) {
        var radiobuton = document.getElementById("formulario");
        radiobuton[1].checked = false;
        radiobuton[2].checked = false;
        radiobuton[3].checked = false;
        radiobuton[4].checked = false; 
    }
    
}
function mostrarResultado(contador) { 
    var respuesta = document.getElementById("formularioresuelto");
    if(contador == 0  ){//2
        respuesta[1].checked = true
    }else if(contador == 1  ){//3
        respuesta[3].checked = true
    }else if(contador == 2  ){//4
        respuesta[3].checked = true
    }else if(contador == 3 ){//5
        respuesta[2].checked = true
    }else if(contador == 4  ){//6
        respuesta[3].checked = true
    }else if(contador == 5 ){//7
        respuesta[0].checked = true
    }else if(contador == 6  ){//8
        respuesta[3].checked = true
    }else if(contador == 7  ){//9
        respuesta[2].checked = true
    }else if(contador == 8  ){//10
        respuesta[1].checked = true
    }
}
function verificarSelecion() {
    var formularioRespuestas = document.forms[0].respuesta;//Obtenemos la cantidad de elemtentos del formulario con name "Respuesta"
    for (let index = 0; index < formularioRespuestas.length; index++) {//Recorremos todos los elementos
        if (formularioRespuestas[index].checked) {//Verificamos cual tiene el atributo cheked("Selecionado")
            return true;
            }
    } 
}

window.onload = function () {
    uncheck();
    hora = new Date();
    inicioMinuto=hora.getMinutes();
    //Solo funciona con el contenido de index
    if (document.getElementById("siguiente")&& document.getElementById("aceptar")) {
        document.getElementById("siguiente").onclick = siguientePregunta;//Para el boton Siguiete pregunta
        document.getElementById("aceptar").onclick = aceptarRespuesta;//Para el boton Aceptar Respuesta 
    }
    //Para el archivo php
    if (document.getElementById("formularioresuelto")) {
        document.getElementById("siguiente").onclick =siguientePregunta;
        
    }
}