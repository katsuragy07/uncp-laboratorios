@inject('m_laboratorio','App\Models\Laboratorio')
@inject('m_persona','App\Models\Persona')
@inject('m_unidadmedida','App\Models\Unidad_medida')
@inject('m_proveedor','App\Models\Proveedor')
<script>
$(function(){
	$('#modal_mante').modal('show');
})
</script>
<div class="modal fade" id="modal_mante" tabindex="-1" role="dialog" aria-labelledby="largemodal" aria-hidden="true">
		<div class="modal-dialog modal-lg " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="largemodal1"> <i class="fa fa-plus"></i> Nuevo Equipo</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form class="form-horizontal" action="{{ route('guardar.equipo') }}" method="POST">
					@csrf
				<div class="modal-body">
					<div class="form-group row">
						<label class="col-md-3 form-label">Laboratorio</label>
						<div class="col-md-6">

							<select name="laboratorio_id" required="" class="form-control" >
								<option value="">Seleccionar...</option>
								@foreach($m_laboratorio::orderby('nombre_lab','ASC')->get() as $laboratorio)
								<option @if($laboratorio->id == @$info->laboratorio_id) selected @endif  value="{{ $laboratorio->id }}">{{ $laboratorio->nombre_lab }}</option>
								@endforeach
							</select>
						</div>
					</div>	
					<div class="form-group row">
						<label class="col-md-3 form-label">Cod Patrimonial</label>
						<div class="col-md-9">
							<input type="text" name="cod_patrimonio" class="form-control" value="{{ @$info->cod_patrimonio }}">
						</div>
					</div>				
					<div class="form-group row">
						<label class="col-md-3 form-label">Nombre Equipo</label>
						<div class="col-md-9">
							<input type="text" name="nom_equipo" class="form-control"  required="" value="{{ @$info->nom_equipo }}">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Ubicación</label>
						<div class="col-md-9">
							<input type="text" name="ubicacion" class="form-control"  required="" value="{{ @$info->ubicacion }}">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Responsable</label>
						<div class="col-md-6">
							<select name="responsable_id" class="form-control" required="" >
								<option value="">-- Seleccionar --</option>
								@foreach($m_persona::orderby('apellidos','ASC')->get() as $persona)
								<option @if($persona->id == @$info->responsable_id) selected @endif value="{{ $persona->id }}">{{ $persona->nombres }} {{ $persona->apellidos }}</option>
								@endforeach
							</select>
						</div>
					</div>
				 
					<div class="form-group row">
						<label class="col-md-3 form-label">Proveedor</label>
						<div class="col-md-6">
							<select name="proveedor_id" class="form-control"  >
								<option value="">-- Seleccionar --</option>
								@foreach($m_proveedor::orderby('ruc','ASC')->get() as $proveedor)
								<option @if($proveedor->id == @$info->proveedor_id) selected @endif value="{{ $proveedor->id }}">{{ $proveedor->ruc }} {{ $proveedor->proveedor }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Estado</label>
						<div class="col-md-6">
							<select name="estado_equipo" class="form-control"  >
								<option value="">-- Seleccionar --</option>
								<option @if(@$info->estado_equipo =='NU') selected @endif value="NU">Nuevo</option>
								<option @if(@$info->estado_equipo =='BU') selected @endif value="BU">Bueno</option>
								<option @if(@$info->estado_equipo =='RE') selected @endif value="RE">Regular</option>
								<option @if(@$info->estado_equipo =='ML') selected @endif value="ML">Malo</option> 
							</select>
						</div>
					</div>

					 
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id" value="{{ @$info->id }}">
					<input type="hidden" name="unidad_medida_id" value="1"><!--La unidad de medida de equipo es 1 UNIDAD-->
					<input type="hidden" name="tipo_equipo_id" value="1"><!-- 1 EQUIPO DE ESPECIALIDAD-->
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</div>
				</form>
			</div>
		</div>
	</div>