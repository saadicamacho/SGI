<?php include("header.php");
 ?>
<body>

<?php
    include("main-container-tecnico.php");

?>


			<!-- Page header -->
			<div class="full-box page-header">
				<h3 class="text-left">
					<i class="fas fa-sync-alt fa-fw"></i> &nbsp; ACTUALIZAR MIS DATOS
				</h3>
			</div>
			<!-- Content here-->
			<div class="container-fluid">
				<form action="" class="form-neon" autocomplete="off">
					<fieldset>
            <?php 	$varif=mysqli_query($link, "select * from tecnicos where cedula='".$_GET["id"]."' ");
                    while ($row= mysqli_fetch_assoc($varif)) {
             ?>
             <label for="item_nombre" class="bmd-label-floating" style="color:red;">Los campos (*) son obligatorios</label>             <label for="item_nombre" class="bmd-label-floating" style="color:red;">Los campos (*) son obligatorios</label>
            <br/><br/>
						<div class="container-fluid">
							<div class="row">
								<div class="col-12 col-md-6" style="display:none;">
									<div class="form-group">
										<label for="cliente_dni" class="bmd-label-floating">Cédula</label>
										<input type="text" pattern="[a-zA-Z0-9-]{1,27}" class="form-control" name="cliente_dni" id="cliente_dni" maxlength="27" value="<?php echo $row["cedula"]; ?>" >
									</div>
								</div>
								<div class="col-12 col-md-6" style="display:none;">
									<div class="form-group">
										<label for="cliente_nombre" class="bmd-label-floating" >Nombre</label>
										<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" name="cliente_nombre" id="cliente_nombre" maxlength="40" value="<?php echo $row["nombre"]; ?>">
									</div>
								</div>
                <div class="col-12 col-md-6">
                  <div class="form-group">
                    <label for="usuario_clave_1" class="bmd-label-floating">Contraseña (*)</label>
                    <input type="password" class="form-control" name="usuario_clave" id="usuario_clave" maxlength="10" value="<?php echo base64_decode($row["password"]); ?>">
                    <small id="emailHelp" class="form-text text-muted">Máximo 10 caracteres entre letras y números.</small>
                  </div>
                </div>
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="cliente_direccion" class="bmd-label-floating">Correo</label>
										<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ#- ]{1,150}" class="form-control" name="cliente_correo" id="cliente_correo" maxlength="150" placeholder="usuario@ejemplo.com" value="<?php echo $row["correo"]; ?>">
									</div>
								</div>
							</div>
						</div>
          <?php    }

                  if ($_GET["cliente_dni"]&&$_GET["cliente_nombre"]&&$_GET["usuario_clave"]) {
                      mysqli_query($link, "update tecnicos set nombre='".$_GET["cliente_nombre"]."',password='".base64_encode($_GET["usuario_clave"])."',correo='".$_GET["cliente_correo"]."' where cedula='".$_GET["cliente_dni"]."' ");
                      echo"<script>
                            swal({ title: '¡Excelente!',
                                  text: 'Se ha actualizado satisfactoriamente.',
                                  icon: 'success'}).then(okay => {
                                  if (okay) {
                                  window.location.href = 'actualizar-tecnicos-perfil.php?id=$_GET[cliente_dni]';
                                  }
                            });
                           </script>";
                  }else if(isset($_GET["actualizar_tecnico"])){

                      echo"<script>
                            swal({ title: '¡ERROR!',
                                  text: 'No se aceptan campos vacíos',
                                  icon: 'error'}).then(okay => {
                                  if (okay) {
                                  window.location.href = 'actualizar-tecnicos-perfil.php?id=$_GET[cliente_dni]';
                                  }
                            });
                           </script>";
                    }

          ?>
					</fieldset>
					<br><br><br>
					<p class="text-center" style="margin-top: 40px;">
						<button type="submit" class="btn btn-raised btn-success btn-sm" name="actualizar_tecnico"><i class="fas fa-sync-alt"></i> &nbsp; ACTUALIZAR</button>
					</p>
				</form>
			</div>

		</section>
	</main>
	<?php include("footer.php"); ?>
