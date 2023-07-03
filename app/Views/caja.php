<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet"
        href="<?php echo base_url('public/css/style.css') ?>?<?php echo date('l jS \of F Y h:i:s A'); ?>" />
    <title>Caja</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?= base_url("/") ?>">MessiCo</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav mx-auto">
                        <a class="nav-link active" aria-current="page" href="#">Empleado:
                            <?= $fullname ?>
                        </a>
                        <a class="nav-link" href="<?= base_url("/carrito") ?>">Carrito</a>
                        <a class="nav-link" href="<?= base_url("/ingresar_productos") ?>">Ingresar Productos</a>
                        <a class="nav-link" href="<?= base_url("/caja") ?>">Caja</a>
                        <a class="nav-link" href="<?= base_url('/logout') ?>">LogOut</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>


    <div class="contenedor-caja">


        <div class="contenido-caja">
            <?php $totalVentas = 0 ?>
            <?php foreach ($ventas as $index => $venta) {
                $totalVentas += $venta['total'];
                ?>
                <h2>Venta:
                    <?= $index + 1 ?>
                </h2>

                <div class="productsVenta">
                    <?php foreach (json_decode($venta['products'], true) as $index => $product) { ?>
                        <div class="productVenta">
                            <h3>
                                Producto:
                                <?= $product['name'] ?> -

                                codigo de barra:
                                <?= $product['codigoDeBarra'] ?> -


                                Precio:
                                <?= $product['price'] ?>
                            </h3>
                        </div>
                    <?php } ?>
                </div>
                <p>Total venta:
                    <?= floatval($venta['total']) ?>
                </p>
            <?php } ?>

            <p><b>Total de Caja:
                    <?= $totalVentas ?>
                </b></p>


        </div>
        <div class="comparacion-contenedor">

            <div class="contenido-comparacion">
                <h4>Comparación monto</h4>
                <input class="cajita" type="text" placeholder="Ingrese monto en caja" id="inputComparar">

                <button id="ButtonComparar">Comparar</button>
                <?php if (count($ventas) > 0) { ?>
                    <form class="cerrar-cajita" action="<?= base_url('/cerrarCaja') ?>" method="POST">
                        <input type="text" hidden value="<?= $totalVentas ?>" name="totalVentas">
                        <button class="cerrar">Cerrar Caja</button>
                    </form>
                <?php } ?>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        let totalVentas = <?= $totalVentas ?>;
        $('#ButtonComparar').on('click', e => {
            let valorIngresado = $('#inputComparar').val();
            if (totalVentas == valorIngresado) {
                Swal.fire({
                    icon: 'success',
                    title: 'El monto coincide con el total',
                    
                    
                })
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'El monto no coincide con el total',
                    text: 'Me parece que te robaron!',
                    
                })
            }
        })

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