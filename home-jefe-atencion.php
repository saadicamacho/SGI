<?php include("header.php");
      include("main-container-jefe-atencion.php");



 ?>


    <!-- Page header -->
    <div class="full-box page-header">
      <h3 class="text-left">
        <i class="fab fa-dashcube fa-fw"></i> &nbsp; Busqueda de incidencias por:
      </h3>
    </div>

    <!-- Content -->
    <div class="full-box tile-container">

      <a href="busqueda_incidencias-fecha.php" class="tile">
        <div class="tile-tittle">Fecha</div>
        <div class="tile-icon">
          <i class="fas fa-calendar-week"></i>
        </div>
      </a>

      <a href="busqueda_incidencias-tecnico.php" class="tile">
        <div class="tile-tittle">Técnico</div>
        <div class="tile-icon">
          <i class="fas fa-user-tie fa-fw"></i>
        </div>
      </a>

      <a href="busqueda_incidencias-status.php" class="tile">
        <div class="tile-tittle">Status</div>
        <div class="tile-icon">
          <i class="fas fa-clipboard-check"></i>
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
