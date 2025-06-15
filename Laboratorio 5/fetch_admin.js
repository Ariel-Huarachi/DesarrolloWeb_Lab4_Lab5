var contenedor;

window.onload = () => {
    cargarAdmin("inicio_admin.html");
};

function cargarAdmin(abrir) {
    contenedor = document.getElementById("contenido-admin");

    fetch(abrir)
        .then(Response => Response.text())
        .then(data => {
            contenedor.innerHTML = data;
        });
}

// Funciones para gestionar las habitaciones

function mostrarFormularioAgregarHabitacion() {
    fetch("form_agregar_habitacion.php")
        .then(res => res.text())
        .then(html => {
            document.getElementById("contenido-admin").innerHTML = html;
        });
}

function agregarHabitacion() {
    const form = document.getElementById("formAgregarHabitacion");
    const datos = new FormData(form);

    fetch("agregar_habitacion.php", {
        method: "POST",
        body: datos
    })
        .then(res => res.text())
        .then(msg => {
            alert(msg);
            cargarAdmin('gestionar_habitaciones.php');
        });
}

function editarHabitacion(id) {
    fetch(`form_editar_habitacion.php?id=${id}`)
        .then(res => res.text())
        .then(html => {
            document.getElementById("contenido-admin").innerHTML = html;
        });
}

function actualizarHabitacion(id) {
    const form = document.getElementById("formEditarHabitacion");
    const datos = new FormData(form);
    datos.append("id", id);

    fetch("actualizar_habitacion.php", {
        method: "POST",
        body: datos
    })
        .then(res => res.text())
        .then(msg => {
            alert(msg);
            cargarAdmin('gestionar_habitaciones.php');
        });
}

function eliminarHabitacion(id) {
    if (confirm("¿Estás seguro de eliminar esta habitación?")) {
        fetch('eliminar_habitacion.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'id=' + encodeURIComponent(id)
        })
        .then(res => res.text())
        .then(data => {
            alert(data);
            cargarAdmin('gestionar_habitaciones.php');
        });
    }
}

function gestionarFotos(id) {
    fetch(`gestionar_fotos.php?id=${id}`)
        .then(res => res.text())
        .then(html => {
            document.getElementById("contenido-admin").innerHTML = html;
        });
}

// Funciones para gestionar las reservas




