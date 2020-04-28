

<?php





include("conn/connLocalhost.php");



?>




<div class="modal fade" id="mensaje_iniciars" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">

<div class="booking-form">
  <?php
    if(isset($error)) { ?>
        <div style="background: #F5A9A9;"class="alert alert-warning alert-dismissable">
  <?php
    printMsg($error, "error");
  echo "  </div>";}

  ?>

   <?php if(isset($queryblogAdd)){
    ?>
    <div class="alert alert-success alert-dismissible fade show">
       <strong>Success!</strong> Your message has been sent successfully.
       <button type="button" class="close" data-dismiss="alert">&times;</button>
   </div>
   <?php } ?>


    <form method="post" action="control.propiedad.php" enctype="multipart/form-data">
      <div class="check-date">
        <br>
        <label id="formularioletra">Registro de propiedades</label>
        <br>
          <label for="room" >Colonia:</label>

          <input type="text" required name="colonia" placeholder="Colonia de la propiedad" />
          <br>

        <label for="room"></label>
          <label for="room">Numero:</label>
          <input required type="text" placeholder="numero de propiedad" name="numero" />
            <br>
          <label for="room" >Habitaciones:</label>
          <input required type="number" placeholder="numero de habitaciones de la propiedad"  name="habitaciones"/>
            <br>
          <label for="room" >Capacidad:</label>
          <input required type="number" placeholder="numero de capacidad de personas" name="capacidad"/>
            <br>
          <label for="room" >Baño:</label>
          <input required type="number"name="baño" placeholder="numero de baños en propiedad" />
            <br>

      </div>
        <div class="select-option">
            <label for="guest" >Tipo:</label>
            <select required  id="guest" name="tipo">
                <option value="1">Condominio</option>
                <option value="2">Casa</option>
                <option value="3">Departamento</option>

            </select>
        </div>
        <div class="check-date">
            <label for="room" >Imagen:</label>

            <input type="file" required class="form-control-file" name="files[]" multiple >
              <br>

          <label for="room"></label>
            <label for="room">Descripcion:</label>
            <textarea style=" width: -webkit-fill-available;" required type="text" rows="4" cols="60" name="descripcion" placeholder="Descripcion de la casa"></textarea>
              <br>
            <label for="room" >Costo por dia:</label>
            <input required name="costo_dia" type="text" placeholder="renta por dia" />
              <br>
            <label for="room" >Costo por semana:</label>
            <input required name="costo_semana" type="text" placeholder="renta semanal" />
              <br>
            <label for="room" >Costo por mes:</label>
            <input required name="costo_mes" type="text" placeholder="renta por mes" />
              <br>
              <div class="map" id="map">
                  <iframe
                      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.0606825994123!2d-72.8735845851828!3d40.760690042573295!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89e85b24c9274c91%3A0xf310d41b791bcb71!2sWilliam%20Floyd%20Pkwy%2C%20Mastic%20Beach%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1578582744646!5m2!1sen!2sbd"
                      height="470" style="border:0;" allowfullscreen=""></iframe>
              </div>




        </div>


        <input type="submit" name="sent"  value="Registrar" >
    </form>
</div>
</div>
<script>


var marker;          //variable del marcador
var coords = {};    //coordenadas obtenidas con la geolocalización

//Funcion principal
initMap = function ()
{

//usamos la API para geolocalizar el usuario
    navigator.geolocation.getCurrentPosition(
      function (position){
        coords =  {
          lng: position.coords.longitude,
          lat: position.coords.latitude
        };
        setMapa(coords);  //pasamos las coordenadas al metodo para crear el mapa


      },function(error){console.log(error);});

}



function setMapa (coords)
{
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
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-_zF4mtTkrsoTOFUR9zfRJpPlVXPUoE0&callback=initMap" type="text/javascript"></script>
