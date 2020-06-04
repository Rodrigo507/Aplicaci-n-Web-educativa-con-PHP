<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRACTICA RESUELTA</title>
</head>
<body>
    <?php
        $nombre = $_POST['nombre_php'];
        $respuestas = $_POST['respuestas_php'];
        $puntos = $_POST['puntos_php'];
        $fechaTermino = $_POST['fechatemina_php'];
        $horaTermino = $_POST['horatemina_php'];
        $tiempoPrueba = $_POST['tiempotrascurido_php'];
        echo("<h1?>Nombre: ". $nombre ."</h1><br>");
        echo("<h1?>Respuestas: ". $respuestas ."</h1><br>");
        echo("<h1?>Puntos Obtenidos: ". $puntos ."</h1><br>");
        echo("<h1?>Fecha que termino practica: ". $fechaTermino ."</h1><br>");
        echo("<h1?>Hora que termino practica: ". $horaTermino ."</h1><br>");
        echo("<h1?>Tiempo que tardo la practica: ". $tiempoPrueba ."</h1><br>");
    ?>

    <?php
    $nombre_contizacion = "resultado.txt";//Nombre base del arhcivo a crear
    $open = fopen($nombre_contizacion,"a");//Abrimos el archivo en modo escritura
        fwrite($open,"Nombre: ".$nombre."\n");
        fwrite($open,"Respuestas:".$respuestas."\n");
        fwrite($open,"Puntos Obtenidos: ". $puntos."\n");
        fwrite($open,"Fecha que termino practica: ". $fechaTermino."\n");
        fwrite($open,"Hora que termino practica: ". $horaTermino."\n");
        fwrite($open,"Tiempo que tardo la practica: ". $tiempoPrueba."\n");
        fwrite($open,"-----------------------------------\n");
    fclose($open);//Cerramos el archivo txt
    
    ?>
</body>
</html>