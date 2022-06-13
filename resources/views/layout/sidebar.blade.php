<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item  {{ active_class(['/']) }}">
      <a class="nav-link" href="{{ url('/') }}">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    </li>
    <li class="nav-item nav-category">Penentuan Restitusi</li>
    <li class="nav-item {{ active_class(['histori-gangguan']) }}">
      <a class="nav-link" href="{{ url('/histori-gangguan') }}">
        <i class="menu-icon mdi mdi-file"></i>
        <span class="menu-title">Histori Gangguan</span>
      </a>
    </li>
    <li class="nav-item {{ active_class(['restitusi']) }}">
      <a class="nav-link" href="{{ url('/restitusi') }}">
        <i class="menu-icon mdi mdi mdi-access-point"></i>
        <span class="menu-title">Restitusi</span>
      </a>
    </li>
    <li class="nav-item {{ active_class(['kategori-gangguan']) }}">
      <a class="nav-link" href="{{ url('/kategori-gangguan') }}">
        <i class="menu-icon mdi mdi-drawing"></i>
        <span class="menu-title">Kategori Gangguan</span>
      </a>
    </li>
    <li class="nav-item {{ active_class(['konklusi']) }}">
      <a class="nav-link" href="{{ url('/konklusi') }}">
        <i class="menu-icon mdi mdi-responsive"></i>
        <span class="menu-title">Manajemen Konklusi</span>
      </a>
    </li>
    <li class="nav-item {{ active_class(['lokasi']) }}">
      <a class="nav-link" href="{{ url('/lokasi') }}">
        <i class="menu-icon mdi mdi mdi-home-map-marker"></i>
        <span class="menu-title">Lokasi</span>
      </a>
    </li>
    <li class="nav-item nav-category">Accounts</li>
    <li class="nav-item {{ active_class(['users']) }}">
      <a class="nav-link" href="{{ url('/users') }}"> 
        <i class="menu-icon mdi mdi-account-circle-outline"></i>
        <span class="menu-title">User Management</span> 
      </a>
    </li>
  </ul>
</nav>