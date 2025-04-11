
$("#MiForm").submit(function (event) {
    event.preventDefault(); // Evitamos el envío tradicional del formulario.

    let user = $("#MiCorreo").val();
    let clave = $("#UserPass").val();
    var caso = "login";

    // Validación del correo y contraseña
    const claveRegex = /^(?=.*[a-zA-Z])(?=.*\d).{8,}$/; // Al menos 8 caracteres, 1 letra y 1 número.
    
    /*if (user === "" || clave === "") {
        Swal.fire({
            title: "Debes llenar todos los campos!",
            icon: "warning",
            confirmButtonText: "OK"
        }).then((result) => {
            if(result.isConfirmed) {
                 //Me manda al login.php otra vez
                 window.location.href = "http://localhost/BibliotecaGrupo1/public/login/login.php"
            }
        });
        return false;
    }*/

        if (user === "" || clave === "") {
            Swal.fire({
                title: "Debes llenar todos los campos!",
                text: "Por favor proceda a llenarlos",
                icon: "warning",
            });
            return false;
        }


    if (!claveRegex.test(clave)) {
        Swal.fire({
            title: "Formato de contraseña inválido",
            text: "Debe contener al menos 8 caracteres, una letra y un número.",
            icon: "warning",
        });
        return false;
    }

    // Realizar petición AJAX
    $.ajax({
        url: 'login',
        type: 'POST', // Considera cambiar a POST para mayor seguridad.
        data: { usuario: user, clave: clave, caso: caso },
        success: function (resp) {
            Swal.fire({
                title: "Buen trabajo!",
                text: "DATA: " + resp,
                icon: "success"
            });
            window.location.href = ""; 
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

//validación html para crear un usuario

$("#FormCrearUsuario").submit(function (event) {
    event.preventDefault(); // Evitamos el envío tradicional del formulario.

    // Capturar valores de los campos
    /*let nombre = $("#Nombre").val();
    let correo = $("#Correo").val();
    let contraseña = $("#Contraseña").val();
    let confirmarContraseña = $("#ConfirmarContraseña").val();
    let telefono = $("#Telefono").val();*/

    let datos = {
        Nombre: $("#Nombre").val(),
        Correo: $("#Correo").val(),
        Contraseña: $("#Contraseña").val(),
        Telefono: $("#Telefono").val()
    };

    // Regex para validaciones
    const correoRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Formato de correo
    const telefonoRegex = /^\d{4}-\d{4}$/; // Formato de teléfono: 9790-0387

    // Validar que todos los campos estén llenos
    if (!nombre || !correo || !contraseña || !confirmarContraseña || !telefono) {
        Swal.fire({
            title: "Debes llenar todos los campos!",
            text: "Por favor completa toda la información requerida.",
            icon: "warning"
        });
        return false;
    }

    // Validar formato del correo
    if (!correoRegex.test(correo)) {
        Swal.fire({
            title: "Formato de correo inválido!",
            text: "Por favor ingresa un correo electrónico válido.",
            icon: "warning"
        });
        return false;
    }

    // Validar que las contraseñas coincidan
    if (contraseña !== confirmarContraseña) {
        Swal.fire({
            title: "Las contraseñas no coinciden!",
            text: "Por favor asegúrate de que ambas contraseñas sean iguales.",
            icon: "warning"
        });
        return false;
    }

    // Validar formato del teléfono
    if (!telefonoRegex.test(telefono)) {
        Swal.fire({
            title: "Formato de teléfono inválido!",
            text: "El formato correcto es: 9790-0387.",
            icon: "warning"
        });
        return false;
    }

    // Si todas las validaciones pasan, enviar datos (puedes añadir tu lógica AJAX aquí)
    Swal.fire({
        title: "Buen trabajo!",
        text: "Formulario validado exitosamente.",
        icon: "success"
    });

    // Aquí podrías agregar tu petición AJAX
    $.ajax({
        url: "http://localhost/BibliotecaGrupo1/public/user", // URL del endpoint
        type: "POST",
        data: JSON.stringify(datos),
        contentType: "application/json",
        success: function (response) {
            Swal.fire({
                title: "¡Usuario Creado!",
                text: response.message,
                icon: "success"
            });
        },
        error: function () {
            Swal.fire({
                title: "Error",
                text: "Hubo un problema al crear el usuario.",
                icon: "error"
            });
        }
    });
});

