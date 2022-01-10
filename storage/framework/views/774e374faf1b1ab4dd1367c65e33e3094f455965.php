<?php $m_laboratorio = app('App\Models\Laboratorio'); ?>
<?php $m_persona = app('App\Models\Persona'); ?>
<?php $lsttipodocumento = app('App\Models\Tipo_doc_especifico'); ?>
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
					<h5 class="modal-title" id="largemodal1"> <i class="fa fa-plus"></i> Nuevo Documento</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form class="form-horizontal" action="<?php echo e(route('guardar.docespecifico')); ?>" method="POST" enctype="multipart/form-data" id="frmproy">
					<?php echo csrf_field(); ?>
				<div class="modal-body">
					<div class="form-group row">
						<label class="col-md-3 form-label">Laboratorio</label>
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
						<label class="col-md-3 form-label">Tipo Documento Especifico</label>
						<div class="col-md-9">
							<select name="tipo_documento_id" id="tipo_documento_id" required="" class="form-control">
								<option value="">-- Seleccionar --</option>
								<?php $__currentLoopData = $lsttipodocumento::orderby('tipo_doc_especifico','ASC')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipodocumento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option <?php if($tipodocumento->id == @$info->tipo_documento_id): ?> selected <?php endif; ?> value="<?php echo e($tipodocumento->id); ?>"><?php echo e($tipodocumento->tipo_doc_especifico); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
					</div>


					<div class="form-group row">
						<label class="col-md-3 form-label">Ingrese Nombre de Documento</label>
						<div class="col-md-9">
							<textarea class="form-control" name="nombre" id="nombre" required="" rows="3"> <?php echo e(@$info->nombre); ?></textarea>
						</div>
					</div>
					
					

					 
					<div class="form-group row">
						<label class="col-md-3 form-label">Archivo</label>
						<div class="col-md-9">
							<input type="file" name="archivo" id="archivo"  accept=".pdf" class="form-control"  value="<?php echo e(@$info->archivo); ?>" style="display:none;">
							<div class="flex mt-2" style="padding: 5px;align-items: center;text-align: center;border-radius: 5px;border: dashed 1px #29327f;cursor: pointer;color: #29327f;" id="op_archivo">
								<i class="las la-cloud-upload-alt" style="font-size: 40px;"></i> 
							</div>
							<div class="flex m-2" style="color: #29327f;font-size: 1.1rem;max-width: 100%;" id="val_archivo" value="<?php echo e(@$info->archivo); ?>"></div>

							<?php 
								if(@$info->archivo!=''){
								?><a href="files/docespecifico/<?php echo e(@$info->archivo); ?>" class="text-info" target="_blank" title="Descargar"><?php  echo @$info->archivo; ?></a>
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
		$('#op_archivo').click(function() { $('#archivo').click(); });
		$('#archivo').change(function() {
			if(jQuery.isEmptyObject($(this)[0].files[0])){
				$('#val_archivo').html('');	
				return;
			}
			$('#val_archivo').html($(this)[0].files[0].name);
		});
	});

</script><?php /**PATH C:\wamp64\www\sistemauncp\laboratorio\resources\views/docespecifico/modal_form_docespecifico.blade.php ENDPATH**/ ?>