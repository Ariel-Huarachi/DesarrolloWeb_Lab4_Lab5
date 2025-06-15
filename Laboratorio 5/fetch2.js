window.onload = () => {
    mostrarLogin();
};

function mostrarLogin() {
    document.getElementById("formLog").innerHTML = `
    <link rel="stylesheet" href="estilosForm.css">
    <img class="imgForm" src="Imagenes/hotel1.webp" alt="Logo" class="logo">
    <form onsubmit="autenticar(); return false;" class="login">
        <h1>Iniciar Sesión</h1>
        <label for="correoLogin">Correo</label>
        <input class="gmail" type="email" name="correo" id="correoLogin" placeholder="correo electrónico">
        <label for="passwordLogin">Contraseña</label>
        <input class="contrasena" type="password" name="password" id="passwordLogin" placeholder="contraseña">
        <input type="submit" value="Ingresar">
        <p>¿No tienes cuenta? <a class="form" href="#" onclick="mostrarRegistro()">Regístrate</a></p>
    </form>`;
}

function mostrarRegistro() {
    document.getElementById("formLog").innerHTML = `
    <link rel="stylesheet" href="estilosForm.css">
    <img class="imgForm" src="Imagenes/hotel1.webp" alt="Logo" class="logo">
    <form onsubmit="registrar(); return false;" class="login">
        <h1>Registro</h1>
        <label for="usuarioNuevo">Usuario</label>
        <input class="gmail" type="text" name="usuario" id="usuarioNuevo" placeholder="nombre de usuario">
        <label for="correoNuevo">Correo</label>
        <input class="gmail" type="email" name="correo" id="correoNuevo" placeholder="correo electrónico">
        <label for="passwordNuevo">Contraseña</label>
        <input class="contrasena" type="password" name="password" id="passwordNuevo" placeholder="contraseña">
        <input type="submit" value="Registrarme">
        <p>¿Ya tienes cuenta? <a class="form" href="#" onclick="mostrarLogin()">Inicia sesión</a></p>
    </form>`;
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
            if (data.nivel === 2) {
                alert("Bienvenido Administrador");
                window.location.href = "admin.html";
            } else if (data.nivel === 1) {
                alert("Bienvenido Usuario");
                window.location.href = "usuario.html";
            } else if (data.nivel === 0) {
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
            window.location.href = "usuario.html";
        })
        .catch(error => {
            console.error("Error al registrar:", error);
            alert("Ocurrió un error al registrarse.");
        });
}