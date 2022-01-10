<?php $m_laboratorio = app('App\Models\Laboratorio'); ?>
<?php $m_persona = app('App\Models\Persona'); ?>
<?php $m_asignatura = app('App\Models\Asignatura'); ?>
<?php $m_unidadmedida = app('App\Models\Unidad_medida'); ?>
<?php $m_proveedor = app('App\Models\Proveedor'); ?>
<?php $m_periodo = app('App\Models\Periodo'); ?>
<?php $funciones = app('App\Http\Controllers\FuncionesController'); ?>
<script>
$(function(){
	$('#modal_mante').modal('show');
})
</script>
<div class="modal fade" id="modal_mante" tabindex="-1" role="dialog" aria-labelledby="largemodal" aria-hidden="true">
		<div class="modal-dialog modal-lg " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="largemodal1"> <i class="fa fa-plus"></i> Nuevo Registro</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form class="form-horizontal" action="<?php echo e(route('guardar.infoacademica')); ?>" method="POST" enctype="multipart/form-data" id="frmproy">
					<?php echo csrf_field(); ?>
				<div class="modal-body">
					<div class="form-group row">
						<label class="col-md-3 form-label">Laboratorio:</label>
						<div class="col-md-6">

							<select name="laboratoriodet_id" id="laboratoriodet_id" required="" class="form-control">
								<option value="">Seleccionar...</option>
								<?php $__currentLoopData = $laboratorio_det; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $laboratorio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option <?php if($laboratorio->id == @$info->laboratoriodet_id): ?> selected <?php endif; ?> value="<?php echo e($laboratorio->id); ?>"><?php echo e($laboratorio->full_name); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
					</div> 		
					<div class="form-group row">
						<label class="col-md-3 form-label">Semestre Académico:</label>
						<div class="col-md-6">

							<select name="periodo_id" id="periodo_id" required="" class="form-control">				
								<option value="">-- Seleccionar --</option>
								<?php $__currentLoopData = $m_periodo::orderby('periodo','DESC')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $periodo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option <?php if($periodo->id == @$info->periodo_id): ?> selected <?php endif; ?> value="<?php echo e($periodo->id); ?>"><?php echo e($periodo->periodo); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
					</div> 			
				
					<div class="form-group row">
						<label class="col-md-3 form-label">Docente:</label>
						<div class="col-md-7">
							<select  id='docente_id' name="docente_id"  style="width: 100%;" class="select2AjaxPersona">
								<?php if(@$info->docente_id>0): ?>
									<option selected value="<?php echo e($info->docente_id); ?>"><?php echo e($funciones->info_persona($info->docente_id)); ?></option>
								<?php endif; ?>
							</select>	
														
						</div>
						<div class="col-md-2">
							<button type="button" class="btn btn-warning" onclick="abrirModalPersona('docente_id');" > 
                                	<i class="fa fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-success" onclick="abrirModalPersona('docente_id','Nuevo');" > 
                                	<i class="fa fa-plus"></i>
                            </button>
						</div>
					</div>

					
					<div class="form-group row">
						<label class="col-md-3 form-label">Asignatura:</label>
						<div class="col-md-9">
							<select name="asignatura_id" id="asignatura_id" required="" class="form-control">
								<option value="">-- Seleccionar --</option>
								<?php $__currentLoopData = $m_asignatura::orderby('nom_asignatura','ASC')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asignatura): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option <?php if($asignatura->id == @$info->asignatura_id): ?> selected <?php endif; ?> value="<?php echo e($asignatura->id); ?>"><?php echo e($asignatura->cod_asignatura.' - '.$asignatura->nom_asignatura); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
					</div>
					

					<div class="form-group row">
						<label class="col-md-3 form-label">Horas Prácticas:</label>
						<div class="col-md-4">
							<input type="text" name="hra_academica" autocomplete="off" class="form-control"  value="<?php echo e(@$info->hra_academica); ?>">
						</div>
						<label class="col-xm-2 form-label">Aforo:</label>
						<div class="col-md-4">
							<input type="number" name="aforo" autocomplete="off" class="form-control"  value="<?php echo e(@$info->aforo); ?>">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-md-3 form-label">Fecha Inicio:</label>
						<div class="col-md-4">
							<input type="date" required name="fecha_inicio" class="form-control"  value="<?php echo e(@$info->fecha_inicio); ?>">
						</div>
						<label class="col-xm-2 form-label">Fecha Fin:</label>
						<div class="col-md-4">
							<input type="date" required name="fecha_fin" class="form-control"  value="<?php echo e(@$info->fecha_fin); ?>">
						</div>
					</div>
				

					<div class="form-group row">
						<label class="col-md-3 form-label">Calendario de Uso:</label>
						<div class="col-md-9">
							<input type="file" name="calendario_uso" id="calendario_uso" accept=".pdf" class="form-control"  value="<?php echo e(@$info->calendario_uso); ?> " style="display:none;">
							<div class="flex mt-2" style="padding: 5px;align-items: center;text-align: center;border-radius: 5px;border: dashed 1px #29327f;cursor: pointer;color: #29327f;" id="op_contrato">
								<i class="las la-cloud-upload-alt" style="font-size: 40px;"></i> 
							</div>
							<div class="flex m-2" style="color: #29327f;font-size: 1.1rem;max-width: 100%;" id="val_contrato"></div>

							<?php 
								if(@$info->calendario_uso!=''){
								?><a href="files/infoacademica/<?php echo e(@$info->calendario_uso); ?>" class="text-info f_calendario_uso" target="_blank" title="Descargar"><?php  echo @$info->calendario_uso; ?></a>
								<input type="hidden" name="f_calendario_uso" id="f_calendario_uso" value="<?php echo e(@$info->calendario_uso); ?>">
								<i onclick="elimfile('f_calendario_uso');" class="f_calendario_uso fa fa-lg fa-times-circle  txt-color-red" style="cursor: pointer;"></i>

							<?php }?>


						</div>
					</div>
					 
					<div class="form-group row">
						<label class="col-md-3 form-label">Guia/Manual:</label>
						<div class="col-md-9">
							<input type="file" name="guia_manual" id="guia_manual"  accept=".pdf" class="form-control"  value="<?php echo e(@$info->guia_manual); ?>" style="display:none;">
							<div class="flex mt-2" style="padding: 5px;align-items: center;text-align: center;border-radius: 5px;border: dashed 1px #29327f;cursor: pointer;color: #29327f;" id="op_guia_manual">
								<i class="las la-cloud-upload-alt" style="font-size: 40px;"></i> 
							</div>
							<div class="flex m-2" style="color: #29327f;font-size: 1.1rem;max-width: 100%;" id="val_guia_manual" value="<?php echo e(@$info->guia_manual); ?>"></div>

							<?php 
								if(@$info->guia_manual!=''){
								?><a href="files/infoacademica/<?php echo e(@$info->guia_manual); ?>" class="f_guia_manual text-info" target="_blank" title="Descargar"><?php  echo @$info->guia_manual; ?></a>
								<input type="hidden" name="f_guia_manual" id="f_guia_manual" value="<?php echo e(@$info->guia_manual); ?>">
								<i onclick="elimfile('f_guia_manual');" class="f_guia_manual fa fa-lg fa-times-circle  txt-color-red" style="cursor: pointer;"></i>
							<?php }?>


							
						</div>
					</div>

					  
					
					<br><!--INICIO DETALLE-->
					<h5><p>Horario:</p>	</h5>			
					<div class="form-group row">
						<div class="table-responsive">
							<table id="tb_horario" class="table">
								<thead>
									<tr>
										<th>Item</th>
										<th>Dia de la Semana</th>
										<th>Hora Inicio</th>
										<th>Hora Fin</th>
										
									</tr>
								</thead>
								<tbody> 
									<?php $i = 1; ?>	
									<?php $__currentLoopData = $horario; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fila): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr> 
												<td> <?php $i; ?></td> 
												<td>
													<select id="dia_semana<?php echo e($i); ?>" name="dia_semana[]" required="" class="form-control"  >
												
														<option value="Domingo" <?php if($fila->dia_semana == 'Domingo') { echo ' selected="selected"'; } ?>>Domingo</option>
														<option value="Lunes" <?php if( $fila->dia_semana  == 'Lunes') { echo ' selected="selected"'; } ?>>Lunes </option>
														<option value="Martes" <?php if($fila->dia_semana == 'Martes') { echo ' selected="selected"'; } ?>>Martes </option>
														<option value="Miercoles" <?php if($fila->dia_semana  == 'Miercoles') { echo ' selected="selected"'; } ?>>Miercoles</option>
														<option value="Jueves" <?php if($fila->dia_semana  == 'Jueves') { echo ' selected="selected"'; } ?>>Jueves </option>
														<option value="Viernes" <?php if($fila->dia_semana  == 'Viernes') { echo ' selected="selected"'; } ?>>Viernes </option>											
														<option value="Sabado" <?php if($fila->dia_semana  == 'Sabado') { echo ' selected="selected"'; } ?>>Sabado </option>
													</select>
												</td>
												<td><input type="time" class="form-control" id="hora<?php echo e($i); ?>" name="hora[]" required="" value="<?php echo e($fila->hora); ?>"></td>
												<td><input type="time" class="form-control" id="hora_fin<?php echo e($i); ?>" name="hora_fin[]" required="" value="<?php echo e($fila->hora_fin); ?>"></td>
												<td class='info' width='5%' align='center'><a href='javascript:void(0);' class='elimina btn' title = 'Quitar Horario'><i class='glyphicon glyphicon-remove-circle txt-color-red'></i></a></td>
											</tr>
											
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</tbody>
							</table>

						  	
						</div>
						<div class="col-lg-7">
							<a href="javascript:void(0);" onclick="agregarHorario();" class="btn btn-outline-info " title="Agregar Horario">
						  		<i class="fa fa-plus "></i>
						  	</a>
						</div>
						
					

						
					<!--<div class="col-lg-5">
							<div class=""><strong>Cantidad:</strong> <span class="badge badge-primary mt-2" id="info_cant">0</span> <span id="info_cant_um"></span></div>
							<div class=""><strong>Cantidad:</strong> <span class="badge badge-info mt-2" id="info_cant_min">0</span> <span id="info_cant_um_min"></span></div>
						</div> -->
					</div> <!--FIN DETALLE-->






					  <!--INICIO DETALLE-->		
					  <br>
					  <h5><p>Programa(s) que Utilizan el Laboratorio o Taller:</p></h5>	
					  <div class="form-group row">
						<div class="table-responsive">
							<table id="tb_programa" class="table">
								<thead>
									<tr>
										<th>Item</th>
										<th>Nombre del Programa</th>
										<th>Código del Programa</th>
								
										
									</tr>
								</thead>
								<tbody> 
									<?php $i1 = 1; ?>	
									<?php $__currentLoopData = $programa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fila1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr> 
												<td> <?php $i1; ?></td> 
												<td><input type="text" autocomplete="off" class="form-control" id="nom_programa<?php echo e($i1); ?>" name="nom_programa[]" required="" value="<?php echo e($fila1->nom_programa); ?>"></td>
												<td><input type="text" autocomplete="off" class="form-control" id="cod_programa<?php echo e($i1); ?>" name="cod_programa[]" required="" value="<?php echo e($fila1->cod_programa); ?>"></td>
												<td class='info' width='5%' align='center'><a href='javascript:void(0);' class='elimina btn' title = 'Quitar Horario'><i class='glyphicon glyphicon-remove-circle txt-color-red'></i></a></td>
											</tr>
											
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</tbody>
							</table>

						  	
						</div>
					
						
						<br><br><br>
						<div class="col-lg-7">
							<a href="javascript:void(0);" onclick="agregarPrograma();" class="btn btn-outline-info " title="Agregar Programa">
						  		<i class="fa fa-plus "></i>
						  	</a>
						</div>

						
					<!--<div class="col-lg-5">
							<div class=""><strong>Cantidad:</strong> <span class="badge badge-primary mt-2" id="info_cant">0</span> <span id="info_cant_um"></span></div>
							<div class=""><strong>Cantidad:</strong> <span class="badge badge-info mt-2" id="info_cant_min">0</span> <span id="info_cant_um_min"></span></div>
						</div> -->
					</div> <!--FIN DETALLE-->

					

				

						
				
				</div>

				
					
				<div class="modal-footer">
					<input type="hidden" name="id" value="<?php echo e(@$info->id); ?>">
					<input type="hidden" name="tipo_equipo_id" value="2"><!-- 2 Material-->
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</div>
				</form>
			</div>
		</div>
	</div>

	<script>
	$(document).ready(function() {
		$('#op_contrato').click(function() { $('#calendario_uso').click(); });
		$('#calendario_uso').change(function() {
			if(jQuery.isEmptyObject($(this)[0].files[0])){
				$('#val_contrato').html('');	
				return;
			}
			$('#val_contrato').html($(this)[0].files[0].name);
			
		});
		$('#op_guia_manual').click(function() { $('#guia_manual').click(); });
		$('#guia_manual').change(function() {
			if(jQuery.isEmptyObject($(this)[0].files[0])){
				$('#val_guia_manual').html('');	
				return;
			}
			$('#val_guia_manual').html($(this)[0].files[0].name);
		});	
	});


	item = 0;
	function agregarHorario()
			{   
				item = item + 1;
				cadena ='<tr>'; 
					cadena = cadena + '<td>'+item+'</td>';
					cadena = cadena + '<td><select type="text" required="" class="form-control" id="dia_semana'+item+'" name="dia_semana[]"><option value="">Seleccione</option> <option value="Domingo">Domingo</option> <option value="Lunes">Lunes</option><option value="Martes">Martes</option> <option value="Miercoles">Miercoles</option> <option value="Jueves">Jueves</option> <option value="Viernes">Viernes</option> <option value="Sabado">Sabado</option> </select></td>';
					cadena = cadena + '<td><input type="time" required="" class="form-control" id="hora'+item+'" name="hora[]" value=""></td>';
					cadena = cadena + '<td><input type="time" required="" class="form-control" id="hora_fin'+item+'" name="hora_fin[]" value=""></td>';
						
					cadena = cadena + "<td class='info' width='5%' align='center'><a href='javascript:void(0);' class='elimina btn' title = 'Quitar lote'><i class='glyphicon glyphicon-remove-circle txt-color-red'></i></a></td>";
				cadena = cadena + '</tr>';
							
					$("#tb_horario tbody").append(cadena);  
					fn_dar_eliminar();  
					$("#dia_semana"+item).focus();
			}


			item1 = 0;
	function agregarPrograma()
			{   
				item1 = item1 + 1;
				cadena ='<tr>'; 
					cadena = cadena + '<td>'+item1+'</td>';
					cadena = cadena + '<td><input type="text" autocomplete="off" required="" class="form-control" id="nom_programa'+item1+'" name="nom_programa[]" value=""></td>';
					cadena = cadena + '<td><input type="text" autocomplete="off" required="" class="form-control" id="cod_programa'+item1+'" name="cod_programa[]" value=""></td>';
						
					cadena = cadena + "<td class='info' width='5%' align='center'><a href='javascript:void(0);' class='elimina btn' title = 'Quitar lote'><i class='glyphicon glyphicon-remove-circle txt-color-red'></i></a></td>";
				cadena = cadena + '</tr>';
							
					$("#tb_programa tbody").append(cadena);  
					fn_dar_eliminarprograma();  
					$("#nom_programa"+item1).focus();
			}

	
	function fn_dar_eliminar(){
		$("a.elimina").click(function(){        
				$(this).parents("#tb_horario tbody tr").remove();                               
				//sumasubtotal();
		});    
	};
	$("a.elimina").click(function(){        
				$(this).parents("#tb_horario tbody tr").remove();                               
				//sumasubtotal();
		});


	function fn_dar_eliminarprograma(){
		$("a.elimina").click(function(){        
				$(this).parents("#tb_programa tbody tr").remove();                               
				//sumasubtotal();
		});    
	};
	$("a.elimina").click(function(){        
				$(this).parents("#tb_programa tbody tr").remove();                               
				//sumasubtotal();
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
   		var urlnuevo = "<?php echo e(route('mant.persona')); ?>?id="+x_id;
		$( "#div_mantPersona" ).html('Cargando...');
		$( "#div_mantPersona" ).load(urlnuevo );
    }

	function x_fn_insertRS(){
		option = $('#div_OptionPersona').html();
		if(x_combo_persona == 'docente_id'){
			$("#docente_id").html(option);
			//recargarAjaxPersona();
		}
		 recargarAjaxPersona();
		//console.log('sdfdsf');
		
	}


	</script>
<?php /**PATH C:\wamp64\www\sistemauncp\laboratorio\resources\views/infoacademica/modal_form_infoacademica.blade.php ENDPATH**/ ?>