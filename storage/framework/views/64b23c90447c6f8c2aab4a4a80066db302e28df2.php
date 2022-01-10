<?php $funciones = app('App\Http\Controllers\FuncionesController'); ?>
<?php $m_laboratorio = app('App\Models\Laboratorio'); ?>

<?php $__env->startSection('titulo','Movimiento - Kardex'); ?>
<?php $__env->startSection('contenido'); ?>
<?php $PrivUsuario = $funciones->PrivUsuario();	?>
<div class=""> <!-- container -->
    

    <div class="row justify-content-center">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                	<form action="<?php echo e(route('listar.movimiento')); ?>" method="GET">
                    <div class="row"> 
                    	<?php  if(in_array("admin_todo_laboratorio", $PrivUsuario)) {  	?>
                        <div class="col-lg">
                            <label class="form-label"> Laboratorio</label>
                            <select name="laboratorio_id" class="form-control" >
								<option value="TODOS">-- Todos --</option>
								<?php $__currentLoopData = $m_laboratorio::orderby('nombre_lab','ASC')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $laboratorio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option <?php if($laboratorio->id == $databusqueda->laboratorio_id): ?> selected <?php endif; ?> value="<?php echo e($laboratorio->id); ?>"><?php echo e($laboratorio->nombre_lab); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
                        </div>
                        <?php }else{ ?>
                        	<input type="hidden" name="laboratorio_id" value="<?php echo e(Auth::user()->laboratorio_id); ?>">
                        <?php  } ?>
                        <div class="col-lg">
                            <label class="form-label"> Equipo</label>
                            <input class="form-control mb-4" placeholder="" type="text" name="nom_equipo" value="<?php echo e($databusqueda->nom_equipo); ?>">
                        </div>
                        <div class="col-lg "><br>
                           <button type="submit" class="btn btn-primary"> 
                                <i class="fa fa-search"></i> Buscar
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
									<th>Fecha / Hora</th>
									
									<th>Material/Insumo</th>
									<th>Marca</th>
									<th>Especificación</th>
									<th>Lote/F. VENC</th>
									<th>Cantidad</th>
									<th>Stock</th>
									<th>Tipo Movimiento</th>
									<th>Atención</th>
									<th>Compra</th>
									<th>Origen</th>
									<th>Destino</th>
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
										<td><?php echo fechaHoraUsuBR($fila->created_at); ?></td>
										<td><b><?php echo e($fila->nom_equipo); ?></b></td>
										<td><?php echo e($fila->marca); ?></td>
										<td><?php echo e($fila->especificacion); ?></td>
										<td><?php echo e($fila->lote); ?><br><?php echo e(fechaUsu($fila->fch_vencimiento)); ?></td>
										<td><b><?php echo e(signo_cant_mov($fila->cantidad_movimiento,$fila->tipo_movimiento_id)); ?></b></td>
										<td><b><?php echo e($fila->stock_equipo_lab); ?></b></td>
										<td><?php echo e($fila->tipo_movimiento); ?></td>
										<td><?php if($fila->num_atencion>0): ?> # <?php endif; ?> <?php echo e($fila->num_atencion); ?></td>
										<td><?php echo e($fila->numdoc_sustento); ?></td>
										<td><?php echo e($fila->laboratorio_origen); ?></td>
										<td><?php echo e($fila->laboratorio_destino); ?></td>
										<td><?php echo e($fila->persona_recibido); ?></td>


										 
										<td>					        				 
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
	}

	function editar(id,movimiento) {
		$('#txtid').val(id);
		$('#txtmovimiento').val(movimiento);
	}

	function eliminar(id,mensaje){
		$('#id_borrar').val(id);
		$('#lblmensaje').text( mensaje);
	}
 
$(document).ready(function() {
});

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.principal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\sistemauncp\laboratorio\resources\views/atencion/lista_movimiento.blade.php ENDPATH**/ ?>