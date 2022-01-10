<?php $lstfacultad = app('App\Models\Facultad'); ?>
<?php $lstlaboratorio = app('App\Models\Laboratorio'); ?>
<?php $lstdocente = app('App\Models\Persona'); ?>
<?php $lstasignatura = app('App\Models\Asignatura'); ?>

<?php $__env->startSection('titulo','Personales Responsables'); ?>
<?php $__env->startSection('contenido'); ?>
<div class=""> <!-- container -->
   
<!-- Modal Nuevo y editar -->
<div id="div_ModalMant">		
	</div>
	<!-- Fin Modal nuevo y editar -->


	<!-- Modal eliminar -->
	<div class="modal" id="modal_eliminar">
		<div class="modal-dialog modal-dialog-centered text-center" role="document">
			<div class="modal-content tx-size-sm">
				<div class="modal-body text-center p-4">
					<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					<i class="fe fe-x-circle fs-100 text-danger lh-1 mb-5 d-inline-block"></i>
					<h4 class="text-danger"> Estás seguro eliminar? </h4>
					<p class="mg-b-20 mg-x-20" id="lblmensaje" style="font-size: 1.2rem;">  </p>
					<form action="<?php echo e(route('editar.personal')); ?>" method="POST">
						<?php echo csrf_field(); ?>
						<input type="hidden" name="id_fila" id="id_borrar">
						
						<textarea class="form-control mb-2" placeholder="Escribe el motivo" rows="2" required="" name="motivo"></textarea>

					<button aria-label="Close" class="btn btn-secondary pd-x-25" data-dismiss="modal" type="button">Cancelar</button>
					<button type="submit" class="btn btn-primary">Eliminar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- Fin Modal eliminar -->


    <div class="row justify-content-center">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                	<form action="<?php echo e(route('listado.personal')); ?>" method="GET">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Laboratorio:</label>
                            
							<select name="laboratorio_id" id="laboratorio_id" class="form-control select2-show-search select2-hidden-accessible" data-placeholder="Seleccione Tipo Laboratorio" tabindex="-1">
								<option value="">Todos...</option>
								<?php $__currentLoopData = $laboratorio_det; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $laboratorio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option <?php if($laboratorio->id == $databusqueda->laboratorio_id): ?> selected <?php endif; ?> value="<?php echo e($laboratorio->id); ?>"><?php echo e($laboratorio->full_name); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
                        </div>

						<div class="col-md-5">
                            <label class="form-label">Asignatura:</label>
                            
							<select name="asignatura_id"  id="asignatura_id" class="form-control select2-show-search select2-hidden-accessible" data-placeholder="Seleccione una Asignatura" tabindex="-1">
								<option value="">Todos...</option>
								<?php $__currentLoopData = $lstasignatura::orderby('nom_asignatura','ASC')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asignatura): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option <?php if($asignatura->id == $databusqueda->asignatura_id): ?> selected <?php endif; ?> value="<?php echo e($asignatura->id); ?>"><?php echo e($asignatura->nom_asignatura); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
						
                    </div>
					
					<br>
					<div class="row">
						<div class="col-md-5">
                            <label class="form-label">Docente:</label>
                            
							<select name="docente_id"  id="docente_id" class="form-control select2-show-search select2-hidden-accessible" data-placeholder="Seleccione un Docente" tabindex="-1">
								<option value="">Todos...</option>
								<?php $__currentLoopData = $lstdocente::orderby('apellidos','ASC')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $docente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option <?php if($docente->id == $databusqueda->docente_id): ?> selected <?php endif; ?> value="<?php echo e($docente->id); ?>"><?php echo e($docente->nombre .' '. $docente->apellidos); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
                        </div>

						<div class="col-md-4">
                            <label class="form-label"> Ingrese Descripcion:</label>
                            <input class="form-control mb-5" placeholder="Ingrese Campos" type="text" name="txtbuscar" value="<?php echo e($databusqueda->cod_sunedu); ?>">
                        </div>

						<div class="col-xm-3"><br>
                           <button type="submit" class="btn btn-primary"> 
                                <i class="fa fa-search"></i> Buscar
                            </button>
							<button type="button" id="btnnuevo" class="btn btn-success" > 
                                <i class="fa fa-plus"></i> Nuevo
                            </button>
                        </div>

					</div>
                    </form>

                </div>
            </div>
            <div class="card">
                <div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover card-table table-vcenter text-nowrap mb-0">
							<thead>
								<tr>
									<th>#</th>
									<th>Nombres</th>
									<th>Especialidad</th>
									<th>F. Ingreso</th>
									<th>F. término</th>
									<th>Hoja de Vida</th>	
									<th>Resolución</th>								
									<th>Opciones</th>
								</tr>
							</thead>
							<tbody>

								<?php 
								$i = 0;
								if(isset($_GET['page'])){
									$i = ($_GET['page']*10)-10;
								}
								 ?>
								<?php $__currentLoopData = $lista; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fila): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php $i++;  ?>
									<tr>
										<td><?php echo e($i); ?></td>
									
									
										<td><?php echo e($fila->apellidos .' '.$fila->nombres); ?></td>
										<td><?php echo e($fila->especialidad); ?></td>
										<td><?php echo e($fila->fch_ingreso); ?></td>
										<td><?php echo e($fila->fch_cese); ?></td> 
									
										<td> 
											<?php
					
												$ruta_hoja_vida=asset('files/personal').'/'.$fila->hoja_vida;
											
												if($fila->hoja_vida!=''){
											?>

														<a href="<?php echo e($ruta_hoja_vida); ?>" target="_blank" title="Descargar">
														<i class="fa fa-file-pdf-o" style="font-size:20px;color:green"></i>
													</a>
													<?php	} else {?>

														
														<i class="fa fa-times" style="color:red"></i>


														<?php	} ?>
										
											
										</td>
										<td>

										<?php
					
												$ruta_resolucion=asset('files/personal').'/'.$fila->resolucion;
											
												if($fila->resolucion!=''){
											?>

														<a href="<?php echo e($ruta_resolucion); ?>" target="_blank">
														<i class="fa fa-file-pdf-o" aria-hidden="true" style="font-size:20px;color:red" title="Descargar Resolución"></i>
														</a>
													<?php	} else {?>
														<i class="fa fa-times" style="color:red"></i>
																
														<?php	} ?>




										</td>
										
										
										<td>
										<button type="button" class="btn-info editardato" value="<?php echo e($fila->id); ?>" > 
					                            <i class="glyphicon glyphicon-edit"></i> 
					                        </button>
					                        <button class="btn-danger" data-toggle="modal" data-target="#modal_eliminar" onclick="eliminar(<?php echo e($fila->id); ?>,'<?php echo e($fila->apellidos .' '.$fila->nombres); ?>')"> 
					                            <i class="glyphicon glyphicon-trash"></i> 
					                    </button>
            
										</td> 
									</tr>									
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tbody>
						</table>
					</div>
					<hr class="m-1">
				    <div class="text-center">
				        <?php echo $lista->render(); ?>

				    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
 $("#btnnuevo").click(function(event){ 
    event.preventDefault();        
    var urlnuevo = "<?php echo e(route('mant_personal')); ?>";
    $( "#div_ModalMant" ).html('Cargando...');
    $( "#div_ModalMant" ).load(urlnuevo );
  }); 

	$(".editardato").click(function(event){
    	event.preventDefault();     
	    //var idtablas = $(this).val();
	    var idtablas = $(this).attr("value");
	    var url = "<?php echo e(route('mant_personal')); ?>?id="+idtablas;
	    $( "#div_ModalMant" ).html('Cargando...');
	    $( "#div_ModalMant" ).load(url);
   }); 


	function eliminar(idfila,nombre){
		$('#lblmensaje').text( nombre);
		$('#id_borrar').val(idfila);
	}

$(document).ready(function() {
	

});

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.principal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\sistemauncp\laboratorio\resources\views/personal/lista_personal.blade.php ENDPATH**/ ?>