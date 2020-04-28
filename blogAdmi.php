


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

$queryGetBlog = "SELECT titulo, descripcion, imagen FROM blog";
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
    <title>Sona | Template</title>

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

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php } while($blogDetails = mysqli_fetch_assoc($resQueryGetBlog)); ?>




    <!-- Footer Section Begin -->
    <footer class="footer-section">
        <div class="container">
            <div class="footer-text">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="ft-about">
                            <div class="logo">
                                <a href="#">
                                    <img src="img/footer-logo.png" alt="">
                                </a>
                            </div>
                            <p>We inspire and reach millions of travelers<br /> across 90 local websites</p>
                            <div class="fa-social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-tripadvisor"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-youtube-play"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 offset-lg-1">
                        <div class="ft-contact">
                            <h6>Contact Us</h6>
                            <ul>
                                <li>(12) 345 67890</li>
                                <li>info.colorlib@gmail.com</li>
                                <li>856 Cordia Extension Apt. 356, Lake, United State</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 offset-lg-1">
                        <div class="ft-newslatter">
                            <h6>New latest</h6>
                            <p>Get the latest updates and offers.</p>
                            <form action="#" class="fn-form">
                                <input type="text" placeholder="Email">
                                <button type="submit"><i class="fa fa-send"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="copyright-option">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <ul>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Terms of use</a></li>
                            <li><a href="#">Privacy</a></li>
                            <li><a href="#">Environmental Policy</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-5">
                        <div class="co-text"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></div>
                    </div>
                </div>
            </div>
        </div>









    </footer>
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
