<!-- Main container -->
<main class="full-box main-container">
  <!-- Nav lateral -->
  <section class="full-box nav-lateral">
    <div class="full-box nav-lateral-bg show-nav-lateral"></div>
    <div class="full-box nav-lateral-content">
      <figure class="full-box nav-lateral-avatar">
        <i class="far fa-times-circle show-nav-lateral"></i>
        <figcaption class="roboto-medium text-center">
          <?php echo $_SESSION["nombre"]; ?><br>
          <small class="roboto-condensed-light">
            <?php $var=mysqli_query($link, "select * from dependencias where id=$_SESSION[dependencia_id] ");
                  while ($r= mysqli_fetch_assoc($var)) { echo  $r["nombre"]; } ?>
          </small>
        </figcaption>
      </figure>
      <div class="full-box nav-lateral-bar"></div>
      <nav class="full-box nav-lateral-menu">
        <ul>
          <li>
            <a href="home-jefe-atencion.php"><i class="fab fa-dashcube fa-fw"></i> &nbsp; Escritorio</a>
          </li>
        </ul>
      </nav>
    </div>
  </section>
  <section class="full-box page-content">
      <nav class="full-box navbar-info">
          <a href="#" class="float-left show-nav-lateral">
              <i class="fas fa-exchange-alt"></i>
          </a>

          <a href="actualizar-usuario-jefe-atencion.php?id=<?php echo $_SESSION["cedula"]; ?>">
              <i class="fas fa-user-cog"></i>
          </a>

          <a href="#" class="btn-exit-system">
              <i class="fas fa-power-off"></i>
          </a>
      </nav>
