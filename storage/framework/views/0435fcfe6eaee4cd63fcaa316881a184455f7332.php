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
recargarAjaxUbigeo();
</script>
<div class="modal fade" id="modal_mante" tabindex="-1" role="dialog" aria-labelledby="largemodal" aria-hidden="true">
		<div class="modal-dialog modal-lg " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="largemodal1"> <i class="fa fa-plus"></i> Nuevo Investigación</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form class="form-horizontal" action="<?php echo e(route('guardar.infoinvestigacion')); ?>" method="POST" enctype="multipart/form-data">
					<?php echo csrf_field(); ?>
				<div class="modal-body">
					<div class="form-group row">
						<label class="col-md-3 form-label">Laboratorio</label>
						<div class="col-md-6">

							<select name="laboratoriodet_id" id="laboratoriodet_id" required="" class="form-control" >
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
						<label class="col-md-3 form-label">Investigador Principal</label>
						<div class="col-md-7">
							<select id="solicitante_id" name="solicitante_id" style="width: 100%;" class="select2AjaxPersona" required="" >
								<?php if(@$info->solicitante_id>0): ?>
									<option selected value="<?php echo e($info->solicitante_id); ?>"><?php echo e($funciones->info_persona($info->solicitante_id)); ?> </option>
								<?php endif; ?>
							</select>
						</div>

						<div class="col-md-2">
							<button type="button" class="btn btn-warning" onclick="abrirModalPersona('solicitante_id');" > 
                                	<i class="fa fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-success" onclick="abrirModalPersona('solicitante_id','Nuevo');" > 
                                	<i class="fa fa-plus"></i>
                            </button>
						</div>

					</div>

			


					<div class="form-group row">
						<label class="col-md-3 form-label">Código del Proyecto</label>
						<div class="col-md-9">
							<input type="text" name="cod_proyecto" class="form-control" autocomplete="off" value="<?php echo e(@$info->cod_proyecto); ?>">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-md-3 form-label">Nombre del Proyecto</label>
						<div class="col-md-9">
						
							<textarea class="form-control" name="nom_proyecto" id="nom_proyecto" required="" rows="3"> <?php echo e(@$info->nom_proyecto); ?></textarea>
							
						</div>
					</div>  

					<div class="form-group row">
						<label class="col-md-3 form-label">Equipo de Investigadores</label>
						<div class="col-md-9">
						
							<textarea class="form-control" name="responsables" id="responsables" required="" rows="3"> <?php echo e(@$info->responsables); ?></textarea>
							
						</div>
					</div> 

					<div class="form-group row">
						<label class="col-md-3 form-label">Fuente Financiamiento</label>
						<div class="col-md-9">
							<input type="text" name="fuente_finan" id="fuente_finan" autocomplete="off" class="form-control"  value="<?php echo e(@$info->fuente_finan); ?>">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-md-3 form-label">Monto</label>
						<div class="col-md-9">
							<input type="text" name="monto_otorgar" id="monto_otorgar" autocomplete="off" class="form-control"  value="<?php echo e(@$info->monto_otorgar); ?>">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-md-3 form-label">Grupo Investigación</label>
						<div class="col-md-9">
							<input type="text" name="centro_inv" id="centro_inv" autocomplete="off" class="form-control"  value="<?php echo e(@$info->centro_inv); ?>">
						</div>
					</div>

					
					<div class="form-group row">
						<label class="col-md-3 form-label">Linea Investigación</label>
						<div class="col-md-9">
							<input type="text" name="linea_inv" id="linea_inv" class="form-control" autocomplete="off" value="<?php echo e(@$info->linea_inv); ?>">
						</div>
					</div>

					

					<div class="form-group row">
						<label class="col-md-3 form-label">Aseguramiento de la Calidad</label>
						<div class="col-md-9">
							<input type="file" name="aseg_calidad" id="aseg_calidad" accept=".pdf" class="form-control"  value="<?php echo e(@$info->monto_otorgar); ?>" style="display:none;">
							<div class="flex mt-2" style="padding: 5px;align-items: center;text-align: center;border-radius: 5px;border: dashed 1px #29327f;cursor: pointer;color: #29327f;" id="op_calidad">
								<i class="las la-cloud-upload-alt" style="font-size: 40px;"></i> 
							</div>
							<div class="flex m-2" style="color: #29327f;font-size: 1.1rem;max-width: 100%;" id="val_calidad"></div>
							<?php 
								if(@$info->aseg_calidad!=''){
									
								?><a href="files/infoinvestigacion/<?php echo e(@$info->aseg_calidad); ?>" class="f_aseg_calidad text-info" target="_blank" title="Descargar"><?php  echo @$info->aseg_calidad; ?></a>
								<input type="hidden" name="f_aseg_calidad" id="f_aseg_calidad" value="<?php echo e(@$info->aseg_calidad); ?>">
								<i onclick="elimfile('f_aseg_calidad');" class="f_aseg_calidad fa fa-lg fa-times-circle  txt-color-red" style="cursor: pointer;"></i>
							<?php }?>

						</div>
					</div>

					<div class="form-group row">
						<label class="col-md-3 form-label">Resultado de la Investigación</label>
						<div class="col-md-9">
							<input type="file" name="resultado_inv" id="resultado_inv" accept=".pdf" class="form-control"  value="<?php echo e(@$info->monto_otorgar); ?>" style="display:none;">
							<div class="flex mt-2" style="padding: 5px;align-items: center;text-align: center;border-radius: 5px;border: dashed 1px #29327f;cursor: pointer;color: #29327f;" id="op_resultado">
								<i class="las la-cloud-upload-alt" style="font-size: 40px;"></i> 
							</div>
							<div class="flex m-2" style="color: #29327f;font-size: 1.1rem;max-width: 100%;" id="val_resultado" ></div>
							<?php 
								if(@$info->resultado_inv!=''){
								?><a href="files/infoinvestigacion/<?php echo e(@$info->resultado_inv); ?>" class="f_resultado_inv text-info" target="_blank" title="Descargarddd"><?php  echo @$info->resultado_inv; ?></a>
								<input type="hidden" name="f_resultado_inv" id="f_resultado_inv" value="<?php echo e(@$info->resultado_inv); ?>">
								<i onclick="elimfile('f_resultado_inv');" class="f_resultado_inv fa fa-lg fa-times-circle  txt-color-red" style="cursor: pointer;"></i>
							<?php }?>


						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id" value="<?php echo e(@$info->id); ?>">
					<input type="hidden" name="tipo_equipo_id" value="2"><!-- 2 Material-->
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
		$('#op_calidad').click(function() { $('#aseg_calidad').click(); });
		$('#aseg_calidad').change(function() {
			if(jQuery.isEmptyObject($(this)[0].files[0])){
				$('#val_calidad').html('');	
				return;
			}
			$('#val_calidad').html($(this)[0].files[0].name);
		});
		$('#op_resultado').click(function() { $('#resultado_inv').click(); });
		$('#resultado_inv').change(function() {
			if(jQuery.isEmptyObject($(this)[0].files[0])){
				$('#val_resultado').html('');	
				return;
			}
			$('#val_resultado').html($(this)[0].files[0].name);
		});
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
		if(x_combo_persona == 'solicitante_id'){
			$("#solicitante_id").html(option);
			//recargarAjaxPersona();
		}
		 recargarAjaxPersona();
		//console.log('sdfdsf');
		
	}
	</script>

<?php /**PATH C:\wamp64\www\sistemauncp\laboratorio\resources\views/infoinvestigacion/modal_form_infoinvestigacion.blade.php ENDPATH**/ ?>