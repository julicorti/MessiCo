<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('public/css/style.css') ?>">
    <title>Ticket</title>
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

                        <a class="nav-link" href="<?= base_url('/carrito') ?>">Carrito</a>
                        <a class="nav-link" href="<?= base_url("/ingresar_productos") ?>">Ingresar Productos</a>
                        <a class="nav-link" href="<?= base_url('/logout') ?>">LogOut</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="contenedor-ticket">
            <div class="carta-ticket">
                <h1>Ticket:
                    <?= $id_venta ?>
                </h1>
                <p>Fecha:
                    <?= date('d/m/Y') ?>
                </p>
                <p>Productos: </p>
                <div class="ticketProducts">
                    <?php foreach (json_decode($products, true) as $index => $p) { ?>
                        <p>Nombre:
                            <?= $p['name'] ?>...................... Precio:
                            <?= $p['price'] ?>
                        </p>
                    <?php } ?>
                </div>
                <p><b>Total:
                        <?= $total ?>
                    </b></p>
            </div>


        </div>
    </main>
    <script>

        window.print()
    </script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</body>

</html>