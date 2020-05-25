<?php

include("../../conn/connLocalhost.php");
include("../utils.php");
if (!isset($_SESSION)) {
    session_start();
    //session_destroy();



  if(!isset($_SESSION['usuarioId'])) header('Location: entrar.php?authError=true');
}



//if(is_numeric($_GET['idp'])) {

if(isset($_GET['btneliminar']) ) {


  // Recuperamos los datos del usuario en función del id del usuario que tiene sesión iniciada
  $queryPropiedadData = sprintf("SELECT * FROM propiedad WHERE id = %d",
    mysqli_real_escape_string($connLocalhost, trim($_GET['idp']))
  );

  // Ejecutamos el query
  $queryPropiedadData = mysqli_query($connLocalhost, $queryPropiedadData) or trigger_error("There was an error recovering the user data...");

  // Contamos el resultset
//  $validId = mysqli_num_rows($queryPropiedadData);

  // Evaluamos el conteo, si es 0 es id invalida
  //if(!$validId) $error[] = "The user id doesn't exist";

  // Hacemos un fetch de los resultados
  $propiedadDetails = mysqli_fetch_assoc($queryPropiedadData);
//}
//elseif(!isset($_POST['idp'])) {
  //$error[] = "La propiedad  es invalida.";
//}
// Checamos si existe el boton en POST para determinar si el formulario ha sido enviado
}
if(isset($_POST['sent'])) {
  // Obtenemos el password del admin para autorizar la actualizacion
// $queryAdminPassword = "SELECT password FROM users WHERE id = ".$_SESSION['usuario'];

  // Ejecutamos el query
  //$resQueryAdminPassword = mysqli_query($connLocalhost, $queryAdminPassword) or trigger_error("Admin password retrieval failed");

  // hacemos el fetch para recuperar el password a una variable que pueda manejar con PHP
  //$adminPassword = mysqli_fetch_assoc($resQueryAdminPassword);

  // Validacion de password proporcionado por el usuario par autorizar la actualizacion de datos contra el password en la BD
  //if($_POST['password'] != $adminPassword['password']) $error[] = "The password doesn't match";

  // Inserción del nuevo usuario en la base de datos, solamente se ejecutará cuando NO EXISTAN ERRORES

  if(!isset($error)) {
    // Definimos el query a ejecutar
    $queryPropiedadDelete = "DELETE FROM propiedad WHERE id = ".$_POST['id'];

    // Ejecutamos el query y cachamos el resultado
    $resQueryPropiedadDelete = mysqli_query($connLocalhost, $queryPropiedadDelete) or trigger_error("The user delete query failed...");

    // Redireccionamos al usuario si todo salio bien
    if($resQueryPropiedadDelete) {
      header("Location: ../../control.propiedad.php?userDelete=true");
    }
  }

}
 ?>


 <!DOCTYPE html>
 <html lang="zxx">
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
     <link rel="stylesheet" href="../../css/bootstrap.min.css" type="text/css">
     <link rel="stylesheet" href="../../css/font-awesome.min.css" type="text/css">
     <link rel="stylesheet" href="../../css/elegant-icons.css" type="text/css">
     <link rel="stylesheet" href="../../css/flaticon.css" type="text/css">
     <link rel="stylesheet" href="../../css/owl.carousel.min.css" type="text/css">
     <link rel="stylesheet" href="../../css/nice-select.css" type="text/css">
     <link rel="stylesheet" href="../../css/jquery-ui.min.css" type="text/css">
     <link rel="stylesheet" href="../../css/magnific-popup.css" type="text/css">
     <link rel="stylesheet" href="../../css/slicknav.min.css" type="text/css">
     <link rel="stylesheet" href="../../css/style.css" type="text/css">
     <link rel="shortcut icon" href="../../favicon.ico" />

     <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>




   </head>
   <body>

     <?php include("../../includes/headerAdmiM.php"); ?>



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
         <?php
           if(isset($error)) { ?>
               <div style="background: #F5A9A9;"class="alert alert-warning alert-dismissable">
         <?php
           printMsg($error, "error");
         echo "  </div>";}

         ?>



      <?php if(isset($queryPropiedadDelete)){
       ?>
       <div class="alert alert-success alert-dismissible fade show">
          <strong>Success!</strong> Se ha eliminado una propiedad exitosamente.
          <button type="button" class="close" data-dismiss="alert">&times;</button>
      </div>
      <?php } ?>





      <p><strong>Nota:</strong>Esta accion no se poodra deshacer <strong>Debe asegurarse de las acciones.</strong></p>



      <div class="form-row ">

      <?php
        if(isset($error)) printMsg($error, "error");
        if(isset($_GET['userUpdate'])) printMsg("The user was updated succesfully", "exito");

        if(!isset($error)) { ?>
          <div style="width: 60%;"class=" booking-form">

            <div class="blog-section">
                <div class="section-title">
                    <h2 style="font-size: 33px!important;">Comprobando datos</h2>


                    </div>
                </div>
<div class="">

</div>
      <form action="formatoEliminar.php" method="post">

        <div class="check-date">
            <br>
            <label for="room" >Colonia:</label>
            <input readonly type="hidden" required name="id" value="<?php echo $propiedadDetails['id'] ?>" />

            <input readonly type="text" required name="colonia" value="<?php echo $propiedadDetails['colonia'] ?>" />
            <br>

          <label for="room"></label>
            <label for="room">Numero:</label>
            <inputreadonly required type="text" value="<?php echo $propiedadDetails['numero'] ?>"name="numero" />
              <br>
            <label for="room" >Habitaciones:</label>
            <input readonly required type="number" value="<?php echo $propiedadDetails['habitaciones'] ?>" name="habitaciones"/>
              <br>
            <label for="room" >Capacidad:</label>
            <input readonly required type="number" value="<?php echo $propiedadDetails['capacidad'] ?>" name="capacidad"/>
              <br>
            <label for="room" >Baño:</label>
            <input readonly required type="number"name="baño" value="<?php echo $propiedadDetails['baño'] ?>" />
              <br>

        </div>
        <div class="check-date">

              <label for="guest" >Tipo:</label>
              <?php  if($propiedadDetails['tipo']==1){
              $i="condominio";}
              if($propiedadDetails['tipo']==2){
                $i="condominio";}
              if($propiedadDetails['tipo']==3){
                $i="condominio";} ?>

                <input readonly required type="text"name="baño" value="<?php echo $i ?>" />

          </div>
          <div class="check-date">
              <label for="room" >Imagen:</label>

              <?php
              $fullImg= $propiedadDetails['imagenes'];
              $fullImgC= trim($fullImg, ',');

               $lisImg = explode(",", $fullImgC);

                 foreach ($lisImg as $imagen=>$valor)
               		{
?>
<img src="<?php echo "../../".$valor; ?> " height="70" width="70">



<?php

               		}
                  ?>
                        <br>


            <label for="room"></label>
              <label for="room">Descripcion:</label>
              <textarea readonly style=" width: -webkit-fill-available;" required type="text" rows="4" cols="60" name="descripcion"> <?php echo $propiedadDetails['descripcion'] ?></textarea>
                <br>
              <label for="room" >Costo por dia:</label>
              <input readonly required name="costo_dia" type="text" value="<?php echo $propiedadDetails['costo_dia'] ?>" />
                <br>
              <label for="room" >Costo por semana:</label>
              <input readonly required name="costo_semana" type="text" value="<?php echo $propiedadDetails['costo_semana'] ?>" />
                <br>
              <label for="room" >Costo por mes:</label>
              <input readonly required name="costo_mes" type="text" value="<?php echo $propiedadDetails['costo_mes'] ?>" />
                <br>

                <input type="submit" name="sent"  value="Eliminar" >


      </form>

    </div>
  </div>


      <?php }?>







 <script src="../../js/jquery-3.3.1.min.js"></script>
 <script src="../../js/bootstrap.min.js"></script>
 <script src="../../js/jquery.magnific-popup.min.js"></script>
 <script src="../../js/jquery.nice-select.min.js"></script>
 <script src="../../js/jquery-ui.min.js"></script>
 <script src="../../js/jquery.slicknav.js"></script>
 <script src="../../js/owl.carousel.min.js"></script>
 <script src="../../js/main.js"></script>


 </body>
 </html>
