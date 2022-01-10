<?php $m_laboratorio = app('App\Models\Laboratorio'); ?>
<?php $m_persona = app('App\Models\Persona'); ?>
<?php $lstequipo = app('App\Models\Equipo'); ?>
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
				<form class="form-horizontal" action="<?php echo e(route('guardar_componentes')); ?>" method="POST" enctype="multipart/form-data" id="frmproy">
					<?php echo csrf_field(); ?>
				<div class="modal-body">
								
					
					<div class="form-group row">
						<label class="col-md-3 form-label">Equipos</label>
						<div class="col-md-9">
							<select name="equipo_id" id="equipo_id" required="" class="form-control">
								<option value="">-- Seleccionar --</option>
								<?php $__currentLoopData = $lstequipo::orderby('nom_equipo','ASC')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option <?php if($equipo->id == @$info->equipo_id): ?> selected <?php endif; ?> value="<?php echo e($equipo->id); ?>"><?php echo e($equipo->nom_equipo); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Nombre Componente</label>
						<div class="col-md-9">
							<input type="text" name="nom_componente" class="form-control"  autocomplete="off"  value="<?php echo e(@$info->nom_componente); ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Marca</label>
						<div class="col-md-4">
							<input type="text" name="marca" class="form-control"  autocomplete="off" value="<?php echo e(@$info->marca); ?>">
						</div>
						<label class="col-xm-2 form-label">Capacidad</label>
						<div class="col-md-4">
							<input type="text" name="capacidad" class="form-control" autocomplete="off" value="<?php echo e(@$info->capacidad); ?>">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-md-3 form-label">Descripción</label>
						<div class="col-md-9">
						<textarea class="form-control" name="descripcion" id="descripcion" rows="3"> <?php echo e(@$info->descripcion); ?></textarea>
						</div>
					</div>



					<div class="form-group row">
						<label class="col-md-3 form-label">Licencia</label>
						<div class="col-md-9">
						<input type="text" name="flg_original" class="form-control" autocomplete="off" value="<?php echo e(@$info->flg_original); ?>">
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
<?php /**PATH C:\wamp64\www\sistemauncp\laboratorio\resources\views/componentes/modal_form_componentes.blade.php ENDPATH**/ ?>