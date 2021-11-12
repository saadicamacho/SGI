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
                    <i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE DEPENDENCIAS
                </h3>

            </div>


            <!--CONTENT-->
           <div class="container-fluid">
				<div class="table-responsive">
					<table class="table table-dark table-sm">
						<thead>
							<tr class="text-center roboto-medium">
								<th>#</th>
								<th>NOMBRE</th>
								<th>ACTUALIZAR</th>
								<th>ELIMINAR</th>
							</tr>
						</thead>
						<tbody>
              <?php
                // maximo por pagina
                $limit = 10;

                // pagina pedida
                $pag = (int) $_GET["pag"];
                if ($pag < 1)
                {
                $pag = 1;
                }
                $offset = ($pag-1) * $limit;
                $totalfila=mysqli_query($link, "select count(*) as total from dependencias");
                      while ($q= mysqli_fetch_assoc($totalfila)) {
                      $total = $q["total"];
                }

                $varif=mysqli_query($link, "select * from dependencias LIMIT $offset, $limit");
                      while ($row= mysqli_fetch_assoc($varif)) {
                      $count++;

               ?>
							<tr class="text-center" >
                <td><?php echo  $count; ?></td>
								<td><?php echo  $row["nombre"]; ?></td>
								<td>
                                    <a href="actualizar-dependencias.php?id=<?php echo  $row["id"]; ?>" class="btn btn-success">
                                        <i class="fas fa-sync-alt"></i>
                                    </a>
                                </td>
                                <td>
                                    <form action="">
                                        <button type="button" class="btn btn-warning">
                                          <a href="lista-dependencias.php?id=<?php echo  $row["id"]; ?>" class="btn btn-success">
                                            <i class="far fa-trash-alt"></i>
                                          </a>
                                        </button>
                                    </form>

                                </td>
                              <?php    }

                                       if ($_GET["id"]) {
                                          mysqli_query($link,"delete from dependencias where id='".$_GET["id"]."'  limit 1 ");
                                          echo"<script>
                                                swal({ title: '¡Excelente!',
                                                      text: 'Se ha eliminado satisfactoriamente.',
                                                      icon: 'success'}).then(okay => {
                                                      if (okay) {
                                                      window.location.href = 'lista-dependencias.php';
                                                      }
                                                });
                                               </script>";
                                      }

                              ?>
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
