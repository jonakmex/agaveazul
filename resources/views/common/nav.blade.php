<!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
        </div>
        
      </div>
     
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      @if(Auth::user()->profile->id == 1)
        @include('admin.nav')
      @elseif(Auth::user()->profile->id == 2)
        @include('tesorero.nav')
      @else
        @include('condomino.nav')
      @endif
    </section>
    <!-- /.sidebar -->
  </aside>