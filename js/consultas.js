function mostrarFormulario() {
    if (this.value==2) {
        document.getElementById("pFecha").removeAttribute("style");//Mostramos el capo para ingresar la fecha
        document.getElementById("dtPregunta").setAttribute("style",style="visibility: hidden;");//Mostramos el capo para ingresar la fecha
        document.getElementById("butonConsultar").onmouseover = validarFecha;//Para validar fecha
        document.getElementById("r1").setAttribute("required","required");
        document.getElementById("r2").removeAttribute("required");
    }else if (this.value ==6) {
        document.getElementById("r2").setAttribute("required","required");
        document.getElementById("r1").removeAttribute("required");
        document.getElementById("dtPregunta").removeAttribute("style");//Ocultamos 
        document.getElementById("pFecha").setAttribute("style",style="visibility: hidden;");//Mostramos el capo para ingresar la fecha
        document.getElementById("butonConsultar").onmouseover = validarNumeroPregunta;//Para validar fecha
    }else{
        document.getElementById("r1").removeAttribute("required");
        document.getElementById("r2").removeAttribute("required");
        document.getElementById("dtPregunta").setAttribute("style",style="visibility: hidden;");//Mostramos el capo para ingresar la fecha
        document.getElementById("pFecha").setAttribute("style",style="visibility: hidden;");//Mostramos el capo para ingresar la fecha
    }
    document.getElementById("butonConsultar").removeAttribute("style")
}

function enviarValores() {//nombre,opciones selecionadas, pts obtenidos, fecha que termini, horra que termini , tiempo en que realizo la prueba
    var op = document.getElementById("opciones");
    var select = op.options[op.selectedIndex].value;    
        if (select==2) {
            document.getElementById("dato").value = document.getElementById("r1").value;//Nombre
        }else if (select == 6) {
            document.getElementById("dato").value = document.getElementById("r2").value;//Nombre
        }
    document.getElementById("opcion_selecionada").value = select;//Nombre
        
}

function validarFecha() {
    var resp = true;
    var value = document.getElementById("r1").value;
    var fecha = value.split("/");    
    var dia = parseInt(fecha[0], 10),
        mes = parseInt(fecha[1], 10),
        ano = parseInt(fecha[2], 10);
        
            if (dia>31) {
                resp=false
            }
            if (mes>12) {
                resp= false;
            }
            if (ano>2020) {
                resp= false;
            }
        
    if (resp==false) {
        alert("Fecha incorrecta");
    }
}

function validarNumeroPregunta() {
    var value = document.getElementById("r2").value
    if (value>10) {
        alert("Numero de pregunta debe ser menor que 11");
    }
}

window.onload = function () {
    document.getElementById("opciones").onmouseup= mostrarFormulario;
    document.getElementById("butonConsultar").onclick = enviarValores;
}