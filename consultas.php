<?php
$valorSelecion = $_POST['opcion_selecionada'];
$dato = $_POST['dato'];
$datos=array();//Agregaremos a cada encuentado en un indice
$datos=dividirUsuarios();


if ($valorSelecion==1) {//Estadística general
    estaGeneral($datos);
}else if ($valorSelecion==2) {//Estadística por fecha
    estaFecha($dato,$datos);
}else if ($valorSelecion==3) {//Lista de Estudiantes con práctica perfecta
    estaPerfecta($datos);
}else if ($valorSelecion==4) {//Lista de los estudiantes con los 10 mejores tiempos
    echo "Function 10 mejores tiempo <br>";
    //estMejores($datos);
    //echo $datos[0];
}else if ($valorSelecion==5) {//Lista de estudiantes con puntajes inferiores a 7.
    estInferior($datos);
}else if($valorSelecion==6) {//Lista de estudiantes que han fallado una determinada pregunta.

}

echo("<form id='exit' method='get' action='consultas.html' '>
        <button type='submit'>Salir</button>
        </form>");
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
    for ($i=0; $i < count($array); $i++) { 
        echo $array[$i];
    }
}
?>
