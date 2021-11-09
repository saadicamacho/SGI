<?php include("header.php");
 ?>
<body>
  <?php
        include("main-container-tecnico.php");

   ?>

			<!-- Page header -->
			<div class="full-box page-header">
				<h3 class="text-left">
					<i class="fas fa-plus fa-fw"></i> &nbsp; ASIGNAR SOLUCIÓN A LA INCIDENCIA
				</h3>
			</div>

			<!-- Content here-->
			<div class="container-fluid">
				<form action="" class="form-neon" autocomplete="off">
					<fieldset>
          <label for="item_nombre" class="bmd-label-floating" style="color:red;">Los campos (*) son obligatorios</label>
            <br/><br/>
						<div class="container-fluid">
							<div class="row">
                <div class="col-12 col-md-4" style="display:none;">
                  <div class="form-group">
                    <label for="item_nombre" class="bmd-label-floating">Nombre</label>
                    <input type="text" pattern="[0-9]{1,140}" class="form-control" name="id_asignacion" id="id_asignacion" maxlength="140" value="<?php echo $_GET["id"] ?>">
                  </div>
                </div>
                <div class="col-12 col-md-12">
                  <div class="form-group">
                    <label for="item_nombre" class="bmd-label-floating">Descripción (*)</label>
                    <textarea class="form-control" id="descripcion_solucion" name="descripcion_solucion"></textarea>
                    <small id="emailHelp" class="form-text text-muted">Indique una breve descripción de la solución de la incidencia.</small>
                 </div>
               </div>
							</div>
						</div>
					</fieldset>
					<br><br><br>
					<p class="text-center" style="margin-top: 40px;">
						&nbsp; &nbsp;
						<button type="submit" class="btn btn-raised btn-info btn-sm" name="asignar_tec"><i class="far fa-save"></i> &nbsp; ASIGNAR</button>
					</p>
				</form>
        <?php
        if($_GET["descripcion_solucion"]){
           $var=mysqli_query($link, "select * from asignaciones  where id=$_GET[id_asignacion]");
                while ($r= mysqli_fetch_assoc($var)) {
                  $id_incidencia= $r["incidencias_id"];
                }


                
            mysqli_query($link, "update asignaciones set solucion='".$_GET["descripcion_solucion"]."', fecha_fin= now() where id=$_GET[id_asignacion] limit 1 ");
            mysqli_query($link, "update incidencias set status=2 where id=$id_incidencia limit 1 ");

            echo"<script>
                  swal({ title: '¡Excelente!',
                        text: 'Se ha asignado una solución satisfactoriamente.',
                        icon: 'success'}).then(okay => {
                        if (okay) {
                        window.location.href = 'lista-asignaciones-tecnico.php';
                        }
                  });
                 </script>";

        }else if(isset($_GET["asignar_tec"])){

            echo"<script>
                  swal({ title: '¡ERROR!',
                        text: 'No deje el campo descripción en blanco.',
                        icon: 'error'}).then(okay => {
                        if (okay) {
                        window.location.href = 'asignar-solucion-incidencia.php?id=$_GET[id_asignacion]';
                        }
                  });
                 </script>";
          }
          else{

          }

        ?>
			</div>

		</section>
	</main>


	<?php include("footer.php"); ?>
