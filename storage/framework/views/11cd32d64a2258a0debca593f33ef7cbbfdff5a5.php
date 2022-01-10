<?php $lstfacultad = app('App\Models\Facultad'); ?>

<?php $__env->startSection('titulo','Editar Registro'); ?>
<?php $__env->startSection('contenido'); ?>
<form class="needs-validation was-validated" action="<?php echo e(route('update.laboratorios',$laboratorios->id)); ?>" method="POST" enctype="multipart/form-data">
<?php echo csrf_field(); ?>

<div class="row row-sm">
		<div class="col-lg-6">

		
	
			 <div class="form-group"> 
			 <label for="size_2">Código de Sunedu:&nbsp;&nbsp;&nbsp;</label>	
				<input class="form-control  mb-4 is-valid state-valid" name="cod_sunedu" id="cod_sunedu" placeholder="Codigo Sunedu" required="" type="text"  value="<?php echo e($laboratorios->cod_sunedu); ?>">
				
				<label for="size_2">Nombre de Laboratorio:&nbsp;&nbsp;&nbsp;</label>	
				<textarea class="form-control mb-4 is-valid state-valid" name="nombre_lab" id="nombre_lab" placeholder="Nombre de Laboratorio" required="" rows="2"><?php echo e($laboratorios->nombre_lab); ?></textarea>

				<label for="size_2">Facultad:&nbsp;&nbsp;&nbsp;</label>	
						<select name="facultad_id" required="" class="form-control mb-4 is-valid state-valid" id="facultad_id">
						<?php $__currentLoopData = $lstfacultad::orderby('nom_facultad','ASC')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facultad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<option <?php if($facultad->id == $laboratorios->facultad_id): ?> selected <?php endif; ?> value="<?php echo e($facultad->id); ?>"><?php echo e($facultad->nom_facultad); ?></option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>

				
				<label for="size_2">Descripción:&nbsp;&nbsp;&nbsp;</label>	
				<textarea class="form-control mb-4 is-valid state-valid" name="decripcion_lab" id="decripcion_lab" placeholder="Descripción"  rows="3"><?php echo e($laboratorios->decripcion_lab); ?></textarea>

				<label for="size_2">Observaciones:&nbsp;&nbsp;&nbsp;</label>	
				<textarea class="form-control mb-4 is-valid state-valid" name="observaciones_lab" id="observaciones_lab" placeholder="Observaciones"  rows="3"><?php echo e($laboratorios->observaciones_lab); ?></textarea>




				
			<label for="size_2">Ubicación:&nbsp;&nbsp;&nbsp;</label>
				<textarea class="form-control mb-4 is-valid state-valid" name="ubicacion" id="ubicacion" placeholder="Referencia de ubicación del laboratorio o taller (Local):"  rows="2"><?php echo e($laboratorios->ubicacion); ?></textarea>

				<label for="size_2">Que servicios brinda para la enseñanza?:&nbsp;&nbsp;&nbsp;</label>
				<textarea class="form-control mb-4 is-valid state-valid" name="tipos_de_ensenanza" id="tipos_de_ensenanza" placeholder="Que servicios brinda para la enseñanza?"  rows="5"><?php echo e($laboratorios->tipos_de_ensenanza); ?></textarea>



				<label for="size_2">Pabellón:&nbsp;&nbsp;&nbsp;</label>
				<input class="form-control  mb-4 is-valid state-valid" name="pabellon" id="pabellon" placeholder="Pabellon" type="text"  value="<?php echo e($laboratorios->pabellon); ?>">

				<label for="size_2">Número de Aula:&nbsp;&nbsp;&nbsp;</label>
				<input class="form-control  mb-4 is-valid state-valid" name="num_aula" id="num_aula" placeholder="Numero de Aula" type="text"  value="<?php echo e($laboratorios->num_aula); ?>">

				<label for="size_2">Piso:&nbsp;&nbsp;&nbsp;</label>
				<input class="form-control  mb-4 is-valid state-valid" name="piso" id="piso" placeholder="Piso" type="text"  value="<?php echo e($laboratorios->piso); ?>">
				
				<label for="size_2">Aforo:&nbsp;&nbsp;&nbsp;</label>
				<input class="form-control  mb-4 is-valid state-valid" name="aforo" id="aforo" placeholder="Aforo" type="number"  value="<?php echo e($laboratorios->aforo); ?>">
				
				<label for="size_2">Área Total m2:&nbsp;&nbsp;&nbsp;</label>
				<input class="form-control mb-4 is-invalid state-invalid" name="area_total" id="area_total" placeholder="Area Total" type="text" value="<?php echo e($laboratorios->area_total); ?>">
				
				<label for="size_2">Área Libre:&nbsp;&nbsp;&nbsp;</label>
				<input class="form-control mb-4 is-invalid state-invalid" name="area_libre" id="area_libre" placeholder="Area Libre" type="text" value="<?php echo e($laboratorios->area_libre); ?>">
				
				<label for="size_2">Área Ocupada:&nbsp;&nbsp;&nbsp;</label>
				<input class="form-control mb-4 is-invalid state-invalid" name="area_ocupada" id="area_ocupada" placeholder="Area Ocupada" type="text" value="<?php echo e($laboratorios->area_ocupada); ?>">
			</div>
		</div>
												
		<div class="col-lg-6">								
			<div class="form-group">
					
			<label for="size_2">Foto del Laboratorio (.pdf)</label>
			<input type="file" name="foto_laboratorio" id="foto_laboratorio" accept=".pdf" class="form-control"  value="<?php echo e(@$laboratorios->foto_laboratorio); ?> " style="display:none;">
			<div class="flex mt-2" style="padding: 5px;align-items: center;text-align: center;border-radius: 5px;border: dashed 1px #29327f;cursor: pointer;color: #29327f;" id="op_foto_laboratorio">
				<i class="las la-cloud-upload-alt" style="font-size: 40px;"></i> 
			</div>
				<div class="flex m-2" style="color: #29327f;font-size: 1.1rem;max-width: 100%;" id="val_foto_laboratorio"></div>

							<?php 
								if(@$laboratorios->foto_laboratorio!=''){
								?><a href="../files/laboratorio/<?php echo e($laboratorios->foto_laboratorio); ?>" class="f_foto_laboratorio text-info" target="_blank" title="Descargar"><?php  echo @$laboratorios->foto_laboratorio; ?></a>
								<input type="hidden" name="f_foto_laboratorio" id="f_foto_laboratorio" value="<?php echo e(@$info->foto_laboratorio); ?>">
								<i onclick="elimfile('f_foto_laboratorio');" class="f_foto_laboratorio fa fa-lg fa-times-circle  txt-color-red" style="cursor: pointer;"></i>
							<?php }?>



			<br><br><label for="size_2">Organigrama del Laboratorio (.pdf)</label>
			<input type="file" name="organigrama" id="organigrama" accept=".pdf" class="form-control" value="<?php echo e(@$laboratorios->organigrama); ?> " style="display:none;" >
			<div class="flex mt-2" style="padding: 5px;align-items: center;text-align: center;border-radius: 5px;border: dashed 1px #29327f;cursor: pointer;color: #29327f;" id="op_organigrama">
				<i class="las la-cloud-upload-alt" style="font-size: 40px;"></i> 
			</div>
				<div class="flex m-2" style="color: #29327f;font-size: 1.1rem;max-width: 100%;" id="val_organigrama"></div>

							<?php 
								if(@$laboratorios->organigrama!=''){
								?><a href="../files/laboratorio/<?php echo e($laboratorios->organigrama); ?>" class="f_organigrama text-info" target="_blank" title="Descargar"><?php  echo @$laboratorios->organigrama; ?></a>
								<input type="hidden" name="f_organigrama" id="f_organigrama" value="<?php echo e(@$info->organigrama); ?>">
								<i onclick="elimfile('f_organigrama');" class="f_organigrama fa fa-lg fa-times-circle  txt-color-red" style="cursor: pointer;"></i>
							<?php }?>

			<br><br><br><label for="size_2">Resolución de Creación del Laboratorio (.pdf)&nbsp;&nbsp;&nbsp;</label>
				<input type="file" name="resolucion_creacion" id="resolucion_creacion" accept=".pdf" class="form-control" value="<?php echo e(@$laboratorios->resolucion_creacion); ?> " style="display:none;" >
				<div class="flex mt-2" style="padding: 5px;align-items: center;text-align: center;border-radius: 5px;border: dashed 1px #29327f;cursor: pointer;color: #29327f;" id="op_resolucion_creacion">
				<i class="las la-cloud-upload-alt" style="font-size: 40px;"></i> 
			</div>
				<div class="flex m-2" style="color: #29327f;font-size: 1.1rem;max-width: 100%;" id="val_resolucion_creacion"></div>

							<?php 
								if(@$laboratorios->resolucion_creacion!=''){
								?><a href="../files/laboratorio/<?php echo e($laboratorios->resolucion_creacion); ?>" class="f_resolucion_creacion text-info" target="_blank" title="Descargar"><?php  echo @$laboratorios->resolucion_creacion; ?></a>
								<input type="hidden" name="f_resolucion_creacion" id="f_resolucion_creacion" value="<?php echo e(@$info->resolucion_creacion); ?>">
								<i onclick="elimfile('f_resolucion_creacion');" class="f_resolucion_creacion fa fa-lg fa-times-circle  txt-color-red" style="cursor: pointer;"></i>
							<?php }?>
				

			<br><br><br>
