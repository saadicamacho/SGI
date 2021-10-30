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
                    <i class="fas fa-sync-alt fa-fw"></i> &nbsp; ACTUALIZAR DEPENDENCIAS
                </h3>

            </div>


            <!--CONTENT-->
            <div class="container-fluid">
				<form action="" class="form-neon" autocomplete="off">
					<fieldset>
            <?php 	$varif=mysqli_query($link, "select * from dependencias where id='".$_GET["id"]."' ");
                    while ($row= mysqli_fetch_assoc($varif)) {

             ?>
             <label for="item_nombre" class="bmd-label-floating" style="color:red;">Los campos (*) son obligatorios</label>
             <br/><br/>         
						<legend><i class="far fa-plus-square"></i> &nbsp; Información del item</legend>
						<div class="container-fluid">
							<div class="row">
                <div class="col-12 col-md-4" style="display:none;">
                  <div class="form-group">
                    <label for="item_codigo" class="bmd-label-floating">id</label>
                    <input type="text" pattern="[a-zA-Z0-9-]{1,45}" class="form-control" name="item_id" id="item_id" maxlength="45" value="<?php echo $row["id"]; ?>" >
                  </div>
                </div>

								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="item_nombre" class="bmd-label-floating">Nombre (*)</label>
										<input type="text" pattern="[a-zA-záéíóúÁÉÍÓÚñÑ0-9 ]{1,140}" class="form-control" name="item_nombre" id="item_nombre" maxlength="140" value="<?php echo $row["nombre"]; ?>" >
									</div>
								</div>
							</div>
						</div>
          <?php    }

                  if ($_GET["item_nombre"]) {

                      mysqli_query($link, "update dependencias set nombre='".$_GET["item_nombre"]."' where id='".$_GET["item_id"]."' limit 1 ");
                      echo"<script>
                            swal({ title: '¡Excelente!',
                                  text: 'Se ha actualizado satisfactoriamente.',
                                  icon: 'success'}).then(okay => {
                                  if (okay) {
                                  window.location.href = 'actualizar-dependencias.php?id=$_GET[item_id]';
                                  }
                            });
                           </script>";
                  }else if(isset($_GET["actualizar_dependencia"])){

                      echo"<script>
                            swal({ title: '¡ERROR!',
                                  text: 'No se aceptan campos vacíos',
                                  icon: 'error'}).then(okay => {
                                  if (okay) {
                                  window.location.href = 'actualizar-dependencias.php?id=$_GET[item_id]';
                                  }
                            });
                           </script>";
                    }



          ?>
					</fieldset>
					<br><br><br>
					<p class="text-center" style="margin-top: 40px;">
						<button type="submit" class="btn btn-raised btn-success btn-sm" name="actualizar_dependencia"><i class="fas fa-sync-alt"></i> &nbsp; ACTUALIZAR</button>
					</p>
				</form>
			</div>
        </section>




    </main>
<?php include("footer.php"); ?>
