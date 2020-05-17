



<?php
include("conn/connLocalhost.php");
include("includes/utils.php");

if(!isset($_GET['userDelete'])) {
$accionE=false;}
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

  $conjuntorutas="";

for ($i=0; $i <count($_FILES["files"]["name"]); $i++) {
  // code...

  $nombreimg=$_FILES['files']['name'][$i];
  $archivo=$_FILES['files']['tmp_name'][$i];

  $ruta="images";

  $ruta =$ruta."/".$nombreimg;
  move_uploaded_file($archivo,$ruta);
  $conjuntorutas .=$ruta.",";

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

$queryGetPropiedad = "SELECT id, colonia, numero, habitaciones, capacidad, baño, tipo, descripcion, costo_dia, costo_semana, costo_mes FROM propiedad ORDER BY colonia DESC";
$resQueryGetPropiedad = mysqli_query($connLocalhost, $queryGetPropiedad) or trigger_error("There was an error getting the user data... please try again");

$totalPropiedad = mysqli_num_rows($resQueryGetPropiedad);

$PropiedadDetails = mysqli_fetch_assoc($resQueryGetPropiedad);


?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>




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


          <?php if(isset($_GET['userDelete']) ) {
            if ($_GET['userDelete']==true) {
              // code...


           ?>
           <div class="alert alert-success alert-dismissible fade show">
              <strong>Accion exitosa!</strong> Se ha eliminado una propiedad exitosamente.
              <button type="button" class="close" data-dismiss="alert">&times;</button>
          </div>
          <?php }    } ?>

  <button button type="submit" id="submit"data-toggle="modal" data-target="#formatoRpropiedades" >REGISTRAR</button>

<div class="table-striped table-responsive table-sm ">


  <table  class="table table-striped breadcrumb-section">



    <thead>
      <tr>

        <th scope="col">colonia</th>
        <th scope="col">numero</th>
        <th scope="col">habitaciones</th>
        <th scope="col">Baño</th>
        <th scope="col">Tipo</th>
        <th id= "anchuraDesc" scope="col">Descripcion</th>
        <th scope="col">Costo x dia</th>
        <th scope="col">Costo x semana</th>
        <th scope="col">Costo x mes</th>
        <th style="padding-inline-start: 22px" scope="col">  &nbsp;&nbsp; &nbsp;&nbsp; Accion</th>

      </tr>
    </thead>
    <tbody>
      <?php
       do { ?>

      <tr>
        <td><?php echo $PropiedadDetails['colonia'] ?></td>
        <td><?php echo $PropiedadDetails['numero'] ?></td>
        <td><?php echo $PropiedadDetails['habitaciones'] ?></td>
        <td><?php echo $PropiedadDetails['baño'] ?></td>
        <td><?php echo $PropiedadDetails['tipo'] ?></td>
        <td ><?php echo $PropiedadDetails['descripcion'] ?></td>
        <td><?php echo $PropiedadDetails['costo_dia'] ?></td>
        <td><?php echo $PropiedadDetails['costo_semana'] ?></td>
        <td><?php echo $PropiedadDetails['costo_mes'] ?></td>

        <form  method="GET" action="includes/formatos/formatoEliminar.php" enctype="multipart/form-data" >
          <input type="hidden" name="idp" value="<?php echo $PropiedadDetails['id'] ?>" />


          <input type ="hidden" name="tabla"  value=" <?php echo 'propiedad' ?>"/>
          <td><input style="font-size: 12px;"type="submit" class="btn btn-danger" name="btneliminar" value="Eliminar" />


          </form>
          <form  method="GET" action="includes/formatos/formatoEditarP.php" enctype="multipart/form-data" >
            <input type="hidden" name="idp" value="<?php echo $PropiedadDetails['id'] ?>" />


            <input type ="hidden" name="tabla"  value=" <?php echo 'propiedad' ?>"/>
            <input type="submit" style="font-size: 12px; color: white; margin-inline-start:
            6px; margin-block-start: 4px;" class="btn btn-warning" name="btneditarP" value="Editar" />

</td>
            </form>
      </tr>

    </tbody>
  <?php } while($PropiedadDetails = mysqli_fetch_assoc($resQueryGetPropiedad)); ?>

  </table>



</div>


    <?php include("includes/formatos/formatoRpropiedad.php"); ?>
    <?php if (isset($idproducto)){ ?>
      <script> $("#valorP").trigger("click");</script>







    <?php } ?>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/jquery.slicknav.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>


</body>
</html>
