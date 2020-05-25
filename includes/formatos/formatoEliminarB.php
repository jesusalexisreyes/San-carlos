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
  $queryBlogData = sprintf("SELECT * FROM blog WHERE id = %d",
    mysqli_real_escape_string($connLocalhost, trim($_GET['idb']))
  );

  // Ejecutamos el query
  $queryBlogData = mysqli_query($connLocalhost, $queryBlogData) or trigger_error("There was an error recovering the user data...");


  $blogDetails = mysqli_fetch_assoc($queryBlogData);

}


    if(isset($_POST['sent'])) {

      // Definimos el query a ejecutar
      $queryBlogDelete = "DELETE FROM blog WHERE id = ".$_POST['id'];



      // Ejecutamos el query y cachamos el resultado
      $resQueryBlogDelete = mysqli_query($connLocalhost, $queryBlogDelete) or trigger_error("The user update query failed...");

      // Redireccionamos al usuario si todo salio bien
      if($resQueryBlogDelete) {
        header("Location:  ../../blogAdmi.php?blogDelete=true");
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



      <?php if(isset($queryBlogUpdate)){
       ?>
       <div class="alert alert-success alert-dismissible fade show">
          <strong>Success!</strong> Se ha editado una propiedad exitosamente.
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
      <form action="formatoEliminarB.php" method="post" enctype="multipart/form-data">

        <div class="check-date">
            <br>
            <label for="room" >Titulo:</label>

            <input  type="text" readonly  name="titulo" value="<?php echo $blogDetails['titulo'] ?>" />
            <br>

          <label for="room"></label>
            <label for="room">Descripcion:</label>
            <input  type="text" readonly value="<?php echo $blogDetails['descripcion'] ?>"name="descripcion" />
              <br>



        </div>

          <div class="check-date">
              <label for="room" >Imagen:</label>
              <input type="file" hidden  class="form-control-file"  name="files[]" multiple >
              <p><strong>Nota:</strong>Al subir nuevas imagenes se borraran los anteriores</p>

              <?php

              $fullImg= $blogDetails['imagen'];
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

  <div class="check-date">

                <input type="submit" name="sent"  value="Eliminar" >
                <input type="text" name="id" value="<?php echo $blogDetails['id']; ?>" />

</div>

      </form>

    </div>
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
