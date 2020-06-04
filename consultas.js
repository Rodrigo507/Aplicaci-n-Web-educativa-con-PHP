function mostrarFormulario() {
    document.getElementById("aceptar").setAttribute("style","visibility: hidden;");//Ocultamos 
    var op = document.getElementById("opciones");
    var select = op.options[op.selectedIndex].value;
    if (select ==2) {
        document.getElementById("pFecha").removeAttribute("style");//Mostramos el capo para ingresar la fecha
        enviarValores(select,document.getElementById("r1").value)
    }else if (select ==6) {
        document.getElementById("dtPregunta").removeAttribute("style");//Ocultamos 
        enviarValores(select,document.getElementById("r2").value)
    }else{
        enviarValores(select);
    }
    document.getElementById("butonConsultar").removeAttribute("style");//Ocultamos 
    console.log(select);

}
function enviarValores(valorSelect,dato="null") {//nombre,opciones selecionadas, pts obtenidos, fecha que termini, horra que termini , tiempo en que realizo la prueba
    document.getElementById("opcion_selecionada").value = valorSelect;//Nombre
    document.getElementById("dato").value = dato;//Nombre
}






window.onload = function () {
    if (document.getElementById("aceptar")) {
        document.getElementById("aceptar").onclick = mostrarFormulario;
        
    }

}