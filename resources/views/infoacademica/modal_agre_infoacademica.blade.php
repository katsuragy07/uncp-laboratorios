@inject('m_laboratorio','App\Models\Laboratorio')
@inject('m_persona','App\Models\Persona')
@inject('m_asignatura','App\Models\Asignatura')
@inject('m_unidadmedida','App\Models\Unidad_medida')
@inject('m_proveedor','App\Models\Proveedor')
@inject('funciones','App\Http\Controllers\FuncionesController')
<script>
$(function(){
	$('#modal_mante').modal('show');
})
recargarAjaxUbigeo();
</script>
<div class="modal fade" id="modal_mante" tabindex="-1" role="dialog" aria-labelledby="largemodal" aria-hidden="true">
		<div class="modal-dialog modal-lg " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="largemodal1"> <i class="fa fa-plus"></i> Agrega Materiales, Insumo y Equipos</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form class="form-horizontal" action="{{ route('guardar.agre_infoacademica') }}" method="POST" enctype="multipart/form-data">
					@csrf
				<div class="modal-body">
						
					
					
					<div class="form-group row">
						<label class="col-md-3 form-label">Laboratorio</label>
						<div class="col-md-6">

							<select name="laboratoriodet_id" id="laboratoriodet_id" required="" class="form-control">
								<option value="">Seleccionar...</option>
								@foreach($laboratorio_det as $laboratorio)
								<option @if($laboratorio->id == @$info->laboratoriodet_id) selected @endif value="{{ $laboratorio->id }}">{{ $laboratorio->full_name }}</option>
								@endforeach
							</select>
						</div>
					</div> 

					<div class="form-group row">
						<label class="col-md-3 form-label">Asignatura</label>
						<div class="col-md-9">
							<select name="asignatura_id" id="asignatura_id" required="" class="form-control">
								<option value="">-- Seleccionar --</option>
								@foreach($m_asignatura::orderby('nom_asignatura','ASC')->get() as $asignatura)
								<option @if($asignatura->id == @$info->asignatura_id) selected @endif value="{{ $asignatura->id }}">{{ $asignatura->cod_asignatura.' - '.$asignatura->nom_asignatura }}</option>
								@endforeach
							</select>
						</div>
					</div>
					 <!--INICIO DETALLE-->				
					 <div class="form-group row">
						<div class="table-responsive">
							<table id="tb_table" class="table">
								<thead>
									<tr>
										<th>Item</th>
										<th>Tipo</th>
										<th>Nombre</th>
										<th>Cantidad</th>
										
									</tr>
								</thead>
								<tbody> 
									<?php $i = 1; ?>	
									@foreach($actividad_infoacademica  as $fila)
											<tr> 
												<td> <?php $i; ?></td> 
												<td>
													<select id="tipo_equipo_id{{ $i }}" name="tipo_equipo_id[]" required="" class="form-control">
													<option value="">Seleccionar...</option>
														@foreach($tipo_equipo as $t_equipo)
														<option @if($t_equipo->id == @$fila->tipo_equipo_id) selected @endif value="{{ $t_equipo->id }}">{{ $t_equipo->tipo_equipo }}</option>
														@endforeach
													</select>
												</td>
												<td><input type="text" class="form-control" id="descripcion{{ $i }}" name="descripcion[]" required="" value="{{ $fila->descripcion }}"></td>
												<td><input type="text" class="form-control" id="cantidad{{ $i }}" name="cantidad[]" required="" value="{{ $fila->cantidad }}"></td>
												<td class='info' width='5%' align='center'><a href='javascript:void(0);' class='elimina btn' title = 'Quitar Horario'><i class='glyphicon glyphicon-remove-circle txt-color-red'></i></a></td>
											</tr>
											
									@endforeach
								</tbody>
							</table>

						  	
						</div>
						<div class="col-lg-7">
							<a href="javascript:void(0);" onclick="agregar();" class="btn btn-outline-success " title="Agregar">
						  		<i class="fa fa-plus "></i>
						  	</a>
						</div>
						
					

						
					<!--<div class="col-lg-5">
							<div class=""><strong>Cantidad:</strong> <span class="badge badge-primary mt-2" id="info_cant">0</span> <span id="info_cant_um"></span></div>
							<div class=""><strong>Cantidad:</strong> <span class="badge badge-info mt-2" id="info_cant_min">0</span> <span id="info_cant_um_min"></span></div>
						</div> -->
					</div> <!--FIN DETALLE-->


								
								
				

					
				</div> <!-- fin del modal body -->
				<div class="modal-footer">
					<input type="hidden" name="info_academica_id" value="{{ @$info->id }}">
					<input type="hidden" name="usuario_id" id="usuario_id" value="20">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	<script>
	$(document).ready(function() {
		/*$('#op_calidad').click(function() { $('#aseg_calidad').click(); });
		$('#aseg_calidad').change(function() {
		$('#val_calidad').html($(this)[0].files[0].name);
		});
		$('#op_resultado').click(function() { $('#resultado_inv').click(); });
		$('#resultado_inv').change(function() {
		$('#val_resultado').html($(this)[0].files[0].name);
		});*/
	});

	recargarAjaxPersona();
 	var x_combo_persona = '';
	function abrirModalPersona(tipo,accion){
   		if(accion=='Nuevo'){
   			x_id = '';
   		}else{
   			x_id = $("#"+tipo).val();
   		}
   		x_combo_persona = tipo;
   		var urlnuevo = "{{ route('mant.persona') }}?id="+x_id;
		$( "#div_mantPersona" ).html('Cargando...');
		$( "#div_mantPersona" ).load(urlnuevo );
    }

	function x_fn_insertRS(){
		option = $('#div_OptionPersona').html();
		if(x_combo_persona == 'solicitante_id'){
			$("#solicitante_id").html(option);
			//recargarAjaxPersona();
		}
		 recargarAjaxPersona();
		//console.log('sdfdsf');
		
	}


	item = 0;
	function agregar()
			{   
				item = item + 1;
				cadena ='<tr>'; 
					cadena = cadena + '<td>'+item+'</td>';
					cadena += '<td  >';        
           			cadena += '<select class="form-control" style="width: 100%;" id="tipo_equipo_id" name="tipo_equipo_id[]" required>';
            		cadena += '<option selected="selected"  value="">-SELECCIONE-</option><?php 
              		  $opciones_res[''] = '-Seleccione-';
               		 if(isset($tipo_equipo))
                    if($tipo_equipo){
                    foreach ($tipo_equipo as $filasequipo) {
                       echo  '<option value="'.$filasequipo->id.'">'.$filasequipo->tipo_equipo.'</option>';
                    }
                } 
            ?>';
			cadena += '</select>';
			cadena += '</td>';

					cadena = cadena + '<td><input type="text" autocomplete="off" required="" class="form-control" id="descripcion'+item+'" name="descripcion[]" value=""></td>';
					cadena = cadena + '<td><input type="text" autocomplete="off" required="" class="form-control" id="cantidad'+item+'" name="cantidad[]" value=""></td>';
						
					cadena = cadena + "<td class='info' width='5%' align='center'><a href='javascript:void(0);' class='elimina btn' title = 'Quitar lote'><i class='glyphicon glyphicon-remove-circle txt-color-red'></i></a></td>";
				cadena = cadena + '</tr>';
							
					$("#tb_table tbody").append(cadena);  
					fn_dar_eliminar();  
					$("#tipo_equipo_id"+item).focus();
			}

			function fn_dar_eliminar(){
		$("a.elimina").click(function(){        
				$(this).parents("#tb_table tbody tr").remove();                               
				//sumasubtotal();
		});    
	};
	$("a.elimina").click(function(){        
				$(this).parents("#tb_table tbody tr").remove();                               
				//sumasubtotal();
		});

	</script>

