@extends('common.user')

@section('content')


<div class="container">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="{{route('residentes.store')}}" method="POST">
                    {{ csrf_field () }}
          <input name="vivienda_id" id="vivienda_id" value="{{$vivienda->id}}" hidden/>
					<div class="modal-header">
						<h4 class="modal-title">Registrar Residente</h4>
						<a href="#" class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="nombre">Nombre</label>
							 <input type="text"  name="nombre" id="nombre" class="form-control"/ required>
						</div>
            <div class="form-group">
							<label for="telefono">Telefono</label>
							 <input type="text"  name="telefono" id="telefono" class="form-control"/ required>
						</div>
            <div class="form-group">
							<label for="email">Correo</label>
							 <input type="text"  name="email" id="email" class="form-control"/ required>
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
