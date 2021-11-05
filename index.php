
<?php include("header.php"); ?>

<body>


	<div class="login-container">
		<div class="login-content">
			<p class="text-center">
				<i class="fas fa-user-circle fa-5x"></i>
			</p>
			<p class="text-center">
				Inicia sesión con tu cuenta
			</p>
			<form action="" method="post">
				<div class="form-group">
					<label for="UserName" class="bmd-label-floating"><i class="fas fa-user-secret"></i> &nbsp; Cedúla</label>
					<input type="text" class="form-control" id="UserName" name="usuario" pattern="[a-zA-Z0-9]{1,35}" maxlength="35">
				</div>
				<div class="form-group">
					<label for="UserPassword" class="bmd-label-floating"><i class="fas fa-key"></i> &nbsp; Contraseña</label>
					<input type="password" class="form-control" id="UserPassword" name="clave" maxlength="200">
				</div>
				<button type="submit" class="btn-login text-center" name="inicio_sesion">INCIAR SESIÓN</button>
			</form>
     
	 
	 <?php
			  if($_POST["usuario"]&&$_POST["clave"]){

							 $varif=mysqli_query($link, "select * from trabajadores where cedula='".$_POST["usuario"]."' and password  ='".base64_encode($_POST["clave"])."' ");
									while ($q= mysqli_fetch_assoc($varif)) {

										   $exist=1;
											 $_SESSION["cedula"]=$q["cedula"];
											 $_SESSION["nombre"]=$q["nombre"];
											 $_SESSION["dependencia_id"]=$q["dependencias_id"];
											 $_SESSION["correo"]=$q["correo"];

								 }

								$var=mysqli_query($link, "select * from tecnicos where cedula='".$_POST["usuario"]."' and password  ='".base64_encode($_POST["clave"])."' ");
											while ($q1= mysqli_fetch_assoc($var)) {

															 $exist_t=1;
															 $_SESSION["cedula"]=$q1["cedula"];
															 $_SESSION["nombre"]=$q1["nombre"];
															 $_SESSION["correo"]=$q1["correo"];

								       }


										  	if($exist==1||$exist_t==1){

													if($exist_t==1)
														echo "<script>parent.location.href='lista-asignaciones-tecnico.php';</script>";

													if(strcasecmp ($_SESSION["nombre"],"root") == 0)
															echo "<script>parent.location.href='home-root.php';</script>";


													 $var=mysqli_query($link, "select * from dependencias where id=$_SESSION[dependencia_id] ");
													 while ($q1= mysqli_fetch_assoc($var)) {

													      $nombre_dependencia=$q1["nombre"];

												    }

                            $vec=	array("Jefe de Atención", "Coordinador de Mantenimiento");
														for($i=0;$i<count($vec);$i++){

		                        if(strcasecmp($nombre_dependencia, $vec[$i])==0)
														 $u_especial=1;

														}

														if($u_especial==1){
															 if(strcasecmp($nombre_dependencia, "Coordinador de Mantenimiento")==0)
															    echo "<script>parent.location.href='home-coordinador-mantenimiento.php';</script>";
															 if(strcasecmp($nombre_dependencia, "Jefe de Atención")==0)
																	echo "<script>parent.location.href='home-jefe-atencion.php';</script>";

													  }

													  if(!$u_especial)
															    echo "<script>parent.location.href='home-usuario.php';</script>";

												}
												else {
													echo"<script>
																swal({ title: '¡ERROR!',
																			text: 'Usiario o contraseña invalida.',
																			icon: 'error'}).then(okay => {
																			if (okay) {
																			window.location.href = 'index.php';
																			}
																});
															 </script>";
												}





					}	else if(isset($_POST["inicio_sesion"])){

							echo"<script>
										swal({ title: '¡ERROR!',
													text: 'Usiario o contraseña invalida.',
													icon: 'error'}).then(okay => {
													if (okay) {
													window.location.href = 'index.php';
													}
										});
									 </script>";
						}
				?>

		</div>
	</div>
<?php include("footer.php"); ?>
