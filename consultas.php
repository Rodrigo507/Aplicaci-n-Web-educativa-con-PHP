<?php
$valorSelecion = $_POST['opcion_selecionada'];
$dato = $_POST['dato'];
if ($valorSelecion==1) {//Para op1
    estaGeneral();
}else if ($valorSelecion==2) {//Para op2 por Fecha
    estaFecha($dato);
}else if ($valorSelecion==3) {//Para op2 por Fecha
    estaPerfecta();
}else if ($valorSelecion==5) {//Para op2 por Fecha
    estInferior();
}


function estaGeneral(){
    echo "Estadística general<br>";
    $Nombre_Archivo = "resultado.txt";
    $El_archivo=fopen($Nombre_Archivo,"r") or die("No se puede abrir el archivo");
        While (!feof($El_archivo)){
            $linea = fgets($El_archivo);
            echo $linea."<br>";
    
        }
    fclose($El_archivo);
}

function estaFecha($fechauser){
    echo "Estadística Fecha<br>";
    $Nombre_Archivo = "resultado.txt";
    $El_archivo=fopen($Nombre_Archivo,"r") or die("No se puede abrir el archivo");
    While (!feof($El_archivo)){
        $linea = fgets($El_archivo);
        if (strstr($linea,'Fecha que termino practica: '.$fechauser)) {
            echo $linea."<br>";
        }
    }
    fclose($El_archivo);
}

function estaPerfecta(){
    echo "Lista de Estudiantes con práctica perfecta<br>";
    $Nombre_Archivo = "resultado.txt";
    $El_archivo=fopen($Nombre_Archivo,"r") or die("No se puede abrir el archivo");
    While (!feof($El_archivo)){
        $linea = fgets($El_archivo);
        if (strstr($linea,"Puntos Obtenidos: 10")) {
            echo $linea."<br>";
        }
    }
    fclose($El_archivo);
}

function estInferior(){
    echo "Lista de estudiantes con puntajes inferiores a 7.<br>";
    $Nombre_Archivo = "resultado.txt";
    $El_archivo=fopen($Nombre_Archivo,"r") or die("No se puede abrir el archivo");
    While (!feof($El_archivo)){
        $linea = fgets($El_archivo);
        if (strstr($linea,"Puntos Obtenidos")) {
            $linea = substr($linea,-3);
            if ($linea<7) {
                echo $linea."<br>";
            }
        }
    }
    fclose($El_archivo);
}
?>
