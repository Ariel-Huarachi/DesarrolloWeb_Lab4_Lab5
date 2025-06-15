function bandeja_entrada() {
    fetch("bandeja_entrada.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById('contenido').innerHTML = data;
        });
}

function bandeja_salida() {
    fetch("bandeja_salida.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById('contenido').innerHTML = data;
        });
}

function ver() {
    fetch("ver.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById('contenido').innerHTML = data;
        })
        .catch(error => {
            console.error("Error:", error);
        });
}

function verMensajeSalida(id) {
    fetch(`verMensaje.php?id=${id}`
        , {
            method: "POST",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `id=${id}`
        }
    )
        .then(response => response.text())
        .then(data => {
            document.getElementById('mensaje').innerHTML = data;
            document.getElementById('modal').style.display = 'flex';
        });
}

function verMensaje(boton, id) {
    fetch(`verMensaje.php`, {
        method: "POST",
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `id=${id}`
    })
        .then(response => response.text())
        .then(data => {
            document.getElementById('mensaje').innerHTML = data;
            document.getElementById('modal').style.display = 'flex';
        });

    const fila = boton.closest('tr');
    const estadoActual = parseInt(fila.dataset.estado);

    if (estadoActual === 0) {
        fetch(`marcar_leido.php?id=${id}`)
            .then(response => response.text())
            .then(data => {
                if (data === 'aceptar') {
                    fila.classList.remove('pendiente');
                    fila.classList.add('leido');
                    fila.querySelector('.estado').textContent = 'Leído';
                } else {
                    alert('Error al marcar como leído');
                }
            });
    }
}

function verBorrador(id) {
    fetch(`verMensaje.php?id=${id}`
        , {
            method: "POST",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `id=${id}`
        }
    )
        .then(response => response.text())
        .then(data => {
            document.getElementById('mensaje').innerHTML = data;
            document.getElementById('modal').style.display = 'flex';
        });
}

function cerrarModal() {
    document.getElementById('modal').style.display = 'none';
}

function autenticar() {
    const correo = document.getElementById("correoLogin").value;
    const password = document.getElementById("passwordLogin").value;

    const datos = new FormData();
    datos.append("correo", correo);
    datos.append("password", password);

    fetch("autenticar.php", {
        method: "POST",
        body: datos
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            if (data.rol === 2) {
                alert("Bienvenido Administrador");
                window.location.href = "admin.php";
            } else if (data.rol === 1) {
                alert("Bienvenido Usuario");
                window.location.href = "usuario.php";
            } else if (data.rol === 0) {
                alert("Cuenta suspendida");
                mostrarLogin();
            }
        } else {
            alert("Error: " + data.error);
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("Hubo un error al procesar la solicitud.");
    });
}

function suspender(id) {
    if (!confirm("¿Estás seguro de que quieres suspender esta cuenta?")) {
        return;
    }
    fetch(`suspender_usuario.php`, {
        method: "POST",
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `id=${id}`
    })
        .then(response => response.text())
        .then(data => {
            alert(data);
            ver();
        })
        .catch(error => {
            console.error("Error:", error);
        });
}

function habilitar(id) {
    if (!confirm("¿Estás seguro de que quieres habilitar esta cuenta?")) {
        return;
    }
    fetch(`habilitar_usuario.php`, {
        method: "POST",
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `id=${id}`
    })
        .then(response => response.text())
        .then(data => {
            alert(data);
            ver();
        })
        .catch(error => {
            console.error("Error:", error);
        });
}

function verCorreos(id) {
    fetch(`verCorreo.php?id=${id}`)
        .then(response => response.text())
        .then(data => {
            document.getElementById('contenido').innerHTML = data;
        })
        .catch(error => {
            console.error("Error:", error);
        });
}

function eliminarMensaje(id) {
    if (confirm("¿Estás seguro de eliminar este mensaje?")) {
        fetch(`eliminar.php?id=${id}`)
            .then(response => response.text())
            .then(response => {
                if (response === 'aceptar') {
                    document.getElementById(`fila-${id}`).remove();
                } else {
                    alert('Error al eliminar');
                }
            });
    }
}

function bandeja_borrador() {
    fetch("bandeja_borrador.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById('contenido').innerHTML = data;
        });
}

