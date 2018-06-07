<ul class="sidebar-menu">
<li class="header">ADMINISTRACION</li>
<li class="treeview-active">
  <a href="#">
    <i class="fa fa-dashboard"></i> <span>Residencial</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li><a href="{{route('vivienda.index')}}"><i class="fa fa-circle-o"></i>Viviendas</a></li>
    <li><a href="{{route('residentes.index')}}"><i class="fa fa-circle-o"></i>Residentes</a></li>
      <li><a href="../../index2.html"><i class="fa fa-circle-o"></i>Proveedores</a></li>
      <li><a href="../../index2.html"><i class="fa fa-circle-o"></i>Amenidades</a></li>
      <li><a href="../../index2.html"><i class="fa fa-circle-o"></i>Reglamento</a></li>
  </ul>
</li>
<li class="treeview-active">
  <a href="#">
    <i class="fa fa-dashboard"></i> <span>Finanzas</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li><a href="{{route('cuentas.index')}}"><i class="fa fa-circle-o"></i>Cuentas</a></li>
    <li><a href="{{route('cuotas.index')}}"><i class="fa fa-circle-o"></i>Cuotas</a></li>
  </ul>
</li>
</ul>
