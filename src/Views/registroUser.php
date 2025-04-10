<html lang="es">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link href="/BibliotecaGrupo1/src/Views/css/main.css" rel="stylesheet">
	<link rel="icon" href="/BibliotecaGrupo1/src/Views/assets/img/Logotip.ico" type="image/x-icon">

</head>
<body>
<div class="container">
        <h1>Crear Usuario</h1>
        <form action="" method="POST" id="FormCrearUsuario" name="FormCrearUsuario">
            <!-- Campo Nombre -->
            <div class="form-group">
                <label for="Nombre">Nombre</label>
                <input type="text" id="Nombre" name="Nombre" class="form-control" placeholder="Ingresa tu nombre" required>
            </div>

            <!-- Campo Correo -->
            <div class="form-group">
                <label for="Correo">Correo</label>
                <input type="email" id="Correo" name="Correo" class="form-control" placeholder="Ingresa tu correo electrónico" required>
            </div>

            <!-- Campo Contraseña -->
            <div class="form-group">
                <label for="Contraseña">Contraseña</label>
                <input type="password" id="Contraseña" name="Contraseña" class="form-control" placeholder="Ingresa tu contraseña" required>
            </div>

            <!-- Campo Confirmar Contraseña -->
            <div class="form-group">
                <label for="ConfirmarContraseña">Confirmar Contraseña</label>
                <input type="password" id="ConfirmarContraseña" name="ConfirmarContraseña" class="form-control" placeholder="Confirma tu contraseña" required>
            </div>

            <!-- Campo Teléfono -->
            <div class="form-group">
                <label for="Telefono">Teléfono</label>
                <input type="tel" id="Telefono" name="Telefono" class="form-control" placeholder="Ingresa tu número de teléfono" required>
            </div>

            <!-- Botón Crear Usuario -->
            <div class="form-group text-center">
                <input type="submit" value="Crear Usuario" class="btn btn-primary">
            </div>

            

        </form>
    </div>
</body>