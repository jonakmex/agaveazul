@extends('common.user')

@section('content')

<section class="content-header">
	<h1>
		{{$vivienda->descripcion}}
		<small>Editar</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="{{route('vivienda.index')}}">Viviendas</a></li>
		<li class="active">{{$vivienda->descripcion}}</li>
	</ol>
</section>

<div class="container">
		<div class="modal-dialog">
			<div class="modal-content">
        <form action="{{ route('vivienda.update',['id'=>$vivienda->id]) }}" method="POST">
                    {{ csrf_field () }}
                    {{ method_field('PUT') }}
					<div class="modal-header">
						<h4 class="modal-title">Editar Vivienda</h4>
						<a href="{{route('vivienda.index')}}" class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="descripcion">Descripcion</label>
							 <input type="text" value="{{$vivienda->descripcion}}" name="descripcion" id="descripcion" class="form-control"/ required>
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