<div class="d-none">
	

			<label for="size_2">Horario de Atención del Laboratorio (.pdf) &nbsp;&nbsp;&nbsp;</label>
				<input type="file" name="horario_atencion" id="horario_atencion" accept=".pdf" class="form-control" value="<?php echo e(@$laboratorios->horario_atencion); ?> " style="display:none;" >
				<div class="flex mt-2" style="padding: 5px;align-items: center;text-align: center;border-radius: 5px;border: dashed 1px #29327f;cursor: pointer;color: #29327f;" id="op_horario_atencion">
				<i class="las la-cloud-upload-alt" style="font-size: 40px;"></i> 
			</div>
			</div>
				<div class="flex m-2" style="color: #29327f;font-size: 1.1rem;max-width: 100%;" id="val_horario_atencion"></div>

							<?php 
								if(@$laboratorios->horario_atencion!=''){
								?><a href="../files/laboratorio/<?php echo e($laboratorios->horario_atencion); ?>" class="f_horario_atencion text-info" target="_blank" title="Descargar"><?php  echo @$laboratorios->horario_atencion; ?></a>
								<input type="hidden" name="f_horario_atencion" id="f_horario_atencion" value="<?php echo e(@$info->horario_atencion); ?>">
								<i onclick="elimfile('f_horario_atencion');" class="f_horario_atencion fa fa-lg fa-times-circle  txt-color-red" style="cursor: pointer;"></i>
							<?php }?>
 
			 <br><br><br>
			 <div class="radio">
				<h6>¿Cuenta con Internet?:</h6>
				<label for="si">SI</label>
				<input type="radio" name="flg_internet" id="flg_internet" value="1"<?php echo ($laboratorios->flg_internet == 1 ? ' checked' : '')?>>
				
				&nbsp;&nbsp;&nbsp;
				<label for="no">NO</label>
				<input type="radio" name="flg_internet" id="flg_internet" value="0"<?php echo ($laboratorios->flg_internet == 0 ? 'checked' : '')?>>
			</div>

			 <br>
			 <div class="radio">
				<h6>¿Cuenta con Tacho de Residuos Sólidos Peligrosos?:</h6>
				<label for="si">SI</label>
				<input type="radio" name="flg_tacho_peligroso" id="flg_tacho_peligroso" value="1"<?php echo ($laboratorios->flg_tacho_peligroso == 1 ? ' checked' : '')?>>
				
				&nbsp;&nbsp;&nbsp;
				<label for="no">NO</label>
				<input type="radio" name="flg_tacho_peligroso" id="flg_tacho_peligroso" value="0"<?php echo ($laboratorios->flg_tacho_peligroso == 0 ? 'checked' : '')?>>
			</div>
			

			<br>
			<div class="radio">
				<h6>¿Cuenta con Tacho de Residuos Sólidos Biocontaminantes?:</h6>
				<label for="si">SI</label>
				<input type="radio" name="flg_tacho_biocont" id="flg_tacho_biocont" value="1"<?php echo ($laboratorios->flg_tacho_biocont == 1 ? ' checked' : '')?>>
				
				&nbsp;&nbsp;&nbsp;
				<label for="no">NO</label>
				<input type="radio" name="flg_tacho_biocont" id="flg_tacho_biocont" value="0"<?php echo ($laboratorios->flg_tacho_biocont == 0 ? 'checked' : '')?>>
			</div>

			<br>
			<div class="radio">
				<h6>¿Cuenta con Recipiente de Residuos líquidos?:</h6>
				<label for="si">SI</label>
				<input type="radio" name="flg_recipiente_rl" id="flg_recipiente_rl" value="1"<?php echo ($laboratorios->flg_recipiente_rl == 1 ? ' checked' : '')?>>
				
				&nbsp;&nbsp;&nbsp;
				<label for="no">NO</label>
				<input type="radio" name="flg_recipiente_rl" id="flg_recipiente_rl" value="0"<?php echo ($laboratorios->flg_recipiente_rl == 0 ? 'checked' : '')?>>
			</div>
			

			</div>
		</div>
	</div>
											
	<div class="form-group">
		<a href=""> <button class="btn btn-primary state-loading" type="submit"> Guardar </button></a>
		<input type="reset" class="btn btn-warning d-none" value="Limpiar">
		<a class="btn btn-danger d-none" href="javascript:history.back()">Retornar</a>

	</div>	
	
	
 </form>   <!-- fin Form-->


