<?php include("header.php");
 ?>
<body>

  <?php
        include("main-container-coordinador-mantenimiento.php");

   ?>

			<!-- Page header -->
			<div class="full-box page-header">
				<h3 class="text-left">
					<i class="fas fa-plus fa-fw"></i> &nbsp; ASIGNAR TÉCNICO A LA INCIDENCIA
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
                    <input type="text" pattern="[0-9]{1,140}" class="form-control" name="id_incidencia" id="id_incidencia" maxlength="140" value="<?php echo $_GET["id"] ?>">
                  </div>
                </div>

                <div class="col-12 col-md-6">
                  <div class="form-group">
                    <label for="item_estado" class="bmd-label-floating">Asignar Técnico (*)</label>
                    <select class="form-control" name="asignacion_tecnico" id="asignacion_tecnico">
                      <option value="" selected="" disabled="">Seleccione una opción</option>
                        <?php   $varif=mysqli_query($link, "select * from tecnicos");
                              while ($row= mysqli_fetch_assoc($varif)) { ?>
                      <option  value="<?php echo  $row["cedula"]; ?>"><?php echo  $row["nombre"]; ?></option>
                         <?php } ?>
                    </select>
                      <small id="emailHelp" class="form-text text-muted">Escoje un técnico en la lista</small>
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
        if($_GET["asignacion_tecnico"]){

            mysqli_query($link,"insert into asignaciones(tecnicos_cedula,incidencias_id,fecha_ini) values('".$_GET["asignacion_tecnico"]."','".$_GET["id_incidencia"]."',now())");
            mysqli_query($link, "update incidencias set status=1 where id=$_GET[id_incidencia] limit 1 ");
            echo"<script>
                  swal({ title: '¡Excelente!',
                        text: 'Se ha asignado el técnico satisfactoriamente.',
                        icon: 'success'}).then(okay => {
                        if (okay) {
                        window.location.href = 'home-coordinador-mantenimiento.php';
                        }
                  });
                 </script>";

        }else if(isset($_GET["asignar_tec"])){

            echo"<script>
                  swal({ title: '¡ERROR!',
                        text: 'No ha asignado ningún técnico.',
                        icon: 'error'}).then(okay => {
                        if (okay) {
                        window.location.href = 'asignar-tecnico-coordinador-mantenimiento.php?id=$_GET[id_incidencia]';
                        }
                  });
                 </script>";
          }

        ?>
			</div>

		</section>
	</main>


	<?php include("footer.php"); ?>
