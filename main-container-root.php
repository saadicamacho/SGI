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
        </figcaption>
      </figure>
      <div class="full-box nav-lateral-bar"></div>
      <nav class="full-box nav-lateral-menu">
        <ul>
          <li>
            <a href="home-root.php"><i class="fab fa-dashcube fa-fw"></i> &nbsp; Escritorio</a>
          </li>

          <li>
            <a href="#" class="nav-btn-submenu"><i class="fas fa-users fa-fw"></i> &nbsp; Trabajadores <i class="fas fa-chevron-down"></i></a>
            <ul>
              <li>
                <a href="agregar-trabajadores.php"><i class="fas fa-plus fa-fw"></i> &nbsp; Agregar Trabajadores</a>
              </li>
              <li>
                <a href="lista-trabajadores.php"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista de Trabajadores</a>
              </li>
            </ul>
          </li>

          <li>
            <a href="#" class="nav-btn-submenu"><i class="fas fa-pallet fa-fw"></i> &nbsp; Dependencias <i class="fas fa-chevron-down"></i></a>
            <ul>
              <li>
                <a href="agregar-dependencias.php"><i class="fas fa-plus fa-fw"></i> &nbsp; Agregar Dependencias </a>
              </li>
              <li>
                <a href="lista-dependencias.php"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista de Dependencias</a>
              </li>
            </ul>
          </li>

          <li>
            <a href="#" class="nav-btn-submenu"><i class="fas fa-user-tie fa-fw"></i> &nbsp; Técnicos <i class="fas fa-chevron-down"></i></a>
            <ul>
              <li>
                <a href="agregar-tecnicos.php"><i class="fas fa-plus fa-fw"></i> &nbsp; Agregar Tecnicos </a>
              </li>
              <li>
                <a href="lista-tecnicos.php"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista de tecnicos</a>
              </li>
            </ul>
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

          <a href="#" class="btn-exit-system">
              <i class="fas fa-power-off"></i>
          </a>
      </nav>