<script>
	
	$(document).ready(function() {
		$('#op_foto_laboratorio').click(function() { $('#foto_laboratorio').click(); });
		$('#foto_laboratorio').change(function() {
			if(jQuery.isEmptyObject($(this)[0].files[0])){
				$('#val_foto_laboratorio').html('');	
				return;
			}
			$('#val_foto_laboratorio').html($(this)[0].files[0].name);
		});

		$('#op_organigrama').click(function() { $('#organigrama').click(); });
		$('#organigrama').change(function() {
			if(jQuery.isEmptyObject($(this)[0].files[0])){
				$('#val_organigrama').html('');	
				return;
			}
			$('#val_organigrama').html($(this)[0].files[0].name);
		});	

		$('#op_resolucion_creacion').click(function() { $('#resolucion_creacion').click(); });
		$('#resolucion_creacion').change(function() {
			if(jQuery.isEmptyObject($(this)[0].files[0])){
				$('#val_resolucion_creacion').html('');	
				return;
			}
			$('#val_resolucion_creacion').html($(this)[0].files[0].name);
		});	
		
		$('#op_horario_atencion').click(function() { $('#horario_atencion').click(); });
		$('#horario_atencion').change(function() {
			if(jQuery.isEmptyObject($(this)[0].files[0])){
				$('#val_horario_atencion').html('');	
				return;
			}
			$('#val_horario_atencion').html($(this)[0].files[0].name);
		});	

		
	});

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.principal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\sistemauncp\laboratorio\resources\views/laboratorio/edit.blade.php ENDPATH**/ ?>