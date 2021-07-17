<header class="main-header">

  <!-- Logo -->
  <a href="" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>AG</b>V</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg">Agave Azul <b>V</b></span>
  </a>

  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">

        <!-- User Account Menu -->
        <li class="dropdown user user-menu">
          <!-- Menu Toggle Button -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <!-- The user image in the navbar-->
            <img src="{{asset('img/residencial-el-agave-azul2.png')}}" class="user-image" alt="User Image">
            <!-- hidden-xs hides the username on small devices so only the image appears. -->
            <span class="hidden-xs"></span>
          </a>
          <ul class="dropdown-menu">
            <!-- The user image in the menu -->
            <li class="user-header">
              <img src="{{asset('img/residencial-el-agave-azul.png')}}" class="img-circle" alt="User Image">

              <p>
                
                <small></small>
              </p>
            </li>

            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-right">
                <a class="btn btn-default btn-flat" href=""
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Salir') }}
                </a>
                <form id="logout-form" action="/logout" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
              </div>
            </li>
          </ul>
        </li>

      </ul>
    </div>
  </nav>
</header>
