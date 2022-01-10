<?php $m_laboratorio = app('App\Models\Laboratorio'); ?>
<?php $m_unidadmedida = app('App\Models\Unidad_medida'); ?>
<?php $m_proveedor = app('App\Models\Proveedor'); ?>
<?php $m_tipo_fiscalizado = app('App\Models\Tipo_fiscalizado'); ?>
<?php $funciones = app('App\Http\Controllers\FuncionesController'); ?>
<?php $PrivUsuario = $funciones->PrivUsuario();	?>
<?php 
	$unidad_medida = $m_unidadmedida::orderby('unidad_medida','ASC')->get();
?>
<script>
$(function(){
	$('#modal_mante').modal('show');
})
</script>
<div class="modal fade" id="modal_mante" tabindex="-1" role="dialog" aria-labelledby="largemodal" aria-hidden="true">
		<div class="modal-dialog modal-lg " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="largemodal1"> <i class="fa fa-plus"></i> Nuevo Insumo</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form class="form-horizontal" action="<?php echo e(route('guardar.equipo')); ?>" method="POST">
					<?php echo csrf_field(); ?>
				<div class="modal-body">
					<?php  if(in_array("admin_todo_laboratorio", $PrivUsuario)) {  	?>					
						<div class="form-group row">
							<label class="col-md-3 form-label">Laboratorio</label>
							<div class="col-md-6">
								<select name="laboratorio_id" required="" class="form-control" >
									<option value="">Seleccionar...</option>
									<?php $__currentLoopData = $m_laboratorio::orderby('nombre_lab','ASC')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $laboratorio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option <?php if($laboratorio->id == @$info->laboratorio_id): ?> selected <?php endif; ?>  value="<?php echo e($laboratorio->id); ?>"><?php echo e($laboratorio->nombre_lab); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							</div>
						</div>
					<?php }else{ ?>
						<div class="form-group row">
							<label class="col-md-3 form-label">Laboratorio</label>
							<div class="col-md-9">
								<?php echo e($funciones->Nombre_Laboratorio(Auth::user()->laboratorio_id)); ?>

								<input type="hidden" name="laboratorio_id" value="<?php echo e(Auth::user()->laboratorio_id); ?>">
							</div>						 
						</div>
					<?php  } ?>


					<div class="form-group row">
						<label class="col-md-3 form-label">Tipo de fiscalización</label>
						<div class="col-md-6">
							<select name="tipo_fiscalizado_id" required="" class="form-control" >
								<option value="">Seleccionar...</option>
								<?php $__currentLoopData = $m_tipo_fiscalizado::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo_fiscalizado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option <?php if($tipo_fiscalizado->id == @$info->tipo_fiscalizado_id): ?> selected <?php endif; ?>  value="<?php echo e($tipo_fiscalizado->id); ?>"><?php echo e($tipo_fiscalizado->tipo_fiscalizado); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Nombre Insumo</label>
						<div class="col-md-9">
							<input type="text" name="nom_equipo" class="form-control"  required="" value="<?php echo e(@$info->nom_equipo); ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Marca</label>
						<div class="col-md-9">
							<input type="text" name="marca" class="form-control"  value="<?php echo e(@$info->marca); ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Concentración</label>
						<div class="col-md-9">
							<input type="text" name="concentracion" class="form-control"   value="<?php echo e(@$info->concentracion); ?>">
						</div>
					</div>
					 
					 <div class="form-group row">
						<label class="col-md-3 form-label">Especificación</label>
						<div class="col-md-9">
							<input type="text" name="especificacion" class="form-control"  value="<?php echo e(@$info->especificacion); ?>">
						</div>
					</div>
					  
					<div class="form-group row">
						<label class="col-md-3 form-label">Unidad Medida</label>
						<div class="col-md-6">
							<select name="unidad_medida_id" id="unidad_medida_id" class="form-control" required="" >
								<option value="">-- Seleccionar --</option>
								<?php $__currentLoopData = $unidad_medida; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unidad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option <?php if($unidad->id == @$info->unidad_medida_id): ?> selected <?php endif; ?> value="<?php echo e($unidad->id); ?>"><?php echo e($unidad->unidad_medida); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
					</div>
					<hr>
					 
					<div class="form-group row">
						<label class="col-md-3 form-label">Unidad Medida en Almacen</label>
						<div class="col-md-6">
							<select name="unidad_med_min_id" id="unidad_med_min_id" class="form-control" required="" >
								<option value="">-- Seleccionar --</option>
								<?php $__currentLoopData = $unidad_medida; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unidad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option <?php if($unidad->id == @$info->unidad_med_min_id): ?> selected <?php endif; ?> value="<?php echo e($unidad->id); ?>"><?php echo e($unidad->unidad_medida); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Equivalencia en cantidad</label>
						<div class="col-md-9">
							<input type="number" onkeyup="sumasubtotal();" onmouseup="sumasubtotal();" name="cantidad_min" id="cantidad_min" class="form-control"  required="" value="<?php echo e(@$info->cantidad_min); ?>">
						</div>
					</div>

					<div class="form-group row">
						<div class="table-responsive">
							<table id="tb_lote" class="table">
								<thead>
									<tr>
										 
										<th>F. fabricación</th>
										<th>F. vencimiento</th>
										<th>Lote</th>
										<th>Cantidad</th>
									</tr>
								</thead>
								<tbody> 
									<?php $i = 1; ?>	
									<?php $__currentLoopData = $lote_equipo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fila): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>  
									<td><input type="date" class="form-control" id="fch_fabricacion<?php echo e($i); ?>" name="fch_fabricacion[]" value="<?php echo e($fila->fch_fabricacion); ?>"></td>
									<td><input type="date" class="form-control" id="fch_vencimiento<?php echo e($i); ?>" name="fch_vencimiento[]" value="<?php echo e($fila->fch_vencimiento); ?>"></td>
									<td><input type="text" class="form-control" id="lote<?php echo e($i); ?>" name="lote[]" value="<?php echo e($fila->lote); ?>"></td>
									<td><input type="number" class="form-control" id="cantidad_lote<?php echo e($i); ?>" name="cantidad_lote[]" required item="<?php echo e($i); ?>" value="<?php echo e($fila->cantidad_lote); ?>" onkeyup="sumasubtotal();" onmouseup="sumasubtotal();"><input type="hidden" id="cantidad_lote_min<?php echo e($i); ?>" name="cantidad_lote_min[]" value="<?php echo e($fila->cantidad_lote_min); ?>"></td>
											
									<td class='info' width='5%' align='center'><a href='javascript:void(0);' class='elimina btn' title = 'Quitar lote'><i class='glyphicon glyphicon-remove-circle txt-color-red'></i></a></td>
								</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</tbody>
							</table>

						  	
						</div>
						<div class="col-lg-7">
							<a href="javascript:void(0);" onclick="agregarLote();" class="btn btn-outline-info " title="Agregar un item">
						  		<i class="fa fa-plus "></i>
						  	</a>
						</div>
						<div class="col-lg-5">
							<div class=""><strong>Cantidad:</strong> <span class="badge badge-primary mt-2" id="info_cant">0</span> <span id="info_cant_um"></span></div>
							<div class=""><strong>Cantidad:</strong> <span class="badge badge-info mt-2" id="info_cant_min">0</span> <span id="info_cant_um_min"></span></div>
						</div>
					</div>

				 
					 
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id" value="<?php echo e(@$info->id); ?>">
					<input type="hidden" name="tipo_equipo_id" value="3"><!-- 3 Insumo-->
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	<script >
 
 item = 1000;
