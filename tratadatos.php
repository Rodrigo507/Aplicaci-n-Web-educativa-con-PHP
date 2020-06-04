<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica Ciencias</title>
    <script src="codigo.js"></script>
</head>
<body>
    
<?php
    $preguntas = Array("2- ¿Dónde debe tirarse el aceite usado de cocina?","3- ¿Es totalmente pura el agua que bebemos?","4- ¿Qué es el efecto invernadero?","5- ¿Qué es el calentamiento global?","6- ¿Qué es la lluvia ácida?","7- ¿Qué es una marea negra?","8- ¿Qué provoca la contaminación por detergentes?","9- ¿Qué agua es mejor para lavarse?","10- ¿Qué liberan al aire las algas y plantas en la fotosíntesis?");
    $visitante= leer();
    $nombre = $_POST['nombre'];
    $condicion="";
    if ($visitante==9) {//Ocultamos el boton de siguitente al llegar a la pregunta 10
        $condicion="style='visibility: hidden;'";
    }
    echo("<form id='formulario'action='tratadatos.php' method='POST'>
    <label id='nombre' for='nombre'>Nombre: ".$nombre." </label><input type='text' name='nombre' value=".$nombre." style='visibility:hidden'>
    <h4 id='pregunta'>".$preguntas[$visitante-1]."</h4>
    <input type='radio' value='1' name='respuesta' > <label >1- Solido </label> <br>
    <input type='radio' value='2' name='respuesta'> <label >2- Liquido </label><br>
    <input type='radio' value='3' name='respuesta'> <label >3- Gaseoso </label><br>
    <input type='radio' value='4' name='respuesta'> <label >4- Plasma </label><br>
    <p id='correcta'></p>
    <input id='aceptar' type='button' value='Aceptar Respuesta'>
    <!-- <input id='siguiente' type='submit' value='Siguiente pregunta'> -->
    <input id='siguiente' type='submit' value='Siguiente pregunta'".$condicion.">
    <input id='enviar' type='submit' value='Enviar datos' style='visibility: hidden;'>
    </form>");
    echo("<p id='cont' style='visibility: hidden;'>".$visitante."</p>");
    //-------------------------------------------------------------------
    echo("<div id='resultados' style='visibility: hidden;'>
    <h2 name='aaa' id='pts'>Puntos Obtenidos: </h2>
    <h2 id='tiempo'>Puntos Obtenidos: </h2>
</div>    ");
echo"<script>
window.onload = function () {
    document.getElementById('aceptar').onclick = RespuestaSelecionada;//Para el boton Aceptar Respuesta
   
    
}
    </script>";
$valorRespuesta;
    //Obtenemos el valor de check del radio buton
echo"<script> function RespuestaSelecionada() {
    document.getElementById('aceptar').disabled=true;
var formularioRespuestas = document.forms[0].respuesta;
for (let index = 0; index < formularioRespuestas.length; index++) {
    console.log('aaaaaaaaaaaaaaaaaaaa**');
    if (formularioRespuestas[index].checked) {
        
        console.log('Pregunta selecionada'+formularioRespuestas[index].value);
        break;
        }
    }
}</script>";


    aumentar($visitante);
    function leer(){
        $archivo = "contador.txt"; //el archivo que contiene en numero
        $f = fopen($archivo, "r"); //abrimos el archivo en modo de lectura
        if($f){
            $contador = fread($f, filesize($archivo)); //leemos el archivo
            fclose($f);
        }
        $f = fopen($archivo, "w+");
        return $contador;
    }
    function aumentar($contador){
        $archivo = "contador.txt"; //el archivo que contiene en numero
        $f = fopen($archivo, "w+");
        if($f){
            $contador = $contador+1;
            if ($contador==10) {
                $contador=1;
            }
            fwrite($f, $contador);
            fclose($f);
        }
    }
?>    
</body>
</html>