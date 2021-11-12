<?php include("header.php");
      include("main-container-root.php");

      if($_SESSION["dependencia_id"]>0){
        session_destroy();
        echo "<script>location.href='index.php';</script>";
      }

 ?>


    <!-- Page header -->
    <div class="full-box page-header">
      <h3 class="text-left">
        <i class="fab fa-dashcube fa-fw"></i> &nbsp; ESCRITORIO
      </h3>
    </div>

    <!-- Content -->
    <div class="full-box tile-container">

      <a href="lista-trabajadores.php" class="tile">
        <div class="tile-tittle">Trabajadores</div>
        <div class="tile-icon">
          <i class="fas fa-users fa-fw"></i>
          <p><?php

                $totalclientes=mysqli_query($link, "select count(*) as total from trabajadores where dependencias_id>0");
                while ($q= mysqli_fetch_assoc($totalclientes)) {
                $total = $q["total"];
                }
                echo $total;

          ?> Registrados</p>
        </div>
      </a>

      <a href="lista-dependencias.php" class="tile">
        <div class="tile-tittle">Dependencias</div>
        <div class="tile-icon">
          <i class="fas fa-pallet fa-fw"></i>
          <p><?php

                $totalclientes=mysqli_query($link, "select count(*) as total from dependencias");
                while ($q= mysqli_fetch_assoc($totalclientes)) {
                $total = $q["total"];
                }
                echo $total;

          ?>  Registrados</p>
        </div>
      </a>

      <a href="lista-tecnicos.php" class="tile">
        <div class="tile-tittle">Técnicos</div>
        <div class="tile-icon">
          <i class="fas fa-user-tie fa-fw"></i>
          <p><?php

                $totalventas=mysqli_query($link, "select count(*) as total from tecnicos");
                while ($q= mysqli_fetch_assoc($totalventas)) {
                $total = $q["total"];
                }
                echo $total;

          ?> Registrados</p>
        </div>
      </a>

      <!-- <a href="user-list.html" class="tile">
        <div class="tile-tittle">Usuarios</div>
        <div class="tile-icon">
          <i class="fas fa-user-secret fa-fw"></i>
          <p>50 Registrados</p>
        </div>
      </a> -->
    </div>


  </section>
</main>

<?php include("footer.php"); ?>
