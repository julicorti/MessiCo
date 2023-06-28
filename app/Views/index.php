<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url("public/css/style.css") ?>?<?php echo date('l jS \of F Y h:i:s A'); ?>" />
</head>


<body class="sector-empleado">
  <header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">MessiCo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
          aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav mx-auto">
            <a class="nav-link active" aria-current="page" href="#">Empleado: <?= $fullname?></a>
            <a class="nav-link" href="#">Features</a>
            <a class="nav-link" href="<?= base_url('/logout') ?>">LogOut</a>
          </div>
        </div>
      </div>
    </nav>
  </header>

  <main>
    <div class="contenedor">

      <div class="carta">
        <img src="<?= base_url('public/image/carrito.png') ?>" alt="" />
      </div>

      <div class="carta">
        <div class="contenido">
          <a href="./empleado.php">
            <h3>Ingreso Productos</h3>
          </a>
        </div>
      </div>
      <div class="carta">
        <img src="<?= base_url('public/image/pesos.png') ?>" alt="" />
      </div>
    </div>
  </main>
  <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>