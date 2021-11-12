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
            <a href="home-usuario.php"><i class="fas fa-align-center fa-fw"></i> &nbsp; Formulario de incidencias</a>
          </li>
          <li>
            <a href="lista-incidencias-usuario.php"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Mis listas de incidencias</a>
          </li>

          <!-- <li>
            <a href="#" class="nav-btn-submenu"><i class="fas fa-users fa-fw"></i> &nbsp; Clientes <i class="fas fa-chevron-down"></i></a>
            <ul>
              <li>
                <a href="client-new.php"><i class="fas fa-plus fa-fw"></i> &nbsp; Agregar Cliente</a>
              </li>
              <li>
                <a href="client-list.php"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista de clientes</a>
              </li>
              <li>
                <a href="client-search.php"><i class="fas fa-search fa-fw"></i> &nbsp; Buscar cliente</a>
              </li>
            </ul>
          </li>

          <li>
            <a href="#" class="nav-btn-submenu"><i class="fas fa-pallet fa-fw"></i> &nbsp; Productos <i class="fas fa-chevron-down"></i></a>
            <ul>
              <li>
                <a href="item-new.php"><i class="fas fa-plus fa-fw"></i> &nbsp; Agregar productos</a>
              </li>
              <li>
                <a href="item-list.php"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista de productos</a>
              </li>
              <li>
                <a href="item-search.php"><i class="fas fa-search fa-fw"></i> &nbsp; Buscar productos</a>
              </li>
            </ul>
          </li>

          <li>
            <a href="#" class="nav-btn-submenu"><i class="fas fa-file-invoice-dollar fa-fw"></i> &nbsp; Ventas <i class="fas fa-chevron-down"></i></a>
            <ul>
              <li>
                <a href="ventas-new.php"><i class="fas fa-plus fa-fw"></i> &nbsp; Nueva venta</a>
              </li>
              <li>
                <a href="ventas-list.php"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista de ventas</a>
              </li>
              <li>
                <a href="inventario-search.php"><i class="fas fa-search-dollar fa-fw"></i> &nbsp; Inventario</a>
              </li>
            </ul>
          </li> -->





        </ul>
      </nav>
    </div>
  </section>
  <section class="full-box page-content">
      <nav class="full-box navbar-info">
          <a href="#" class="float-left show-nav-lateral">
              <i class="fas fa-exchange-alt"></i>
          </a>

          <a href="actualizar-usuario.php?id=<?php echo $_SESSION["cedula"]; ?>">
              <i class="fas fa-user-cog"></i>
          </a>

          <a href="#" class="btn-exit-system">
              <i class="fas fa-power-off"></i>
          </a>
      </nav>
