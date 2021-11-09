<?php include("header.php");
 ?>
<body>

  <?php
        include("main-container-usuario.php");
   ?>

            <!-- Page header -->
            <div class="full-box page-header">
                <h3 class="text-left">
                    <i class="fas fa-clipboard-list fa-fw"></i> &nbsp; MIS LISTAS DE INCIDENCIAS
                </h3>

            </div>
          <?php
              $t=mysqli_query($link, "select * from incidencias where trabajadores_cedula=$_SESSION[cedula]");
                    while ($q1= mysqli_fetch_assoc($t)) {
                    $existe=1;
                    $tipo_i=$q1[status];
              }

           ?>



            <!--CONTENT-->
           <div class="container-fluid">
				<div class="table-responsive">
            <?php if($existe==1){ ?>
					<table class="table table-dark table-sm">
						<thead>
							<tr class="text-center roboto-medium">
								<th>ID</th>
								<th>EQUIPO</th>
								<th>DESCRIPCIÓN</th>
                <th>STATUS</th>
                <th>FECHA CREACIÓN</th>
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
                $totalfila=mysqli_query($link, "select count(*) as total from incidencias where trabajadores_cedula=$_SESSION[cedula]");
                      while ($q= mysqli_fetch_assoc($totalfila)) {
                      $total = $q["total"];
                }

                $varif=mysqli_query($link, "select * from incidencias where trabajadores_cedula=$_SESSION[cedula] LIMIT $offset, $limit");
                      while ($row= mysqli_fetch_assoc($varif)) {

               ?>
							<tr class="text-center" <?php if($row["status"]==0){ ?>style="background-color: #FEDDD4;"<?php } ?><?php if($row["status"]==1){ ?>style="background-color: #ffe2d1;"<?php } ?><?php if($row["status"]==2){ ?>style="background-color: #E1E4CC;"; <?php } ?> <?php if($row["status"]==3||$row["status"]==4){ ?>style="background-color: #e1f0c4;"<?php } ?>>
								<td><?php echo  $row["id"]; ?></td>
								<td><?php echo  $row["equipo"]; ?></td>
								<td><?php echo  $row["descripcion"]; ?></td>
                <td><?php if(!$row["status"])echo  "Sin asignación de técnico";if($row["status"]==1)echo "En proceso";if($row["status"]==2){?>
                  <form action="">
                    <button type="button" class="btn btn-warning">
                        <a href="calificar-incidencia.php?id=<?php echo  $row["id"]; ?>" class="btn btn-success">
                          Atendida Esperando por calificar
                        </a>
                    </button>
                  </form>
                <?php }
                if($row["status"]==3)
                  echo "Solucionada";
                if($row["status"]==4)
                  echo "Procesada sin solución";   ?>
              </td>


                <td><?php echo date("d/m/y g:i A",strtotime($row["fecha_ini"]));  ?></td>
                <td>
                <form action="">
                    <button type="button" class="btn btn-warning">
                  <?php if(!$row["status"]){ ?>
                  <a href="actualizar-incidencias.php?id=<?php echo  $row["id"]; ?>" class="btn btn-success">
                      <i class="fas fa-sync-alt"></i>
                  </a>
                <?php  }if($row["status"]==1){    ?>
                  <i class="fas fa-history"></i>
                <?php  }   ?>
                <?php  if($row["status"]==2){    ?>
                 <i class="fas fa-spinner"></i>
                 <?php  }   ?>
                 <?php  if($row["status"]==3){    ?>
                  <i class="fas fa-smile-beam"></i>
                  <?php  }   ?>
                  <?php  if($row["status"]==4){    ?>
                   <i class="fas fa-meh"></i>
                   <?php  }   ?>
                 </button>
               </form>
                </td>
                <td>
                  <form action="">
                    <button type="button" class="btn btn-warning">
                        <?php if(!$row["status"]){ ?>
                        <a href="lista-incidencias-usuario.php?id=<?php echo  $row["id"]; ?>" class="btn btn-success">
                          <i class="far fa-trash-alt"></i>
                        </a>
                       <?php  }if($row["status"]==1){    ?>
                         <i class="fas fa-history"></i>
                       <?php  }   ?>
                       <?php  if($row["status"]==2){    ?>
                        <i class="fas fa-spinner"></i>
                        <?php  }   ?>
                        <?php  if($row["status"]==3){    ?>
                         <i class="fas fa-smile-beam"></i>
                         <?php  }   ?>
                         <?php  if($row["status"]==4){    ?>
                          <i class="fas fa-meh"></i>
                          <?php  }   ?>
                    </button>
                  </form>
                </td>

                              <?php    }

                                       if ($_GET["id"]) {
                                          mysqli_query($link,"delete from incidencias where id=$_GET[id]  limit 1 ");
                                          echo"<script>
                                                swal({ title: '¡Excelente!',
                                                      text: 'Se ha eliminado satisfactoriamente.',
                                                      icon: 'success'}).then(okay => {
                                                      if (okay) {
                                                      window.location.href = 'lista-incidencias-usuario.php';
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
            <?php }else echo "Aún no has generado ninguna incidencia"; ?>
				</nav>
			</div>

        </section>




    </main>

  	<?php include("footer.php"); ?>
