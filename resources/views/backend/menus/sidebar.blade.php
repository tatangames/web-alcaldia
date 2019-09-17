
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{ asset('/images/LOGO_2_-_copia.png') }}" alt="Admin Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Panel de Control</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
            <a href="{{ url('/admin/inicio') }}" target="frameprincipal" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Inicio
                
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('/admin/listarslider') }}" target="frameprincipal" class="nav-link">
              <i class="nav-icon fas fa-images"></i>
              <p>
                Slider
                
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{ url('/admin/listarprograma') }}" target="frameprincipal" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Programas Municipales
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/admin/listarservicio') }}" target="frameprincipal" class="nav-link">
              <i class="nav-icon fas fa-university"></i>
              <p>
                Servicios Municipales
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/admin/listarnoticia') }}" target="frameprincipal" class="nav-link">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>
                Noticias
                
              </p>
            </a>
          </li>

         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

