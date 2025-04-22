
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Categorias</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="/BibliotecaGrupo1/src/Views/css/main.css" rel="stylesheet">
    <link rel="icon" href="/BibliotecaGrupo1/src/Views/assets/img/Logotip.ico" type="image/x-icon">
</head>
<body>
<!-- SideBar -->
<!--Todo esto es la barra lateral que usaremos para intentar dinamizar -->
<section class="full-box cover dashboard-sideBar">
    <div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
    <div class="full-box dashboard-sideBar-ct">
        <!--SideBar Title -->
        <div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title">
            BibliotecaGrupo1 <i class="zmdi zmdi-close btn-menu-dashboard visible-xs"></i>
        </div>
        <!-- SideBar User info -->
        <div class="full-box dashboard-sideBar-UserInfo">
            <figure class="full-box">
                <img src="/BibliotecaGrupo1/src/Views/assets/avatars/AdminMaleAvatar.png" alt="UserIcon">
                <figcaption class="text-center text-titles">Administrador</figcaption>
            </figure>
            <ul class="full-box list-unstyled text-center">
                <li>
                    <a href="" title="Mis Perfil">
                        <i class="zmdi zmdi-account-circle"></i>
                    </a>
                </li>
                <li>
                    <a href="" title="Mi cuenta">
                        <i class="zmdi zmdi-settings"></i>
                    </a>
                </li>
                <li>
                    <a href="#!" title="Cerrar Sesión" class="btn-exit-system">
                        <i class="zmdi zmdi-power"></i>
                    </a>
                </li>
            </ul>
        </div>
		<!-- Content page -->
		<div class="container-fluid">
			<div class="page-header">
			  <h1 class="text-titles"><i class="zmdi zmdi-labels zmdi-hc-fw"></i> Administración <small>CATEORÍAS</small></h1>
			</div>
			<p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse voluptas reiciendis tempora voluptatum eius porro ipsa quae voluptates officiis sapiente sunt dolorem, velit quos a qui nobis sed, dignissimos possimus!</p>
		</div>

		<div class="container-fluid">
			<ul class="breadcrumb breadcrumb-tabs">
			  	<li>
			  		<a href="category.html" class="btn btn-info">
			  			<i class="zmdi zmdi-plus"></i> &nbsp; NUEVA CATEORÍA
			  		</a>>
			  	</li>
			  	<li>
			  		<a href="category-list.html" class="btn btn-success">
			  			<i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE CATEORÍAS
			  		</a>
			  	</li>
			</ul>
		</div>

		<!-- Panel nueva categoria -->
		<div class="container-fluid">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; NUEVA CATEORÍA</h3>
				</div>
				<div class="panel-body">
					<form>
				    	<fieldset>
				    		<legend><i class="zmdi zmdi-assignment-o"></i> &nbsp; Información de la categoría</legend>
				    		<div class="container-fluid">
				    			<div class="row">
				    				<div class="col-xs-12 col-sm-6">
								    	<div class="form-group label-floating">
										  	<label class="control-label">Código *</label>
										  	<input pattern="[0-9]{1,7}" class="form-control" type="text" name="codigo-reg" required="" maxlength="7">
										</div>
				    				</div>
				    				<div class="col-xs-12 col-sm-6">
								    	<div class="form-group label-floating">
										  	<label class="control-label">Nombre *</label>
										  	<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="nombre-reg" required="" maxlength="30">
										</div>
				    				</div>
				    			</div>
				    		</div>
				    	</fieldset>
					    <p class="text-center" style="margin-top: 20px;">
					    	<button type="submit" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Guardar</button>
					    </p>
				    </form>
				</div>
			</div>
		</div>
		
	</section>

	<!--====== Scripts -->
	<script src="/BibliotecaGrupo1/src/Views/js/jquery-3.1.1.min.js"></script>
	<script src="/BibliotecaGrupo1/src/Views/js/sweetalert2.min.js"></script>
	<script src="/BibliotecaGrupo1/src/Views/js/bootstrap.min.js"></script>
	<script src="/BibliotecaGrupo1/src/Views/js/material.min.js"></script>
	<script src="/BibliotecaGrupo1/src/Views/js/ripples.min.js"></script>
	<script src="/BibliotecaGrupo1/src/Views/js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="/BibliotecaGrupo1/src/Views/js/main.js"></script>
	<script>
		$.material.init();
	</script>
</body>
</html>
