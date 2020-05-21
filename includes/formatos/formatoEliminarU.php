<?php

include("../../conn/connLocalhost.php");
include("../utils.php");




//if(is_numeric($_GET['idp'])) {


$queryGetTipo = "SELECT id, nombre FROM perfil_usuario";
$resQueryGetTipo = mysqli_query($connLocalhost, $queryGetTipo) or trigger_error("There was an error getting the user data... please try again");

if(isset($_GET['btneliminaUr']) ) {


  $queryBlogData = sprintf("SELECT * FROM usuario WHERE id = %d",
    mysqli_real_escape_string($connLocalhost, trim($_GET['usrId']))
  );

  // Ejecutamos el query
  $queryBlogData = mysqli_query($connLocalhost, $queryBlogData) or trigger_error("There was an error recovering the user data...");


  $blogDetails = mysqli_fetch_assoc($queryBlogData);






}




if(isset($_POST['sent'])) {

  // Definimos el query a ejecutar
  $queryUsrDelete = "DELETE FROM usuario WHERE id = ".$_POST['usrId'];



  // Ejecutamos el query y cachamos el resultado
  $resQueryBlogDelete = mysqli_query($connLocalhost, $queryUsrDelete) or trigger_error("The user update query failed...");

  // Redireccionamos al usuario si todo salio bien
  if($resQueryBlogDelete) {
    header("Location:  ../../controlUsuario.php?usrDelete=true");
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
          <strong>Success!</strong> Se ha eliminado un usuario exitosamente.
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
      <form action="formatoEliminarU.php" method="post" enctype="multipart/form-data">

        <div class="check-date">
            <br>
            <label for="room" >Nombre:</label>

            <input  type="text" readonly name="nombre" value="<?php echo $blogDetails['nombre'] ?>" />
            <br>

          <label for="room"></label>
            <label for="room">Correo:</label>
            <input readonly  type="e-mail" value="<?php echo $blogDetails['correo'] ?>"name="correo" />
              <br>



        </div>



                  <div class="form-grup" >
                    <label for="room">Tipo de usurio:</label>
                    <br>
                  <select name="perfil">
<?php
                    $valor = $blogDetails['perfil_usuario'];
                    $queryGeTipotUsuario = "SELECT id, nombre FROM perfil_usuario WHERE id=$valor";
                    $resQueryGetTipoUsuario = mysqli_query($connLocalhost, $queryGeTipotUsuario) or trigger_error("There was an error getting the user data... please try again");

                    $totalUsuario = mysqli_num_rows($resQueryGetTipoUsuario);

                    $UsuarioTDetails = mysqli_fetch_assoc($resQueryGetTipoUsuario);
                    do {
                     ?>
                     <?php echo "<option value='$UsuarioTDetails[id]'>$UsuarioTDetails[nombre]</option>"?>



                      <?php } while($UsuarioTDetails = mysqli_fetch_assoc($resQueryGetTipoUsuario)); ?>

                  </select>
                </div>
<br>

                <div class="check-date" >
                  <br>

                  <label for="room">Edad:</label>

                  <input readonly  type="number" value="<?php echo $blogDetails['edad'] ?>"name="edad" />
                    <br>
                    <div class="check-date" >
                      <br>

                      <label for="room">Telefono:</label>

                      <input  readonly type="number" value="<?php echo $blogDetails['telefono'] ?>"name="telefono" />
                        <br>

                      </div>



  <div class="check-date">

                <input type="submit" name="sent"  value="Eliminar" >
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
