<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$valorSelecion = $_POST['opcion_selecionada'];
$dato = $_POST['dato'];//Es el valor que enviar el que solicita la consulta(Numero de prueba - Fecha)
$datos=array();//Agregaremos a cada encuentado en un indice
$datos=dividirUsuarios();
$ordenado=array();
$ordenado=burbuja($datos,sizeof($datos));
if (sizeof($datos)!=0) {//Solo entra si hay datos en el array de datos
    if ($valorSelecion==1) {//Estadística general
        estaGeneral($datos);
    }else if ($valorSelecion==2) {//Estadística por fecha
        estaFecha($dato,$datos);
    }else if ($valorSelecion==3) {//Lista de Estudiantes con práctica perfecta
        estaPerfecta($datos);
    }else if ($valorSelecion==4) {//Lista de los estudiantes con los 10 mejores tiempos
        estMejores($ordenado);
    }else if ($valorSelecion==5) {//Lista de estudiantes con puntajes inferiores a 7.
        estInferior($datos);
    }else if($valorSelecion==6) {//Lista de estudiantes que han fallado una determinada pregunta.
        estFallaron($datos,$dato);
    }
    echo("<br>*******************************<br>");
    echo("<h1>INFORMACION</h1>");
    echo("<br>Cantidad de prácticas completadas: ".sizeof($datos)."<br>");
    echo("<br>Tiempo máximo en resolver: ".tiemMaximo($ordenado));
    echo("<br>Tiempo mínimo en resolver: ".tiemMinimo($ordenado));
    echo("<br><br>");
    echo("<br>Cantidad de estudiantes por puntajes correctos<br> ");
    puntosObteCantidad($datos);//Muestra tabla con la cantidad de estudiantes por cada puntaje que se obtubo
    echo("<br>Estadística de aciertos y fallas:<br><br>");
    aciertFallas($datos);//Muestra una tabla que contiene # de pregunta cant aciertos y cant Fallas por pregunta

    echo("<br><br><form id='exit' method='get' action='../html/consultas.html' '>
        <button type='submit'>Salir</button>
        </form>");
    //echo("<button onclick=".generarInforme()."> Llamar </buton>");
}else{
    echo("<h1> NO HAY DATOS PARA PROCESAR</h1><br><br>");
    echo("<form id='exit' method='get' action='../html/consultas.html' '>
            <button type='submit'>Salir</button>
            </form>");

}
function estaGeneral($array){//Estadística general 
    echo "<h3>Estadística General</h3>";
    for ($i=0; $i < count($array); $i++) {
        echo("Prueba #".($i+1)."<br>"); 
        echo $array[$i];
        if (count($array)>=1) {
            echo "---------------------------------------<br>";
        }
    }
}

function estaFecha($fechauser,$array){//Estadística por fecha
    echo "<h1>Estadística Fecha</h1>";
    for ($i=0; $i < count($array); $i++) {
        if (strpos($array[$i],$fechauser) !== false) {//Buscamos la posicion de la cadena dada(si es diferente de false se encontro la posicion)
            echo $array[$i]."<br>";
            echo "---------------------------------------<br>";
        }
    }
    
}

function estaPerfecta($array){// Lista de Estudiantes con práctica perfecta
    echo "<h3>Lista de Estudiantes con práctica perfecta</h3>";
    for ($i=0; $i < count($array); $i++) { 
        if (strpos($array[$i],"Puntos Obtenidos: 10")!==false) {//Para los que obtubieron 10 pts
            echo $array[$i]."<br>";
            if (count($array)>=1) {
                echo "---------------------------------------<br>";
            }
        }
    }
}

function estInferior($array){//Lista de estudiantes con puntajes inferiores a 7.
    $cont =1;
    echo "<h3>Lista de estudiantes con puntajes inferiores a 7.</h3>";
    for ($i=0; $i < count($array); $i++) { 
        $pos1 = strpos($array[$i],"Obtenidos");//Pocicion de obtenidos 
        if (substr($array[$i],$pos1+10,3)<7) {//si la subcadena(puntos) es menor a 7 
            echo("Prueba # ".$cont);
            echo $array[$i]."<br>";
            echo "---------------------------------------<br>";
            
            $cont++;
        }
    }
}

function estFallaron($array,$numPregunta){//Funcion que muestra solo estudiantes que fallaron n pregunta
    echo("<h3>Lista de estudiantes que han fallado una determinada pregunta # ".$numPregunta."</h3>");

    $arrayRespuestasCorrecta = array(0=>"1", 1=>"2", 2=>"4", 3=>"4", 4=>"3", 5=>"4", 6=>"1", 7=>"4", 8=>"3", 9=>"2");//Clave de respuestas correcta
    for ($x=0; $x <sizeof($array) ; $x++) { 
        $respuesta_usur = valoresRespuesta($array,$x);//Array con respuestas para cada parcial
        if ($respuesta_usur[$numPregunta-1]!=$arrayRespuestasCorrecta[$numPregunta-1]) {//Si la respuesta es diferente se imprime 
            echo($array[$x]."<br");
            echo "---------------------------------------<br>";
        }
        $respuesta_usur = array();//Para limpiar el array que contiene las respuestas del usuario
    }
}

function dividirUsuarios(){//Tratamos el archivo txt y agregamos cada usuario a un indice en el array
    $array=array();
    $Nombre_Archivo = "../textoPlano/resultado.txt";
    $cadena="";
    $El_archivo=fopen($Nombre_Archivo,"r") or die("No se puede abrir el archivo");
    while(!feof($El_archivo)){
        $linea = fgets($El_archivo);
        $cadena = $cadena.$linea."<br>";
        if (strstr($linea,"Tiempo")) {//Para dividir los datos de cada usuario
            //Si la linea que leemos contiene misa es el fin de esa encuesta
            array_push($array,$cadena);//Agregamos la cadena(Datos de encuesta) al array
            $cadena="";//Eliminamos el contenido del encuentado anteriro
        }
    }
    fclose($El_archivo); 
    return $array;
}

function estMejores($array){//Lista de los estudiantes con los 10 mejores tiempos
        //Le pasamos un array ordenado de forma acendente 
    echo "<h3>Lista de los estudiantes con los 10 mejores tiempos</h3>";
    if (count($array)>11) {//Para controlar que se muestre solo 10 por si hay mas pruebas
        $tam = 10;
    }else{
        $tam = count($array);//Si no solo el tamaño del array
    }
    for ($i=0; $i < $tam; $i++) { 
        echo "Prueba #".($i+1)."<br>";
        echo $array[$i];
        echo "---------------------------------------<br>";
    }
}

function burbuja($A,$n){//Para ordenar el arreglo
    //A= array de datos
    //n= Numero de elemento del array
    for($i=1;$i<$n;$i++)    {
            for($j=0;$j<$n-$i;$j++){
                //-------------------
                //Obtenemos el valor del tiempo del ejercicio  b y b+1
                $pos1 = strpos($A[$j],"Tiempo");
                $pos2 = strpos($A[$j+1],"Tiempo");
                $x1 = substr($A[$j],$pos1+30);
                $x2 = substr($A[$j+1],$pos2+30);
                //-------------------
                if ($x1==10) {
                    $x1=8;
                }
                if ($x2==10) {
                    $x2=8;
                }
                if(strcmp($x1, $x2)==1){
                    $k=$A[$j+1];
                    $A[$j+1]=$A[$j]; 
                    $A[$j]=$k;
                }
            }
    }
  return $A;//Retornamos un array ordenado
}

function tiemMaximo($arrayOrdenado){//Obtenemos el valor del maximo 
    $posicionTiempo = strpos($arrayOrdenado[sizeof($arrayOrdenado)-1],"Tiempo");
    $valorTiempo = substr($arrayOrdenado[sizeof($arrayOrdenado)-1],$posicionTiempo+30);
    return $valorTiempo;
}

function tiemMinimo($arrayOrdenado){//Obtenemos el valor minimo
    $posicionTiempo = strpos($arrayOrdenado[0],"Tiempo");
    $valorTiempo = substr($arrayOrdenado[0],$posicionTiempo+30);
    return $valorTiempo;
}
function puntosObteCantidad($array){
    $cantidad=0;
    $cont =10;
    echo("<br>Puntos Obetenidos&nbsp;&nbsp;&nbsp;&nbspCant. de estudiantes<br>");
    for ($z=0; $z <11 ; $z++) { 
        for ($i=0; $i < count($array); $i++) { 
            $pos1 = strpos($array[$i],"Obtenidos");
            if (substr($array[$i],$pos1+10,3)==$cont) {
                $cantidad++;
            }
        }
        echo("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$cont."&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;".$cantidad);
        echo("<br>");
        $cont--;
        $cantidad=0;
    }
}

function valoresRespuesta($array,$numParcial){//Retorna un array con los valores que el usuario respondio a cada pregunta
    $respuesta_usur = array();//Valores de las respuestas de 1 prueba
    $pos1 = strpos($array[$numParcial],"Respuestas:");//Posicion al encontrar la palabra en el string
    $id=11;//Posicion en el array de la primera respuesta
    for ($i=0; $i <10 ; $i++) {//recorremos para obtener las 10 respuestas
        $resp= substr($array[$numParcial],$pos1+$id,1);//substring que contiene la respuesta por pregunta
        array_push($respuesta_usur,$resp);//Agregamos la respuesta en el array
        $id=$id+2;//Aumentamos para obtener el siguiente valor de la siguiente pregunta
    }
    return $respuesta_usur;//Retornamos el array con respuesta solo de 1 practica resuelta
}

function aciertFallas($array){
    $arrayRespuestasCorrecta = array(0=>"1", 1=>"2", 2=>"4", 3=>"4", 4=>"3", 5=>"4", 6=>"1", 7=>"4", 8=>"3", 9=>"2");//Clave de respuestas correcta
    $cantAciertas = array(0=>0, 1=>0, 2=>0, 3=>0, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0);//Guardamos las aciertas por pregunta
    $cantFallas =array(0=>0, 1=>0, 2=>0, 3=>0, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0);//Guardamos las fallas por pregunta
    for ($x=0; $x <sizeof($array) ; $x++) { 
        $respuesta_usur = valoresRespuesta($array,$x);//Array con respuestas para cada parcial
        for ($i=0; $i <sizeof($respuesta_usur) ; $i++) {//Recorremos las respuestas 
            if ($respuesta_usur[$i]==$arrayRespuestasCorrecta[$i]) {//Comparamos si la respuesta del usuario es igual a la de la clave por pregunta
                $cantAciertas[$i]=$cantAciertas[$i]+1;//Acumulamos las aciertas
            }else{
                $cantFallas[$i]=$cantFallas[$i]+1;//Acumulamos las fallas 
            }
        }
        $respuesta_usur = array();//Para limpiar el array que contiene las respuestas del usuario
    }
    echo("&nbsp;&nbsp;Pregunta&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cantidad de Acierto&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cantidad de fallas<br>");
    for ($i=0; $i <10; $i++) {//Mostramos los datos de los array  
        echo("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".($i+1)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$cantAciertas[$i]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$cantFallas[$i]."<br>");
    }
}

?>


</body>
</html>
