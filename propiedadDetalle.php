

<?php
include("conn/connLocalhost.php");







if(isset($_GET['btnDetalle']) ) {



$id =$_GET['id'];

  //Obteniendo propiedades
  $queryGetPropiedadAll = "SELECT id, colonia, numero, habitaciones, capacidad, baño, tipo, imagenes, descripcion, costo_dia, costo_semana, costo_mes, latitud, longitud FROM propiedad WHERE id=$id";
  $resQueryGetPropiedadAll = mysqli_query($connLocalhost, $queryGetPropiedadAll) or trigger_error("There was an error getting the user data... please try again");

  $totalPropiedadAll = mysqli_num_rows($resQueryGetPropiedadAll);

  $PropiedadDetailsAll = mysqli_fetch_assoc($resQueryGetPropiedadAll);

}


//Obteniendo propiedades
$queryGetPropiedad = "SELECT id, colonia, numero, habitaciones, capacidad, baño, tipo, imagenes, descripcion, costo_dia, costo_semana, costo_mes FROM propiedad ORDER BY colonia DESC LIMIT 4";
$resQueryGetPropiedad = mysqli_query($connLocalhost, $queryGetPropiedad) or trigger_error("There was an error getting the user data... please try again");

$totalPropiedad = mysqli_num_rows($resQueryGetPropiedad);

$PropiedadDetails = mysqli_fetch_assoc($resQueryGetPropiedad);






 ?>




<!DOCTYPE html>
<html lang="zxx">

