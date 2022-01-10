<?php $lstfacultad = app('App\Models\Facultad'); ?>
<?php $lstlaboratorio = app('App\Models\Laboratorio'); ?>
<?php $lstdocente = app('App\Models\Persona'); ?>
<?php $lstasignatura = app('App\Models\Asignatura'); ?>

<?php $__env->startSection('titulo','Laboratorio de Cómputo'); ?>
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
					<form action="<?php echo e(route('editar_software')); ?>" method="POST">
						<?php echo csrf_field(); ?>
						<input type="hidden" name="id" id="id_borrar">
						
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
                	<form action="<?php echo e(route('listado_software')); ?>" method="GET">
                    <div class="row">
                        <div class="col-md-8">
                            <label class="form-label">Laboratorio:</label>
                            
							<select name="laboratorio_id" id="laboratorio_id" class="form-control select2-show-search select2-hidden-accessible" data-placeholder="Seleccione Tipo Laboratorio" tabindex="-1">
								<option value="">Todos...</option>
								<?php $__currentLoopData = $lstlaboratorio::orderby('nombre_lab','ASC')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $laboratorio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option <?php if($laboratorio->id == @$info->laboratorio_id): ?> selected <?php endif; ?> value="<?php echo e($laboratorio->id); ?>"><?php echo e($laboratorio->nombre_lab); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
                        </div>

						
						
                    </div>
					
					<br>
					<div class="row">
						

						<div class="col-md-8">
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
									<th>laboratorio</th>
									<th>software</th>
									<th>versión</th>
									<th>año adquisición</th>
									<th>fecha Fin Licencia</th>
									<th>Carta de Garantia</th>
									<th>Manual</th>
									
									
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
								<?php $__currentLoopData = $lista; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php $i++;  ?>
									<tr>
										<td><?php echo e($i); ?></td>
									
										<td><?php echo e($filas->nombre_lab); ?></td>
										<td><?php echo e($filas->nom_software); ?></td>
										<td><?php echo e($filas->version); ?></td>
										<td><?php echo e($filas->anio_adquisicion); ?></td>
										<td><?php echo e(fechaUsu($filas->fch_fin_vigencia)); ?></td>
										<td> 
											<?php
					
												$ruta_carta_garantia=asset('files/software').'/'.$filas->carta_garantia;
											
												if($filas->carta_garantia!=''){
											?>

														<a href="<?php echo e($ruta_carta_garantia); ?>" target="_blank" title="Descargar">
														<i class="fa fa-file-pdf-o" style="font-size:20px;color:green"></i>
													</a>
													<?php	} else {?>

														
														<i class="fa fa-times" style="color:red"></i>


														<?php	} ?>
										
											
										</td>
										<td>

										<?php
					
												$ruta_manual_usuario=asset('files/software').'/'.$filas->manual_usuario;
											
												if($filas->manual_usuario!=''){
											?>

														<a href="<?php echo e($ruta_manual_usuario); ?>" target="_blank">
														<i class="fa fa-file-pdf-o" aria-hidden="true" style="font-size:20px;color:red" title="Descargar"></i>
														</a>
													<?php	} else {?>
														<i class="fa fa-times" style="color:red"></i>
																
														<?php	} ?>




										</td>
										
										
										<td>
										<button type="button" class="btn-info editardato" value="<?php echo e($filas->id); ?>" > 
					                            <i class="glyphicon glyphicon-edit"></i> 
					                        </button>
					                        <button class="btn-danger" data-toggle="modal" data-target="#modal_eliminar" onclick="eliminar(<?php echo e($filas->id); ?>,'<?php echo e($filas->nom_software); ?>')"> 
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
    var urlnuevo = "<?php echo e(route('mant_software')); ?>";
    $( "#div_ModalMant" ).html('Cargando...');
    $( "#div_ModalMant" ).load(urlnuevo );
  }); 

	$(".editardato").click(function(event){
    	event.preventDefault();     
	    //var idtablas = $(this).val();
	    var idtablas = $(this).attr("value");
	    var url = "<?php echo e(route('mant_software')); ?>?id="+idtablas;
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

<?php echo $__env->make('layouts.principal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\sistemauncp\laboratorio\resources\views/software/lista_software.blade.php ENDPATH**/ ?>