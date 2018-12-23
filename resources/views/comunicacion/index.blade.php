@extends('_template.dashboard')

@section('title')
  <title>Comunicado</title>
@endsection

@section('styles')
  <link href="{{asset('css/custom-checkbox.css')}}" rel="stylesheet">
  <link href="{{asset('css/custom-table.css')}}" rel="stylesheet">
  <link href="{{asset('css/custom-modal.css')}}" rel="stylesheet">
  <link href="{{asset('css/custom-pagination.css')}}" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('dashboard/plugins/datatables/dataTables.bootstrap.css')}}">
  <!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="{{asset('dashboard/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
@endsection

@section('content')
<script type="text/javascript">

</script>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">
      <h1>
        Enviar un comunicado
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Advanced Elements</li>
      </ol>
    </section>

    <!-- Main content -->
   <section class="content">
     <form action="{{route('comunicacion.send')}}" method="POST" enctype="multipart/form-data">
       {{ csrf_field () }}

       <input type="hidden" id="errors" data-errors="{{ $errors->first('vivienda') }}">
     <div class="row">
       <div class="col-md-9">
         <div class="box box-primary">
             <div class="box-header with-border">
               <h3 class="box-title">Escribir comunicado</h3>
             </div>
             <!-- /.box-header -->

             <div class="box-body">
               <div class="form-group">
                 @if ($errors->has('subject'))
  							 	<span class="help-block">{{ $errors->first('subject') }}</span>
  							 @endif
                 <input name="subject" class="form-control" placeholder="Asunto:">
               </div>
               <div class="form-group">
                     @if ($errors->has('compose'))
      							 	<span class="help-block">{{ $errors->first('compose') }}</span>
      							 @endif
                     <textarea name="compose" id="compose-textarea" class="form-control" style="height: 300px">

                     </textarea>
               </div>
               <div class="form-group">
                 <div class="btn btn-default btn-file">
                   <i class="fa fa-paperclip"></i> Attachment
                   <input type="file" id="attachment" name="attachment">
                 </div>
                 <p class="help-block">Max. 32MB</p>
               </div>
             </div>
             <!-- /.box-body -->
             <div class="box-footer">
               <div class="pull-right">
                 <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Enviar</button>
               </div>
             </div>
             <!-- /.box-footer -->
           </div>
           <!-- /. box -->
       </div>
       <!-- /.col (left) -->
       <div class="col-md-3">
           @if ($errors->has('vivienda'))
              <div class="box box-danger">
          @else
              <div class="box box-primary">
           @endif
         <table class="table table-bordered table-hover">
           <thead>
             <tr>
               <th width="10%">
                 <span class="custom-checkbox">
                   <input type="checkbox" id="selectAll">
                   <label for="selectAll"></label>
                 </span>
               </th>
               <th>Vivienda</th>
             </tr>
           </thead>
           <tbody>
             @foreach($viviendas as $vivienda)
             <tr>
               <td>
                 <span class="custom-checkbox">
                   <input type="checkbox" id="checkbox1" name="selected[]" value="{{$vivienda->id}}">
                   <label for="checkbox1"></label>
                 </span>
               </td>
               <td>{{$vivienda->clave}}</td>
             </tr>
             @endforeach
           </tbody>
         </table>
         </div>
       </div>
     </div>
     <!-- /.row -->
   </form>
   </section>
   <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @include('comunicacion.modal.error',['name'=>'errorModal'])

@endsection
@section('scripts')
<!-- DataTables -->
<script src="{{asset('dashboard/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('dashboard/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="https://unpkg.com/ionicons@4.4.4/dist/ionicons.js"></script>
<script src="{{asset('dashboard/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('dashboard/plugins/iCheck/icheck.min.js')}}"></script>
<!-- InputMask -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.2.6/jquery.inputmask.bundle.min.js"></script>
<script src="{{asset('dashboard/js/app.min.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('dashboard/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script src="{{asset('js/comunicado/index.js')}}"></script>
<script>
  $(function () {
    //Add text editor
    $("#compose-textarea").wysihtml5();
  });
</script>
@endsection
