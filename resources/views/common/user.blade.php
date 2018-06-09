@extends('common.base')
@yield('styles')
@section('body')

<body class="hold-transition skin-blue fixed sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  @include('common.header')

  <!-- =============================================== -->

  @include('common.nav')

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  @include('common.footer')

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
@include('_includes.js.jquery')
<!-- Bootstrap 3.3.6 -->
@include('_includes.js.bootstrap')
<!-- SlimScroll -->
@include('_includes.js.slimscroll')
<!-- FastClick -->
@include('_includes.js.fastclick')
<!-- AdminLTE App -->
<script src="{{asset('dashboard/dist/js/app.min.js')}}"></script>

@yield('scripts')
</body>

@endsection
