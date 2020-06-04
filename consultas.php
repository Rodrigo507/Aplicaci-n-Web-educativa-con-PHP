<?php
$fechauser = "4/6/2020";
echo "Estadística general<br>";
echo "--------------------------<br><br><br>";
$Nombre_Archivo = "resultado.txt";
$El_archivo=fopen($Nombre_Archivo,"r") or die("No se puede abrir el archivo");
    While (!feof($El_archivo)){
        $linea = fgets($El_archivo);
        echo $linea."<br>";
    
    }
   
    fclose($El_archivo);
    echo "--------------------------<br>";
    echo "Estadística por fecha<br>";
    echo "--------------------------<br><br><br>";
    $El_archivo=fopen($Nombre_Archivo,"r") or die("No se puede abrir el archivo");
    While (!feof($El_archivo)){
        $linea = fgets($El_archivo);
        if (strstr($linea,'Fecha que termino practica: '.$fechauser)) {
            echo $linea."<br>";
        }
    }
    fclose($El_archivo);
    echo "--------------------------<br>";
    echo "Lista de Estudiantes con práctica perfecta<br>";
    echo "--------------------------<br><br><br>";
    $El_archivo=fopen($Nombre_Archivo,"r") or die("No se puede abrir el archivo");
    While (!feof($El_archivo)){
        $linea = fgets($El_archivo);
        if (strstr($linea,"Puntos Obtenidos: 10")) {
            echo $linea."<br>";
        }
    }
    fclose($El_archivo);
?>