function agregarLote()
{   
	item = item + 1;
    cadena ='<tr>'; 
		cadena = cadena + '<td><input type="date" class="form-control" id="fch_fabricacion'+item+'" name="fch_fabricacion[]" value=""></td>';
		cadena = cadena + '<td><input type="date" class="form-control" id="fch_vencimiento'+item+'" name="fch_vencimiento[]" value=""></td>';
		cadena = cadena + '<td><input type="text" class="form-control" id="lote'+item+'" name="lote[]" value=""></td>';
		cadena = cadena + '<td><input type="number" class="form-control" id="cantidad_lote'+item+'" name="cantidad_lote[]" required item="'+item+'" value="" onkeyup="sumasubtotal();" onmouseup="sumasubtotal();"><input type="hidden" id="cantidad_lote_min'+item+'" name="cantidad_lote_min[]" value=""></td>';
	            
        cadena = cadena + "<td class='info' width='5%' align='center'><a href='javascript:void(0);' class='elimina btn' title = 'Quitar lote'><i class='glyphicon glyphicon-remove-circle txt-color-red'></i></a></td>";
    cadena = cadena + '</tr>';
                 
        $("#tb_lote tbody").append(cadena);  
           
        fn_dar_eliminar();    
        sumasubtotal();
        $("#fch_fabricacion"+item).focus();
}

function fn_dar_eliminar(){
		$("a.elimina").click(function(){        
				$(this).parents("#tb_lote tbody tr").remove();                               
				sumasubtotal();
		});    
	};
	$("a.elimina").click(function(){        
				$(this).parents("#tb_lote tbody tr").remove();                               
				sumasubtotal();
		});
 
function sumasubtotal(){
	//cantidad_lote_min = $('#cantidad_lote_min').val();
	cantidad_min = $('#cantidad_min').val();
    suma = 0;       
    $('input[name$="cantidad_lote[]"]').each(function(){
    	item = $(this).attr('item');
        if (!isNaN(parseFloat($(this).val()))) {
        	cantidad = parseFloat($(this).val());
            suma=parseFloat(suma)+parseFloat($(this).val());
            
            cantmin = (cantidad * cantidad_min);
    		$('#cantidad_lote_min'+item).val(cantmin);
        }else{
        	$('#cantidad_lote_min'+item).val(0);
        }
    })

    sumamin = 0;       
    $('input[name$="cantidad_lote_min[]"]').each(function(){
        if (!isNaN(parseFloat($(this).val()))) {
            sumamin=parseFloat(sumamin)+parseFloat($(this).val());     
        }
    })


    //cantmin = (suma * cantidad_min);

    $("#info_cant").html(suma.toFixed(2)); 
    $("#info_cant_min").html(sumamin.toFixed(2)); 
}
$('#unidad_medida_id').change(function(){
	unidadmedida =  $('select[name="unidad_medida_id"] option:selected').text();
	$("#info_cant_um").html(unidadmedida);
});
$('#unidad_med_min_id').change(function(){
	unidadmedida_min =  $('select[name="unidad_med_min_id"] option:selected').text();
	$("#info_cant_um_min").html(unidadmedida_min);	
});

<?php if($info){	?>
unidadmedida =  $('select[name="unidad_medida_id"] option:selected').text();
$("#info_cant_um").html(unidadmedida);
unidadmedida_min =  $('select[name="unidad_med_min_id"] option:selected').text();
$("#info_cant_um_min").html(unidadmedida_min);	
<?php }	?>
agregarLote();
	</script><?php /**PATH C:\wamp64\www\sistemauncp\laboratorio\resources\views/equipos/modal_form_insumos.blade.php ENDPATH**/ ?>