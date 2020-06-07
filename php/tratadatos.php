<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRACTICA RESUELTA</title>
    <script src="../js/codigo.js"></script>
</head>
<body>
    <?php
    //Obtenemos los datos de la practica resuelta y la asignamos a la variables
        $nombre = $_POST['nombre_php'];
        $respuestas = $_POST['respuestas_php'];
        $puntos = $_POST['puntos_php'];
        $fechaTermino = $_POST['fechatemina_php'];
        $horaTermino = $_POST['horatemina_php'];
        $tiempoPrueba = $_POST['tiempotrascurido_php'];
        //Mostramos en pantalla las respuestas correctas
        echo("<form id='formularioresuelto'>
        <label id='nombre' for='nombre'>Nombre: ".$nombre." </label>
        <h4 id='pregunta'>1- ¿En qué estado se encuentra el agua de los glaciares?</h4>
        <input type='radio' value='1' name='respuesta' checked> <label id='r1'>1- Solido </label> <br>
        <input type='radio' value='2' name='respuesta'> <label  id='r2'>2- Liquido </label><br>
        <input type='radio' value='3' name='respuesta'> <label  id='r3'>3- Gaseoso </label><br>
        <input type='radio' value='4' name='respuesta'> <label  id='r4'>4- Plasma </label><br>
        <p id='correcta'></p>
        <!-- <input id='siguiente' type='submit' value='Siguiente pregunta'> -->
        <input id='siguiente' type='button' value='Siguiente pregunta'>
    </form>");
    ?>

    <?php
        //Boton de salir (index)
    echo("<form id='exit' method='get' action='../index.html' style='display: none;'>
        <button type='submit'>Salir</button>
        </form>");
    ?>

    <?php
    //Escribimos en el archivo txt los datos de la prueba
    $nombre_archivo = "../textoPlano/resultado.txt";//Nombre base del arhcivo a crear
    $open = fopen($nombre_archivo,"a");//Abrimos el archivo en modo escritura
        fwrite($open,"Nombre: ".$nombre."\n");
        fwrite($open,"Respuestas:".$respuestas."\n");
        fwrite($open,"Puntos Obtenidos: ". $puntos."\n");
        fwrite($open,"Fecha que termino practica: ". $fechaTermino."\n");
        fwrite($open,"Hora que termino practica: ". $horaTermino."\n");
        fwrite($open,"Tiempo que tardo la practica: ". $tiempoPrueba." min\n");
        fwrite($open,"\n");
    fclose($open);//Cerramos el archivo txt
    ?>
</body>
</html>