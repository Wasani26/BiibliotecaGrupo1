
<html lang="es">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link href="/BibliotecaGrupo1/src/Views/css/main.css" rel="stylesheet">
	<link rel="icon" href="/BibliotecaGrupo1/src/Views/assets/img/Logotip.ico" type="image/x-icon">

</head>
<body>
    
	<div class="full-box login-container cover">
		<form  method="get" id="MiForm" name="MiForm" class="logInForm">
			<p class="text-center text-muted"><img src="/BibliotecaGrupo1/src/Views/assets/img/Logo.png" witdh="200" height="200"></p>
			<p class="text-center text-muted text-uppercase">Inicia sesión con tu cuenta</p>
			<div class="form-group label-floating">
			  <label class="control-label" for="MiCorreo">Correo</label>
			  <input class="form-control" id="MiCorreo" type="text">
			  <p class="help-block">Escribe tu correo electronico</p>
			</div>
			<div class="form-group label-floating">
			  <label class="control-label" for="UserPass">Contraseña</label>
			  <input class="form-control" id="UserPass" type="password">
			  <p class="help-block">Escribe tú contraseña</p>
			</div>
			<div class="form-group text-center">
				<input type="submit" value="Ingresar" class="btn btn-info" style="color: #FFF;">
			</div>
          <!--Si no tienes cuenta-->
			<div class="">
                      <p class="" >No tienes Cuenta? <a href="registrer" action="">Crea una aqui</a></p>
                    </div>

		</form>
	</div>
	<!--====== Scripts-->
	<script src="/BibliotecaGrupo1/src/Views/js/jquery-3.1.1.min.js"></script>
	<script src="/BibliotecaGrupo1/src/Views/js/bootstrap.min.js"></script>
	<script src="/BibliotecaGrupo1/src/Views/js/material.min.js"></script>
	<script src="/BibliotecaGrupo1/src/Views/js/ripples.min.js"></script>
	<script src="/BibliotecaGrupo1/src/Views/js/sweetalert2.min.js"></script>
	<script src="/BibliotecaGrupo1/src/Views/js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="/BibliotecaGrupo1/src/Views/js/main.js"></script>
	
	<script>
		$.material.init();
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="/BibliotecaGrupo1/src/Views/js/funciones.js"></script>
</body>
</html>