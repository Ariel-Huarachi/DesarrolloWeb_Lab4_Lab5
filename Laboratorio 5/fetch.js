var contenedor;
var tipoHabitacion;
var habitacion;
var numero;
var superficie;
var camas;
var precio;
var fecha_entrada;
var fecha_salida;

window.onload = () => {
    cargar("inicio.html");
};

function cargar(abrir) {
    contenedor = document.getElementById("contenido");

    fetch(abrir)
        .then(Response => Response.text())
        .then(data => {
            contenedor.innerHTML = data;
        });
}

function cargarFormulario(abrir) {
    contenedor = document.getElementById("contenido");

    fetch(abrir)
        .then(Response => Response.text())
        .then(data => {
            contenedor.innerHTML = data;
            cargarTiposHabitaciones();
        });
}

function cargarTiposHabitaciones() {
    tipoHabitacion = document.getElementById("tipoHabitacion");
    habitacion = document.getElementById("habitacion");
    numero = document.getElementById("numero");
    fetch("tipoHabitacion.php")
        .then(Response => Response.text())
        .then(data => {
            tipoHabitacion.innerHTML = data;
            habitacion.innerHTML = "";
            numero.innerHTML = "";
            cargarHabitaciones();
            document.getElementById("tipoHabitacion").addEventListener("change", cargarHabitaciones);
        });
}

function cargarHabitaciones() {
    console.log("Cargando habitaciones...");
    tipoHabitacion = document.getElementById("tipoHabitacion").value;
    habitacion = document.getElementById("habitacion");
    numero = document.getElementById("numero");

    const formData = new FormData();
    formData.append("id", tipoHabitacion);

    fetch("habitacion.php", {
        method: "POST",
        body: formData
    })
        .then(Response => Response.text())
        .then(data => {
            habitacion.innerHTML = data;
            numero.innerHTML = "";
            cargarNumero();
            document.getElementById("habitacion").addEventListener("change", cargarNumero);
        });
}

function cargarNumero() {
    habitacion = document.getElementById("habitacion").value;
    numero = document.getElementById("numero");

    const formData = new FormData();
    formData.append("id", habitacion);

    fetch("numero.php", {
        method: "POST",
        body: formData
    })
        .then(Response => Response.text())
        .then(data => {
            numero.innerHTML = data;
            cargarDatos();
        });
}

function cargarDatos() {
    habitacion = document.getElementById("habitacion").value;
    camas = document.getElementById("camas");
    precio = document.getElementById("precio");
    superficie = document.getElementById("superficie");

    let formData = new FormData();
    formData.append("id", habitacion);

    fetch("detalles.php", {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        camas.innerHTML = data.camas;
        precio.innerHTML = data.precio;
        superficie.innerHTML = data.superficie;
    });
}

function verHabitaciones(idTipo) {
    const contenedor = document.getElementById("contenido");

    fetch("formReservar.html")
        .then(response => response.text())
        .then(html => {
            contenedor.innerHTML = html;

            const tipoSelect = document.getElementById("tipoHabitacion");

            fetch("tipoHabitacion.php")
                .then(response => response.text())
                .then(data => {
                    tipoSelect.innerHTML = data;
                    tipoSelect.value = idTipo;

                    cargarHabitaciones();
                    tipoSelect.addEventListener("change", cargarHabitaciones);
                });
        });
}


function reservar() {
    tipoHabitacion = document.getElementById("tipoHabitacion").value;
    habitacion = document.getElementById("habitacion").value;
    numero = document.getElementById("numero").value;
    fecha_entrada = document.getElementById("fechaEntrada").value;
    fecha_salida = document.getElementById("fechaSalida").value;
    superficie = document.getElementById("superficie").value;
    camas = document.getElementById("camas").value;
    precio = document.getElementById("precio").value;

    const datosReserva = {
        tipoHabitacion: tipoHabitacion,
        habitacion: habitacion,
        numero: numero,
        fecha_entrada: fecha_entrada,
        fecha_salida: fecha_salida,
        superficie: superficie,
        camas: camas,
        precio: precio
    };

    fetch("reservar.php", {
        method: "POST",
        body: JSON.stringify(datosReserva)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Reserva realizada con éxito.");
            cargar("inicio.html");
        } else {
            alert("Error al realizar la reserva: " + data.message);
        }
    })
}