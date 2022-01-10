<?php $lstfacultad = app('App\Models\Facultad'); ?>
<?php $lstlaboratorio = app('App\Models\Laboratorio'); ?>
<?php $lstpersona = app('App\Models\Persona'); ?>

<?php $__env->startSection('titulo','Lab. de Investigación'); ?>
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
					<form action="<?php echo e(route('borrar_infoinvestigacion')); ?>" method="POST">
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
                	<form action="<?php echo e(route('listado.investigacion')); ?>" method="GET">
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
                            <label class="form-label">Solicitante:</label>
                            
							<select name="solicitante_id" id="solicitante_id" class="form-control select2-show-search select2-hidden-accessible" data-placeholder="Seleccione Tipo Laboratorio" tabindex="-1">
								<option value="">Todos...</option>
								<?php $__currentLoopData = $lstpersona::orderby('apellidos','ASC')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $solicitante): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option <?php if($solicitante->id == $databusqueda->solicitante_id): ?> selected <?php endif; ?> value="<?php echo e($solicitante->id); ?>"><?php echo e($solicitante->apellidos.' '.$solicitante->nombres); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
						
                    </div>
					
					<br>
					<div class="row">
					

						<div class="col-md-9">
                            <label class="form-label"> Ingrese Descripción:</label>
                            <input class="form-control mb-5" autocomplete="off" placeholder="Ingrese Campos" type="text" name="txtbuscar" value="<?php echo e($databusqueda->cod_sunedu); ?>">
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
									<th>Cod. Proyecto</th>
									<th>Proyecto</th>
									<th>Responsable</th>
									<th>Fuente Financiamiento</th>
									<th>centro Investigación</th>
									<th>linea Investigación</th>
									
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
								<?php $__currentLoopData = $listas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lista): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php $i++;  ?>
									<tr>
										<td><?php echo e($i); ?></td>
										<td><?php echo e($lista->cod_proyecto); ?></td>
										<td><?php echo e($lista->nom_proyecto); ?></td>
										<td><?php echo e($lista->apellidos .' '.$lista->nombres); ?></td>
										<td><?php echo e($lista->fuente_finan); ?></td> 
										<td><?php echo e($lista->centro_inv); ?></td>
										<td><?php echo e($lista->linea_inv); ?></td>
										<td>
										<button type="button" class="btn-success agregardato" value="<?php echo e($lista->id); ?>" > 
					                            <i class="glyphicon glyphicon-plus"></i> 
					                    </button>

										<button type="button" class="btn-info editardato" value="<?php echo e($lista->id); ?>" > 
					                            <i class="glyphicon glyphicon-edit"></i> 
					                    </button>
										
							
					                    
										<button class="btn-danger" data-toggle="modal" data-target="#modal_eliminar" onclick="eliminar(<?php echo e($lista->id); ?>,'<?php echo e($lista->cod_proyecto); ?>')"> 
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
				        <?php echo $listas->render(); ?>

				    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
 $("#btnnuevo").click(function(event){ 
    event.preventDefault();        
    var urlnuevo = "<?php echo e(route('mant_infoinvestigacion')); ?>";
    $( "#div_ModalMant" ).html('Cargando...');
    $( "#div_ModalMant" ).load(urlnuevo );
  }); 

	$(".editardato").click(function(event){
    	event.preventDefault();     
	    var idtablas = $(this).attr("value");
	    var url = "<?php echo e(route('mant_infoinvestigacion')); ?>?id="+idtablas;
	    $( "#div_ModalMant" ).html('Cargando...');
	    $( "#div_ModalMant" ).load(url);
   }); 

   $(".agregardato").click(function(event){
    	event.preventDefault();     
	    var idtablas = $(this).attr("value");
	    var url = "<?php echo e(route('agre_infoinvestigacion')); ?>?id="+idtablas;
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

<?php echo $__env->make('layouts.principal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\sistemauncp\laboratorio\resources\views/infoinvestigacion/lista_infoinvestigacion.blade.php ENDPATH**/ ?>