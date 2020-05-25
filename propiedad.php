

<?php
include("conn/connLocalhost.php");




     if (isset($_GET['pageno'])) {
         $pageno = $_GET['pageno'];
     } else {
         $pageno = 1;
     }
     $no_of_records_per_page = 6;
     $offset = ($pageno-1) * $no_of_records_per_page;


     $total_pages_sql = "SELECT COUNT(*) FROM propiedad";
     $result = mysqli_query($connLocalhost,$total_pages_sql);
     $total_rows = mysqli_fetch_array($result)[0];
     $total_pages = ceil($total_rows / $no_of_records_per_page);






if(isset($_GET['btnenviarP']) ) {



$inicial =$_GET['precioInicial'];
$final=$_GET['precioFinal'];
$tipo='';
if($_GET['tipo']!=0){
  $tipo="AND tipo =".$_GET['tipo'];
}
  //Obteniendo propiedades
  $queryGetPropiedadAll = "SELECT id, colonia, numero, habitaciones, capacidad, baño, tipo, imagenes, descripcion, costo_dia, costo_semana, costo_mes FROM propiedad WHERE costo_dia >=$inicial  AND costo_dia <=$final $tipo ORDER BY colonia DESC LIMIT $offset, $no_of_records_per_page";
  $resQueryGetPropiedadAll = mysqli_query($connLocalhost, $queryGetPropiedadAll) or trigger_error("There was an error getting the user data... please try again");

  $totalPropiedadAll = mysqli_num_rows($resQueryGetPropiedadAll);

  $PropiedadDetailsAll = mysqli_fetch_assoc($resQueryGetPropiedadAll);

}

if(!isset($_GET['btnenviarP'])  ) {




//Obteniendo propiedades
$queryGetPropiedadAll = "SELECT id, colonia, numero, habitaciones, capacidad, baño, tipo, imagenes, descripcion, costo_dia, costo_semana, costo_mes FROM propiedad ORDER BY colonia DESC LIMIT $offset, $no_of_records_per_page";
$resQueryGetPropiedadAll = mysqli_query($connLocalhost, $queryGetPropiedadAll) or trigger_error("There was an error getting the user data... please try again");

$totalPropiedadAll = mysqli_num_rows($resQueryGetPropiedadAll);

$PropiedadDetailsAll = mysqli_fetch_assoc($resQueryGetPropiedadAll);

}

//Obteniendo propiedades
$queryGetPropiedad = "SELECT id, colonia, numero, habitaciones, capacidad, baño, tipo, imagenes, descripcion, costo_dia, costo_semana, costo_mes FROM propiedad ORDER BY colonia DESC LIMIT 4";
$resQueryGetPropiedad = mysqli_query($connLocalhost, $queryGetPropiedad) or trigger_error("There was an error getting the user data... please try again");

$totalPropiedad = mysqli_num_rows($resQueryGetPropiedad);

$PropiedadDetails = mysqli_fetch_assoc($resQueryGetPropiedad);


if (count($PropiedadDetailsAll) == 0 ) {


  header("Location: propiedad.php?prop=true");

}



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
    <link rel="shortcut icon" href="favicon.ico" />



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
          <?php if (isset($_GET['prop'])) {
        echo "    <div class='alert alert-warning' role='alert'>
    No existe propiedad con esos valores        </div>

";
          }?>
            <div class="row">


              <?php

               do {

                                       $fullImg= $PropiedadDetailsAll['imagenes'];
                                       $fullImgC= trim($fullImg, ',');

                                        $lisImg = explode(",", $fullImgC);

                  ?>
                 <div class="col-lg-4 col-md-6">
                     <div class="room-item">
                         <form action="propiedadDetalle.php" method="get">
                         <img style="width="200" height="300"" src="<?php echo $lisImg['0'];?>" alt="">
                         <div class="ri-text">
                             <h4><?php echo $PropiedadDetailsAll['colonia']." #".$PropiedadDetailsAll['numero']; ?></h4>
                             <h3> <?php echo $PropiedadDetailsAll['costo_dia'] ?> <span>/Por noche</span></h3>
                             <table>
                                 <tbody>
                                     <tr>
                                         <td class="r-o">Habitaciones:</td>
                                         <td><?php echo $PropiedadDetailsAll['habitaciones'] ?></td>
                                     </tr>
                                     <tr>
                                         <td class="r-o">Capacidad:</td>
                                         <td>Max: <?php echo $PropiedadDetailsAll['capacidad'] ?></td>
                                     </tr>
                                     <tr>
                                         <td class="r-o">Baño:</td>
                                         <td><?php echo $PropiedadDetailsAll['baño'] ?></td>
                                     </tr>
                                     <tr>
                                         <td class="r-o">Tipo:</td>
                                         <td><?php if($PropiedadDetailsAll['tipo']==1){
                                          echo "condominio";}
                                          if($PropiedadDetailsAll['tipo']==2){
                                           echo "Casa";}
                                           if($PropiedadDetailsAll['tipo']==3){
                                            echo "Departamento";}
                                           ?> </td>
                                     </tr>
                                 </tbody>
                             </table>
                             <input  type="hidden" name="id" value="<?php echo $PropiedadDetailsAll['id'] ?>">
                                 <button class="alert alert-warning" name="btnDetalle" type="submit">Ver Detalles</button>                         </div>
                               </form>

                     </div>
                 </div>

              <?php  } while($PropiedadDetailsAll = mysqli_fetch_assoc($resQueryGetPropiedadAll));
             ?>

            </div>
        </div>
        <nav aria-label="Page navigation example">

            <ul class="pagination justify-content-center">
                <li class="page-item"><a style="color:#dfa974;" class="page-link"href="?pageno=1">Primero</a></li>
                <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?> page-item">
                    <a style="color:#dfa974;" class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Anterior</a>
                </li class="page-item">
                <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?> page-item">
                    <a style="color:#dfa974;" class="page-link"  href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Siguiente</a>
                </li>
                <li class="page-item"><a style="color:#dfa974;" class="page-link" href="?pageno=<?php echo $total_pages; ?>">Ultimo</a></li>
            </ul>
          </nav>

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
                   do {   ?>



                    <div class="col-lg-3 col-md-6">

                      <?php

                      $fullImg= $PropiedadDetails['imagenes'];
                      $fullImgC= trim($fullImg, ',');

                       $lisImg = explode(",", $fullImgC);


?>

                        <div class="hp-room-item set-bg" data-setbg="<?php  echo $lisImg['0']; ?>"  >
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
