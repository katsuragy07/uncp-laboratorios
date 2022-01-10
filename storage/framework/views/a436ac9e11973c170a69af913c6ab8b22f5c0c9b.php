<?php $funciones = app('App\Http\Controllers\FuncionesController'); ?>
<?php $m_laboratorio = app('App\Models\Laboratorio'); ?>

<?php $__env->startSection('titulo','Tipo de Laboratorio'); ?>
<?php $__env->startSection('contenido'); ?>
<?php $PrivUsuario = $funciones->PrivUsuario();	?>
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
				<form class="form-horizontal" action="<?php echo e(route('guardar.equipo_seguridad')); ?>" method="POST">
					<?php echo csrf_field(); ?>					
				<div class="modal-body">					
					<div class="form-group row">
						<label class="col-md-3 form-label">Equipo de seguridad</label>
						<div class="col-md-9">
							<input type="text" name="equipo_seguridad" class="form-control"  placeholder="" required="" id="txtequipo_seguridad">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Tipo</label>
						<div class="col-md-6">
							<select name="tipo" id="cmbtipo" required="" class="form-control">
								<option value="">Selecionar</option>
								<option value="EPP Individual">EPP Individual</option>
								<option value="EPP Colectivo">EPP Colectivo</option>								
							</select>
							
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
					<form action="<?php echo e(route('borrar.equipo_seguridad')); ?>" method="POST">
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
        	<?php  if(in_array("admin_todo_laboratorio", $PrivUsuario)) {  	?>
            <div class="card">
                <div class="card-body">
                	<form action="<?php echo e(route('lista.tipo_laboratorio')); ?>" method="GET">
                    <div class="row"> 

                        
                        <div class="col-lg">
                            <label class="form-label"> Laboratorio</label>
                            <select name="laboratorio_id" class="form-control" >
								<option value="TODOS">-- Todos --</option>
								<?php $__currentLoopData = $m_laboratorio::orderby('nombre_lab','ASC')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $laboratorio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option <?php if($laboratorio->id == $databusqueda->laboratorio_id): ?> selected <?php endif; ?> value="<?php echo e($laboratorio->id); ?>"><?php echo e($laboratorio->nombre_lab); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
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
            <?php }else{ ?>
            	<input type="hidden" name="laboratorio_id" value="<?php echo e(Auth::user()->laboratorio_id); ?>">
            <?php  } ?>
            <div class="card">
                <div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover card-table table-vcenter text-nowrap mb-0">
							<thead>
								<tr>
									<th>#</th>
									<th>Tipo de Laboratorio</th>
									<th>Asignar?</th>
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
										<td><?php echo e($fila->tipo_laboratorio); ?></td>
										<td >
										<?php if($databusqueda->laboratorio_id>0): ?>
											<input  id="est_privilegio<?php echo $fila->id; ?>" <?php if (in_array($fila->id, $tipo_laboratorio)) {    echo "checked"; }?> name="checkbox[<?php echo $fila->id; ?>]" type="checkbox" onclick="permiso(<?php echo $fila->id; ?>);" value="<?php echo $fila->id; ?>"/>
											<?php else: ?>
											-
											<?php endif; ?>
										</td> 
									</tr>									
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tbody>
						</table>
					</div>
					<hr class="m-1">
				    <div class="text-center">
				        
				    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
 
function permiso(id){  
    var estado = "";    
    if( $("#est_privilegio"+id).prop('checked') ) {
        estado = 1;
    }else{
        estado = 0;
    }   
      
    $.ajax({ 
        type: "post", 
        url: "<?php echo e(route('mant.tipo_laboratorio')); ?>", cache: false, 
        data:{
        	"_token": "<?php echo e(csrf_token()); ?>",
            tipolaboratorio_id:id,
            estado:estado,
            laboratorio_id   : '<?php echo $databusqueda->laboratorio_id;?>'
        },
        success: function(response){    
                                
                var obj_mensaje = JSON.parse(response); 
                                
                if(obj_mensaje.length>0){                         
                    if(obj_mensaje.substr(0, 8) == 'Activado')
                    {
                       	notif({
							msg: "<i class='fa fa-check swing animated'></i> Se agregó el equipo de forma satisfactoria",
							type: "success",
							position: "right"
						});
                    }else{
                        event.preventDefault();  
                        notif({
							msg: "<i class='fa fa-info-circle swing animated'></i> Se retiró el equipo de forma satisfactoria",
							type: "warning",
							position: "right"
						}); 
                    }                                               
                }       
         }
    }); 
  
}
 
$(document).ready(function() {
});

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.principal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\sistemauncp\laboratorio\resources\views/laboratorio/mant_tipo_laboratorio.blade.php ENDPATH**/ ?>