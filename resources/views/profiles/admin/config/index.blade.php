@extends('_template.dashboard')

@section('title')
  <title>Home</title>
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
            <div class="col-xs-6">
              <div class="box">
              <form method="POST" action="{{route('config.store')}}">
              {{ csrf_field () }}
              <table class="table table-hover">
                    <thead>
                      <tr>
                      <th>Propiedad</th>
                      <th width="10%">
            						Estado
            					</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($items as $item)
                      <tr>
                        <td>{{$item['key']}}</td>
                        <td>
                          <span class="custom-checkbox">
            								<input type="checkbox" id="checkbox1" name="enabled[]" {{$item['checked']}} value="{{$item['key']}}">
            								<label for="checkbox1"></label>
            							</span>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  
                  <div class="modal-footer">
	                    <button type="submit" class="btn btn-success enviar" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Procesando...">
                        Guardar
                      </button>
	                </div>
                  </form>
              </div>
            </div>
        </div>
    </section>
  </div>

<!-- /.content-wrapper -->
@endsection
@section('scripts')
<!-- DataTables -->
<script src="{{asset('dashboard/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('dashboard/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="https://unpkg.com/ionicons@4.4.4/dist/ionicons.js"></script>
<script src="{{asset('dashboard/js/app.min.js')}}"></script>
<script src="{{asset('js/home.js')}}"></script>
@endsection