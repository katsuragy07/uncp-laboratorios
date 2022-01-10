<?php $m_tipo_documento = app('App\Models\Tipo_documento'); ?>

<?php $__env->startSection('titulo','Persona'); ?>
<?php $__env->startSection('contenido'); ?>
<div class=""> <!-- container -->
   
   <!-- Modal Nuevo y editar -->
	<div class="modal fade" id="modal_nuevo" tabindex="-1" role="dialog" aria-labelledby="largemodal" aria-hidden="true">
		<div class="modal-dialog modal-lg " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="largemodal1"> <i class="fa fa-plus"></i> Nuevo</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form class="form-horizontal" action="<?php echo e(route('guardar.persona')); ?>" method="POST">
					<?php echo csrf_field(); ?>					
				<div class="modal-body">
					<div class="form-group row">
						<label class="col-md-3 form-label">Tipo Doc.</label>				
						<div class="col-md-6">
							<select name="tipo_documento_id" required="" class="form-control" id="cmbtipodocumento">
								<option value="">Seleccionar...</option>
								<?php $__currentLoopData = $m_tipo_documento::orderby('id','ASC')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo_documento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($tipo_documento->id); ?>"><?php echo e($tipo_documento->tipo_documento); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Num. Doc</label>
						<div class="col-md-9">
							<input type="text" name="num_doc" class="form-control"  autocomplete="off" required="" id="txtnum_doc">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Nombres</label>
						<div class="col-md-9">
							<input type="text" name="nombres" class="form-control"  autocomplete="off" required="" id="txtnombres">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Apellidos</label>
						<div class="col-md-9">
							<input type="text" name="apellidos" class="form-control"  autocomplete="off" required="" id="txtapellidos">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Correo</label>
						<div class="col-md-9">
							<input type="email" name="correo" class="form-control"  autocomplete="off" id="txtcorreo">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Celular</label>
						<div class="col-md-9">
							<input type="text" name="celular" class="form-control"  autocomplete="off"  id="txtcelular">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Fecha de Nacimiento</label>
						<div class="col-md-9">
							<input type="date" name="fch_nacimiento" class="form-control"  autocomplete="off" id="txtfch_nacimiento">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id" id="txtid">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</div>
				</form>
			</div>
		</div>
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
					<form action="<?php echo e(route('borrar.persona')); ?>" method="POST">
						<?php echo csrf_field(); ?>
						<input type="hidden" name="id" id="id_borrar">
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
                	<form action="<?php echo e(route('listar.persona')); ?>" method="GET">
                    <div class="row">
                        <div class="col-lg">
                            <label class="form-label"> Nombres</label>
                            <input class="form-control mb-4" placeholder="" type="text" name="nombres" value="<?php echo e($databusqueda->nombres); ?>">
                        </div>
                        <div class="col-lg">
                            <label class="form-label"> Apellidos</label>
                            <input class="form-control mb-4" placeholder="" type="text" name="apellidos" value="<?php echo e($databusqueda->apellidos); ?>">
                        </div>
                        <div class="col-lg "><br>
                           <button type="submit" class="btn btn-primary"> 
                                <i class="fa fa-search"></i> Buscar
                            </button>
                           
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_nuevo" onclick="nuevo()"> 
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
									<th>Num. documento</th>
									<th>Nombres</th>
									<th>Apellidos</th>
									<th></th>
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
								<?php
								 $i++;  ?>
									<tr>
										<td><?php echo e($i); ?></td>
										<td><?php echo e($fila->num_doc); ?></td>
										<td><?php echo e($fila->nombres); ?></td> 
										<td><?php echo e($fila->apellidos); ?></td>
										 
										<td>
					        				<button type="button" class="btn-info" data-toggle="modal" data-target="#modal_nuevo" onclick="editar(<?php echo e($fila->id); ?>,'<?php echo e($fila->tipo_documento_id); ?>','<?php echo e($fila->num_doc); ?>','<?php echo e($fila->nombres); ?>','<?php echo e($fila->apellidos); ?>','<?php echo e($fila->correo); ?>','<?php echo e($fila->celular); ?>','<?php echo e($fila->fch_nacimiento); ?>')" > 
					                            <i class="glyphicon glyphicon-edit"></i> 
					                        </button>

					                        <button class="btn-danger" data-toggle="modal" data-target="#modal_eliminar" onclick="eliminar(<?php echo e($fila->id); ?>,'<?php echo e($fila->nombres); ?>')"> 
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
	function nuevo(){
		$('#txtid').val('');		
		$('#txtnombres').val("");
		$('#txtapellidos').val("");	
		$('#txtcorreo').val("");	
		$('#txtfch_nacimiento').val("");	
		$('#txtcelular').val("");	
			
	}

	function editar(id,tipo,num_doc,nombres,apellidos,correo,fch_nacimiento,celular) {
		$('#txtid').val(id);
		$('#txtnum_doc').val(num_doc);
		$('#cmbtipodocumento').val(tipo);
		$('#txtnombres').val(nombres);
		$('#txtapellidos').val(apellidos);
		$('#txtcorreo').val(correo);	
		$('#txtfch_nacimiento').val(celular);	
		$('#txtcelular').val(fch_nacimiento);	
	}

	function eliminar(id,mensaje){
		$('#id_borrar').val(id);
		$('#lblmensaje').text( mensaje);
	}
 
$(document).ready(function() {
});

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.principal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\sistemauncp\laboratorio\resources\views/mantenimiento/lista_persona.blade.php ENDPATH**/ ?>