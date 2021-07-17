<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="{{route('home')}}">{{ Auth::user()->name }}</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Residencial</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
            <a class="dropdown-item" href="{{route('vivienda.index')}}">Casas</a>
        </div>
      </li>
    </ul>
    <form id="logout-form" class="form-inline my-2 my-lg-0" action="{{ route('logout') }}" method="POST">
      {{ csrf_field () }}
      <a class="btn btn-outline-success my-2 my-sm-0" href="{{ route('logout') }}"
         onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
          {{ __('Salir') }}
      </a>
    </form>
  </div>
</nav>
