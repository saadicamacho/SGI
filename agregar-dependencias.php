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
                    <i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR DEPENDENCIAS
                </h3>
            </div>


            <!--CONTENT-->
            <div class="container-fluid">
				<form action="" class="form-neon" autocomplete="off">
					<fieldset>
            <label for="item_nombre" class="bmd-label-floating" style="color:red;">Los campos (*) son obligatorios</label>
            <br/><br/>
						<div class="container-fluid">
							<div class="row">
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="item_nombre" class="bmd-label-floating">Nombre (*)</label>
										<input type="text" pattern="[a-zA-záéíóúÁÉÍÓÚñÑ ]{1,140}" class="form-control" name="nombre" id="nombre" maxlength="140">
									</div>
								</div>
							</div>
						</div>
					</fieldset>
					<br><br><br>
					<p class="text-center" style="margin-top: 40px;">
						<button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
						&nbsp; &nbsp;
						<button type="submit" class="btn btn-raised btn-info btn-sm" name="agregar_dependecia"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
					</p>
				</form>
			</div>
        </section>
        <?php
        if(isset($_GET["agregar_dependecia"])&&$_GET["nombre"]){
              $t=mysqli_query($link, "select * from dependencias where nombre like '%".trim($_GET[nombre])."%' ");
                    while ($q1= mysqli_fetch_assoc($t)) {
                    $existe=1;
              }
        }
        if(!$existe){
                  if($_GET["nombre"]){

                      mysqli_query($link,"insert into dependencias (id,nombre) values(0,'".$_GET["nombre"]."')");
                      echo"<script>
                            swal({ title: '¡Excelente!',
                                  text: 'Se ha registrado satisfactoriamente.',
                                  icon: 'success'}).then(okay => {
                                  if (okay) {
                                  window.location.href = 'agregar-dependencias.php';
                                  }
                            });
                           </script>";

                  }else if(isset($_GET["agregar_dependecia"])){

                      echo"<script>
                            swal({ title: '¡ERROR!',
                                  text: 'Ingrese los campos necesarios para el registro.',
                                  icon: 'error'}).then(okay => {
                                  if (okay) {
                                  window.location.href = 'agregar-dependencias.php';
                                  }
                            });
                           </script>";
                    }
        }else if(isset($_GET["agregar_dependecia"])&&$existe==1){
          echo"<script>
                swal({ title: '¡ERROR!',
                      text: 'Ya existe dicha dependencia.',
                      icon: 'error'}).then(okay => {
                      if (okay) {
                      window.location.href = 'agregar-dependencias.php';
                      }
                });
               </script>";
        }

        ?>



    </main>


    	<?php include("footer.php"); ?>
