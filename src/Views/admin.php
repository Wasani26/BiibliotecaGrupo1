<!DOCTYPE html>
<html lang="es">
<head>
	<title>Vista Principal</title>
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
			<!-- SideBar Menu -->
			<ul class="list-unstyled full-box dashboard-sideBar-Menu">
				<li>
					<a href="">
						<i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i> Dashboard
					</a>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-case zmdi-hc-fw"></i> Administración <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href=""><i class="zmdi zmdi-labels zmdi-hc-fw"></i> Categorías</a>
						</li>
						<li>
							<a href=""><i class="zmdi zmdi-book zmdi-hc-fw"></i> Nuevo libro</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Usuarios <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href=""><i class="zmdi zmdi-account zmdi-hc-fw"></i> Administradores</a>
						</li>
						<li>
							<a href=""><i class="zmdi zmdi-male-female zmdi-hc-fw"></i> Lectores</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="">
						<i class="zmdi zmdi-book-image zmdi-hc-fw"></i> Catalogo
					</a>
				</li>
			</ul>
		</div>
	</section>



	<!-- Content page-->
	<section class="full-box dashboard-contentPage">
		<!-- NavBar -->
		<nav class="full-box dashboard-Navbar">
			<ul class="full-box list-unstyled text-right">
				<li class="pull-left">
					<a href="#!" class="btn-menu-dashboard"><i class="zmdi zmdi-more-vert"></i></a>
				</li>
				<li>
					<a href="" class="btn-search">
						<i class="zmdi zmdi-search"></i>
					</a>
				</li>
			</ul>
		</nav>
		
    
        <!--Ya este es el contenido de la página que tocará dinamizar-->
		
		<div class="container-fluid">
			<div class="page-header">
			  <h1 class="text-titles">System <small>Tiles</small></h1>
			</div>
		</div>
		<div class="full-box text-center" style="padding: 30px 10px;">
			<article class="full-box tile">
				<div class="full-box tile-title text-center text-titles text-uppercase">
					Admin
				</div>
				<div class="full-box tile-icon text-center">
					<i class="zmdi zmdi-account"></i>
				</div>
				<div class="full-box tile-number text-titles">
					<p class="full-box">1</p>
					<small>Register</small>
				</div>
			</article>
			<article class="full-box tile">
				<div class="full-box tile-title text-center text-titles text-uppercase">
					Bibliotecarios
				</div>
				<div class="full-box tile-icon text-center">
					<i class="zmdi zmdi-male-alt"></i>
				</div>
				<div class="full-box tile-number text-titles">
					<p class="full-box">1</p>
					<small>Register</small>
				</div>
			</article>
			<article class="full-box tile">
				<div class="full-box tile-title text-center text-titles text-uppercase">
					Lectores/Usuarios
				</div>
				<div class="full-box tile-icon text-center">
					<i class="zmdi zmdi-face"></i>
				</div>
				<div class="full-box tile-number text-titles">
					<p class="full-box">1</p>
					<small>Register</small>
				</div>
			</article>
		</div>
		

		</div>
	

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