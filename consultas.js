function mostrarFormulario() {
    document.getElementById("aceptar").setAttribute("style","visibility: hidden;");//Ocultamos 
    var op = document.getElementById("opciones");
    var select = op.options[op.selectedIndex].value;
    if (select ==2) {
        document.getElementById("pFecha").removeAttribute("style");//Mostramos el capo para ingresar la fecha
    }else if (select ==6) {
        document.getElementById("dtPregunta").removeAttribute("style");//Ocultamos 
    }else{
        document.getElementById("butonConsultar").removeAttribute("style");//Ocultamos 
    }
    document.getElementById("butonConsultar").removeAttribute("style");//Ocultamos 
}
function enviarValores(o) {//nombre,opciones selecionadas, pts obtenidos, fecha que termini, horra que termini , tiempo en que realizo la prueba
    var op = document.getElementById("opciones");
    var select = op.options[op.selectedIndex].value;
        if (select==2) {
            alert ("fecha");
            document.getElementById("dato").value = document.getElementById("r1").value;//Nombre
        }else if (select == 6) {
            document.getElementById("dato").value = document.getElementById("r2").value;//Nombre
            alert("Numero")
        }else{
            document.getElementById("opcion_selecionada").value = select;//Nombre

        }
}






window.onload = function () {
    if (document.getElementById("aceptar")) {
        document.getElementById("aceptar").onclick = mostrarFormulario;
        document.getElementById("butonConsultar").onclick = this.enviarValores;
        
    }

}