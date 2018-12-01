
@extends('_template.public')

@section('title')
  <title>Register</title>
@endsection


@section('body')
<form class="form-signin" method="POST" action="{{ route('register') }}">
    {{ csrf_field () }}
    <div class="text-center mb-4">
      <img class="" src="{{asset('img/residencial-el-agave-azul2.png')}}" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Agave Azul V</h1>
    </div>

    <div class="form-group has-feedback">


            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{$token->residente->nombre}}" placeholder="Nombre" readonly>

            @if ($errors->has('name'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif

    </div>

    <div class="form-group has-feedback">



            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{$token->residente->email}}" placeholder="Email" readonly>

            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif

    </div>

    <div class="form-group has-feedback">



            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif

    </div>

    <div class="form-group has-feedback">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar" required>

    </div>


    <div class="form-group">
      <input type="hidden" name="profile_id" value="{{$token->profile->id}}">
      <input type="hidden" name="token" value="{{$token->token}}">
    </div>

    <div class="form-group has-feedback">

            <button type="submit" class="btn btn-primary">
                {{ __('Registrar') }}
            </button>

    </div>
</form>
@endsection
