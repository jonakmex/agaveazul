@extends('common.user')

@section('content')


<div class="container">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="{{ route('vivienda.store') }}" method="POST">
                    {{ csrf_field () }}
					<div class="modal-header">
						<h4 class="modal-title">Crear Vivienda</h4>
						<a href="{{route('vivienda.index')}}" class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="descripcion">Descripcion</label>
							 <input type="text"  name="descripcion" id="descripcion" class="form-control"/ required>
						</div>			
					</div>
					<div class="modal-footer">
                        <a href="{{route('vivienda.index')}}" class="btn btn-default">Cancelar</a>
						<input type="submit" class="btn btn-success" value="Guardar">
					</div>
				</form>
			</div>
		</div>
    </div>

@endsection
