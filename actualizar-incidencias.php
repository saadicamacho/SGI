<?php include("header.php");
      include("main-container-usuario.php");

 ?>


    <!-- Page header -->
    <div class="full-box page-header">
      <h3 class="text-left">
        <i class="fab fa-dashcube fa-fw"></i> &nbsp; ACTUALIZAR INCIDENCIA
      </h3>
    </div>

    <!--CONTENT-->
    <div class="container-fluid">
<form action="" class="form-neon" autocomplete="off">
  <fieldset>
    <?php

    if($_GET["id"]){
        $t=mysqli_query($link, "select * from incidencias where id=$_GET[id]");
              while ($row= mysqli_fetch_assoc($t)) {


     ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-12 col-md-4">
          <label for="item_nombre" class="bmd-label-floating" style="color:red;">Los campos (*) son obligatorios</label>
          <br/><br/>
          <div class="form-group" style="display:none;">
            <label for="item_nombre" class="bmd-label-floating">Ingrese número de equipo del departamanto (*)</label>
            <input type="text" pattern="[a-zA-záéíóúÁÉÍÓÚñÑ0-9- ]{1,140}" class="form-control" name="id_incidencia" id="id_incidencia" maxlength="200" value="<?php echo $row["id"]; ?>">
          </div>
          <div class="form-group">
            <label for="item_nombre" class="bmd-label-floating">Ingrese número de equipo del departamanto (*)</label>
            <input type="text" pattern="[a-zA-záéíóúÁÉÍÓÚñÑ0-9- ]{1,140}" class="form-control" name="equipo" placeholder="EJEMPLO: EQUIPO-001" id="equipo" maxlength="200" value="<?php echo $row["equipo"]; ?>">
          </div>
          </div>
          <div class="col-12 col-md-12">
            <div class="form-group">
              <label for="item_nombre" class="bmd-label-floating">Descripción (*)</label>
              <textarea class="form-control" id="descripcion_incidencia" name="descripcion_incidencia"><?php echo $row["descripcion"]; ?></textarea>
              <small id="emailHelp" class="form-text text-muted">Indique una breve descripción de la falla del aquipo.</small>
           </div>
         </div>

    </div>
  </fieldset>
<?php  }
     } ?>

  <br><br><br>
  <p class="text-center" style="margin-top: 40px;">

    <button type="submit" class="btn btn-raised btn-info btn-sm" name="actualizar_incidencias"><i class="fas fa-sync-alt fa-fw"></i> &nbsp; ACTUALIZAR</button>
  </p>
</form>
</div>
</section>
<?php
if($_GET["equipo"]&&$_GET["descripcion_incidencia"]){

    mysqli_query($link,"update incidencias set equipo='".$_GET["equipo"]."', descripcion='".$_GET["descripcion_incidencia"]."' where id='".$_GET["id_incidencia"]."' limit 1");
    echo"<script>
          swal({ title: '¡Excelente!',
                text: 'Se ha actualizado satisfactoriamente.',
                icon: 'success'}).then(okay => {
                if (okay) {
                window.location.href = 'actualizar-incidencias.php?id=$_GET[id_incidencia]';
                }
          });
         </script>";

}else if(isset($_GET["actualizar_incidencias"])){

    echo"<script>
          swal({ title: '¡ERROR!',
                text: 'Ingrese los campos necesarios para generar la incidencia.',
                icon: 'error'}).then(okay => {
                if (okay) {
                window.location.href = 'actualizar-incidencias.php?id=$_GET[id_incidencia]';
                }
          });
         </script>";
  }

?>



</main>


<?php include("footer.php"); ?>
