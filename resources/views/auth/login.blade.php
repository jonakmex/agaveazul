
@extends('_template.public')

@section('title')
  <title>Login</title>
@endsection


@section('body')
<form class="form-signin" method="POST" action="{{ route('login') }}">
  {{ csrf_field () }}
  <div class="text-center mb-4">
    <img class="" src="{{asset('img/residencial-el-agave-azul2.png')}}" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Agave Azul V</h1>
  </div>

      <div class="form-group has-feedback">
        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if ($errors->has('email'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group has-feedback">
        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @if ($errors->has('password'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>

  <div class="checkbox mb-3">
    <label>
      <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Recordarme') }}
    </label>
  </div>

   <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Login') }}</button>

   <div class="checkbox mb-3">
     <label>
       <a href="{{ route('password.request') }}">Olvide mi contraseña</a><br>
     </label>
   </div>
  <p class="mt-5 mb-3 text-muted text-center">&copy; 2017-2018</p>
</form>
@endsection
