@extends('_template.base')


@section('styles')
  <!-- Custom styles for this template -->
  <link href="{{asset('css/starter-template.css')}}" rel="stylesheet">
@endsection

@section('body')
@include('_include.nav')

<main role="main" class="col-md-12">
  @yield('main')
</main><!-- /.container -->

<footer class="footer">
  <div class="container">
    <span class="text-muted">Copyright 2018.</span>
  </div>
</footer>
@endsection
