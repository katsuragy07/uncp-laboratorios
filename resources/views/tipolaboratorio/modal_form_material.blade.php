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
					<h5 class="modal-title" id="largemodal1"> <i class="fa fa-plus"></i> Nuevo Material</h5>
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
						<label class="col-md-3 form-label">Nombre Material</label>
						<div class="col-md-9">
							<input type="text" name="nom_equipo" class="form-control"  required="" value="{{ @$info->nom_equipo }}">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Marca</label>
						<div class="col-md-9">
							<input type="text" name="marca" class="form-control"  required="" value="{{ @$info->marca }}">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Serie</label>
						<div class="col-md-9">
							<input type="text" name="serie" class="form-control"  required="" value="{{ @$info->serie }}">
						</div>
					</div>
					 
					<div class="form-group row">
						<label class="col-md-3 form-label">Unidad Medida</label>
						<div class="col-md-6">
							<select name="unidad_medida_id" class="form-control" required="" >
								<option value="">-- Seleccionar --</option>
								@foreach($m_unidadmedida::orderby('unidad_medida','ASC')->get() as $unidad)
								<option @if($unidad->id == @$info->unidad_medida_id) selected @endif value="{{ $unidad->id }}">{{ $unidad->unidad_medida }}</option>
								@endforeach
							</select>
						</div>
					</div>
				 
					 
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id" value="{{ @$info->id }}">
					<input type="hidden" name="tipo_equipo_id" value="2"><!-- 2 Material-->
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</div>
				</form>
			</div>
		</div>
	</div>