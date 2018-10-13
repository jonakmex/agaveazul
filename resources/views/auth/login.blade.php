@extends('_template.public')

@section('title')
  <title>Login</title>
@endsection

@section('body')

<form class="form-signin" method="POST" action="{{ route('login') }}">
  {{ csrf_field () }}
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
  <div class="row">
    <div class="col-xs-8">
      <div class="checkbox icheck">
        <label>
          <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Recordarme') }}
        </label>
      </div>
    </div>
    <!-- /.col -->
    <div class="col-xs-4">
      <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Login') }}</button>
    </div>
    <!-- /.col -->
  </div>
</form>

<a href="{{ route('password.request') }}">Olvide mi contraseña</a><br>

@endsection
