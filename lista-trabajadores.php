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
					<i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE TRABAJADORES
				</h3>
			</div>


			<!-- Content here-->
			<div class="container-fluid">
				<div class="table-responsive">
					<table class="table table-dark table-sm">
						<thead>
							<tr class="text-center roboto-medium">
								<th>CÉDULA</th>
								<th>NOMBRE</th>
								<th>DEPENDENCIA</th>
								<th>CORREO</th>
  							<th>TELEFONO</th>
								<th>ACTUALIZAR</th>
								<th>ELIMINAR</th>
							</tr>
						</thead>
						<tbody>
            <?php
              // maximo por pagina
              $limit = 5;

              // pagina pedida
              $pag = (int) $_GET["pag"];
              if ($pag < 1)
              {
              $pag = 1;
              }
              $offset = ($pag-1) * $limit;
              $totalfila=mysqli_query($link, "select count(*) as total from trabajadores where telefono is not null");
                    while ($q= mysqli_fetch_assoc($totalfila)) {
                    $total = $q["total"];
              }

              $varif=mysqli_query($link, "select * from trabajadores where telefono is not null LIMIT $offset, $limit");
                    while ($row= mysqli_fetch_assoc($varif)) {

             ?>
							<tr class="text-center" >
								<td><?php echo  $row["cedula"]; ?></td>
								<td><?php echo  $row["nombre"]; ?></td>
								<td><?php $var=mysqli_query($link, "select * from dependencias where id=$row[dependencias_id] ");
                      while ($r= mysqli_fetch_assoc($var)) { echo  $r["nombre"]; } ?></td>
								<td><?php echo  $row["correo"]; ?></td>
                <td><?php echo  $row["telefono"]; ?></td>
								<td>
									<a href="actualizar-trabajadores.php?id=<?php echo  $row["cedula"]; ?>" class="btn btn-success">
	  									<i class="fas fa-sync-alt"></i>
									</a>
								</td>
								<td>
									<form action="">
										<button type="button" class="btn btn-warning">
                      <a href="lista-trabajadores.php?id=<?php echo  $row["cedula"]; ?>" class="btn btn-success">
		  									<i class="far fa-trash-alt"></i>
                      </a>
										</button>
									</form>
								</td>
							</tr>
									</form>
                <?php    }

                         if ($_GET["id"]) {
                            mysqli_query($link,"delete from trabajadores where cedula='".$_GET["id"]."'  limit 1 ");
                            echo"<script>
                                  swal({ title: '¡Excelente!',
                                        text: 'Se ha eliminado satisfactoriamente.',
                                        icon: 'success'}).then(okay => {
                                        if (okay) {
                                        window.location.href = 'lista-trabajadores.php';
                                        }
                                  });
                                 </script>";
                        }

                ?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<nav aria-label="Page navigation example">
					<ul class="pagination justify-content-center">
            <?php
                     $totalPag = ceil($total/$limit);
                     $linksf = array();
                     for( $i=1; $i<=$totalPag ; $i++)
                     {
                        $linksf[] = "<li class='page-item'><a class='page-link' href=\"?pag=$i\">$i</a></li>";
                     }
                     echo implode("", $linksf);
                  ?>
					</ul>
				</nav>
			</div>

		</section>
	</main>

	<?php include("footer.php"); ?>
