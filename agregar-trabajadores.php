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
					<i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR TRABAJADORES
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
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="cliente_dni" class="bmd-label-floating">Cédula (*)</label>
										<input type="text" pattern="[0-9]{7,8}" class="form-control" name="cliente_dni" id="cliente_dni" maxlength="50">
                    <small id="emailHelp" class="form-text text-muted">Máximo 7 a 8 números, no se aceptan letras.</small>
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="cliente_nombre" class="bmd-label-floating">Nombre (*)</label>
										<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" name="cliente_nombre" id="cliente_nombre" maxlength="40">
									</div>
								</div>
                <div class="col-12 col-md-6">
									<div class="form-group">
										<label for="usuario_clave_1" class="bmd-label-floating">Contraseña (*)</label>
										<input type="password" class="form-control" name="usuario_clave" id="usuario_clave" maxlength="10">
                    <small id="emailHelp" class="form-text text-muted">Máximo 10 caracteres entre letras y números.</small>
									</div>
								</div>
                <div class="col-12 col-md-6">
                  <div class="form-group">
                    <label for="item_estado" class="bmd-label-floating">Dependencia (*)</label>
                    <select class="form-control" name="item_dependencia" id="item_dependencia">
                      <option value="" selected="" disabled="">Seleccione una opción</option>
                        <?php   $varif=mysqli_query($link, "select * from dependencias where id>0");
                              while ($row= mysqli_fetch_assoc($varif)) { ?>
                      <option  value="<?php echo  $row["id"]; ?>"><?php echo  $row["nombre"]; ?></option>
                         <?php } ?>
                    </select>
                  </div>
                </div>
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="cliente_telefono" class="bmd-label-floating">Teléfono (*)</label>
										<input type="text" pattern="[0-9()+-]{10,11}" class="form-control" name="cliente_telefono" id="cliente_telefono">
                    <small id="emailHelp" class="form-text text-muted">Ejmplo: 01234567890</small>
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="cliente_direccion" class="bmd-label-floating">Correo</label>
										<input type="email" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" class="form-control" name="cliente_correo" id="cliente_correo"  placeholder="usuario@ejemplo.com" maxlength="150">
									</div>
								</div>
							</div>
						</div>
					</fieldset>
					<br><br><br>
					<p class="text-center" style="margin-top: 40px;">
						<button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
						&nbsp; &nbsp;
						<button type="submit" class="btn btn-raised btn-info btn-sm" name="agragar_trabajador"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
					</p>
				</form>
        <?php

        if(isset($_GET["agragar_trabajador"])){
            $t=mysqli_query($link, "select * from trabajadores where cedula=$_GET[cliente_dni]");
                  while ($q1= mysqli_fetch_assoc($t)) {
                  $existe=1;
            }
        }

        if(!$existe){
                if($_GET["cliente_dni"]&&$_GET["cliente_nombre"]&&$_GET["usuario_clave"]&&$_GET["cliente_telefono"]&&$_GET["item_dependencia"]){

                    mysqli_query($link,"insert into trabajadores(cedula,dependencias_id,nombre,password,correo,telefono) values('".$_GET["cliente_dni"]."','".$_GET["item_dependencia"]."','".$_GET["cliente_nombre"]."','".base64_encode($_GET["usuario_clave"])."','".$_GET["cliente_correo"]."','".$_GET["cliente_telefono"]."')");

                    echo"<script>
                          swal({ title: '¡Excelente!',
                                text: 'Se ha registrado satisfactoriamente.',
                                icon: 'success'}).then(okay => {
                                if (okay) {
                                window.location.href = 'agregar-trabajadores.php';
                                }
                          });
                         </script>";

                }else if(isset($_GET["agragar_trabajador"])){

                    echo"<script>
                          swal({ title: '¡ERROR!',
                                text: 'Ingrese los campos necesarios para el registro.',
                                icon: 'error'}).then(okay => {
                                if (okay) {
                                window.location.href = 'agregar-trabajadores.php';
                                }
                          });
                         </script>";
                  }
        }else if(isset($_GET["agragar_trabajador"])&&$existe==1){
          echo"<script>
                swal({ title: '¡ERROR!',
                      text: 'Ya existe un trabajador con dicha cédula.',
                      icon: 'error'}).then(okay => {
                      if (okay) {
                      window.location.href = 'agregar-trabajadores.php';
                      }
                });
               </script>";
        }

        ?>
			</div>

		</section>
	</main>


	<?php include("footer.php"); ?>
