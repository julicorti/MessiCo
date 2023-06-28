<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login y Register - MagtimusPro</title>

  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <link rel="stylesheet" href="<?php echo base_url('public/css/style.css') ?>" />
</head>

<body class="inicio">
  <main class="login-main">
    <div class="contenedor__todo">
      <div class="caja__trasera">
        <div class="caja__trasera-login">
          <h3>¿Ya tienes una cuenta?</h3>
          <p>Inicia sesión para entrar en la página</p>
          <button id="btn__iniciar-sesion">Iniciar Sesión</button>
        </div>
        <div class="caja__trasera-register">
          <h3>¿Aún no tienes una cuenta?</h3>
          <p>Regístrate para que puedas iniciar sesión</p>
          <button id="btn__registrarse">Regístrarse</button>
        </div>
      </div>

      <!--Formulario de Login y registro-->
      <div class="contenedor__login-register">
        <!--Login-->
        <form action="<?php echo base_url("/login") ?>" class="formulario__login" method="POST">
          <h2>Iniciar Sesión</h2>
          <input type="text" placeholder="Correo Electronico" name="email" />
          <input type="password" placeholder="Contraseña" name="password" />
          <button>Entrar</button>
        </form>

        <!--Register-->
        <form action="<?php echo base_url("/registrarse") ?>" method="POST" class="formulario__register">
          <h2>Regístrarse</h2>
          <input type="text" placeholder="Nombre completo" name="fullname" />
          <input type="text" placeholder="Correo Electronico" name="email" />
          <input type="text" placeholder="Usuario" name="username" />
          <input type="password" placeholder="Contraseña" name="password" />
          <button>Regístrarse</button>
        </form>
      </div>
    </div>
  </main>

  <script>
    <?php if (isset($error)) { ?>
      Swal.fire({
        icon: 'error',
        title: 'Hubo un error',
        text: '<?=$error?>'
      })
    <?php } ?>
  </script>
  <script src="<?php echo base_url('public/js/script.js') ?>"></script>
  </script>
</body>

</html>