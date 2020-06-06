<?php
$valorSelecion = $_POST['opcion_selecionada'];
$dato = $_POST['dato'];
$datos=array();//Agregaremos a cada encuentado en un indice
$datos=dividirUsuarios();
$ordenado=array();
$ordenado=burbuja($datos,sizeof($datos));
if (sizeof($datos)!=0) {
    if ($valorSelecion==1) {//Estadística general
        estaGeneral($datos);
    }else if ($valorSelecion==2) {//Estadística por fecha
        estaFecha($dato,$datos);
    }else if ($valorSelecion==3) {//Lista de Estudiantes con práctica perfecta
        estaPerfecta($datos);
    }else if ($valorSelecion==4) {//Lista de los estudiantes con los 10 mejores tiempos
        estMejores($ordenado);
    //echo $datos[0];
    }else if ($valorSelecion==5) {//Lista de estudiantes con puntajes inferiores a 7.
        estInferior($datos);
    }else if($valorSelecion==6) {//Lista de estudiantes que han fallado una determinada pregunta.

    }
    echo("<br>Cantidad de prácticas completadas: ".sizeof($datos)."<br>");
    echo("<br>Tiempo máximo en resolver: ".tiemMaximo($ordenado));
    echo("<br>Tiempo mínimo en resolver: ".tiemMinimo($ordenado));
    echo("<br><br>");
    echo("<br>Cantidad de estudiantes por puntajes correctos<br> ");
    puntosObteCantidad($datos);
    aciertFallas($datos);

    echo("<form id='exit' method='get' action='consultas.html' '>
            <button type='submit'>Salir</button>
            </form>");
}else{
    echo("<h1> NO HAY DATOS PARA PROCESAR</h1>");
    echo("<form id='exit' method='get' action='consultas.html' '>
            <button type='submit'>Salir</button>
            </form>");

}
function estaGeneral($array){
    echo "<h1>Estadística General</h1>";
    for ($i=0; $i < count($array); $i++) {
        echo("Prueba #".($i+1)."<br>"); 
        echo $array[$i];
        echo "---------------------------------------<br>";
    }
}

function estaFecha($fechauser,$array){
    echo "<h1>Estadística Fecha</h1>";
    for ($i=0; $i < count($array); $i++) {
        if (strpos($array[$i],$fechauser) !== false) {
            echo $array[$i]."<br>";
            echo "---------------------------------------<br>";
        }
    }
    
}

function estaPerfecta($array){
    echo "Lista de Estudiantes con práctica perfecta<br>";
    for ($i=0; $i < count($array); $i++) { 
        if (strpos($array[$i],"Puntos Obtenidos: 10")!==false) {
            echo $array[$i]."<br>";
        }
    }
}


function estInferior($array){
    $cont =1;
    echo "Lista de estudiantes con puntajes inferiores a 7.<br>";
    for ($i=0; $i < count($array); $i++) { 
        $pos1 = strpos($array[$i],"Obtenidos");
        if (substr($array[$i],$pos1+10,3)<7) {
            echo("Prueba # ".$cont);
            echo $array[$i]."<br>";
            $cont++;
        }
    }
}

function dividirUsuarios(){
    $array=array();
    $Nombre_Archivo = "resultado.txt";
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

function estMejores($array){
    echo "Lista de los estudiantes con los 10 mejores tiempos<br>";
    if (count($array)>11) {
        $tam = 10;
    }else{
        $tam = count($array);
    }
    for ($i=0; $i < $tam; $i++) { 
        echo "Prueba #".($i+1)."<br>";
        echo $array[$i];
        echo "---------------------------------------<br>";
    }
}
function burbuja($A,$n){
    for($i=1;$i<$n;$i++)    {
            for($j=0;$j<$n-$i;$j++){
                $pos1 = strpos($A[$j],"Tiempo");
                $pos2 = strpos($A[$j+1],"Tiempo");
                $x1 = substr($A[$j],$pos1+30);
                $x2 = substr($A[$j+1],$pos2+30);
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
  return $A;
}
function tiemMaximo($arrayOrdenado){
    $posicionTiempo = strpos($arrayOrdenado[sizeof($arrayOrdenado)-1],"Tiempo");
    $valorTiempo = substr($arrayOrdenado[sizeof($arrayOrdenado)-1],$posicionTiempo+30);
    return $valorTiempo;
}
function tiemMinimo($arrayOrdenado){
    $posicionTiempo = strpos($arrayOrdenado[0],"Tiempo");
    $valorTiempo = substr($arrayOrdenado[0],$posicionTiempo+30);
    return $valorTiempo;
}
function puntosObteCantidad($array){
    $cantidad=0;
    $cont =10;
    echo "Lista de estudiantes con puntajes inferiores a 7.<br>";
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
    $respuesta_usur = array();
    $pos1 = strpos($array[$numParcial],"Respuestas:");
    $id=11;
    for ($i=0; $i <10 ; $i++) { 
        $resp= substr($array[$numParcial],$pos1+$id,1);
        array_push($respuesta_usur,$resp);
        $id=$id+2;
    }
    return $respuesta_usur;
}
function aciertFallas($array){
    $arrayRespuestasCorrecta = array(0=>"1", 1=>"2", 2=>"4", 3=>"4", 4=>"3", 5=>"4", 6=>"1", 7=>"4", 8=>"3", 9=>"2");
    $cantAciertas = array(0=>0, 1=>0, 2=>0, 3=>0, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0);
    $cantFallas =array(0=>0, 1=>0, 2=>0, 3=>0, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0);
    for ($x=0; $x <sizeof($array) ; $x++) { 
        $respuesta_usur = valoresRespuesta($array,$x);
        for ($i=0; $i <sizeof($respuesta_usur) ; $i++) { 
            if ($respuesta_usur[$i]==$arrayRespuestasCorrecta[$i]) {
                $cantAciertas[$i]=$cantAciertas[$i]+1;
            }else{
                $cantFallas[$i]=$cantFallas[$i]+1;
            }
        }
        $respuesta_usur = array();//Para limpiar el array que contiene las respuestas del usuario
    }
    echo("Pregunta------------Cantidad de Acierto----------Cantidad de fallas<br>");
    for ($i=0; $i <10; $i++) { 
        echo("-----".($i+1)."-------------------".$cantAciertas[$i]."-------------------------------".$cantFallas[$i]."<br>");
    }
}
?>
