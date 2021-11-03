<?php include("header.php");
      include("main-container-usuario.php");

 ?>




    <!-- Page header -->
    <div class="full-box page-header">
      <h3 class="text-left">
        <i class="fab fa-dashcube fa-fw"></i> &nbsp; FORMULARIO DE INCIDENCIAS
      </h3>
    </div>

    <!--CONTENT-->
    <div class="container-fluid">
<form action="" class="form-neon" autocomplete="off">
  <fieldset>

    <div class="container-fluid">
      <div class="row">
        <div class="col-12 col-md-4">
          <label for="item_nombre" class="bmd-label-floating" style="color:red;">Los campos (*) son obligatorios</label>
          <br/><br/>
          <div class="form-group">
            <label for="item_nombre" class="bmd-label-floating">Ingrese número de equipo del departamanto (*)</label>
            <input type="text" pattern="[a-zA-záéíóúÁÉÍÓÚñÑ0-9- ]{1,140}" class="form-control" name="equipo" placeholder="EJEMPLO: EQUIPO-001" id="equipo" maxlength="200"  onkeyup="this.value = this.value.toUpperCase();">
          </div>
          </div>
          <div class="col-12 col-md-12">
            <div class="form-group">
              <label for="item_nombre" class="bmd-label-floating">Descripción (*)</label>
              <textarea class="form-control" id="descripcion_incidencia" name="descripcion_incidencia"></textarea>
              <small id="emailHelp" class="form-text text-muted">Indique una breve descripción de la falla del aquipo.</small>
           </div>
         </div>

    </div>
  </fieldset>
  <br><br><br>
  <p class="text-center" style="margin-top: 40px;">
    <button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
    &nbsp; &nbsp;
    <button type="submit" class="btn btn-raised btn-info btn-sm" name="ingresar_incidencias"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
  </p>
</form>
</div>
</section>
<?php
if($_GET["equipo"]&&$_GET["descripcion_incidencia"]){

    mysqli_query($link,"insert into incidencias (id, trabajadores_cedula, equipo, descripcion, status, fecha_ini) values(0,'".$_SESSION["cedula"]."','".$_GET["equipo"]."','".$_GET["descripcion_incidencia"]."',0, now())");
    echo"<script>
          swal({ title: '¡Excelente!',
                text: 'Se ha registrado satisfactoriamente.',
                icon: 'success'}).then(okay => {
                if (okay) {
                window.location.href = 'home-usuario.php';
                }
          });
         </script>";

}else if(isset($_GET["ingresar_incidencias"])){

    echo"<script>
          swal({ title: '¡ERROR!',
                text: 'Ingrese los campos necesarios para generar la incidencia.',
                icon: 'error'}).then(okay => {
                if (okay) {
                window.location.href = 'home-usuario.php';
                }
          });
         </script>";
  }

?>



</main>


<?php include("footer.php"); ?>
