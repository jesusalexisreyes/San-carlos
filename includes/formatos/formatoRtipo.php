
<?php





include("conn/connLocalhost.php");



?>


<div data-backdrop="static" class="modal fade" id="registroblo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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

    <form  method="post" action="controlTipoUsuario.php" enctype="multipart/form-data" >
      <div class="check-date">
          <label for="room" >nombre:</label>

          <input type="text"name="nombre"  placeholder="Titulo" required />
          <br>

        <label for="room"></label>
          <label for="room">Descripcion:</label>

          <textarea type="text" rows="4" cols="55" name="descripcion" placeholder="Describe el blog" required></textarea>

                    <input type="checkbox"name="crear"  placeholder="Titulo" value="1" />
                    <br>

                  <input type="checkbox"name="editar"  placeholder="Titulo" value="1" />
                    <br>
                    <input type="checkbox"name="eliminar"  placeholder="Titulo" value="1" />
                      <br>



              </div>
              <br>


        <input type="submit" name="sent"  value="Registrar" >

    </form>
</div>
</div>
