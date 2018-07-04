@php($residencial_targets=array('vivienda','residentes'))
@php($finanzas_targets=array('cuentas','cuotas'))

@php($residencial = in_array(Request::path(),$residencial_targets) ? "active treeview" : "treeview-active")
@php($finanzas = in_array(Request::path(),$finanzas_targets) ? "active treeview" : "treeview-active")

@php($viviendas = Request::path()=="vivienda"?"active":"")
@php($residentes = Request::path()=="residentes"?"active":"")
@php($cuotas = Request::path()=="cuotas"?"active":"")
@php($cuentas = Request::path()=="cuentas"?"active":"")

<ul class="sidebar-menu">
<li class="header">MENU</li>
<li class="{{$residencial}}">
  <a href="#">
    <i class="fa fa-dashboard"></i> <span>Residencial</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li class="{{$viviendas}}"><a href="{{route('vivienda.index')}}"><i class="fa fa-circle-o"></i>Viviendas</a></li>
  </ul>
</li>
<li class="{{$finanzas}}">
  <a href="#">
    <i class="fa fa-dashboard"></i> <span>Finanzas</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li class="{{$cuentas}}"><a href="{{route('cuentas.index')}}"><i class="fa fa-circle-o"></i>Cuentas</a></li>
    <li class="{{$cuotas}}"><a href="{{route('cuotas.index')}}"><i class="fa fa-circle-o"></i>Cuotas</a></li>
    <li><a href="{{route('test.sendMail')}}"><i class="fa fa-circle-o"></i>Send Mail</a></li>
  </ul>
</li>
</ul>
