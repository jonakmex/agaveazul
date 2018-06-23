@extends('common.user')

@section('content')


<div class="container">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="{{route('cuentas.store')}}" method="POST">
                    {{ csrf_field () }}
					<div class="modal-header">
						<h4 class="modal-title">Crear Cuenta</h4>
						<a href="{{route('cuentas.index')}}" class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
					</div>
					<div class="modal-body">
						<div class="form-group @php($err_descripcion = $errors->has('descripcion')?'has-error':'') {{$err_descripcion}}">
							<label for="descripcion">Descripcion</label>
							 <input type="text" value="{{ old('descripcion') }}"  name="descripcion" id="descripcion" class="form-control"/ required>
							 @if ($errors->has('descripcion'))
							 	<span class="help-block">{{ $errors->first('descripcion') }}</span>
							 @endif
						</div>
            <div class="form-group @php($err_saldo = $errors->has('saldo')?'has-error':'') {{$err_saldo}}">
							<label for="descripcion">Saldo inicial</label>
							 <input type="text" value="{{ old('saldo') }}" name="saldo" id="saldo" value="0.00" class="form-control"/ required>
							 @if ($errors->has('saldo'))
							 	<span class="help-block">{{ $errors->first('saldo') }}</span>
							 @endif
						</div>
					</div>
					<div class="modal-footer">
                        <a href="{{route('cuentas.index')}}" class="btn btn-default">Cancelar</a>
						<input type="submit" class="btn btn-success" value="Guardar">
					</div>
				</form>
			</div>
		</div>
    </div>

@endsection

@section('scripts')
<!-- InputMask -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.2.6/jquery.inputmask.bundle.min.js"></script>

<script>
Inputmask.extendAliases({
  pesos: {
            prefix: "₱ ",
            groupSeparator: ".",
            alias: "numeric",
            placeholder: "0",
            autoGroup: !0,
            digits: 2,
            digitsOptional: !1,
            clearMaskOnLostFocus: !1
        }
});

$(function () {

    //Money Euro
    $("#saldo").inputmask({ alias : "pesos", prefix: '$' ,removeMaskOnSubmit: true});

});
</script>
@endsection
