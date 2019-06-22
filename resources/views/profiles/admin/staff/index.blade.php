@extends('_template.dashboard')

@section('title')
  <title>Crear Operador</title>
@endsection

@section('styles')
  <link href="{{asset('css/custom-checkbox.css')}}" rel="stylesheet">
  <link href="{{asset('css/custom-table.css')}}" rel="stylesheet">
  <link href="{{asset('css/custom-modal.css')}}" rel="stylesheet">
  <link href="{{asset('css/custom-pagination.css')}}" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('dashboard/plugins/datatables/dataTables.bootstrap.css')}}">
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <section class="content">
        <div class="row">
            <div class="col-xs-12">
            <div class="box">
            <div class="box-header">
              <h3 class="box-title">Usuarios</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table id="tblStaff" class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>Email</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($staff as $item)
                    <tr>
                      <td><a href="#">{{ $item->nombre }}</a></td>
                      <td>{{ $item->apellido }}</td>
                      <td>{{ $item->email}}</td>
                      <td>
                        <a href="#editModal{{$item->id}}" class="edit" data-toggle="modal"><ion-icon  name="create" data-toggle="tooltip" title="Edit"></i></a>
                        <a href="#deleteStaffModal{{$item->id}}" class="delete" data-toggle="modal"><ion-icon name="trash" data-toggle="tooltip" title="Delete"></i></a>
                        <a href="#tokenModal{{$item->id}}" data-toggle="modal"><ion-icon name="person" data-toggle="tooltip" title="Token"></ion-icon></a>
                      </td>
                    </tr>
                    @include('profiles.admin.staff.modal.edit',['name'=>'editModal'.$item->id])
                    @include('profiles.admin.staff.modal.delete',['name'=>'deleteStaffModal'.$item->id])
                    @include('profiles.admin.staff.modal.token',['name'=>'tokenModal'.$item->id])
                    @endforeach
                  </tbody>
                </table>
                {{ $staff->links('_template.paginator', ['results' => $staff]) }}
              </div>
            </div>
             <!-- /.box-body -->
           </div>
           <!-- /.box -->
         </div>
            </div>
        </div>
    </section>
  </div>
  @include('profiles.admin.staff.modal.add',['name'=>'addStaffModal'])
<!-- /.content-wrapper -->
@endsection
@section('scripts')
<!-- DataTables -->
<script src="{{asset('dashboard/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('dashboard/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="https://unpkg.com/ionicons@4.4.4/dist/ionicons.js"></script>
<script src="{{asset('dashboard/js/app.min.js')}}"></script>
<script src="{{asset('js/profiles/admin/staff/index.js')}}"></script>
@endsection