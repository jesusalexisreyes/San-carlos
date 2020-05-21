


<?php
include("conn/connLocalhost.php");
include("includes/utils.php");
if(isset($_POST['sent'])) {

  // Validacion de cajas vacias
  foreach ($_POST as $calzon => $caca) {
    if($caca == "" && $calzon != "titulo") $error[] = "El campo $calzon es obligatorio";
  }

$titulo= $_REQUEST['titulo'];
$descripcion = $_REQUEST['descripcion'];
$nombreimg=$_FILES['imagen']['name'];
$archivo=$_FILES['imagen']['tmp_name'];
$ruta="images";

$ruta =$ruta."/".$nombreimg;
move_uploaded_file($archivo,$ruta);

if(!isset($error)) {
  // Definimos el query a ejecutar
  $queryblogAdd = sprintf("INSERT INTO blog (titulo, descripcion, imagen) VALUES ( '%s', '%s', '%s')",
      mysqli_real_escape_string($connLocalhost,trim($titulo)),
      mysqli_real_escape_string($connLocalhost,trim($descripcion)),
      mysqli_real_escape_string($connLocalhost,trim($ruta))

  );


  $resQueryblog = mysqli_query($connLocalhost, $queryblogAdd) or trigger_error("The user insert query failed...");

  if($resQueryblog) {

  }

}
}

//Empezamos a procesar la informacionde la base de datos de el blog

$queryGetBlog = "SELECT id, titulo, descripcion, imagen FROM blog ORDER BY id DESC";
$resQueryGetBlog = mysqli_query($connLocalhost, $queryGetBlog) or trigger_error("There was an error getting the user data... please try again");

$totalBlog = mysqli_num_rows($resQueryGetBlog);

$blogDetails = mysqli_fetch_assoc($resQueryGetBlog);




?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Sona Template">
    <meta name="keywords" content="Sona, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inmobiliaria San Carlos | Blog</title>

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
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script>
    $(document).ready(function() {
        $(".upload").on('click', function() {
            var formData = new FormData();
            var files = $('#image')[0].files[0];
            formData.append('file',files);
            $.ajax({
                url: 'subir.php',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response != 0) {
                        $(".card-img-top").attr("src", response);
                    } else {
    					alert('Formato de imagen incorrecto.');
    				}
                }
            });
    		return false;
        });
    });
    </script>
</head>



<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>


<?php include("includes/headerAdmi.php"); ?>
    <!-- Contact Section Begin -->
    <section class="contact-section spad">
      <?php if(isset($_GET['blogUpdate']) ) {
        if ($_GET['blogUpdate']==true) {
          // code...


       ?>
       <div class="alert alert-success alert-dismissible fade show">
          <strong>Accion exitosa!</strong> Se ha Editado una propiedad exitosamente.
          <button type="button" class="close" data-dismiss="alert">&times;</button>
      </div>
      <?php }    } ?>

        <div class="container">
            <div class="row">

              <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12" style=" position: relative; left: 169px;">

                        <div class="row">


                                <button button type="submit" data-toggle="modal" data-target="#registroblog" >registrar blog</button>
                                <?php  include("includes/formatos/formatoRblog.php"); ?>
                            </div>
                        </div>
  </div>
            </div>


            <div class="row">





  </div><!-- end row -->




    </section>
    <!-- Contact Section End -->




<!-- Seccion donde se coloca la informacion automaticamente de la base de datos -->


       <?php do { ?>

        <section class="aboutus-section spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="about-text">
                            <div class="section-title">
                                <h2><?php echo $blogDetails['titulo']  ?></h2>
                            </div>
                            <p class="s-para"><?php echo $blogDetails['descripcion'] ?></p>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-pic">
                            <div class="row">
                                    <img src="<?php echo $blogDetails['imagen']  ?>" style="width: 600px; height: 468px; border-radius: 5px;" alt="">

                                    <form style="padding: 10px;" method="GET" action="includes/formatos/formatoEliminarB.php" enctype="multipart/form-data" >
                                      <input type="hidden" name="idb" value="<?php echo $blogDetails['id'] ?>" />


                                      <input type="submit" class="btn btn-danger" name="btneliminar" value="Eliminar" />


                                      </form>
                                      <form style="padding: 10px;"  method="GET" action="includes/formatos/formatoEditarB.php" enctype="multipart/form-data" >
                                        <input type="hidden" name="idb" value="<?php echo $blogDetails['id'] ?>" />


                                        <input type ="hidden" name="tabla"  value=" <?php echo 'blog' ?>"/>
                                        <input type="submit"  class="btn btn-warning" name="btneditarB" value="Editar" />

                                        </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php } while($blogDetails = mysqli_fetch_assoc($resQueryGetBlog)); ?>




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
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


</body>
