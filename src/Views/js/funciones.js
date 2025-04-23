$("#MiForm").submit(function (event) {
    //event.preventDefault(); // Evitamos el envío tradicional del formulario.

    let user = $("#MiCorreo").val();
    let clave = $("#UserPass").val();
    var caso = "login";

    // Validación del correo y contraseña
    const claveRegex = /^(?=.*[a-zA-Z])(?=.*\d).{8,}$/; // Al menos 8 caracteres, 1 letra y 1 número.
    

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
        type: 'get', // Considera cambiar a POST para mayor seguridad.
        data: { usuario: user, clave: clave, caso: caso },
        success: function (resp) {
            alert("¡Bienvenido!");
            switch (resp) {
                case 1: window.location.href = "admin"; break;
                case 2: window.location.href = "Biblio"; break;
                case 3: window.location.href = "login"; break;
            }
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
    return false;
   });
               
           



//validación html para crear un usuario

$("#FormCrearUsuario").submit(function (event) {
    event.preventDefault();

    // Capturar valores
    let nombre = $("#Nombre").val();
    let correo = $("#Correo").val();
    let contraseña = $("#Contrasena").val();
    let confirmarContraseña = $("#ConfirmarContraseña").val();
    let telefono = $("#Telefono").val();

    // Regex
    const correoRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const telefonoRegex = /^\d{4}-\d{4}$/;

    // Validaciones
    if (!nombre || !correo || !contraseña || !confirmarContraseña || !telefono) {
        Swal.fire({
            title: "Debes llenar todos los campos!",
            text: "Por favor completa toda la información requerida.",
            icon: "warning"
        });
        return false;
    }

    if (!correoRegex.test(correo)) {
        Swal.fire({
            title: "Formato de correo inválido!",
            text: "Por favor ingresa un correo electrónico válido.",
            icon: "warning"
        });
        return false;
    }

    if (contraseña !== confirmarContraseña) {
        Swal.fire({
            title: "Las contraseñas no coinciden!",
            text: "Por favor asegúrate de que ambas contraseñas sean iguales.",
            icon: "warning"
        });
        return false;
    }

    if (!telefonoRegex.test(telefono)) {
        Swal.fire({
            title: "Formato de teléfono inválido!",
            text: "El formato correcto es: 9790-0387.",
            icon: "warning"
        });
        return false;
    }

    // Enviar datos
    let datos = {
        Nombre: nombre,
        Correo_electronico: correo,
        Contrasena: contraseña,
        confirmaContrasena: confirmarContraseña,
        Telefono: telefono
    };
    console.log(datos)

    $.ajax({
        url: 'user?route=user/&caso=user',
        type: "POST",
        data: JSON.stringify(datos),
        contentType: "application/json",
        success: function (response) {
            console.log(response)
            Swal.fire({
                title: "¡Usuario Creado!",
                text: response.message || "El usuario se creó correctamente.",
                icon: "success",
            });
        },
        error: function (xhr, status, error) {
            console.error("Error:", error);
            console.log("XHR:", xhr);
            console.log("Status:", status);
            Swal.fire({
                title: "Error",
                text: "Hubo un problema al crear el usuario.",
                icon: "error",
            });
        }
        
    });
    
});