<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

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
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


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
                <div class="col-lg-10">
                    <div class="hero-text">
                      <h2 id="titulo" style="font-size: 59px; padding: 5px;">Listado de propiedades</h2>
                      <br>
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
              <?php

               do {  ?>

                <div class="col-lg-8">

                    <div class="about-pic">
                        <div class="row">

                          <div id="demo" class="carousel slide" data-ride="carousel">

                            <!-- Indicators -->
                            <ul class="carousel-indicators">
                              <?php

                                          $fullImg= $PropiedadDetailsAll['imagenes'];
                                          $fullImgC= trim($fullImg, ',');

                                           $lisImg = explode(",", $fullImgC);
 $i=0;
                                           foreach ($lisImg as $imagen=>$valor)

                                              {   $valo="";
                            ?>
<?php if ($i==0) {
$valo ="active"; ?>
<?php }  ?>
<li data-target="#demo" data-slide-to="<?php echo $i; ?>" class="<?php echo $valo; ?>"></li>

<?php
$i++;


} ?>

                            </ul>

                            <!-- The slideshow -->
                            <div class="carousel-inner">



                            <?php


                                        $fullImg= $PropiedadDetailsAll['imagenes'];
                                        $fullImgC= trim($fullImg, ',');

                                         $lisImg = explode(",", $fullImgC);
                                         $i=0;
                                           foreach ($lisImg as $imagen=>$valor)
                                            { $valo="";

                          ?>
                          <?php if ($i==0) {
                          $valo ="active"; } ?>

                          <div class="carousel-item <?php echo $valo; ?>" >
                            <img src="<?php echo $valor; ?>" alt="Chicago" width="1100" height="500">
                          </div>
                          <a class="carousel-control-prev" href="#demo" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                          </a>
                          <a class="carousel-control-next" href="#demo" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                          </a>


                        <?php
                        $i++;
?>

<!-- Left and right controls -->


                                                 <?php


    }

                                                            ?>

                            </div>

                            <div class="check-date">
                        <label  class="text-monospace" for="date-in"> <h4 style="color:#dfa974; padding-top: 10px;;">Descripcion: </h4><P><strong><?php echo $PropiedadDetailsAll['descripcion'] ?></strong></strong> </P> </label>
                          </div>

<div class="section-title">
  <span style="font-size:23px; ">Ubicacion</span>
</div>

                          <!-- Mostraremos el mapa -->
                          <input  hidden name= "latitud" id="latitud" value="<?php echo $PropiedadDetailsAll['latitud'] ?>"  />
                          <input  hidden ame ="longitud" id="longitud"value="<?php echo $PropiedadDetailsAll['longitud'] ?>"  />


                                          <div class="map" id="map">

                                          </div>




                          </div>

                        </div>



                    </div>
                </div>
                <div class="col-lg-4">
                        <div style="margin-bottom: -2px;" class="section-title">
                            <span><?php echo $PropiedadDetailsAll['colonia']." #".$PropiedadDetailsAll['numero']; ?></span>

                        </div>
                        <div class="booking-form">
                            <form action="propiedaddetalles.php" method="get">
                                <div class="check-date">
                                    <label for="date-in">Habitaciones: <P><strong><?php echo $PropiedadDetailsAll['habitaciones'] ?></strong></strong> </P> </label>
                                </div>
                                <div class="check-date">
                                    <label for="date-out">Capacidad:<P><strong><?php echo $PropiedadDetailsAll['capacidad'] ?></strong></strong> </P> </label>
                                </div>
                                <div  class="select-option">
                                    <label for="guest">Baño: <P><strong><?php echo $PropiedadDetailsAll['baño'] ?></strong></strong> </P></label>

                                </div>
                                <div class="check-date">
                                    <label for="room">tipo:<P><strong><?php echo $PropiedadDetailsAll['tipo'] ?></strong></strong> </P></label>


                                  <label for="room"></label>


                                </div>

                                <div class="check-date">
                                    <label for="date-out">Costo por noche : <P><strong><?php echo $PropiedadDetailsAll['costo_dia'] ?></strong></strong> </P></label>
                                </div>
                                <div class="check-date">
                                    <label for="date-in">Costo por semana: <P><strong><?php echo $PropiedadDetailsAll['costo_semana'] ?></strong></strong> </P></label>
                                </div>
                                <div class="check-date">
                                    <label for="date-out">Costo por mes: <P><strong><?php echo $PropiedadDetailsAll['costo_mes'] ?></strong></strong> </P></label>
                                </div>

                            </form>
                        </div>
                </div>



                <div  style="padding: 10px;" class="col-lg-12">

                </div>





                    <script>


                    var marker;          //variable del marcador
                    var coords = {};    //coordenadas obtenidas con la geolocalización





                    function setMapa (coords)
                    {
                         coords = {lng: <?php echo $PropiedadDetailsAll['longitud'] ?>,
                        lat: <?php echo $PropiedadDetailsAll['latitud'] ?>};

                      //Se crea una nueva instancia del objeto mapa
                      var map = new google.maps.Map(document.getElementById('map'),
                      {
                        zoom: 13,
                        center:new google.maps.LatLng(coords.lat,coords.lng),

                      });

                      //Creamos el marcador en el mapa con sus propiedades
                      //para nuestro obetivo tenemos que poner el atributo draggable en true
                      //position pondremos las mismas coordenas que obtuvimos en la geolocalización
                      marker = new google.maps.Marker({
                        map: map,
                        draggable: true,
                        animation: google.maps.Animation.DROP,
                        position: new google.maps.LatLng(coords.lat,coords.lng),

                      });
                      //agregamos un evento al marcador junto con la funcion callback al igual que el evento dragend que indica
                      //cuando el usuario a soltado el marcador
                      marker.addListener('click', toggleBounce);

                      marker.addListener( 'dragend', function (event)
                      {
                        //escribimos las coordenadas de la posicion actual del marcador dentro del input #coords
                        document.getElementById("latitud").value = this.getPosition().lat();
                        document.getElementById("longitud").value= this.getPosition().lng();
                      });
                    }

                    //callback al hacer clic en el marcador lo que hace es quitar y poner la animacion BOUNCE
                    function toggleBounce() {
                    if (marker.getAnimation() !== null) {
                    marker.setAnimation(null);
                    } else {
                    marker.setAnimation(google.maps.Animation.BOUNCE);
                    }
                    }

                    // Carga de la libreria de google maps

                    </script>


              <?php } while($PropiedadDetailsAll = mysqli_fetch_assoc($resQueryGetPropiedadAll)); ?>

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

                        <div class="hp-room-item set-bg" data-setbg="<?php  echo $lisImg['0']; ?>"  style=" background-image: url(<?php  echo $lisImg['0']; ?>);" >
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
                                            <td class="r-o">Capacidad:</td>
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


      <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-_zF4mtTkrsoTOFUR9zfRJpPlVXPUoE0&callback=setMapa" type="text/javascript"></script>







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
