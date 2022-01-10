<?php $m_laboratorio = app('App\Models\Laboratorio'); ?>
<?php $m_persona = app('App\Models\Persona'); ?>

<?php $__env->startSection('titulo','Lista de recepciones'); ?>
<?php $__env->startSection('contenido'); ?>
<div class=""> <!-- container -->
   
   <!-- Modal Nuevo y editar -->
	<div id="div_ModalMant">		
	</div>
	<!-- Fin Modal nuevo y editar -->

	<!-- Modal eliminar -->
	<div class="modal" id="modal_recepcionar">
		<div class="modal-dialog modal-dialog-centered text-center" role="document">
			<div class="modal-content tx-size-sm">
				<div class="modal-body text-center p-4">
					<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					<i class="fe fe-alert-circle fs-100 text-success lh-1 mb-5 d-inline-block"></i>
					<h4 class="text-info"> Estás seguro aceptar la recepción de todo los insumos? </h4>
					<p class="mg-b-20 mg-x-20" id="lblmensaje" style="font-size: 1.2rem;">  </p>
					<form action="<?php echo e(route('aceptar.recepcion')); ?>" method="POST">
						<?php echo csrf_field(); ?>
						<input type="hidden" name="atencion_id" id="atencion_id">
						<input type="hidden" name="tipo_equipo_id" value="3">
						
						<div class="form-group"> 
							<label class="custom-switch"> 
								<span class="custom-switch-description mr-2">Estoy conforme</span> 
								<input type="checkbox" id="ck_conforme" name="custom-switch-checkbox1" class="custom-switch-input"> 
								<span class="custom-switch-indicator custom-switch-indicator-lg"></span> 
							</label> 
						</div>


					<button aria-label="Close" class="btn btn-secondary pd-x-25" data-dismiss="modal" type="button">Cancelar</button>
					<button type="submit" id="btn_aceptar" class="btn btn-primary">Si, Aceptar</button>
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
                	<form action="<?php echo e(route('listar.recepcion')); ?>" method="GET">
                    <div class="row">
                        <div class="col-lg">
                            <label class="form-label"> Recepción desde</label>
                            <input class="form-control mb-4" placeholder="" type="date" name="fch_recepcion_desde" value="<?php echo e($databusqueda->fch_recepcion_desde); ?>">
                        </div>
                        <div class="col-lg">
                            <label class="form-label"> Recepción hasta</label>
                            <input class="form-control mb-4" placeholder="" type="date" name="fch_recepcion_hasta" value="<?php echo e($databusqueda->fch_recepcion_hasta); ?>">
                        </div>
                        <div class="col-lg "><br>
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
                	<!-- sadasd-->
                	
                	<div class="tab_wrapper first_tab"> 
                		<ul class="tab_list"> 
                			<li class="active" rel="tab_1_1">Lista de recepciones</li> 
                			<li rel="tab_1_2" class="">Pendientes por recibir <span class="badge badge-default"><?php echo e(count($listapendiente)); ?></span></li> 
                		</ul>
                		<div class="content_wrapper"> 
                			<!-- Tab 1-->
                			<div class="tab_content first tab_1_1 p-0 active" title="tab_1_1" style="display: block;">

					<div class="table-responsive">
						<table class="table table-hover card-table table-vcenter text-nowrap mb-0">
							<thead>
								<tr>
									<th>#</th>
									<th>Fecha Pedido</th>
									<th>Fecha Recepción</th>
									<th># Atención</th>
									<th>Compra</th>
									<th>Proveedor</th>
									
									<th>Recibido</th>
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
								<?php $i++;  ?>
									<tr>
										<td><?php echo e($i); ?></td> 
										<td><?php echo e(fechaUsu($fila->fecha_solicitud)); ?></td>
										<td><?php echo e(fechaUsu($fila->fecha_recepcion)); ?></td>
										<td><?php echo e($fila->atencion_id); ?></td>
										<td>
											<?php if($fila->doc_sustento!=''){ ?>
												<a href="files/doc_sustento/<?php echo e($fila->doc_sustento); ?>" class="text-info" target="_blank" title="Descargar"><?php  echo $fila->numdoc_sustento; ?></a>
											<?php }else{?>
												<?php echo e($fila->numdoc_sustento); ?>

											<?php }?>
											
										</td>
										<td><?php echo e($fila->proveedor); ?></td>
										
										<td><?php echo e($fila->resp_recepcion); ?></td>
										 
										 
										<td>
					        				<button type="button" class="btn-info editardato" value="<?php echo e($fila->id); ?>" > 
					                            <i class="glyphicon glyphicon-edit"></i> 
					                        </button>
					                        
										</td> 
									</tr>									
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tbody>
						</table>
					</div>
					<hr class="m-2">
				    <div class="text-center">
				        <?php echo $lista->render(); ?>

				    </div>

                			</div> 
                			<!-- fin tab1-->
                			<!-- tab1-->
                			<div class="tab_content tab_1_2 p-0" title="tab_1_2" style="display: none;"> 

					<div class="table-responsive">
						<table class="table table-hover card-table table-vcenter text-nowrap mb-0">
							<thead>
								<tr>
									<th>#</th>
									<th>Fecha Pedido</th>
									<th>Hora Pedido</th>
									<th>Fecha Entrega</th>
									<th>Hora Entrega</th>
									<th>Laboratorio Origen</th>
									<th>Atendido</th>
									<th>Recibido</th>
									<th></th>
								</tr>
							</thead>
							<tbody>

								<?php 
									$i = 0;
								 ?>
								<?php $__currentLoopData = $listapendiente; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fila): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php $i++;  ?>
									<tr>
										<td><?php echo e($i); ?></td> 
										<td><?php echo e(fechaUsu($fila->fch_pedido)); ?></td>
										<td><?php echo e($fila->hora_pedido); ?></td>
										<td><?php echo e(fechaUsu($fila->fch_entrega)); ?></td>
										<td><?php echo e($fila->hora_entrega); ?></td>
										<td><?php echo e($fila->nombre_lab); ?></td>
										<td><?php echo e($fila->resp_atencion); ?></td>
										<td><?php echo e($fila->resp_recibir); ?></td>

										<td> 
											<button class="btn-info recepcionar" data-toggle="modal" data-target="#modal_recepcionar" onclick="recepcionar(<?php echo e($fila->id); ?>,'<b>Atención:</b> N.<?php echo e($fila->id); ?> <b>Fecha Entrega:</b> <?php echo e(fechaUsu($fila->fch_entrega)); ?> <b><br>Recibido por:</b> <?php echo e($fila->resp_recibir); ?>')"> 
					                            <i class="glyphicon glyphicon-check"></i> 
					                        </button> 
										</td> 
									</tr>									
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tbody>
						</table>
					</div>
                			</div>   
                			<!-- tab1-->
                		</div>
                	</div>


                </div>
            </div>
        </div>
    </div>
