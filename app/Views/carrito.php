<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="<?php echo base_url('public/css/style.css') ?>?<?php echo date('l jS \of F Y h:i:s A'); ?>" />
    <title>Carrito</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?= base_url("/") ?>">MessiCo</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav mx-auto">
                        <a class="nav-link active" aria-current="page" href="#">Empleado:
                            <?= $fullname ?>
                        </a>

                        <a class="nav-link" href="<?= base_url('/carrito') ?>">Carrito</a>
                        <a class="nav-link" href="<?= base_url("/ingresar_productos") ?>">Ingresar Productos</a>
                        <a class="nav-link" href="<?= base_url('/logout') ?>">LogOut</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <div class="carrito">
        <div class="carta-carrito">
            <?php if (isset($carrito) && count($carrito) > 0) { ?>
                <table class="tableCarrito" border="1">
                    <tr>
                        <th>Producto</th>
                        <th>Codigo de Barra</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>


                    <?php
                    $totalPrecio = 0;
                    foreach ($carrito as $key => $producto) {
                        $totalPrecio += floatval($producto["price"]);
                    ?>
                        <tr>
                            <td><?php echo $producto["name"] ?></td>
                            <td><?php echo $producto["codigoDeBarra"] ?></td>
                            <td><?php echo $producto["price"] ?></td>
                            <td>
                                <a class="buttonDeleteTable" href="<?= base_url('/eliminarDeCarrito/' . $producto["codigoDeBarra"]) ?>">Eliminar</a>
                            </td>
                        </tr>

                    <?php } ?>
                    <tr>
                        <td>Total: </td>
                        <td></td>
                        <td><?= $totalPrecio ?></td>
                        <td></td>
                    </tr>
                </table>
                <div class="buttonsCarrito">

                    <a href="<?php echo base_url('/cobrar/' . $totalPrecio) ?>">Cobrar</a>
                    <a href="<?php echo base_url('/') ?>" class="volver-carrito">Volver</a>
                </div>

            <?php } else { ?>
                <h2>No hay productos en los carritos</h2>
                <a href="<?php echo base_url('/') ?>" class="volver-carrito">Volver</a>
            <?php } ?>
        </div>

    </div>

    <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script>
        <?php if (isset($alert)) { ?>
            let alert = Toastify({

                text: "<?php echo $alert ?>",

                duration: 3000

            });
            alert.showToast();
        <?php } ?>
    </script>
</body>

</html>