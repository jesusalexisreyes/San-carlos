

<?php
include("conn/connLocalhost.php");
include("includes/utils.php");

if (!isset($_SESSION)) {
    session_start();
    //session_destroy();



  if(!isset($_SESSION['usuarioId'])) header('Location: entrar.php?authError=true');
  if($_SESSION['perfilcrear']==true) header('Location: indexAdmi.php?verificacion=true');
  if($_SESSION['perfileditar']==true) header('Location: indexAdmi.php?verificacion=true');
  if($_SESSION['perfileliminar']==true) header('Location: indexAdmi.php?verificacion=true');

}


if(isset($_POST['sent'])) {

  // Validacion de cajas vacias
  foreach ($_POST as $calzon => $caca) {
    if($caca == "" && $calzon != "nombre") $error[] = "El campo $calzon es obligatorio";
  }



  $nombre= $_REQUEST['nombre'];
  $correo = $_REQUEST['correo'];
  $contraseña= $_REQUEST['contraseña'];
  $contraseña2= $_REQUEST['contraseña2'];

  $telefono = $_REQUEST['telefono'];
  $perfil_usuario= $_REQUEST['perfil_usuario'];
  $edad= $_REQUEST['edad'];



  if($contraseña != $contraseña2) $error[] = "La contraseña no coincide";

  // Validación de email existente
  // Primero determinamos que solo se ejecute la validación cuando tenemos la certeza de que se capturó un email
  if(isset($_POST['email']) && $correo != "") {
    $queryValidateEmail = sprintf("SELECT id FROM usuario WHERE correo = '%s'",
      mysqli_real_escape_string($connLocalhost, trim($correo))
    );

    // Ejecutamos el Query y obtenemos un recordset debido a que el query es de tipo SELECT
$resQueryValidateEmail = mysqli_query($connLocalhost, $queryValidateEmail) or trigger_error("error_msg");

// Contamos cuantos registros fueron devueltos por la consulta anterior, si obtenemos un numero distinto de 0 quiere decir que el correo ya está siendo utilizado
if(mysqli_num_rows($resQueryValidateEmail) != 0) {
  $error[] = "El correo esta en uso ..";
}
}



if(!isset($error)) {
  // Definimos el query a ejecutar
  $queryUsuarioAdd = sprintf("INSERT INTO usuario (nombre, correo, contraseña, telefono, perfil_usuario, edad)
  VALUES ( '%s', '%s', AES_ENCRYPT('%s','llave'), '%s','%s', '%s')",
      mysqli_real_escape_string($connLocalhost,trim($nombre)),
      mysqli_real_escape_string($connLocalhost,trim($correo)),
      mysqli_real_escape_string($connLocalhost,trim($contraseña)),
      mysqli_real_escape_string($connLocalhost,trim($telefono)),
      mysqli_real_escape_string($connLocalhost,trim($perfil_usuario)),
      mysqli_real_escape_string($connLocalhost,trim($edad))


  );


  $resQueryUsuario = mysqli_query($connLocalhost, $queryUsuarioAdd) or trigger_error("The propiety insert query failed...");

  if($resQueryUsuario) {

  }

}
};

//eMPIEZA LA CONSULTA ALA BASE DE DATOS PARA LISTAR LOS TIPOS DE USUARIOS

$queryGetUsuario = "SELECT id, nombre, correo, AES_DECRYPT(contraseña,'llave') AS contraseña, telefono, perfil_usuario, edad FROM usuario";
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
    <link rel="shortcut icon" href="favicon.ico" />


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


                   <?php if(isset($_GET['userUpdate']) ) {
                     if ($_GET['userUpdate']==true) {
                       // code...


                    ?>
                    <div class="alert alert-success alert-dismissible fade show">
                       <strong>Accion exitosa!</strong> Se ha modificado un usuario exitosamente.
                       <button type="button" class="close" data-dismiss="alert">&times;</button>
                   </div>
                   <?php }    } ?>


                   <?php if(isset($_GET['usrDelete']) ) {
                     if ($_GET['usrDelete']==true) {
                       // code...


                    ?>
                    <div class="alert alert-success alert-dismissible fade show">
                       <strong>Accion exitosa!</strong> Se ha Eliminado un usuario exitosamente.
                       <button type="button" class="close" data-dismiss="alert">&times;</button>
                   </div>
                   <?php }    } ?>

    <button button type="submit" data-toggle="modal" data-target="#registroUsuario" >Registrar usuario</button>
    <?php  include("includes/formatos/formatoRusuario.php"); ?>
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
        <th scope="col">contraseña</th>

        <th scope="col">Accion</th>



      </tr>
    </thead>
    <tbody>
      <?php do { ?>

      <tr>
        <td><?php echo $UsuarioDetails['id'] ?></td>
        <td><?php echo $UsuarioDetails['nombre'] ?></td>
        <td><?php echo $UsuarioDetails['correo'] ?></td>
        <td><?php echo $UsuarioDetails['telefono'] ?></td>
<?php
$valor = $UsuarioDetails['perfil_usuario'];
$queryGeTipotUsuario = "SELECT id, nombre FROM perfil_usuario WHERE id=$valor";
$resQueryGetTipoUsuario = mysqli_query($connLocalhost, $queryGeTipotUsuario) or trigger_error("There was an error getting the user data... please try again");

$totalUsuario = mysqli_num_rows($resQueryGetTipoUsuario);

$UsuarioTDetails = mysqli_fetch_assoc($resQueryGetTipoUsuario);
do {
 ?>

        <td><?php echo $UsuarioTDetails['nombre']; ?></td>

  <?php } while($UsuarioTDetails = mysqli_fetch_assoc($resQueryGetTipoUsuario)); ?>



        <td><?php echo $UsuarioDetails['edad'] ?></td>
        <td><?php echo $UsuarioDetails['contraseña'] ?></td>


        <form  method="GET" action="includes/formatos/formatoEliminarU.php" >
          <input type="hidden" name="usrId" value="<?php echo $UsuarioDetails['id'] ?>" />


          <td><input style="font-size: 12px;"type="submit" class="btn btn-danger" name="btneliminaUr" value="Eliminar" />


          </form>
          <form  method="GET" action="includes/formatos/formatoEditarU.php" >
            <input type="hidden" name="usrId" value="<?php echo $UsuarioDetails['id'] ?>" />


            <input type="submit" style="font-size: 12px; color: white; margin-inline-start:
            6px; margin-block-start: 4px;" class="btn btn-warning" name="btneditarU" value="Editar" />

</td>
            </form>

      </tr>

    </tbody>
  <?php } while($UsuarioDetails = mysqli_fetch_assoc($resQueryGetUsuario)); ?>

  </table>


  <?php include("includes/footerAdmi.php"); ?>



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
