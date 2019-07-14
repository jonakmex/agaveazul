<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{asset('img/residencial-el-agave-azul2.png')}}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{Auth::user()->name}}</p>
        <!-- Status -->
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>



    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="header">MENU</li>
      <li class="treeview">
        <a href="#"><ion-icon class="fa fa-home" name="home"></ion-icon> <span>Residencial</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{route('vivienda.index')}}">Directorio</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#"><ion-icon class="fa fa-calculator" name="calculator"></ion-icon> <span>Finanzas</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{route('cuentas.index')}}">Cuentas</a></li>
          <li><a href="{{route('cuotas.index')}}">Cuotas</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#"><ion-icon class="fa fa-mail" name="mail"></ion-icon> <span>Comunicación</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{route('comunicados.index')}}">Comunicados</a></li>
        </ul>
        <ul class="treeview-menu">
          <li><a href="{{route('documento.index')}}">Documentos</a></li>
        </ul>
        <ul class="treeview-menu">
          <li><a href="{{route('comunicacion.index')}}">Enviar Aviso</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#"><ion-icon class="fa fa-calendar" name="settings"></ion-icon> <span>Reportes</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
        <li><a href="{{route('comunicacion.mora')}}">Inquilinos en Mora</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#"><ion-icon class="fa fa-settings" name="settings"></ion-icon> <span>Sistema</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{route('configura.index')}}"> <span>Configuración</span></a></li>
          <li><a href="{{route('staff.index')}}"> <span>Usuarios</span></a></li>
        </ul>
      </li>
    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>

<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