function guardar() {
    const destinatario = document.getElementById('destinatario').value;
    const asunto = document.getElementById('asunto').value;
    const mensaje = document.getElementById('mensaje_textarea').value;

    fetch('guardar.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `destinatario=${encodeURIComponent(destinatario)}&asunto=${encodeURIComponent(asunto)}&mensaje_textarea=${encodeURIComponent(mensaje)}`
    })
        .then(response => response.text())
        .then(data => {
            console.log("Respuesta del servidor:", data);  // <- Añade esto
            if (data === 'aceptar') {
                alert('Mensaje guardado como borrador');
                bandeja_borrador();
            } else {
                alert('Error al guardar el borrador');
            }
        });
}

function editarMensaje(id) {
    fetch(`editarMensaje.php?id=${id}`)
        .then(response => response.text())
        .then(data => {
            // Reutilizamos el mismo modal personalizado
            document.getElementById('mensaje').innerHTML = data;
            document.getElementById('modal').style.display = 'flex';
        })
        .catch(error => {
            console.error("Error:", error);
        });
}


function guardarCambios() {
    const id = document.getElementById('id_mensaje').value;
    const destinatario = document.getElementById('destinatario').value;
    const asunto = document.getElementById('asunto').value;
    const mensaje = document.getElementById('mensaje_textarea').value;

    fetch('guardarCambios.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `id=${id}&destinatario=${encodeURIComponent(destinatario)}&asunto=${encodeURIComponent(asunto)}&mensaje_textarea=${encodeURIComponent(mensaje)}`
    })
        .then(response => response.text())
        .then(data => {
            if (data === 'ok') {
                alert('Borrador actualizado correctamente');
                location.reload();
            } else {
                alert('Error al guardar los cambios');
            }
        });
}

function enviarMensajeEditado() {
    const id = document.getElementById('id_mensaje').value;
    const destinatario = document.getElementById('destinatario').value;
    const asunto = document.getElementById('asunto').value;
    const mensaje = document.getElementById('mensaje_textarea').value;

    fetch('enviarMensajeEditado.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `id=${id}&destinatario=${encodeURIComponent(destinatario)}&asunto=${encodeURIComponent(asunto)}&mensaje_textarea=${encodeURIComponent(mensaje)}`
    })
        .then(response => response.text())
        .then(data => {
            if (data === 'enviado') {
                alert('Mensaje enviado con éxito');
                location.reload();
            } else {
                alert('Error al enviar el mensaje');
            }
        });
}

window.onload = () => {
    mostrarLogin();
};

function mostrarLogin() {
    document.getElementById("formLog").innerHTML = `
    <form onsubmit="autenticar(); return false;" class="login">
        <h1>Iniciar Sesión</h1>
        <label for="correoLogin">Correo</label>
        <input class="gmail" type="email" name="correo" id="correoLogin" placeholder="correo electrónico">
        <label for="passwordLogin">Contraseña</label>
        <input class="contrasena" type="password" name="password" id="passwordLogin" placeholder="contraseña">
        <input type="submit" value="Ingresar">
        <p>¿No tienes cuenta? <a href="#" onclick="mostrarRegistro()">Regístrate</a></p>
    </form>`;
}

function mostrarRegistro() {
    document.getElementById("formLog").innerHTML = `
    <form onsubmit="registrar(); return false;" class="login">
        <h1>Registro</h1>
        <label for="usuarioNuevo">Usuario</label>
        <input class="gmail" type="text" name="usuario" id="usuarioNuevo" placeholder="nombre de usuario">
        <label for="correoNuevo">Correo</label>
        <input class="gmail" type="email" name="correo" id="correoNuevo" placeholder="correo electrónico">
        <label for="passwordNuevo">Contraseña</label>
        <input class="contrasena" type="password" name="password" id="passwordNuevo" placeholder="contraseña">
        <input type="submit" value="Registrarme">
        <p>¿Ya tienes cuenta? <a href="#" onclick="mostrarLogin()">Inicia sesión</a></p>
    </form>`;
}

function registrar() {
    const usuario = document.getElementById("usuarioNuevo").value;
    const correo = document.getElementById("correoNuevo").value;
    const password = document.getElementById("passwordNuevo").value;

    const datos = new FormData();
    datos.append("usuario", usuario);
    datos.append("correo", correo);
    datos.append("password", password);

    fetch("registrar.php", {
        method: "POST",
        body: datos
    })
        .then(res => res.text())
        .then(mensaje => {
            alert(mensaje);
            mostrarLogin();
        })
        .catch(error => {
            console.error("Error al registrar:", error);
            alert("Ocurrió un error al registrarse.");
        });
}