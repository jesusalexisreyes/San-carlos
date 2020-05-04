



<?php
include("conn/connLocalhost.php");
include("includes/utils.php");
if(isset($_POST['sent'])) {

  // Validacion de cajas vacias
  foreach ($_POST as $calzon => $caca) {
    if($caca == "" && $calzon != "nombre") $error[] = "El campo $calzon es obligatorio";
  }
  $colonia= $_REQUEST['colonia'];
  $numero = $_REQUEST['numero'];
  $habitaciones= $_REQUEST['habitaciones'];
  $capacidad = $_REQUEST['capacidad'];
  $baño= $_REQUEST['baño'];
  $tipo = $_REQUEST['tipo'];
  $descripcion = $_REQUEST['descripcion'];
  $costo_dia= $_REQUEST['costo_dia'];
  $costo_semana= $_REQUEST['costo_semana'];
  $costo_mes = $_REQUEST['costo_mes'];
  $latitud= $_REQUEST['latitud'];
  $longitud= $_REQUEST['longitud'];


for ($i=0; $i <count($_FILES["files"]["name"]); $i++) {
  // code...

  $nombreimg=$_FILES['files']['name'][$i];
  $archivo=$_FILES['files']['tmp_name'][$i];

  $ruta="images";
  echo "string";

  $ruta =$ruta."/".$nombreimg;
  move_uploaded_file($archivo,$ruta);

  $conjuntorutas .=$ruta;
  $conjuntorutas .=",";
}

if(!isset($error)) {
  // Definimos el query a ejecutar
  $querypropiedadAdd = sprintf("INSERT INTO propiedad (colonia, numero, habitaciones, capacidad, baño, tipo,
    imagenes, descripcion, costo_dia, costo_semana, costo_mes, latitud, longitud)
  VALUES ( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
      mysqli_real_escape_string($connLocalhost,trim($colonia)),
      mysqli_real_escape_string($connLocalhost,trim($numero)),
      mysqli_real_escape_string($connLocalhost,trim($habitaciones)),
      mysqli_real_escape_string($connLocalhost,trim($capacidad)),
      mysqli_real_escape_string($connLocalhost,trim($baño)),
      mysqli_real_escape_string($connLocalhost,trim($tipo)),
      mysqli_real_escape_string($connLocalhost,trim($conjuntorutas)),
      mysqli_real_escape_string($connLocalhost,trim($descripcion)),
      mysqli_real_escape_string($connLocalhost,trim($costo_dia)),
      mysqli_real_escape_string($connLocalhost,trim($costo_semana)),
      mysqli_real_escape_string($connLocalhost,trim($costo_mes)),
      mysqli_real_escape_string($connLocalhost,trim($latitud)),
      mysqli_real_escape_string($connLocalhost,trim($longitud))

  );


  $resQuerypropiedad = mysqli_query($connLocalhost, $querypropiedadAdd) or trigger_error("The propiety insert query failed...");

  if($resQuerypropiedad) {

  }

}
}

$queryGetPropiedad = "SELECT colonia, numero, habitaciones, capacidad, baño, tipo, descripcion, costo_dia, costo_semana, costo_mes FROM propiedad";
$resQueryGetPropiedad = mysqli_query($connLocalhost, $queryGetPropiedad) or trigger_error("There was an error getting the user data... please try again");

$totalPropiedad = mysqli_num_rows($resQueryGetPropiedad);

$PropiedadDetails = mysqli_fetch_assoc($resQueryGetPropiedad);


?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

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

     <?php if(isset($querypropiedadAdd)){
      ?>
      <div class="alert alert-success alert-dismissible fade show">
         <strong>Success!</strong> Se ha registrado un propiedad exitosamente.
         <button type="button" class="close" data-dismiss="alert">&times;</button>
     </div>
     <?php } ?>

  <button button type="submit" data-toggle="modal" data-target="#mensaje_iniciars" >REGISTRAR</button>



  <table class="table table-striped">



    <thead>
      <tr>

        <th scope="col">colonia</th>
        <th scope="col">numero</th>
        <th scope="col">habitaciones</th>
        <th scope="col">Baño</th>
        <th scope="col">Tipo</th>
        <th scope="col">Descripcion</th>
        <th scope="col">Costo x dia</th>
        <th scope="col">Costo x semana</th>
        <th scope="col">Costo x mes</th>
        <th scope="col">Accion</th>

      </tr>
    </thead>
    <tbody>
      <?php do { ?>

      <tr>
        <td><?php echo $PropiedadDetails['colonia'] ?></td>
        <td><?php echo $PropiedadDetails['numero'] ?></td>
        <td><?php echo $PropiedadDetails['habitaciones'] ?></td>
        <td><?php echo $PropiedadDetails['baño'] ?></td>
        <td><?php echo $PropiedadDetails['tipo'] ?></td>
        <td><?php echo $PropiedadDetails['descripcion'] ?></td>
        <td><?php echo $PropiedadDetails['costo_dia'] ?></td>
        <td><?php echo $PropiedadDetails['costo_semana'] ?></td>
        <td><?php echo $PropiedadDetails['costo_mes'] ?></td>

        <td><?php echo $PropiedadDetails['costo_mes'] ?></td>

      </tr>

    </tbody>
  <?php } while($PropiedadDetails = mysqli_fetch_assoc($resQueryGetPropiedad)); ?>

  </table>




    <?php include("includes/formatos/formatoRpropiedad.php"); ?>

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
