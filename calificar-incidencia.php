<?php include("header.php");
 ?>
<body>

  <?php
        include("main-container-usuario.php");

   ?>

			<!-- Page header -->
			<div class="full-box page-header">
				<h3 class="text-left">
					<i class="fas fa-plus fa-fw"></i> &nbsp; ASIGNAR CALIFICACIÓN
				</h3>
			</div>


      

			<!-- Content here-->
			<div class="container-fluid">
				<form action="" class="form-neon" autocomplete="off">
					<fieldset>
          <?php
             if($_GET["id"]){
                $var=mysqli_query($link, "SELECT t.nombre as nombre_tecnico,a.solucion as solucion  from tecnicos t, asignaciones a where t.cedula=a.tecnicos_cedula and a.incidencias_id=$_GET[id] ");
                while ($r= mysqli_fetch_assoc($var)) {
                   $solucion=$r["solucion"];
           ?>
                  <div style="background-color: #9b9b9b;border: 1px;solid #ddd;padding: 5px;width: 100%;overflow-x: auto;color:white;padding-left:20px;">
                  Solución generada por el técnico responsable de la incidencia:
                  </div>
                  <div style="background-color: #f1f1f1;border: 1px;solid #ddd;padding: 20px;width: 100%;overflow-x: auto;">
                  <?php  echo  $solucion; ?>
                  </div>
         <?php
                 }
               }
                 ?>
         <br/><br/>

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
                    <label for="item_estado" class="bmd-label-floating">Asignar calificación a la solución (*)</label>
                    <select class="form-control" name="asignacion_solucion" id="asignacion_solucion">
                      <option value="" selected="" disabled="">Seleccione una opción</option>
                      <option  value="3">Solucionada</option>
                      <option  value="4">Procesada sin solución</option>
                    </select>
                      <small id="emailHelp" class="form-text text-muted">Escoje una opción acorde a la solución</small>
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
        if($_GET["asignacion_solucion"]){
            if($_GET["asignacion_solucion"]==3)
            mysqli_query($link, "update incidencias set status=3 where id=$_GET[id_incidencia] limit 1 ");
            if($_GET["asignacion_solucion"]==4)
            mysqli_query($link, "update incidencias set status=4 where id=$_GET[id_incidencia] limit 1 ");


            echo"<script>
                  swal({ title: '¡Excelente!',
                        text: 'Se ha asignado la calificación a la solución satisfactoriamente.',
                        icon: 'success'}).then(okay => {
                        if (okay) {
                        window.location.href = 'lista-incidencias-usuario.php';
                        }
                  });
                 </script>";

        }else if(isset($_GET["asignar_tec"])){

            echo"<script>
                  swal({ title: '¡ERROR!',
                        text: 'No deje el espacio calificación en blanco.',
                        icon: 'error'}).then(okay => {
                        if (okay) {
                        window.location.href = 'calificar-incidencia.php?id=$_GET[id_incidencia]';
                        }
                  });
                 </script>";
          }

        ?>
			</div>

		</section>
	</main>


	<?php include("footer.php"); ?>
