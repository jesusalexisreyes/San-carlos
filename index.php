
<?php

include("conn/connLocalhost.php");







//Obteniendo propiedades
$queryGetPropiedad = "SELECT id, colonia, numero, habitaciones, capacidad, baño, tipo, imagenes, descripcion, costo_dia, costo_semana, costo_mes FROM propiedad ORDER BY colonia DESC LIMIT 4";
$resQueryGetPropiedad = mysqli_query($connLocalhost, $queryGetPropiedad) or trigger_error("There was an error getting the user data... please try again");

$totalPropiedad = mysqli_num_rows($resQueryGetPropiedad);

$PropiedadDetails = mysqli_fetch_assoc($resQueryGetPropiedad);

//Sacar articulos del blog
$queryGetBlog = "SELECT id, titulo, descripcion, imagen FROM blog ORDER BY id DESC LIMIT 3";
$resQueryGetBlog = mysqli_query($connLocalhost, $queryGetBlog) or trigger_error("There was an error getting the user data... please try again");

$totalBlog = mysqli_num_rows($resQueryGetBlog);

$BlogDetails = mysqli_fetch_assoc($resQueryGetBlog);


 ?>


<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
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
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Section Begin -->
<?php include("includes/off-canvas.php"); ?>

    <!-- Offcanvas Menu Section End -->

    <!-- Header Section Begin -->
    <?php include("includes/header.php"); ?>

    <!-- Header End -->

    <!-- Hero Section Begin -->
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="hero-text">
                      <h2 id="titulo" style="font-size: 59px; padding: 5px;">Inmobiliaria san carlos</h2>
                      <br>
                      <div class="contenedor">
<ul>
      <li>Maravillosos paisajes</li>

      <li>Playas hermosas</li>

				      <li>Paseos en yates</li>
			    </ul>
		</div>
                        <h3>La mejor opcion para tus vacaciones.</h3>
                        <a href="#" class="primary-btn">Descubre tu destino</a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 offset-xl-2 offset-lg-1">
                    <div class="booking-form">
                        <h3>Haz tu reservacion</h3>
                        <form action="propiedad.php" method="get">
                            <div class="check-date">
                                <label for="date-in">Entrada:</label>
                                <input type="text" class="date-input" id="date-in" >
                                <i class="icon_calendar" ></i>
                            </div>
                            <div class="check-date">
                                <label for="date-out">Salida:</label>
                                <input type="text" class="date-input" id="date-out">
                                <i class="icon_calendar"></i>
                            </div>
                            <div class="select-option">
                                <label for="guest">Tipo:</label>
                                <select name="tipo" id="guest">
                                    <option value="1">Condominio</option>
                                    <option value="2">Casa</option>
                                    <option value="3">Departamento</option>
                                    <option value="0">Todos</option>


                                </select>
                            </div>
                            <div class="check-date">
                                <label for="room">Precio:</label>

                                <input name="precioInicial" min="500" required type="number" placeholder="desde $500" />

                              <label for="room"></label>

                                <input name="precioFinal" min="501" required type="number" placeholder="hasta $1000" />

                            </div>
                            <button name="btnenviarP" type="submit">Ver disponibilidad</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-slider owl-carousel">
            <div class="hs-item set-bg" data-setbg="img/hero/1.jpg"></div>
            <div class="hs-item set-bg" data-setbg="img/hero/2.jpg"></div>
            <div class="hs-item set-bg" data-setbg="img/hero/3.jpg"></div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- About Us Section Begin -->
    <section class="aboutus-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-text">
                        <div class="section-title">
                            <span>Visitanos</span>
                            <h2>Has tu recervacion <br />con nosotros</h2>
                        </div>
                        <p class="f-para">San carlos donde encuentras hermosas vistas naturales </p>
                        <p class="s-para">Es un perfecto lugar para descanzar, cuenta con un sin fin de actividades de recreacion
                          paseos en motos kayaks deliciosos restaurantes.</p>
                        <a href="#" class="primary-btn about-btn">Ver mas</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-pic">
                        <div class="row">
                            <div class="col-sm-6">
                                <img src="img/vistas/tetekawi.jpg" style="width: 330px; height: 468px;" alt="">
                            </div>
                            <div class="col-sm-6">
                                <img src="img/vistas/playa.jpg" style="width: 330px; height: 468px;" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Us Section End -->

    <!-- Services Section End -->
    <section class="services-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span> En el paraiso</span>
                        <h2>¡Escoje donde disfrutarlo!</h2>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- Services Section End -->

    <!-- Home Room Section Begin -->
    <section class="hp-room-section">
        <div class="container-fluid">
            <div class="hp-room-items">
                <div class="row">


                  <?php
                   do {  ?>



                    <div class="col-lg-3 col-md-6">

                      <?php

                      $fullImg= $PropiedadDetails['imagenes'];
                      $fullImgC= trim($fullImg, ',');

                       $lisImg = explode(",", $fullImgC);

?>

                        <div class="hp-room-item set-bg" data-setbg="<?php  print_r($lisImg['0']); ?>">
                            <div class="hr-text">
                                <h3><?php echo $PropiedadDetails['colonia']." #".$PropiedadDetails['numero'] ?></h3>
                                <h2>$ <?php echo $PropiedadDetails['costo_dia'] ?><span>/Por noche</span></h2>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="r-o">Habitaciones:</td>
                                            <td> <?php echo $PropiedadDetails['habitaciones'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Baño:</td>
                                            <td> <?php echo $PropiedadDetails['baño'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Bed:</td>
                                            <td> <?php echo $PropiedadDetails['capacidad'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Tipo:</td>
                                            <td><?php if($PropiedadDetails['tipo']==1){
                                             echo "condominio";}
                                             if($PropiedadDetails['tipo']==2){
                                              echo "Casa";}
                                              if($PropiedadDetails['tipo']==3){
                                               echo "Departamento";}
                                              ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a href="propiedadDetalle.php?id=<?php echo $PropiedadDetails['id'] ?>&btnDetalle=" class="primary-btn">Mas Detalles</a>
                            </div>
                        </div>
                    </div>

                  <?php } while($PropiedadDetails = mysqli_fetch_assoc($resQueryGetPropiedad)); ?>






                </div>
            </div>
        </div>
    </section>
    <!-- Home Room Section End -->


    <!-- Testimonial Section End -->

    <!-- Blog Section Begin -->
    <section class="blog-section spad">
        <div class="container">
          <!-- Aqui empiezan los bloques de abajo -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Pasar el tiempo</span>
                        <h2>¿Como disfrutar San Carlos?</h2>
                    </div>
                </div>
            </div>
            <div class="row">

                                <?php
                                 do {  ?>
                <div class="col-lg-4">
                    <div class="blog-item set-bg" data-setbg="<?php echo $BlogDetails['imagen']; ?>">
                        <div class="bi-text">
                            <h4><a href="blog.php"><?php echo $BlogDetails['titulo'];?></a></h4>
                        </div>
                    </div>
                </div>
              <?php } while($BlogDetails = mysqli_fetch_assoc($resQueryGetBlog)); ?>

            </div>
        </div>
    </section>
    <!-- Blog Section End -->

    <!-- Footer Section Begin -->
    <?php include("includes/footer.php"); ?>

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
</body>

</html>
