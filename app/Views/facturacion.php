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
    <title>Facturacion</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?= base_url('/') ?>">MessiCo</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('/') ?>">Stock</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('/facturacion') ?>">Facturacion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('/logout') ?>">LogOut</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>


    <div class="contenedor-fac">
        <h1>Facturacion</h1>
        <div class="contenido-1">
            <select id="meses">
                <option value="0">Enero</option>
                <option value="1">Febrero</option>
                <option value="2">Marzo</option>
                <option value="3">Abril</option>
                <option value="4">Mayo</option>
                <option value="5">Junio</option>
                <option value="6">Julio</option>
                <option value="7">Agosto</option>
                <option value="8">Septiembre</option>
                <option value="9">Octubre</option>
                <option value="10">Noviembre</option>
                <option value="11">Diciembre</option>
            </select>

            <h2>Cierres de caja</h2>
            <div id="cierreDiv"></div>

        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script>
        let cierres = []
        <?php foreach ($cierres as $index => $cierre) {

            $fecha = $cierre['fecha'];
            $fecha = explode('/', $fecha)
                ?>

            cierres.push({
                "nombre": "<?= $cierre['fullname'] ?>",
                "fecha": new Date(<?= $fecha[2] . ',' . ($fecha[1] - 1) . ',' . $fecha[0] ?>),
                "total": <?= $cierre['totalVentas'] ?>
            })

        <?php } ?>
        console.log(cierres)
        $('#meses').on('change', e => {
            $("#cierreDiv").html("")
            cierres.map(cierre => {
                if ($("#meses").val() == cierre.fecha.getMonth()) {
                    $("#cierreDiv").html(`${$("#cierreDiv").html()}
                    <div class="contenido-2" >
                        <h3>${"Empelado/a: " + cierre.nombre}</h3>
                        <p>${"Fecha: " + cierre.fecha.toLocaleDateString('es-AR')}</p>
        
                        <p><b>${"Total: " + cierre.total}</b></p>
                    </div>
                    `)
                }

            })
        })
    </script>
</body>

</html>