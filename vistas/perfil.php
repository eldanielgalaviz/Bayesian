<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Perfil de <?php echo $usuario;?></title>
    <link rel="icon" href="/static/img/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <link rel="stylesheet" href="/static/css/editarPeriflModal.css" />
    <script src="../static/js/validaciones.js"></script>
    <style>
    .mensaje-error {
        color: red;
        font-size: 20px;
        font-weight: bold;
    }
    </style>
</head>

<body style="background-color: #203647">
    <?php
$rutaDirectorio = dirname(__FILE__);

include "$rutaDirectorio/header.php";
  ?>
    <div class="container my-4 mx-auto rounded p-4" style="background-color: #eefbfb; width: fit-content">
        <div class="d-flex justify-content-between align-items-start">
            <h1 class="align-self-start m-3">Mi Perfil</h1>
        </div>
        <div class="container">
            <div class="nombre">
                <p style="display: inline-block" class="fs-3">Nombre (s)</p>
                <input type="text" id="nombre" name="nombre" style="display: inline-block" disabled="true"
                    value="<?php echo $nombre;?>" />
            </div>

            <div class="apellido">
                <p style="display: inline-block" class="fs-3">Apellido (s)</p>
                <input type="text" id="apellido" name="apellido" style="display: inline-block" disabled="true"
                    value="<?php echo $apellido;?>" />
            </div>

            <div class="edad">
                <p style="display: inline-block" class="fs-3">Edad</p>
                <input type="text" id="edad" name="edad" style="display: inline-block" disabled="true"
                    value="<?php echo $edad;?>" />
            </div>

            <div class="sexo">
                <p class="fs-3">Sexo</p>
                <div class="dropdown">

                    <select disabled="true" id="sexo" name="sexo">
                        <option class="dropdown-item" value="femenino"
                            <?php if ($sexo == 'femenino') echo ' selected'; ?>>Femenino</option>
                        <option class="dropdown-item" value="masculino"
                            <?php if ($sexo == 'masculino') echo ' selected'; ?>>Masculino</option>
                    </select>

                </div>
            </div>

            <div class="usuario">
                <p style="display: inline-block" class="fs-3">Usuario</p>
                <input id="usuario" type="text" name="usuario" style="display: inline-block" disabled="true"
                    value="<?php echo $usuario;?>" />
            </div>

            <div class="correo">
                <p style="display: inline-block" class="fs-3">Correo</p>
                <input type="email" name="email" id="correo" style="display: inline-block" disabled="true"
                    value="<?php echo $correo;?>" />
            </div>

            <div class="btnEditar">
                <button type="button" class="btn btn-primary p-2" data-bs-toggle="modal"
                    data-bs-target="#modalPerfil">Editar perfil</button>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalPerfil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content ">
                <div class="modal-header">
                    <h1 class="modal-title fs-2" id="exampleModalLabel">Edita los campos</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body form">

                    <form method="post" action="../perfil.php">
                        <div class="mb-3 row">
                            <label for="usuario" class="col-sm-2 col-form-label fw-bold">Nombre (s)</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nombre" name="nombre"
                                    value="<?php echo $nombre;?>" />
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="apellido" class="col-sm-2 col-form-label fw-bold">Apellido (s)</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="apellido" name="apellido"
                                    value="<?php echo $apellido;?>" />
                            </div>
                        </div>


                        <div class="mb-3 row">
                            <label for="usuario" class="col-sm-2 col-form-label fw-bold">Edad</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="edad" name="edad"
                                    value="<?php echo $edad?>">
                            </div>
                        </div>


                        <div class="mb-3 row">
                            <label for="sexo" class="col-sm-2 col-form-label fw-bold">Sexo</label>

                            <div class="col-sm-10">
                                <select class="form-select" id="sexo" name="sexo">
                                    <option class="dropdown-item" value="femenino"
                                        <?php if ($sexo == 'femenino') echo ' selected'; ?>>Femenino</option>
                                    <option class="dropdown-item" value="masculino"
                                        <?php if ($sexo == 'masculino') echo ' selected'; ?>>Masculino</option>
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <input type="submit" class="btn btn-primary" value="Guardar cambios" />

                        </div>
                    </form>


                </div>

            </div>
        </div>
    </div>

    <div class="container rounded p-4 mx-auto m-3" style="background-color: #eefbfb; width: fit-content">
        <div class="d-flex justify-content-between align-items-start">
            <h1 class="align-self-start m-3">Cambiar contraseña</h1>
        </div>
        <p class="fs-5">
            Recibe un enlace para acceder a una ventana de cambio de contraseña
        </p>
        <a class="btn btn-primary" href="./cambiarContra.php">Cambiar contraseña</a>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end m-3">
            <a class="btn btn-primary" href="/proyectos.php">Volver</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script>
    function copyToClipboard(text) {
        const input = document.createElement("textarea");
        input.value = text;
        document.body.appendChild(input);
        input.select();
        document.execCommand("copy");
        document.body.removeChild(input);
    }
    </script>
</body>

</html>