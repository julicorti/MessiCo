<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url("public/css/style.css") ?>?<?php echo date('l jS \of F Y h:i:s A'); ?>" />
  <title>Stock</title>
</head>

<body class="admin-body">
  <header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">MessiCo</a>
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
              <a class="nav-link" href="<?= base_url('/facturacion')?>">Facturacion</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('/logout') ?>">LogOut</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <main  >

    <h1>Stock</h1>

    <div class="contenedor-admin">

      <?php foreach ($products as $index => $p) { ?>
        <div class="card" style="width: 20rem">
          <h5 class="card-title">
            <?= $p["name"] ?>
          </h5>
          <img src="<?php echo base_url('/uploads/') . $p['image'] ?>" class="card-img-top" alt="..." />

          <p class="card-text">Codigo de barra:<br>
            <?= $p["codigoDeBarra"] ?>
          </p>
          <p class="card-text">Precio:<br>
            <input type="text" value="<?= $p["price"] ?>" class="price" id="price<?= $p['id_product'] ?>"
              onchange="savePrice(<?= $p['id_product'] ?>)">
          </p>
          <p class="card-text">Stock</p>
          <div class="controller-stock">
            <button class="boton" onclick="addStock('<?= $p['id_product'] ?>')">+</button>
            <input type="text" onchange="saveStock('<?= $p['id_product'] ?>')" value="<?= $p["stock"] ?>"
              id="stock<?= $p["id_product"] ?>" />
            <button class="boton" onclick="removeStock('<?= $p['id_product'] ?>')">-</button>
          </div>
          
        </div>
      <?php } ?>
      <form action="<?= base_url("/updateProducts") ?>" method="post" id="formDataPost" style="display: none;">
        <input type="text" name="data" id="dataPost">
      </form>
      <button class="boton-guardar" onclick="postData()">Guardar Cambios</button>
    </div>


    <div class="createProduct">
     
      <div class="carta-agregar ">
      <h2>Agregar un nuevo producto</h2>
        <form action="<?= base_url('/createNewProduct') ?>" method="POST" enctype="multipart/form-data">

          <input type="file" name="image">
          <input type="text" placeholder="Nombre del producto" name="name">
          <input type="text" placeholder="Precio del producto" name="price">
          <input type="text" placeholder="Stock del producto" name="stock">
          <input type="text" name="codigoDeBarra" placeholder="Ingrese Codigo de Barra">
          <button>Crear</button>
        </form>
      </div>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script>
    let productos = []
    <?php foreach ($products as $index => $p) { ?>
      productos.push({
        id_product: "<?= $p["id_product"] ?>",
        stock: "<?= $p["stock"] ?>",
        price: "<?= $p["price"] ?>",
      })
    <?php } ?>

    function addStock(id) {
      let input = document.getElementById("stock" + id)
      input.value = parseInt(input.value) + 1
      let current = productos.find(p => p.id_product == id)
      current.stock = input.value
      input.focus()
    }

    function removeStock(id) {
      let input = document.getElementById("stock" + id)
      input.value = parseInt(input.value) - 1;
      input.focus()
      if (input.value < 0) {
        input.value = 0;
      }
      let current = productos.find(p => p.id_product == id)
      current.stock = input.value
    }

    const saveStock = (id) => {
      let input = document.getElementById("stock" + id)
      let current = productos.find(p => p.id_product == id)
      current.stock = parseFloat(input.value)

    }

    function savePrice(id) {
      let input = document.getElementById('price' + id)
      let current = productos.find(p => p.id_product == id)
      current.price = parseFloat(input.value)
    }

    function postData() {
      var form = $("#formDataPost")
      $("#dataPost").val(JSON.stringify(productos))
      form.submit();
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>