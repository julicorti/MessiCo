<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="<?php echo base_url('public/css/style.css') ?>?<?php echo date('l jS \of F Y h:i:s A'); ?>" />
    <title>Empleado</title>
</head>

<body class="empleado-body">
    <form class="form" method="POST" action="<?php echo base_url('/ingresoCodigo') ?>">
        <h2 class="form__title">Productos</h2>
        <div class="form__container">
            <div class="form__group">
                <input type="text" name="codigoDeBarra" class="form__input" placeholder="Ingrese el producto">
            </div>
            <input type="submit" class="form__submit" value="Enter">
            <a href="<?php echo base_url('/') ?>" class="form__link">Volver</a>
        </div>
    </form>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
   
    <script>
        <?php if(isset($msg)){?>
        let alert = Toastify({

            text: "<?php echo $msg ?>",

            duration: 3000

        });
            alert.showToast();
            <?php } ?>
    </script>
</body>

</html>