

<?php
error_reporting(E_ALL ^ E_NOTICE);
include("conn/connLocalhost.php");
include("includes/utils.php");
if(isset($_POST['sent'])) {





  $nombre= $_REQUEST['nombre'];
  $descripcion = $_REQUEST['descripcion'];
  $crear= $_REQUEST['crear'];
  $editar = $_REQUEST['editar'];
  $eliminar= $_REQUEST['eliminar'];

if(!isset($error)) {
  // Definimos el query a ejecutar
  $querytipoAdd = sprintf("INSERT INTO perfil_usuario (nombre, descripcion, crear, editar, eliminar)
  VALUES ( '%s', '%s', '%s', '%s', '%s')",
      mysqli_real_escape_string($connLocalhost,trim($nombre)),
      mysqli_real_escape_string($connLocalhost,trim($descripcion)),
      mysqli_real_escape_string($connLocalhost,trim($crear)),
      mysqli_real_escape_string($connLocalhost,trim($editar)),
      mysqli_real_escape_string($connLocalhost,trim($eliminar))


  );


  $resQuerytipo = mysqli_query($connLocalhost, $querytipoAdd) or trigger_error("The propiety insert query failed...");

  if($resQuerytipo) {

  }

}
};

//eMPIEZA LA CONSULTA ALA BASE DE DATOS PARA LISTAR LOS TIPOS DE USUARIOS

$queryGetPerfil = "SELECT id, nombre, descripcion, crear, editar, eliminar FROM perfil_usuario";
$resQueryGetPerfil = mysqli_query($connLocalhost, $queryGetPerfil) or trigger_error("There was an error getting the user data... please try again");

$totalPerfil = mysqli_num_rows($resQueryGetPerfil);

$PerfilDetails = mysqli_fetch_assoc($resQueryGetPerfil);


 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

    <meta name="description" content="Sona Template">
    <meta name="keywords" content="Sona, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inmobilaria San carlos | Tipos usuario</title>


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
                            <h2>Lista de propiedades</h2>


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

         <?php if(isset($querytipoAdd)){
          ?>
          <div class="alert alert-success alert-dismissible fade show">
             <strong>Success!</strong> Se ha registrado un propiedad exitosamente.
             <button type="button" class="close" data-dismiss="alert">&times;</button>
         </div>
         <?php } ?>

                            <button button type="submit" data-toggle="modal" data-target="#registroblo" >Registrar tipo</button>
                        </div>
                    </div>
</div>


  <table class="table table-striped">



    <thead>
      <tr>

        <th scope="col">Id</th>
        <th scope="col">Nombre</th>
        <th scope="col">Descripcion</th>
        <th scope="col">Crear</th>
        <th scope="col">Editar</th>
        <th scope="col">Eliminar</th>


      </tr>
    </thead>
    <tbody>
      <?php do { ?>

      <tr>
        <td><?php echo $PerfilDetails['id'] ?></td>
        <td><?php echo $PerfilDetails['nombre'] ?></td>
        <td><?php echo $PerfilDetails['descripcion'] ?></td>
        <td><?php echo $PerfilDetails['crear'] ?></td>
        <td><?php echo $PerfilDetails['editar'] ?></td>
        <td><?php echo $PerfilDetails['eliminar'] ?></td>


      </tr>

    </tbody>
  <?php } while($PerfilDetails = mysqli_fetch_assoc($resQueryGetPerfil)); ?>

  </table>



  <?php  include("includes/formatos/formatoRtipo.php"); ?>


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
