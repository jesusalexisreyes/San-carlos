

<?php
include("conn/connLocalhost.php");
include("includes/utils.php");
if(isset($_POST['sent'])) {

  // Validacion de cajas vacias
  foreach ($_POST as $calzon => $caca) {
    if($caca == "" && $calzon != "nombre") $error[] = "El campo $calzon es obligatorio";
  }



  $nombre= $_REQUEST['nombre'];
  $correo = $_REQUEST['correo'];
  $contraseña= $_REQUEST['contraseña'];
  $telefono = $_REQUEST['telefono'];
  $perfil_usuario= $_REQUEST['perfil_usuario'];
  $edad= $_REQUEST['edad'];

if(!isset($error)) {
  // Definimos el query a ejecutar
  $queryUsuarioAdd = sprintf("INSERT INTO usuario (nombre, correo, contraseña, telefono, perfil_usuario, edad)
  VALUES ( '%s', '%s', '%s', '%s', '%s', '%s')",
      mysqli_real_escape_string($connLocalhost,trim($nombre)),
      mysqli_real_escape_string($connLocalhost,trim($correo)),
      mysqli_real_escape_string($connLocalhost,trim($contraseña)),
      mysqli_real_escape_string($connLocalhost,trim($telefono)),
      mysqli_real_escape_string($connLocalhost,trim($perfil_usuario)),
      mysqli_real_escape_string($connLocalhost,trim(edad))


  );


  $resQueryUsuario = mysqli_query($connLocalhost, $queryUsuarioAdd) or trigger_error("The propiety insert query failed...");

  if($resQueryUsuario) {

  }

}
};

//eMPIEZA LA CONSULTA ALA BASE DE DATOS PARA LISTAR LOS TIPOS DE USUARIOS

$queryGetUsuario = "SELECT id, nombre, correo, telefono, perfil_usuario, edad FROM usuario";
$resQueryGetUsuario = mysqli_query($connLocalhost, $queryGetUsuario) or trigger_error("There was an error getting the user data... please try again");

$totalUsuario = mysqli_num_rows($resQueryGetUsuario);

$UsuarioDetails = mysqli_fetch_assoc($resQueryGetUsuario);

ini_set('display_errors', 1);
error_reporting(E_ALL);

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

    <meta name="description" content="Sona Template">
    <meta name="keywords" content="Sona, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inmobilaria San carlos | Usuarios</title>


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

  </head>
  <body>
    <?php include("includes/headerAdmi.php"); ?>


        <div class="breadcrumb-section" style="background-color: #ecccad21;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-text">
                            <h2>Lista de Usuarios</h2>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
          if(isset($error)) { ?>
              <div style="background: #F5A9A9;"class="alert alert-warning alert-dismissable">
        <?php
          printMsg($error, "error");
        echo "  </div>";}

        ?>

         <?php if(isset($queryUsuarioAdd)){
          ?>
          <div class="alert alert-success alert-dismissible fade show">
             <strong>Success!</strong> Se ha registrado un usuario exitosamente.
             <button type="button" class="close" data-dismiss="alert">&times;</button>
         </div>
         <?php } ?>

                            <button button type="submit" data-toggle="modal" data-target="#registroUsuario" >Registrar tipo</button>
                        </div>
                    </div>
</div>


  <table class="table table-striped">



    <thead>
      <tr>

        <th scope="col">Id</th>
        <th scope="col">Nombre</th>
        <th scope="col">Correo</th>
        <th scope="col">telefono</th>
        <th scope="col">perfil de usuario</th>
        <th scope="col">edad</th>


      </tr>
    </thead>
    <tbody>
      <?php do { ?>

      <tr>
        <td><?php echo $UsuarioDetails['id'] ?></td>
        <td><?php echo $UsuarioDetails['nombre'] ?></td>
        <td><?php echo $UsuarioDetails['correo'] ?></td>
        <td><?php echo $UsuarioDetails['telefono'] ?></td>
        <td><?php echo $UsuarioDetails['perfil_usuario'] ?></td>
        <td><?php echo $UsuarioDetails['edad'] ?></td>


      </tr>

    </tbody>
  <?php } while($UsuarioDetails = mysqli_fetch_assoc($resQueryGetUsuario)); ?>

  </table>





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
