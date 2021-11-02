<?php include("header.php");
 ?>
<body>

  <?php
      include("main-container-jefe-atencion.php");
   ?>

            <!--CONTENT-->
            <div class="container-fluid">
            	<div class="container-fluid form-neon">
                    <div class="container-fluid">

                        <form action="" autocomplete="off">
                          <fieldset>
                            <legend><i class="far fa-plus-square"></i> &nbsp; Seleccionar técnico para visualizar incidencias asignadas</legend>
                            <div class="container-fluid">
                              <div class="row">
                                <div class="col-12 col-md-4">
                                  <div class="form-group">
                                    <select class="form-control" name="buscar_tecnico" id="buscar_tecnico">
                                      <option value="" selected="" disabled="">Seleccione una opción</option>
                                        <?php   $varif=mysqli_query($link, "select * from tecnicos");
                                              while ($row= mysqli_fetch_assoc($varif)) { ?>
                                      <option  value="<?php echo  $row["cedula"]; ?>"><?php echo  $row["nombre"]; ?></option>
                                         <?php } ?>
                                    </select>
                                </div>
                              </div>
                            </div>
                          </fieldset>
                          <p class="text-center" style="margin-top: 40px;">
                            <button type="submit" name="buscar_tecnico_b" class="btn btn-raised btn-info btn-sm"><i class="fas fa-search-dollar fa-fw"></i> &nbsp; Buscar</button>
                          </p>
                        </form>
                        <?php

                        if($_GET["buscar_tecnico"]){

                            $varif5=mysqli_query($link, "select incidencias_id from asignaciones where 	tecnicos_cedula='".$_GET["buscar_tecnico"]."' ");
                                  while ($row5= mysqli_fetch_assoc($varif5)) {
                                    $existe=1;
                                  }

                        }
                         ?>

                <?php   if($_GET["buscar_tecnico"]&&$existe==1){ ?>
              <div class="container-fluid">
       				<div class="table-responsive">
       					<table class="table table-dark table-sm">
       						<thead>
       							<tr class="text-center roboto-medium">
                      <th>ID</th>
                      <th>NOMBRE DEL TRABAJADOR</th>
                      <th>DEPARTAMENTO</th>
                      <th>EQUIPO</th>
                      <th>DESCRIPCIÓN</th>
                      <th>STATUS</th>
                      <th>FECHA CREACIÓN</th>
                      <th>FECHA DE ASIGNACIÓN</th>
                      <th>FECHA DE FINALIZACIÓN</th>
                      <th>TÉCNICO</th>
                      <th>SOLUCIÓN</th>
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
                      $totalfila=mysqli_query($link, "select count(*) as total from asignaciones where 	tecnicos_cedula='".$_GET["buscar_tecnico"]."' ");
                            while ($q= mysqli_fetch_assoc($totalfila)) {
                            $total = $q["total"];
                      }

                      $vari=mysqli_query($link, "select * from asignaciones where tecnicos_cedula='".$_GET["buscar_tecnico"]."' LIMIT $offset, $limit");
                            while ($r= mysqli_fetch_assoc($vari)) {

                      $varif=mysqli_query($link, "select * from incidencias  where id='".$r["incidencias_id"]."' " );
                            while ($row= mysqli_fetch_assoc($varif)) {

                     ?>
                    <tr class="text-center" <?php if($row["status"]==0){ ?>style="background-color: #FEDDD4;"<?php } ?><?php if($row["status"]==1){ ?>style="background-color: #ffe2d1;"<?php } ?><?php if($row["status"]==2){ ?>style="background-color: #E1E4CC;"; <?php } ?> <?php if($row["status"]==3||$row["status"]==4){ ?>style="background-color: #e1f0c4;"<?php } ?> >
                      <td><?php echo  $row["id"]; ?></td>
                      <td><?php $var4=mysqli_query($link, "select * from trabajadores  where cedula=$row[trabajadores_cedula]");
                            while ($ri= mysqli_fetch_assoc($var4)) { echo  $ri["nombre"];} ?></td>
                      <td><?php $var5=mysqli_query($link, "select d.nombre as dependencia from trabajadores t, dependencias d  where t.dependencias_id=d.id and  t.cedula=$row[trabajadores_cedula]");
                                  while ($ro= mysqli_fetch_assoc($var5)) { echo  $ro["dependencia"];} ?></td>
                      <td><?php echo  $row["equipo"]; ?></td>
                      <td><?php echo  $row["descripcion"]; ?></td>
                      <td><?php
                      if(!$row["status"])echo  "Sin asignación de técnico";
                      if($row["status"]==1)echo "En proceso";
                      if($row["status"]==2)
                      echo "Atendida en espera por calificación";
                      if($row["status"]==3)
                        echo "Solucionada";
                      if($row["status"]==4)
                        echo "Procesada sin solución"; ?></td>
                      <td><?php echo date("d/m/y g:i A",strtotime($row["fecha_ini"]));  ?></td>
                      <td>
                        <?php

                            if(!$row["status"])echo  "Sin fecha";
                            if($row["status"]>=1){
                              $var1=mysqli_query($link, "SELECT t.nombre as nombre_tecnico,a.fecha_ini as fecha_asignacion  from tecnicos t, asignaciones a where t.cedula=a.tecnicos_cedula and a.incidencias_id=$row[id] ");
                              while ($r1= mysqli_fetch_assoc($var1)) {
                                  echo  date("d/m/y g:i A",strtotime($r1["fecha_asignacion"]));
                               }
                            }


                       ?>
                     </td>
                     <td>
                       <?php

                           if(!$row["status"])echo  "Sin fecha";
                           if($row["status"]>=1){
                             $var1=mysqli_query($link, "SELECT t.nombre as nombre_tecnico,a.fecha_ini as fecha_asignacion,a.fecha_fin as fecha_final, a.solucion as solucion  from tecnicos t, asignaciones a where t.cedula=a.tecnicos_cedula and a.incidencias_id=$row[id] ");
                             while ($r1= mysqli_fetch_assoc($var1)) {
                               if($r1["fecha_final"])
                                 echo  date("d/m/y g:i A",strtotime($r1["fecha_final"]));
                               else
                                 echo "Sin asignar";
                              }
                           }


                      ?>
                    </td>
                     <td>
                    <?php

                        if(!$row["status"])echo  "Sin asignar";
                        if($row["status"]>=1){
                          $var1=mysqli_query($link, "SELECT t.nombre as nombre_tecnico,a.fecha_ini as fecha_asignacion,a.fecha_fin as fecha_fin, a.solucion as solucion  from tecnicos t, asignaciones a where t.cedula=a.tecnicos_cedula and a.incidencias_id=$row[id] ");
                          while ($r1= mysqli_fetch_assoc($var1)) {
                               if($r1["nombre_tecnico"])
                                 echo  $r1["nombre_tecnico"];
                               else
                                 echo "Sin asignar";

                           }
                        }


                   ?>
               </td>
                <td>
               <?php

                   if(!$row["status"])echo  "Sin asignar";
                   if($row["status"]>=1){
                     $var1=mysqli_query($link, "SELECT t.nombre as nombre_tecnico,a.fecha_ini as fecha_asignacion,a.fecha_fin as fecha_fin, a.solucion as solucion  from tecnicos t, asignaciones a where t.cedula=a.tecnicos_cedula and a.incidencias_id=$row[id] ");
                     while ($r1= mysqli_fetch_assoc($var1)) {
                       if($r1["solucion"])
                         echo  $r1["solucion"];
                       else
                        echo "Sin asignar";
                      }
                   }


              ?>
            </td>


                                    <?php    }

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
                      <?php   }

                      ?>
                    </div>

            	</div>

           <?php
           if(isset($_GET["buscar_tecnico_b"])&&!$_GET["buscar_tecnico"]){
             echo"<script>
                   swal({ title: '¡Opp..!',
                         text: 'Selecione un técnico para visualizar las incidencias asignadas.',
                         icon: 'error'}).then(okay => {
                         if (okay) {
                         window.location.href = 'busqueda_incidencias-tecnico.php';
                         }
                   });
                  </script>";
           }
           if(isset($_GET["buscar_tecnico_b"])&&$_GET["buscar_tecnico"]&&!$existe){
             echo"<script>
                   swal({ title: '¡Opp..!',
                         text: 'Técnico sin asignaciones.',
                         icon: 'error'}).then(okay => {
                         if (okay) {
                         window.location.href = 'busqueda_incidencias-tecnico.php';
                         }
                   });
                  </script>";
           }



           ?>

			</div>
        </section>
    </main>

<?php include("footer.php"); ?>
