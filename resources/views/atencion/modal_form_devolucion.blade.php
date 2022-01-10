@inject('m_laboratorio','App\Models\Laboratorio')
@inject('m_unidadmedida','App\Models\Unidad_medida')
@inject('m_proveedor','App\Models\Proveedor')
@inject('m_persona','App\Models\Persona')
@inject('m_cargo','App\Models\Cargo')
@inject('funciones','App\Http\Controllers\FuncionesController')
<?php 
	$unidad_medida = $m_unidadmedida::orderby('unidad_medida','ASC')->get();
?>
<script>
$(function(){
	$('#modal_mante').modal('show');
})
</script>
<style type="text/css" >
	#tb_requerimiento p {
		line-height: 12px;
	}
	
</style>
<div class="modal fade" id="modal_mante" tabindex="-1" role="dialog" aria-labelledby="largemodal" aria-hidden="true">
		<div class="modal-dialog modal-lg " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="largemodal1"> <i class="fa fa-rotate-left"></i> Devolución de materiales</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form class="form-horizontal" action="{{ route('guardar.devolucion') }}" method="POST">
					@csrf
				<div class="modal-body"> 

					<div class="form-group row m-0">
						<label class="col-md-3 form-label"><b>Facultad Destino</b></label>
						<div class="col-md-6">
							{{ $infoCab->nom_facultad }}
						</div>
					</div>
					<div class="form-group row m-0">
						<label class="col-md-3 form-label"><b>Laboratorio Destino</b></label>
						<div class="col-md-6">
							{{ $infoCab->nombre_lab }}
						</div>
					</div> 				
					  

					<div class="form-group row m-0">
						<label class="col-md-3 form-label"><b>Encargado del Laboratorio de destino</b></label>
						<div class="col-md-9">
							{{ $infoCab->encargado }}				
						</div>
					</div>

				  
					<div class="form-group row m-0">
						<label class="col-md-3 form-label"><b>Solicitante</b></label>
						<div class="col-md-9">
							{{ $infoCab->responsable }}				
						</div>
					</div>


					<div class="form-group row m-0">
						<label class="col-md-3 form-label"><b>Nota</b></label>
						<div class="col-md-9">
							{{ $infoCab->nota_requerimiento }}				
						</div>
					</div>

				 
 
					<hr>
			 
						 
						<div class="form-group row">
							<div class="table-responsive">
								<table id="tb_requerimiento" class="table table-hover card-table table-vcenter text-nowrap mb-0">
									<thead>
										<tr> 
											<th>Insumo</th>
											 
											<th>Unidad Medida</th>
											<th>Cantidad</th>
											<th>Cant. devolución</th>
											<th class="d-none"></th>
											 
										</tr>
									</thead>
									<tbody> 
										<?php $i = 1; ?>
										@foreach($gridDet  as $fila)

											<tr>
												@if($fila->tipo_equipo_id==1)
													<td><input type="hidden" value="{{ $fila->equipo_id }}" name="equipo_id[]" ><b>{{ $fila->nom_equipo }}</b><p class="mb-0 text-muted fs-13"><b>Código:</b> {{ $fila->cod_patrimonio }}'</p></td>
												@else
													<td><input type="hidden" value="{{ $fila->equipo_id }}" name="equipo_id[]" ><b>{{ $fila->nom_equipo }}</b><p class="mb-0 text-muted fs-13"><b>Marca:</b> {{ $fila->marca }}</p><p class="mb-0 text-muted fs-13"><b>Concentración:</b> {{ $fila->concentracion }}</p><p class="mb-0 text-muted fs-13"><b>Especificación:</b> {{ $fila->especificacion }}</p></td>
												@endif
 
												<td>{{ $fila->unidad_med_min }}</td>'
 
												<td width="15%">
													<input type="number" required min="1"  class="form-control" name="cantidad_atencion_min[]" readonly value="{{ $fila->cantidad_atencion_min }}">
													@if($fila->cantidad_devolucion>0)
													Cant. devuelto:<br>
													<b>{{ $fila->cantidad_devolucion }}</b>
													@endif

												</td>

												@if($fila->tipo_equipo_id==3 or $fila->cantidad_atencion_min<=$fila->cantidad_devolucion)
													<td width="15%"><input type="number" readonly="" class="form-control" name="cantidad_devolucion[]"  value="0" ></td>
												@else
													<td width="15%"><input type="number" required min="0"  class="form-control" name="cantidad_devolucion[]"  value="{{ $fila->cantidad_atencion_min-$fila->cantidad_devolucion }}" max="{{ $fila->cantidad_atencion_min-$fila->cantidad_devolucion }}"></td>
												@endif

												<td class="d-none">
													<input type="hidde" name="detalle_atencion_id[]" value="{{ $fila->detalle_atencion_id }}">
													<input type="hidde" name="tipo_equipo_id[]" value="{{ $fila->tipo_equipo_id }}">
													<input type="hidde" name="lote_equipo_id[]" value="{{ $fila->lote_equipo_id }}">
												</td>
											 

										  	</tr>
										@endforeach
								</tbody>
							</table>

							  	
							</div> 
						</div>
		 
				 
					 
				</div>
				<div class="modal-footer">
					<input type="hidden" name="atencion_id" value="{{ $infoCab->atencion_id }}">
					 
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	<script >
 
	</script>