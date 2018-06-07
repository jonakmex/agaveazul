@extends('common.user')

@section('content')


<div class="container">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="{{ route('vivienda.store') }}" method="POST">
                    {{ csrf_field () }}
					<div class="modal-header">
						<h4 class="modal-title">Editar Recibo / Mensualidad / ENERO 2018 / Casa 10</h4>
						<a href="{{route('vivienda.index')}}" class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="descripcion">Importe</label>
							 <input type="text"  name="importe" id="importe" class="form-control"/ required>
						</div>
            <div class="form-group">
							<label for="descripcion">Ajuste</label>
							 <input type="text"  name="importe" id="importe" class="form-control"/ required>
						</div>
            <div class="form-group">
							<label for="descripcion">Nota</label>
							 <input type="text"  name="importe" id="importe" class="form-control"/ required>
						</div>
            <div class="form-group">
							<label for="descripcion">Fecha Limite</label>
							 <input type="text"  name="importe" id="importe" class="form-control"/ required>
						</div>

					</div>
					<div class="modal-footer">
                        <a href="{{route('recibos.show','id=1')}}" class="btn btn-default">Cancelar</a>
						<input type="submit" class="btn btn-success" value="Pagar">
					</div>
				</form>
			</div>
		</div>
    </div>

@endsection