</div>

<script>
   $("#btnnuevo").click(function(event){ 
    event.preventDefault();        
    var urlnuevo = "<?php echo e(route('mant.recepcion')); ?>";
    $( "#div_ModalMant" ).html('Cargando...');
    $( "#div_ModalMant" ).load(urlnuevo );
  }); 

	$(".editardato").click(function(event){
    	event.preventDefault();     
	    //var idtablas = $(this).val();
	    var idtablas = $(this).attr("value");
	    var url = "<?php echo e(route('mant.recepcion')); ?>?id="+idtablas;
	    $( "#div_ModalMant" ).html('Cargando...');
	    $( "#div_ModalMant" ).load(url);
   }); 


	function recepcionar(idfila,nombre){
		$('#ck_conforme').prop('checked',false);
		//$('#btn_aceptar').prop('disabled',false);
	    $( "#btn_aceptar" ).prop("disabled", true );

		$('#lblmensaje').html( nombre);
		$('#atencion_id').val(idfila);
	}

	$("#ck_conforme").click(function(event){
		if ($('#ck_conforme').is(':checked')) {
			$( "#btn_aceptar" ).prop("disabled", false);
		}else{
			$( "#btn_aceptar" ).prop("disabled", true );
		}
	})


$(document).ready(function() {
	

});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.principal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\sistemauncp\laboratorio\resources\views/atencion/lista_recepcion.blade.php ENDPATH**/ ?>