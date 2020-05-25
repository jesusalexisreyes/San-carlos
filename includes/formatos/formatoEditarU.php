<?php

include("../../conn/connLocalhost.php");
include("../utils.php");
if (!isset($_SESSION)) {
    session_start();
    //session_destroy();



  if(!isset($_SESSION['usuarioId'])) header('Location: entrar.php?authError=true');
}



//if(is_numeric($_GET['idp'])) {


$queryGetTipo = "SELECT id, nombre FROM perfil_usuario";
$resQueryGetTipo = mysqli_query($connLocalhost, $queryGetTipo) or trigger_error("There was an error getting the user data... please try again");

if(isset($_GET['btneditarU']) ) {


  // Recuperamos los datos del usuario en función del id del usuario que tiene sesión iniciada
  $queryBlogData = sprintf("SELECT id, nombre, correo, AES_DECRYPT(contraseña,'llave')AS contraseña, telefono, edad FROM usuario WHERE id = %d",
    mysqli_real_escape_string($connLocalhost, trim($_GET['usrId']))
  );

  // Ejecutamos el query
  $queryBlogData = mysqli_query($connLocalhost, $queryBlogData) or trigger_error("There was an error recovering the user data...");

  // Contamos el resultset
//  $validId = mysqli_num_rows($queryBlogData);

  // Evaluamos el conteo, si es 0 es id invalida
  //if(!$validId) $error[] = "The user id doesn't exist";

  // Hacemos un fetch de los resultados
  $UsrDetails = mysqli_fetch_assoc($queryBlogData);
//}
//elseif(!isset($_POST['idp'])) {
  //$error[] = "La propiedad  es invalida.";
//}
// Checamos si existe el boton en POST para determinar si el formulario ha sido enviado
}
if(isset($_POST['sent'])) {

  $nombre= $_REQUEST['nombre'];
  $correo = $_REQUEST['correo'];
  $contraseña = $_REQUEST['contraseña'];
  $telefono = $_REQUEST['telefono'];
  $perfil = $_REQUEST['perfil'];
  $edad = $_REQUEST['edad'];
  $usrId= $_REQUEST['usrId'];


foreach ($_POST as $calzon => $caca) {
  if($caca == "" ) $error[] = "The field $calzon is required";
}
    if(!isset($error)) {

      // Definimos el query a ejecutar
      $resQueryUsrUpdate = sprintf("UPDATE usuario SET nombre = '%s', correo = '%s', contraseña = AES_ENCRYPT('%s','llave'), telefono = '%s', perfil_usuario = '%s', edad = '%s' WHERE id = ".$usrId,
        mysqli_real_escape_string($connLocalhost,trim($nombre)),
        mysqli_real_escape_string($connLocalhost,trim($correo)),
        mysqli_real_escape_string($connLocalhost,trim($contraseña)),
        mysqli_real_escape_string($connLocalhost,trim($telefono)),
        mysqli_real_escape_string($connLocalhost,trim($perfil)),
        mysqli_real_escape_string($connLocalhost,trim($edad))

      );


      // Ejecutamos el query y cachamos el resultado
      $resQueryUsrUpdate = mysqli_query($connLocalhost, $resQueryUsrUpdate) or trigger_error("The user update query failed...");

      // Redireccionamos al usuario si todo salio bien
      if($resQueryUsrUpdate) {
        header("Location:  ../../controlUsuario.php?userUpdate=true");
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
                             <h2>Edicion de Blog</h2>


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



      <?php if(isset($resQueryUsrUpdate)){
       ?>
       <div class="alert alert-success alert-dismissible fade show">
          <strong>Success!</strong> Se ha editado un usuario exitosamente.
          <button type="button" class="close" data-dismiss="alert">&times;</button>
      </div>
      <?php } ?>





      <p><strong>Nota:</strong>Esta accion no se podra deshacer <strong>Debe asegurarse de las acciones.</strong></p>



      <div class="form-row ">


          <div style="width: 60%;"class=" booking-form">

            <div class="blog-section">
                <div class="section-title">
                    <h2 style="font-size: 33px!important;">Comprobando datos</h2>


                    </div>
                </div>
<div class="">

</div>
      <form action="formatoEditarU.php" method="post" enctype="multipart/form-data">

        <div class="check-date">
            <br>
            <label for="room" >Nombre:</label>

            <input  type="text"  name="nombre" value="<?php echo $UsrDetails['nombre'] ?>" />
            <br>

          <label for="room"></label>
            <label for="room">Correo:</label>
            <input  type="e-mail" value="<?php echo $UsrDetails['correo'] ?>"name="correo" />
              <br>



        </div>

          <div class="check-date">
              <label for="room">Contraseña:</label>
              <input  type="password" value="<?php echo $UsrDetails['contraseña'] ?>"name="contraseña" />
                <br>
                <label for="room">Contraseña:</label>
                <input  type="password" value="<?php echo $UsrDetails['contraseña'] ?>"name="contraseña2" />
                  <br>

                  <div class="form-grup" >
                    <label for="room">Tipo de usurio:</label>
                  <select name="perfil">
                    <?php while($TipoDetails = mysqli_fetch_assoc($resQueryGetTipo)) { ?>

                    <?php echo "<option value='$TipoDetails[id]'>$TipoDetails[nombre]</option>"?>
                    <?php }  ?>

                  </select>
                </div>
<br>

                <div class="check-date" >
                  <br>

                  <label for="room">Edad:</label>

                  <input  type="number" value="<?php echo $UsrDetails['edad'] ?>"name="edad" />
                    <br>
                    <div class="check-date" >
                      <br>

                      <label for="room">Telefono:</label>

                      <input  type="number" value="<?php echo $UsrDetails['telefono'] ?>"name="telefono" />
                        <br>

                      </div>



  <div class="check-date">

                <input type="submit" name="sent"  value="Editar" >
                <td><input type="hidden" name="usrId" value="<?php echo $_GET['usrId']; ?>" /></td>

</div>

      </form>

  </div>






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
