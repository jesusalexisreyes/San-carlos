<?php

include("../../conn/connLocalhost.php");
include("../utils.php");
if (!isset($_SESSION)) {
    session_start();
    //session_destroy();



  if(!isset($_SESSION['usuarioId'])) header('Location: entrar.php?authError=true');
}



//if(is_numeric($_GET['idp'])) {

if(isset($_GET['btneditarP']) ) {


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
  $propId= $_REQUEST['prop'];

  $conjuntorutas="";

for ($i=0; $i <count($_FILES["files"]["name"]); $i++) {
  // code...

  $nombreimg=$_FILES['files']['name'][$i];
  $archivo=$_FILES['files']['tmp_name'][$i];

  $ruta="images";

  $ruta =$ruta."/".$nombreimg;
  move_uploaded_file($archivo,"../../".$ruta);
  $conjuntorutas .=$ruta.",";

}
foreach ($_POST as $calzon => $caca) {
  if($caca == "" && $calzon != "telephone") $error[] = "The field $calzon is required";
}
    if(!isset($error)) {
      echo $propId;

      // Definimos el query a ejecutar
      $queryProUpdate = sprintf("UPDATE propiedad SET colonia = '%s', numero = '%s', habitaciones = '%s', capacidad = '%s', baño = '%s', tipo = '%s'
        , imagenes = '%s', descripcion = '%s', costo_dia = '%s', costo_semana = '%s', costo_mes = '%s', latitud = '%s', longitud = '%s' WHERE id = ".$propId,
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


      // Ejecutamos el query y cachamos el resultado
      $resQueryProUpdate = mysqli_query($connLocalhost, $queryProUpdate) or trigger_error("The user update query failed...");

      // Redireccionamos al usuario si todo salio bien
      if($resQueryProUpdate) {
        header("Location:  ../../control.propiedad.php?userUpdate=true");
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
     <title>Inmobilaria San carlos | Usuario</title>

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
     <link rel="shortcut icon" href="../../favicon.ico" />

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
                             <h2>Usuarios</h2>


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



      <?php if(isset($queryProUpdate)){
       ?>
       <div class="alert alert-success alert-dismissible fade show">
          <strong>Success!</strong> Se ha eliminado una propiedad exitosamente.
          <button type="button" class="close" data-dismiss="alert">&times;</button>
      </div>
      <?php } ?>





      <p><strong>Nota:</strong>Esta accion no se poodra deshacer <strong>Debe asegurarse de las acciones.</strong></p>



      <div class="form-row ">


          <div style="width: 60%;"class=" booking-form">

            <div class="blog-section">
                <div class="section-title">
                    <h2 style="font-size: 33px!important;">Comprobando datos</h2>


                    </div>
                </div>
<div class="">

</div>
      <form action="formatoEditarP.php" method="post" enctype="multipart/form-data">

        <div class="check-date">
            <br>
            <label for="room" >Colonia:</label>

            <input  type="text"  name="colonia" value="<?php echo $propiedadDetails['colonia'] ?>" />
            <br>

          <label for="room"></label>
            <label for="room">Numero:</label>
            <input  type="text" value="<?php echo $propiedadDetails['numero'] ?>"name="numero" />
              <br>
            <label for="room" >Habitaciones:</label>
            <input   type="number" value="<?php echo $propiedadDetails['habitaciones'] ?>" name="habitaciones"/>
              <br>
            <label for="room" >Capacidad:</label>
            <input   type="number" value="<?php echo $propiedadDetails['capacidad'] ?>" name="capacidad"/>
              <br>
            <label for="room" >Baño:</label>
            <input   type="number"name="baño" value="<?php echo $propiedadDetails['baño'] ?>" />
              <br>

        </div>
        <div class="select-option">

              <label for="guest" >Tipo:</label>
              <select   id="guest" name="tipo">

                 <?php
                 if($propiedadDetails['tipo']==1){
                  $i="condominio";}
                  if($propiedadDetails['tipo']==2){
                  $i="Casa";}
                  if($propiedadDetails['tipo']==3){
                  $i="Departamento";} ?>
                  <option type "hidden" value= <?php $i ?> selected disabled >
                    <?php echo $i; ?>
                  </option>
                  <option value="1">Condominio</option>
                  <option value="2">Casa</option>
                  <option value="3">Departamento</option>

              </select>
          </div>
          <div class="check-date">
              <label for="room" >Imagen:</label>
              <input type="file" required class="form-control-file"  name="files[]" multiple >
              <p><strong>Nota:</strong>Al subir nuevas imagenes se borraran los anteriores</p>

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
              <textarea  style=" width: -webkit-fill-available;"  type="text" rows="4" cols="60" name="descripcion"> <?php echo $propiedadDetails['descripcion'] ?></textarea>
                <br>
              <label for="room" >Costo por dia:</label>
              <input   name="costo_dia" type="text" value="<?php echo $propiedadDetails['costo_dia'] ?>" />
                <br>
              <label for="room" >Costo por semana:</label>
              <input   name="costo_semana" type="text" value="<?php echo $propiedadDetails['costo_semana'] ?>" />
                <br>
              <label for="room" >Costo por mes:</label>
              <input   name="costo_mes" type="text" value="<?php echo $propiedadDetails['costo_mes'] ?>" />
                <br>

                <input required name= "latitud" id="latitud" value="<?php echo $propiedadDetails['latitud'] ?>"  />
                <input required name ="longitud" id="longitud"value="<?php echo $propiedadDetails['longitud'] ?>"  />

                <div class="map" id="map">

                </div>
<br>
<br>
  <div class="check-date">
                <input type="submit" name="sent"  value="Editar" >
                <td><input type="hidden" name="prop" value="<?php echo $_GET['idp']; ?>" /></td>

</div>

      </form>

    </div>
  </div>




  <script>


  var marker;          //variable del marcador
  var coords = {};    //coordenadas obtenidas con la geolocalización





  function setMapa (coords)
  {
       coords = {lng: <?php echo $propiedadDetails['longitud'] ?>,
      lat: <?php echo $propiedadDetails['latitud'] ?>};

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
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-_zF4mtTkrsoTOFUR9zfRJpPlVXPUoE0&callback=setMapa" type="text/javascript"></script>





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
