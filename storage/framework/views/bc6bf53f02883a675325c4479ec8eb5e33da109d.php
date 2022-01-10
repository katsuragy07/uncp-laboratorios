<?php $m_tipo_documento = app('App\Models\Tipo_documento'); ?>
<script>
	$(function(){
		$('#modal_persona').modal('show');
	})
 
$(function(){        
	var options = {
		target:        '#div_OptionPersona', 
		beforeSubmit:  showRequest,  
		success:       showResponse  
	};

		$('#frm_regRazonSocial').ajaxForm(options);	 
		$('#rs_tipo_documento_id').focus();		
	});	
function showRequest(formData, jqForm){		

		$('#btn_guardarpersona').html('Grabando...');
		$("#btn_guardarpersona").attr("disabled","disabled"); 
	};
function showResponse(responseText, statusText){
	$('#modal_persona').modal('hide');
 	$('#modal_persona').on('hidden.bs.modal', function () {
	    x_fn_insertRS();
	});
};
</script>

   <!-- Modal Nuevo y editar -->
	<div class="modal fade" id="modal_persona"   role="dialog" aria-labelledby="largemodal" aria-hidden="true">
		<div class="modal-dialog modal-lg " role="document">
			<div class="modal-content" style="border: 1px solid #29327f !important">
				<div class="modal-header">
					<h5 class="modal-title" id="largemodal1"> <i class="fa fa-plus"></i> Persona</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form class="form-horizontal" id="frm_regRazonSocial" action="<?php echo e(route('guardar.persona')); ?>" method="post" >
					<?php echo csrf_field(); ?>					
				<div class="modal-body">
					<div class="form-group row">
						<label class="col-md-3 form-label">Tipo Doc.</label>				
						<div class="col-md-6">
							<select name="tipo_documento_id" required="" class="form-control" id="rs_tipo_documento_id">
								<option value="">Seleccionar...</option>
								<?php $__currentLoopData = $m_tipo_documento::orderby('id','ASC')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo_documento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option <?php if($tipo_documento->id == @$info->tipo_documento_id): ?> selected <?php endif; ?> value="<?php echo e($tipo_documento->id); ?>"><?php echo e($tipo_documento->tipo_documento); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Num. Doc</label>
						<div class="col-md-9">
							<input type="text" name="num_doc" class="form-control"  placeholder="" required="" id="rs_num_doc" value="<?php echo e(@$info->id); ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Nombres</label>
						<div class="col-md-9">
							<input type="text" name="nombres" class="form-control"  placeholder="" required="" id="rs_nombres" value="<?php echo e(@$info->nombres); ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Apellidos</label>
						<div class="col-md-9">
							<input type="text" name="apellidos" class="form-control"  placeholder="" required="" id="rs_apellidos" value="<?php echo e(@$info->apellidos); ?>">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id" id="rs_id" value="<?php echo e(@$info->id); ?>">
					<input type="hidden" name="tipo" value="json" id="rs_tipo">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button type="submit" id="btn_guardarpersona" class="btn btn-primary">Guardar</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Fin Modal nuevo y editar -->
	<script>
	 
	</script><?php /**PATH C:\wamp64\www\sistemauncp\laboratorio\resources\views/mantenimiento/modal_form_persona.blade.php ENDPATH**/ ?>