@inject('m_laboratorio','App\Models\Laboratorio')
@inject('m_persona','App\Models\Persona')
@inject('m_unidadmedida','App\Models\Unidad_medida')
@inject('m_proveedor','App\Models\Proveedor')
@inject('funciones','App\Http\Controllers\FuncionesController')
<?php $PrivUsuario = $funciones->PrivUsuario();	?>
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
					
					<?php  if(in_array("admin_todo_laboratorio", $PrivUsuario)) {  	?>					
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
					<?php }else{ ?>
						<div class="form-group row">
							<label class="col-md-3 form-label">Laboratorio</label>
							<div class="col-md-9">
								{{ $funciones->Nombre_Laboratorio(Auth::user()->laboratorio_id) }}
								<input type="hidden" name="laboratorio_id" value="{{ Auth::user()->laboratorio_id }}">
							</div>						 
						</div>
					<?php  } ?>
			
					<div class="form-group row">
						<label class="col-md-3 form-label">Nombre Material</label>
						<div class="col-md-9">
							<input type="text" name="nom_equipo" class="form-control"  required="" value="{{ @$info->nom_equipo }}">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Marca</label>
						<div class="col-md-9">
							<input type="text" name="marca" class="form-control"   value="{{ @$info->marca }}">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Especificación</label>
						<div class="col-md-9">
							<input type="text" name="especificacion" class="form-control"  value="{{ @$info->especificacion }}">
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
					<div class="form-group row">
						<label class="col-md-3 form-label">Cantidad</label>
						<div class="col-md-9"> 
							@if(@$info->id>0)
								<input type="number" required="" onkeyup="pasarCantidad();" onmouseup="pasarCantidad();" name="cantidad_lote" id="cantidad_lote" class="form-control"  required="" value="{{ $funciones->cantidad_lote( @$info->id ,@$info->laboratorio_id) }}">
							@else
								<input type="number" required="" onkeyup="pasarCantidad();" onmouseup="pasarCantidad();" name="cantidad_lote[]" id="cantidad_lote" class="form-control"  required="" value="">
							@endif

						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Stock mínimo</label>
						<div class="col-md-9"> 
							<input type="number" required="" name="stock_minimo" id="stock_minimo" class="form-control"  required="" value="{{ @$info->stock_minimo }}">

						</div>
					</div>
					
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id" value="{{ @$info->id }}">
					<input type="hidden" name="tipo_equipo_id" value="2"><!-- 2 Material-->
					<input type="hidden" name="tipo_fiscalizado_id" value="1"><!-- 1 No fiscalizado-->
					<input type="hidden" name="cantidad_min" value="1">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Guardar</button>

					@if(@$info->id=='')
						<input type="hidden" class="form-control"  name="fch_fabricacion[]" value="">
						<input type="hidden" class="form-control"  name="fch_vencimiento[]" value="">
						<input type="hidden" class="form-control" name="lote[]" value="">
					@endif
					<input type="hidden" id="cantidad_lote_min" name="cantidad_lote_min[]" value="{{ $funciones->cantidad_lote( @$info->id ,@$info->laboratorio_id) }}">



				</div>
				</form>
			</div>
		</div>
	</div>

<script>
	function pasarCantidad(){
		cantidad_lote = $('#cantidad_lote').val();
		$('#cantidad_lote_min').val(cantidad_lote)
	}
</script>