<?php





include("conn/connLocalhost.php");


$queryGetTipo = "SELECT id, nombre FROM perfil_usuario";
$resQueryGetTipo = mysqli_query($connLocalhost, $queryGetTipo) or trigger_error("There was an error getting the user data... please try again");



?>


<div data-backdrop="static" class="modal fade" id="registroUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
  <h3 class="modal-title" id="exampleModalLabel">Agregar contenido al Blog</h3>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

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

<div class="booking-form">

    <form  method="post" action="controlUsuario.php" enctype="multipart/form-data" >
      <div class="check-date">
          <label for="room" >nombre:</label>

          <input type="text"name="nombre"  placeholder="Titulo" required />
          <br>

        <label for="room"></label>
          <label for="room">Correo:</label>

          <input type="email"  name="correo" placeholder="Ingresa tu correo" required/>
          <br>
          <label for="room">Contraseña:</label>


          <input type="password"  name="contraseña" placeholder="Ingresa tu contraseña" required/>
          <br>
          <label for="room">Repetir contraseña:</label>


          <input type="password"  name="contraseña2" placeholder="Ingresa tu contraseña de nuevo" required/>
          <br>
          <label for="room">Telefono:</label>
          <input type="number"  name="telefono" placeholder="Ingresa tu telefono" required/>
          <label>Tipo de usuario</label> <br>
          <div class="form-grup" >
          <select name="perfil_usuario">
            <?php while($TipoDetails = mysqli_fetch_assoc($resQueryGetTipo)) { ?>

            <?php echo "<option value='$TipoDetails[id]'>$TipoDetails[nombre]</option>"?>
            <?php }  ?>

          </select>
        </div>
        <br>
        <br>

          <label for="room">Edad:</label>
          <input type="number"  name="edad" placeholder="Ingresa tu edad" required/>



              </div>
              <br>


        <input type="submit" name="sent"  value="Registrar" >

    </form>
</div>
</div>
