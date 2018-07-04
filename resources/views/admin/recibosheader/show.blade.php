@extends('common.user')
@section('styles')
<style>
.toolbar {
    float: right;
}

	.table-title .btn {
		color: #fff;
		float: right;
		font-size: 13px;
		border: none;
		min-width: 50px;
		border-radius: 2px;
		border: none;
		outline: none !important;
		margin-left: 10px;
	}
	.table-title .btn i {
		float: left;
		font-size: 21px;
		margin-right: 5px;
	}
	.table-title .btn span {
		float: left;
		margin-top: 2px;
	}
</style>
@endsection
@section('content')


    <!-- Main content -->
    <section class="content">
        <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Recibos {{$reciboHeader != null ? $reciboHeader->cuota->descripcion." | ".$reciboHeader->descripcion : ""}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <table id="tblHeader" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Vivienda</th>
                      <th>Importe</th>
                      <th>Ajuste</th>
                      <th>Total</th>
                      <th>Estado</th>
                      <th>Limite</th>
                      <th>Pago</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($reciboHeader != null)
                      @php($recibos = $reciboHeader->recibos()->paginate(10))
                      @foreach($recibos as $rec)
                      <tr>
                        <td>{{$rec->vivienda->descripcion}}</td>
                        <td>${{number_format($rec->importe, 2, '.', ',')}}</td>
                        <td>${{number_format($rec->ajuste, 2, '.', ',')}}</td>
                        <td>${{number_format($rec->importe+$rec->ajuste, 2, '.', ',')}}</td>
                        <td>
                            @if($rec->estado == 1)
                              <i class="icon ion-md-calendar material-icons" title="Pendiente"></i>
                            @elseif($rec->estado == 2)
                              <i class="icon ion-md-checkmark material-icons" title="Pagado"></i>
                            @elseif($rec->estado == 3)
                              <i class="icon ion-md-warning material-icons" title="Retraso"></i>
                            @endif
                        </td>
                        <td>{{$rec->fecLimite}}</td>
                        <td>{{$rec->fecPago}}</td>
                        <td>
                          @if($rec->estado == 1)
                            <a href="{{route('recibos.payAndBackToRecibos',['rec_id'=>$rec->id])}}" class="edit"><i class="icon ion-md-card material-icons" title="Pagar"></i></a>
                          @elseif($rec->estado == 2)
                            <a href="{{asset($rec->comprobante)}}" target="_blank" class="edit"><i class="icon ion-md-eye material-icons" title="Ver recibo"></i></a>
                          @elseif($rec->estado == 3)
                            <a href="{{asset($rec->comprobante)}}" class="edit"><i class="icon ion-md-card material-icons" title="Pagar"></i></a>
                          @endif
                        </td>
                      </tr>
                      @endforeach
                    @endif
                  </tbody>
                </table>
                {{$recibos->links()}}
                 </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
             <!-- /.box -->
        </div>
        <!-- /.col -->

      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection
@section('scripts')
<script src="{{asset('dashboard/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('dashboard/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script>
  $(function () {
    $("#tblHeader").DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": false,
      "autoWidth": false,
      "dom": '<"toolbar">frtip'
    });

    $("div.toolbar").html('<a href="{{route('recibosHeader.exportar',['id'=>$reciboHeader->id])}}" class="edit"><i class="icon ion-md-download material-icons" title="Exportar"></i></a>');
  });
</script>
@endsection
