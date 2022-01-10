@inject('m_laboratorio','App\Models\Laboratorio')
@inject('m_persona','App\Models\Persona')
@inject('lstequipo','App\Models\Equipo')
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
					<h5 class="modal-title" id="largemodal1"> <i class="fa fa-plus"></i> Nuevo</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form class="form-horizontal" action="{{ route('guardar_componentes') }}" method="POST" enctype="multipart/form-data" id="frmproy">
					@csrf
				<div class="modal-body">
								
					
					<div class="form-group row">
						<label class="col-md-3 form-label">Equipos</label>
						<div class="col-md-9">
							<select name="equipo_id" id="equipo_id" required="" class="form-control">
								<option value="">-- Seleccionar --</option>
								@foreach($lstequipo::orderby('nom_equipo','ASC')->get() as $equipo)
								<option @if($equipo->id == @$info->equipo_id) selected @endif value="{{ $equipo->id }}">{{ $equipo->nom_equipo }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Nombre Componente</label>
						<div class="col-md-9">
							<input type="text" name="nom_componente" class="form-control"  autocomplete="off"  value="{{ @$info->nom_componente }}">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Marca</label>
						<div class="col-md-4">
							<input type="text" name="marca" class="form-control"  autocomplete="off" value="{{ @$info->marca }}">
						</div>
						<label class="col-xm-2 form-label">Capacidad</label>
						<div class="col-md-4">
							<input type="text" name="capacidad" class="form-control" autocomplete="off" value="{{ @$info->capacidad }}">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-md-3 form-label">Descripción</label>
						<div class="col-md-9">
						<textarea class="form-control" name="descripcion" id="descripcion" rows="3"> {{ @$info->descripcion }}</textarea>
						</div>
					</div>



					<div class="form-group row">
						<label class="col-md-3 form-label">Licencia</label>
						<div class="col-md-9">
						<input type="text" name="flg_original" class="form-control" autocomplete="off" value="{{ @$info->flg_original }}">
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
