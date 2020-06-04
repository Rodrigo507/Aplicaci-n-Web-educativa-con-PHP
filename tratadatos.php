<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>resultados</title>
</head>
<body>
    <?php
        $nombre = $_POST['nombre_php'];
        $respuestas = $_POST['respuestas_php'];
        $puntos = $_POST['puntos_php'];
        $fechaTermino = $_POST['fechatemina_php'];
        $tiempoPrueba = $_POST['tiempotrascurido_php'];
        echo("<h1?>Nombre: ". $nombre ."</h1><br>");
        echo("<h1?>Respuestas: ". $respuestas ."</h1><br>");
        echo("<h1?>Puntos Obtenidos: ". $puntos ."</h1><br>");
        echo("<h1?>Fecha que termino practica: ". $fechaTermino ."</h1><br>");
        echo("<h1?>Tiempo que tardo la practica: ". $tiempoPrueba ."</h1><br>");
    ?>
</body>
</html>