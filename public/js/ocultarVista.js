document.addEventListener("DOMContentLoaded", function (event) {
    var lista = document.getElementById('lista');

    if(lista.childElementCount <= 1){
        var formularios =  document.getElementsByName('form');

        formularios.forEach(formulario => formulario.style.display = 'none');

    }

});