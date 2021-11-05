<?php include("header.php");
      include("main-container-coordinador-mantenimiento.php");

 ?>




    <!-- Page header -->
    <div class="full-box page-header">
      <h3 class="text-left">
        <i class="fab fa-dashcube fa-fw"></i> &nbsp; INCIDENCIAS
      </h3>
    </div>



    <!--CONTENT-->
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
        <th>ASIGNAR TÉCNICO</th>

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
        $totalfila=mysqli_query($link, "select count(*) as total from incidencias ");
              while ($q= mysqli_fetch_assoc($totalfila)) {
              $total = $q["total"];
        }

        $varif=mysqli_query($link, "select * from incidencias order by fecha_ini desc LIMIT $offset, $limit" );
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
        <?php if(!$row["status"]){?>
          <form action="">
            <button type="button" class="btn btn-warning">
              <a href="asignar-tecnico-coordinador-mantenimiento.php?id=<?php echo  $row["id"]; ?>" class="btn btn-success">
               <i class="fas fa-user-cog"></i>
              </a>
            </button>
          </form>
        <?php }if($row["status"]>=1){
              $var=mysqli_query($link, "SELECT t.nombre as nombre_tecnico,a.fecha_ini as fecha_asignacion  from tecnicos t, asignaciones a where t.cedula=a.tecnicos_cedula and a.incidencias_id=$row[id] ");
              while ($r= mysqli_fetch_assoc($var)) { echo $r["nombre_tecnico"];
                 $fecha_asignacion=$r["fecha_asignacion"];

               }
              } ?>
        </td>

                      <?php    }


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
