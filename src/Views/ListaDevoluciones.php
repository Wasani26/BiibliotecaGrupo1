<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Lista de devoluciones</title>

    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/bootstrap-material-design.min.css">
    <link rel="stylesheet" href="./css/all.css">
    <link rel="stylesheet" href="./css/sweetalert2.min.css">
    <script src="./js/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="./css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="/BiibliotecaGrupo1/src/Views/css/style.css">
</head>
<body>
    <main class="full-box main-container">
        <?php include('nav_lateral.php'); // Incluye tu barra de navegación lateral (si la tienes en un archivo separado) ?>
        <section class="full-box page-content">
            <?php include('navbar_info.php'); // Incluye tu barra de información superior (si la tienes en un archivo separado) ?>
            <div class="full-box page-header">
                <h3 class="text-left">
                    <i class="fas fa-undo-alt fa-fw"></i> &nbsp; LISTA DE DEVOLUCIONES
                </h3>
                <p class="text-justify">
                    Registro detallado de todas las devoluciones realizadas.
                </p>
            </div>
            <div class="container-fluid">
                <ul class="full-box list-unstyled page-nav-tabs">
                    <li>
                        <a href="devoluciones_nueva.php"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVA DEVOLUCIÓN</a>
                    </li>
                    <li>
                        <a class="active" href="devoluciones_lista.php"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE DEVOLUCIONES</a>
                    </li>
                </ul>
            </div>

            <div class="container-fluid">
                <div class="table-responsive">
                    <table class="table table-dark table-sm">
                        <thead>
                            <tr class="text-center roboto-medium">
                                <th>#</th>
                                <th>FECHA DE DEVOLUCIÓN</th>
                                <th>ID PRÉSTAMO</th>
                                <th>ID USUARIO</th>
                                <th>ACTUALIZAR</th>
                                <th>ELIMINAR</th>
                            </tr>
                        </thead>
                        <tbody id="lista-de-devoluciones">
                            <?php
                            // URL de tu backend para listar devoluciones
                            $url_listar = 'http://localhost/BibliotecaGrupo1/public/devoluciones/listar';
                            // // Obtener los datos del backend (asumiendo respuesta JSON)
                            $response = @file_get_contents($url_listar);

                            if ($response !== false) {
                                $devoluciones = json_decode($response, true);

                                if (is_array($devoluciones) && !empty($devoluciones)) {
                                    foreach ($devoluciones as $devolucion): ?>
                                        <tr class="text-center" >
                                            <td><?php echo $devolucion['Id_Devoluciones']; ?></td>
                                            <td><?php echo $devolucion['Fecha_devolucion']; ?></td>
                                            <td><?php echo $devolucion['Historial_Prestamos_Id_Historial_Prestamos']; ?></td>
                                            <td><?php echo $devolucion['Usuarios_Id_Usuarios']; ?></td>
                                            <td>
                                                <a href="devoluciones_actualizar.php?id=<?php echo $devolucion['Id_Devoluciones']; ?>" class="btn btn-success">
                                                    <i class="fas fa-sync-alt"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <form action="devoluciones_lista.php" method="POST" class="form-eliminar-devolucion">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="id" value="<?php echo $devolucion['Id_Devoluciones']; ?>">
                                                    <button type="submit" class="btn btn-warning">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach;
                                } else {
                                    echo '<tr><td colspan="6" class="text-center">No hay devoluciones registradas.</td></tr>';
                                }
                            } else {
                                echo '<tr><td colspan="6" class="text-center">Error al conectar con el backend.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Anterior</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Siguiente</a>
                        </li>
                    </ul>
                </nav>
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
            const listaDevolucionesTabla = document.getElementById('lista-de-devoluciones');

            if (listaDevolucionesTabla) {
                listaDevolucionesTabla.addEventListener('click', function(event) {
                    if (event.target.classList.contains('btn-warning') || event.target.closest('.btn-warning')) {
                        event.preventDefault();
                        const botonEliminar = event.target.classList.contains('btn-warning') ? event.target : event.target.closest('.btn-warning');
                        const formularioEliminar = botonEliminar.closest('.form-eliminar-devolucion');
                        const idDevolucion = formularioEliminar.querySelector('input[name="id"]').value;

                        Swal.fire({
                            title: '¿Estás seguro?',
                            text: "¡No podrás revertir esto!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Sí, eliminarlo!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Enviar la petición DELETE al backend usando fetch API (más moderno)
                                fetch('http://localhost/BiibliotecaGrupo1/public/devoluciones/eliminar/' + idDevolucion, {
                                    method: 'DELETE'
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data && data.status === 200) {
                                        Swal.fire(
                                            '¡Eliminado!',
                                            'La devolución ha sido eliminada.',
                                            'success'
                                        ).then(() => {
                                            window.location.reload(); // Recargar la página para actualizar la lista
                                        });
                                    } else {
                                        Swal.fire(
                                            '¡Error!',
                                            'No se pudo eliminar la devolución.',
                                            'error'
                                        );
                                    }
                                })
                                .catch(error => {
                                    Swal.fire(
                                        '¡Error!',
                                        'Hubo un problema al comunicarse con el servidor.',
                                        'error'
                                    );
                                });
                            }
                        });
                    }
                });
            }

            // Manejar el envío del formulario de eliminación (fallback si JavaScript no está habilitado)
            const formulariosEliminar = document.querySelectorAll('.form-eliminar-devolucion');
            formulariosEliminar.forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    const idDevolucion = this.querySelector('input[name="id"]').value;
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "¡No podrás revertir esto!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Sí, eliminarlo!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Enviar el formulario de forma tradicional (POST con _method=DELETE)
                            this.submit();
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>