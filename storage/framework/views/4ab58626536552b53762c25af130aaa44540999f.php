<?php $m_laboratorio = app('App\Models\Laboratorio'); ?>
<?php $m_persona = app('App\Models\Persona'); ?>
<?php $m_asignatura = app('App\Models\Asignatura'); ?>
<?php $m_unidadmedida = app('App\Models\Unidad_medida'); ?>
<?php $m_proveedor = app('App\Models\Proveedor'); ?>
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
				<form class="form-horizontal" action="<?php echo e(route('guardar_software')); ?>" method="POST" enctype="multipart/form-data" id="frmproy">
					<?php echo csrf_field(); ?>
				<div class="modal-body">
					<div class="form-group row">
						<label class="col-md-3 form-label">Laboratorio</label>
						<div class="col-md-6">

							<select name="laboratorio_id" id="laboratorio_id" required="" class="form-control">
								<option value="">Seleccionar...</option>
								
								<?php $__currentLoopData = $m_laboratorio::orderby('nombre_lab','ASC')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $laboratorio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option <?php if($laboratorio->id == @$info->laboratorio_id): ?> selected <?php endif; ?> value="<?php echo e($laboratorio->id); ?>"><?php echo e($laboratorio->nombre_lab); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
					</div> 				
					
					
					<div class="form-group row">
						<label class="col-md-3 form-label">Software</label>
						<div class="col-md-9">
							<input type="text" name="nom_software" class="form-control" required="" value="<?php echo e(@$info->nom_software); ?>">
						</div>
					</div>
					
					<div class="form-group row">
						<label class="col-md-3 form-label">Versión</label>
						<div class="col-md-9">
							<input type="text" name="version" class="form-control"  value="<?php echo e(@$info->version); ?>">
						</div>
					</div>

					

					<div class="form-group row">
						<label class="col-md-3 form-label">Compatibilidad con S.O</label>
						<div class="col-md-9">
							<input type="text" name="compatibilidad_so" class="form-control"  value="<?php echo e(@$info->compatibilidad_so); ?>">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-md-3 form-label">Año Adquisición</label>
						<div class="col-md-9">
							<input type="number" name="anio_adquisicion" class="form-control"  value="<?php echo e(@$info->anio_adquisicion); ?>">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-md-3 form-label">Fecha Inicio de Licencia</label>
						<div class="col-md-4">
							<input type="date" name="fch_ini_vigencia" class="form-control"  value="<?php echo e(@$info->fch_ini_vigencia); ?>">
						</div>
						<label class="col-xm-1 form-label">Fecha Fin de Licencia</label>
						<div class="col-md-3">
							<input type="date" name="fch_fin_vigencia" class="form-control"  value="<?php echo e(@$info->fch_fin_vigencia); ?>">
						</div>
					</div>
				 

					
					<div class="form-group row">
						<label class="col-md-3 form-label">Licencia para Cantida de Máquinas</label>
						<div class="col-md-9">
							<input type="number" name="cant_maquina" class="form-control"  value="<?php echo e(@$info->cant_maquina); ?>">
						</div>
					</div>


					

						
					<div class="form-group row">
						<label class="col-md-3 form-label">Personal Capacitado</label>
						<div class="col-md-9">
							<input type="text" name="personal_capacitado" class="form-control"  value="<?php echo e(@$info->personal_capacitado); ?>">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-md-3 form-label">Carta de Garantia</label>
						<div class="col-md-9">
							<input type="file" name="carta_garantia" id="carta_garantia" accept=".pdf" class="form-control"  value="<?php echo e(@$info->carta_garantia); ?> " style="display:none;">
							<div class="flex mt-2" style="padding: 5px;align-items: center;text-align: center;border-radius: 5px;border: dashed 1px #29327f;cursor: pointer;color: #29327f;" id="op_carta_garantia">
								<i class="las la-cloud-upload-alt" style="font-size: 40px;"></i> 
							</div>
							<div class="flex m-2" style="color: #29327f;font-size: 1.1rem;max-width: 100%;" id="val_carta_garantia"></div>

							<?php 
								if(@$info->carta_garantia!=''){
								?><a href="files/software/<?php echo e(@$info->carta_garantia); ?>" class="f_carta_garantia text-info" target="_blank" title="Descargar"><?php  echo @$info->carta_garantia; ?></a>
								<input type="hidden" name="f_carta_garantia" id="f_carta_garantia" value="<?php echo e(@$info->carta_garantia); ?>">
								<i onclick="elimfile('f_carta_garantia');" class="f_carta_garantia fa fa-lg fa-times-circle  txt-color-red" style="cursor: pointer;"></i>

							<?php }?>
						</div>
					</div>
					 
					<div class="form-group row">
						<label class="col-md-3 form-label">Manual de Usuario</label>
						<div class="col-md-9">
							<input type="file" name="manual_usuario" id="manual_usuario"  accept=".pdf" class="form-control"  value="<?php echo e(@$info->manual_usuario); ?>" style="display:none;">
							<div class="flex mt-2" style="padding: 5px;align-items: center;text-align: center;border-radius: 5px;border: dashed 1px #29327f;cursor: pointer;color: #29327f;" id="op_manual_usuario">
								<i class="las la-cloud-upload-alt" style="font-size: 40px;"></i> 
							</div>
							<div class="flex m-2" style="color: #29327f;font-size: 1.1rem;max-width: 100%;" id="val_manual_usuario" value="<?php echo e(@$info->manual_usuario); ?>"></div>

							<?php 
								if(@$info->manual_usuario!=''){
								?><a href="files/software/<?php echo e(@$info->manual_usuario); ?>" class="f_manual_usuario text-info" target="_blank" title="Descargar"><?php  echo @$info->manual_usuario; ?></a>
								<input type="hidden" name="f_manual_usuario" id="f_manual_usuario" value="<?php echo e(@$info->manual_usuario); ?>">
								<i onclick="elimfile('f_manual_usuario');" class="f_manual_usuario fa fa-lg fa-times-circle  txt-color-red" style="cursor: pointer;"></i>

							<?php }?>


							
						</div>
					</div>	
				
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

		$('#op_carta_garantia').click(function() { $('#carta_garantia').click(); });
		$('#carta_garantia').change(function() {
			if(jQuery.isEmptyObject($(this)[0].files[0])){
				$('#val_carta_garantia').html('');	
				return;
			}
			$('#val_carta_garantia').html($(this)[0].files[0].name);
		});
		$('#op_manual_usuario').click(function() { $('#manual_usuario').click(); });
		$('#manual_usuario').change(function() {
			if(jQuery.isEmptyObject($(this)[0].files[0])){
				$('#val_manual_usuario').html('');	
				return;
			}
			$('#val_manual_usuario').html($(this)[0].files[0].name);
		});

		
	});


	item = 0;
	function agregarHorario()
			{   
				item = item + 1;
				cadena ='<tr>'; 
					cadena = cadena + '<td>'+item+'</td>';
					cadena = cadena + '<td><select type="text" class="form-control" id="dia_semana'+item+'" name="dia_semana[]"><option value="">Seleccione</option> <option value="Domingo">Domingo</option> <option value="Lunes">Lunes</option><option value="Martes">Martes</option> <option value="Miercoles">Miercoles</option> <option value="Jueves">Jueves</option> <option value="Viernes">Viernes</option> <option value="Sabado">Sabado</option> </select></td>';
					cadena = cadena + '<td><input type="time" class="form-control" id="hora'+item+'" name="hora[]" value=""></td>';
					cadena = cadena + '<td><input type="time" class="form-control" id="hora_fin'+item+'" name="hora_fin[]" value=""></td>';
						
					cadena = cadena + "<td class='info' width='5%' align='center'><a href='javascript:void(0);' class='elimina btn' title = 'Quitar lote'><i class='glyphicon glyphicon-remove-circle txt-color-red'></i></a></td>";
				cadena = cadena + '</tr>';
							
					$("#tb_horario tbody").append(cadena);  
					fn_dar_eliminar();  
					$("#dia_semana"+item).focus();
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
	
	


	</script><?php /**PATH C:\wamp64\www\sistemauncp\laboratorio\resources\views/software/modal_form_software.blade.php ENDPATH**/ ?>