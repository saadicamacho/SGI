<?php include("header.php");
 ?>
<body>

<?php
    include("main-container-root.php");
    if($_SESSION["dependencia_id"]>0){
      session_destroy();
      echo "<script>location.href='index.php';</script>";
    }
?>


			<!-- Page header -->
			<div class="full-box page-header">
				<h3 class="text-left">
					<i class="fas fa-sync-alt fa-fw"></i> &nbsp; ACTUALIZAR TRABAJADORES
				</h3>
			</div>
			<!-- Content here-->
			<div class="container-fluid">
				<form action="" class="form-neon" autocomplete="off">
					<fieldset>
            <?php 	$varif=mysqli_query($link, "select * from trabajadores where cedula='".$_GET["id"]."' ");
                    while ($row= mysqli_fetch_assoc($varif)) {
             ?>
             <label for="item_nombre" class="bmd-label-floating" style="color:red;">Los campos (*) son obligatorios</label>
             <br/><br/>
						<div class="container-fluid">
							<div class="row">
								<div class="col-12 col-md-6" style="display:none;">
									<div class="form-group">
										<label for="cliente_dni" class="bmd-label-floating">Cédula</label>
										<input type="text" pattern="[a-zA-Z0-9-]{1,27}" class="form-control" name="cliente_dni" id="cliente_dni" maxlength="27" value="<?php echo $row["cedula"]; ?>" >
                	</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="cliente_nombre" class="bmd-label-floating">Nombre  (*)</label>
										<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" name="cliente_nombre" id="cliente_nombre" maxlength="40" value="<?php echo $row["nombre"]; ?>">
									</div>
								</div>
                <div class="col-12 col-md-6">
                  <div class="form-group">
                    <label for="usuario_clave_1" class="bmd-label-floating">Contraseña  (*)</label>
                    <input type="password" class="form-control" name="usuario_clave" id="usuario_clave" maxlength="10" value="<?php echo base64_decode($row["password"]); ?>">
                    <small id="emailHelp" class="form-text text-muted">Máximo 10 caracteres entre letras y números.</small>
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="form-group">
                    <label for="item_estado" class="bmd-label-floating">Dependencia  (*)</label>
                    <select class="form-control" name="item_dependencia" id="item_dependencia">
                      <?php   $var=mysqli_query($link, "select * from dependencias where id=$row[dependencias_id]");
                            while ($r= mysqli_fetch_assoc($var)) { ?>
                      <option value="<?php echo  $r["id"]; ?>" selected="" ><?php echo $r["nombre"]; ?></option>
                       <?php } ?>
                       <option value="" disabled="">Seleccione otra opción</option>
                        <?php   $vari=mysqli_query($link, "select * from dependencias where id>0");
                              while ($ro= mysqli_fetch_assoc($vari)) { ?>
                      <option  value="<?php echo  $ro["id"]; ?>"><?php echo  $ro["nombre"]; ?></option>
                         <?php } ?>
                    </select>
                  </div>
                </div>
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="cliente_telefono" class="bmd-label-floating">Teléfono  (*)</label>
										<input type="text" pattern="[0-9()+]{10,11}" class="form-control" name="cliente_telefono" id="cliente_telefono"  value="<?php echo $row["telefono"]; ?>">
                    <small id="emailHelp" class="form-text text-muted">Ejmplo: 01234567890</small>
                  </div>
								</div>
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="cliente_direccion" class="bmd-label-floating">Correo</label>
										<input  type="email" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" class="form-control" name="cliente_correo" id="cliente_correo" maxlength="150" placeholder="usuario@ejemplo.com" value="<?php echo $row["correo"]; ?>">
									</div>
								</div>
							</div>
						</div>
          <?php    }

                  if ($_GET["cliente_dni"]&&$_GET["cliente_nombre"]&&$_GET["usuario_clave"]&&$_GET["cliente_telefono"]&&$_GET["item_dependencia"]) {
                      mysqli_query($link, "update trabajadores set dependencias_id='".$_GET["item_dependencia"]."',nombre='".$_GET["cliente_nombre"]."',password='".base64_encode($_GET["usuario_clave"])."',correo='".$_GET["cliente_correo"]."',telefono='".$_GET["cliente_telefono"]."' where cedula='".$_GET["cliente_dni"]."' ");
                      echo"<script>
                            swal({ title: '¡Excelente!',
                                  text: 'Se ha actualizado satisfactoriamente.',
                                  icon: 'success'}).then(okay => {
                                  if (okay) {
                                  window.location.href = 'actualizar-trabajadores.php?id=$_GET[cliente_dni]';
                                  }
                            });
                           </script>";
                  }else if(isset($_GET["actualizar_trabajador"])){

                      echo"<script>
                            swal({ title: '¡ERROR!',
                                  text: 'No se aceptan campos vacíos',
                                  icon: 'error'}).then(okay => {
                                  if (okay) {
                                  window.location.href = 'actualizar-trabajadores.php?id=$_GET[cliente_dni]';
                                  }
                            });
                           </script>";
                    }

          ?>
					</fieldset>
					<br><br><br>
					<p class="text-center" style="margin-top: 40px;">
						<button type="submit" class="btn btn-raised btn-success btn-sm" name="actualizar_trabajador"><i class="fas fa-sync-alt"></i> &nbsp; ACTUALIZAR</button>
					</p>
				</form>
			</div>

		</section>
	</main>
	<?php include("footer.php"); ?>
