


$("#MiForm").submit(function (event) {
    event.preventDefault(); // Evitamos el envío tradicional del formulario.

    let user = $("#MiCorreo").val();
    let clave = $("#UserPass").val();
    var caso = "login";

    // Validación del correo y contraseña
    const claveRegex = /^(?=.*[a-zA-Z])(?=.*\d).{8,}$/; // Al menos 8 caracteres, 1 letra y 1 número.
    
    if (user === "" || clave === "") {
        Swal.fire({
            title: "Debes llenar todos los campos!",
            icon: "warning"
        });
        return false;
    }
    
    if (!claveRegex.test(clave)) {
        Swal.fire({
            title: "Formato de contraseña inválido",
            text: "Debe contener al menos 8 caracteres, una letra y un número.",
            icon: "warning"
        });
        return false;
    }

    // Realizar petición AJAX
    $.ajax({
        url: 'login',
        type: 'GET', // Considera cambiar a POST para mayor seguridad.
        data: { usuario: user, clave: clave, caso: caso },
        success: function (resp) {
            Swal.fire({
                title: "Buen trabajo!",
                text: "DATA: " + resp,
                icon: "success"
            });
            window.location.href = "ruta_deseada.html"; // Redirige al usuario.
        },
        error: function (jqXHR, textStatus, errorThrown) {
            Swal.fire({
                title: "Error en el servidor",
                text: "No se pudo completar la solicitud.",
                icon: "error"
            });
            console.error('Error:', textStatus, errorThrown);
        }
    });
});


