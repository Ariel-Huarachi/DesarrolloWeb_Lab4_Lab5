function redactar() {
    var ajax = new XMLHttpRequest();

    ajax.open("GET", "redactar.php", true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            document.getElementById('mensaje').innerHTML = ajax.responseText;
            document.getElementById('modal').style.display = 'flex';
        }
    };
    ajax.send();
}


function enviarMensaje() {
    var formulario = document.getElementById('formulario');
    var datos = new FormData(formulario);

    var checkbox = document.getElementById('enviar_todos');
    if (checkbox && checkbox.checked) {
        datos.set('enviar_todos', '1');
    } else {
        datos.set('enviar_todos', '0');
    }

    var ajax = new XMLHttpRequest();
    ajax.open("POST", "enviar.php", true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            alert(ajax.responseText);
            bandeja_salida();
        }
    };
    ajax.send(datos);
}
