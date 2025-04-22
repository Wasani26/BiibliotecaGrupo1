<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Actualizar Préstamo</title>

    <link rel="stylesheet" href="./css/normalize.css">

    <link rel="stylesheet" href="./css/bootstrap.min.css">

    <link rel="stylesheet" href="./css/bootstrap-material-design.min.css">

    <link rel="stylesheet" href="./css/all.css">

    <link rel="stylesheet" href="./css/sweetalert2.min.css">

    <script src="./js/sweetalert2.min.js"></script>

    <link rel="stylesheet" href="./css/jquery.mCustomScrollbar.css">

    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <main class="full-box main-container">
        <section class="full-box nav-lateral">
            <div class="full-box nav-lateral-bg show-nav-lateral"></div>
            <div class="full-box nav-lateral-content">
                </div>
        </section>
        <section class="full-box page-content">
            <nav class="full-box navbar-info">
                <a href="#" class="float-left show-nav-lateral">
                    <i class="fas fa-exchange-alt"></i>
                </a>
                <a href="user-update.html">
                    <i class="fas fa-user-cog"></i>
                </a>
                <a href="#" class="btn-exit-system">
                    <i class="fas fa-power-off"></i>
                </a>
            </nav>
            <div class="full-box page-header">
                <h3 class="text-left">
                    <i class="fas fa-sync-alt fa-fw"></i> &nbsp; ACTUALIZAR PRÉSTAMO
                </h3>
                <p class="text-justify">
                    Aquí podrás actualizar la información de un préstamo existente.
                </p>
            </div>
            <div class="container-fluid">
                <ul class="full-box list-unstyled page-nav-tabs">
                    <li>
                        <a href="reservation-new.html"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO PRÉSTAMO</a>
                    </li>
                    <li>
                        <a href="reservation-list.html"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE PRÉSTAMOS</a>
                    </li>
                    <li>
                        <a href="reservation-search.html"><i class="fas fa-search-dollar fa-fw"></i> &nbsp; BUSCAR PRÉSTAMOS</a>
                    </li>
                    <li>
                        <a href="reservation-pending.html"><i class="fas fa-hand-holding-usd fa-fw"></i> &nbsp; PRÉSTAMOS PENDIENTES</a>
                    </li>
                </ul>
            </div>

            <div class="container-fluid">
                <div class="container-fluid form-neon">
                    <form id="formulario-actualizar-prestamo" autocomplete="off">
                        <fieldset>
                            <legend><i class="far fa-plus-square"></i> &nbsp; Información del préstamo</legend>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="prestamo_fecha_inicio">Fecha de préstamo</label>
                                            <input type="date" class="form-control" id="prestamo_fecha_inicio">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="prestamo_fecha_devolucion">Fecha de devolución</label>
                                            <input type="date" class="form-control" id="prestamo_fecha_devolucion">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="prestamo_libros_id" class="bmd-label-floating">ID del Libro **</label>
                                            <input type="number" class="form-control" id="prestamo_libros_id">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="prestamo_usuarios_id" class="bmd-label-floating">ID del Usuario **</label>
                                            <input type="number" class="form-control" id="prestamo_usuarios_id">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <br><br><br>
                        <p class="text-center" style="margin-top: 40px;">
                            <button type="submit" class="btn btn-raised btn-success btn-sm"><i class="fas fa-sync-alt"></i> &nbsp; ACTUALIZAR</button>
                        </p>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <script src="./js/jquery-3.4.1.min.js" ></script>

    <script src="./js/popper.min.js" ></script>

    <script src="./js/bootstrap.min.js" ></script>

    <script src="./js/jquery.mCustomScrollbar.concat.min.js" ></script>

    <script src="./js/bootstrap-material-design.min.js" ></script>
    <script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>

    <script src="./js/main.js" ></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const formulario = document.getElementById('formulario-actualizar-prestamo');
            const urlParams = new URLSearchParams(window.location.search);
            const idPrestamo = urlParams.get('id'); // Obtener el ID del préstamo de la URL

            if (idPrestamo) {
                // Cargar los datos del préstamo existente para el formulario
                fetch(`/prestamos/obtener?route=prestamos/obtener/${idPrestamo}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 200 && data.data) {
                            document.getElementById('prestamo_fecha_inicio').value = data.data.Fecha_prestamo;
                            document.getElementById('prestamo_fecha_devolucion').value = data.data.Fecha_devolucion;
                            document.getElementById('prestamo_libros_id').value = data.data.Libros_Id_Libros;
                            document.getElementById('prestamo_usuarios_id').value = data.data.Usuarios_Id_Usuarios;
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: 'No se pudo cargar la información del préstamo.',
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            }).then(() => {
                                window.location.href = 'reservation-list.html'; // Redirigir a la lista
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error al obtener el préstamo:', error);
                        Swal.fire({
                            title: 'Error',
                            text: 'Ocurrió un error al obtener la información del préstamo.',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        }).then(() => {
                            window.location.href = 'reservation-list.html'; // Redirigir a la lista
                        });
                    });

                formulario.addEventListener('submit', function(event) {
                    event.preventDefault();

                    const fecha_prestamo = document.getElementById('prestamo_fecha_inicio').value;
                    const fecha_devolucion = document.getElementById('prestamo_fecha_devolucion').value;
                    const libros_id_libros = document.getElementById('prestamo_libros_id').value;
                    const usuarios_id_usuarios = document.getElementById('prestamo_usuarios_id').value;

                    const data = {
                        Fecha_prestamo: fecha_prestamo,
                        Fecha_devolucion: fecha_devolucion,
                        Libros_Id_Libros: libros_id_libros,
                        Usuarios_Id_Usuarios: usuarios_id_usuarios
                    };

                    fetch(`/prestamos/actualizar?route=prestamos/actualizar/${idPrestamo}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => response.json())
                    .then(response => {
                        if (response.status === 200) {
                            Swal.fire({
                                title: 'Éxito',
                                text: 'Préstamo actualizado correctamente.',
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            }).then(() => {
                                window.location.href = 'reservation-list.html'; // Redirigir a la lista
                            });
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: response.message || 'No se pudo actualizar el préstamo.',
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error al actualizar el préstamo:', error);
                        Swal.fire({
                            title: 'Error',
                            text: 'Ocurrió un error al actualizar el préstamo.',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    });
                });
            } else {
                Swal.fire({
                    title: 'Error',
                    text: 'No se proporcionó un ID de préstamo válido.',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                }).then(() => {
                    window.location.href = 'reservation-list.html'; // Redirigir a la lista
                });
            }
        });
    </script>
</body>
</html>