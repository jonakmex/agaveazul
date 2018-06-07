@extends('common.user')

@section('content')


<div class="container">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="{{route('residentes.update',['id'=>$residente->id])}}" method="POST">
                    {{ csrf_field () }}
                    {{ method_field('PUT') }}
					<div class="modal-header">
						<h4 class="modal-title">Registrar Residente</h4>
						<a href="#" class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="nombre">Nombre</label>
							 <input type="text"  name="nombre" id="nombre" value="{{$residente->nombre}}" class="form-control"/ required>
						</div>
            <div class="form-group">
							<label for="telefono">Telefono</label>
							 <input type="text"  name="telefono" id="telefono" value="{{$residente->telefono}}" class="form-control"/ required>
						</div>
            <div class="form-group">
							<label for="email">Correo</label>
							 <input type="text"  name="email" id="email" value="{{$residente->email}}" class="form-control"/ required>
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
