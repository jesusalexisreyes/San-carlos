
<?php



if(!isset($_SESSION)) {
  session_start();
  //session_destroy();

 if($_SESSION !=null) {


   if ($_SESSION['UsuarioTCrear']=true) {
     header("Location: indexAdmi.php?login=true");
   }if ($_SESSION['UsuarioTEditar']=true) {
     header("Location: indexAdmi.php?login=true");
   }if ($_SESSION['UsuarioTEliminar']=true) {
     header("Location: indexAdmi.php?login=true");
}

}
 }

// Incluimos la conexión a la BD
include("conn/connLocalhost.php");
include("includes/utils.php");

// Validamos que el formulario se haya enviado
if(isset($_POST['sent'])) {
  // validamos campos vacios
  foreach ($_POST as $calzon => $caca) {
    if($caca == "") $error[] = "El campo $calzon es necesario";
  }

  // Continuamos con la validación siempre y cuando estemos libres de errores
  if(!isset($error)) {
    // Armamos la consulta con datos sanitizados
    $queryLoginUser = sprintf("SELECT id, nombre, correo, contraseña, telefono, perfil_usuario FROM usuario WHERE correo = '%s' AND contraseña = AES_ENCRYPT('%s','llave')",
        mysqli_real_escape_string($connLocalhost, trim($_POST['correo'])),
        mysqli_real_escape_string($connLocalhost, trim($_POST['contraseña']))
    );

    // Ejecutamos el query
    $resQueryLoginUser = mysqli_query($connLocalhost, $queryLoginUser) or trigger_error("Algo esta fallando");

    //Evaluamos el resultado, si es exitoso, creamos los indices de sesión
    if(mysqli_num_rows($resQueryLoginUser)) {
      // Hacemos un fetch del resultset
      $userData = mysqli_fetch_assoc($resQueryLoginUser);

      // Definimos los indices de sesión
      $_SESSION['usuarioId'] = $userData['id'];
          $_SESSION['usuarioNombre'] = $userData['nombre'];
      $_SESSION['usuarioCorreo'] = $userData['correo'];
        $_SESSION['usuarioContraseña'] = $userData['Contraseña'];
      $_SESSION['UsuarioPerfil'] = $userData['perfil_usuario'];
      $_SESSION['UsuarioTelefono'] = $userData['telefono'];


      $valor = $userData['perfil_usuario'];
      $queryGeTipotUsuario = "SELECT id, nombre, crear, editar, eliminar FROM perfil_usuario WHERE id=$valor";
      $resQueryGetTipoUsuario = mysqli_query($connLocalhost, $queryGeTipotUsuario) or trigger_error("There was an error getting the user data... please try again");
      if(mysqli_num_rows($resQueryGetTipoUsuario))
        // Hacemos un fetch del resultset
        $perfilData = mysqli_fetch_assoc($resQueryGetTipoUsuario);

        $_SESSION['perfilId'] = $perfilData['id'];
        $_SESSION['perfilnombre'] = $perfilData['nombre'];
        $_SESSION['perfilcrear'] = $perfilData['crear'];
        $_SESSION['perfileditar'] = $perfilData['editar'];
        $_SESSION['perfileliminar'] = $perfilData['eliminar'];



if ($_SESSION['UsuarioTCrear']==true) {
  header("Location: indexAdmi.php?login=true");
}if ($_SESSION['UsuarioTEditar']==true) {
  header("Location: indexAdmi.php?login=true");
}if ($_SESSION['UsuarioTEliminar']==true) {
  header("Location: indexAdmi.php?login=true");
}



    }
    else {
      $error[] = "Las credenciales son incorrectas..... intentelo de nuevo!";
    }

}
}
 ?>



<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Sona Template">
    <meta name="keywords" content="Sona, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inmobilaria San carlos | Rentas</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/flaticon.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="shortcut icon" href="favicon.ico" />

</head>

<body  >
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>


    <header class="header-section">

            <div class="menu-item">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="logo">
                                <a href="index.php">
                                <img src="img/logo.png" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="nav-menu">
                                <nav class="mainmenu">
                                    <ul>

                                    </ul>
                                </nav>
                                <div class="nav-right search-switch">
                                  <!--  <i class="icon_search"></i> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    <!-- Header End -->

    <!-- Hero Section Begin -->

    <!-- Hero Section End -->

    <!-- About Us Section Begin -->
    <section class="aboutus-section spad" style="background-image: url(img/vistas/fondo.Admi.jpg);   background-repeat: no-repeat;
  background-attachment: scroll ;
  background-size: 100% 100%;" >


  <div class=" col-lg-4 mx-auto">
    <?php
  if(isset($error)) printMsg($error, "error");
  if(isset($_GET['loggedOut'])) printMsg("You have logged out succesfully from the system.", "exito");
  if(isset($_GET['authError'])) printMsg("No tiene persmiso para estar aqui.", "error");
?>
      <div class="booking-form">
          <h3>Inicia sesion</h3>
          <form action="entrar.php" method="post">
              <div class="check-date">
                  <label for="date-in">Correo:</label>
                  <input type="e-mail" name="correo" >
              </div>
              <div class="check-date">
                  <label for="date-out">Contraseña:</label>
                  <input type="password" name="contraseña">
              </div>
              <div class="alert alert-warning" role="alert">

              <span style="    font-size: 10px;
    color: #dfa974;
    font-weight: 700;
    letter-spacing: 2px;">Puedes acceder a la vista principal con:<br/>
              correo: visitante@gmail.com <br/>
            contraseña: visitante  </span>
</div>

        <input type="submit" value="Iniciar sesion" style="    border-left: groove;
    border-right: groove;" name ="sent" class="btn btn-default btn-block" />          </form>
      </div>
  </div>
    </section>
    <!-- About Us Section End -->

    <!-- Blog Section End -->

    <!-- Footer Section Begin -->
    <?php include("includes/footerAdmi.php"); ?>

    <!-- Footer Section End -->

    <!-- Search model Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch"><i class="icon_close"></i></div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search model end -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
