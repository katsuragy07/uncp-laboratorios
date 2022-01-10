<script>
$(function(){
	$('#modal_mante').modal('show');
})
</script>
<div class="modal fade" id="modal_mante" tabindex="-1" role="dialog" aria-labelledby="largemodal" aria-hidden="true">
		<div class="modal-dialog modal-lg " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="largemodal1"> <i class="fa fa-edit"></i> Stock por lotes</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form class="form-horizontal" action="<?php echo e(route('guardar.stock_insumo')); ?>" method="POST">
					<?php echo csrf_field(); ?>
				<div class="modal-body">
					<table class="table mb-0">
						<tbody>
							<tr>
								<td class="py-2 px-0" style="width: 30%"> <span class="font-weight-semibold w-50">Laboratorio </span> </td>
								<td class="py-2 px-0"><?php echo e($infolab->nombre_lab); ?></td>
							</tr>
							<tr>
								<td class="py-2 px-0"> <span class="font-weight-semibold w-50">Tipo de fiscalización </span> </td>
								<td class="py-2 px-0"><?php echo e($info->tipo_fiscalizado); ?></td>
							</tr>
							<tr>
								<td class="py-2 px-0"> <span class="font-weight-semibold w-50">Nombre Insumo </span> </td>
								<td class="py-2 px-0"><b><?php echo e($info->nom_equipo); ?></b></td>
							</tr>
							<tr>
								<td class="py-2 px-0"> <span class="font-weight-semibold w-50">Marca </span> </td>
								<td class="py-2 px-0"><?php echo e($info->marca); ?></td>
							</tr>
							<tr>
								<td class="py-2 px-0"> <span class="font-weight-semibold w-50">Concentración </span> </td>
								<td class="py-2 px-0"><?php echo e($info->concentracion); ?></td>
							</tr>
							<tr>
								<td class="py-2 px-0"> <span class="font-weight-semibold w-50">Especificación </span> </td>
								<td class="py-2 px-0"><?php echo e($info->especificacion); ?></td>
							</tr>
							<tr>
								<td class="py-2 px-0"> <span class="font-weight-semibold w-50">Unidad Medida </span> </td>
								<td class="py-2 px-0"><?php echo e($info->unidad_medida); ?></td>
							</tr>
							<tr>
								<td class="py-2 px-0"> <span class="font-weight-semibold w-50">Unidad Medida en Almacen </span> </td>
								<td class="py-2 px-0"><?php echo e($info->unidad_med_min); ?></td>
							</tr>
							<tr>
								<td class="py-2 px-0"> <span class="font-weight-semibold w-50">Equivalencia en cantidad </span> </td>
								<td class="py-2 px-0"><?php echo e($info->cantidad_min); ?><input type="hidden" name="cantidad_min" id="cantidad_min" class="form-control"  required="" value="<?php echo e(@$info->cantidad_min); ?>"></td>
							</tr>
						</tbody>
					</table>
				   

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
									<?php
									$readonly = '';
									 if($fila->cant_movimiento>0){
									 	$readonly = 'readonly=""';
									 } ?>
<tr>  
		<td><input type="hidden" class="form-control" <?php echo e($readonly); ?> id="lote_equipo_id<?php echo e($i); ?>" name="lote_equipo_id[]" value="<?php echo e($fila->id); ?>">
			<input type="date" class="form-control" <?php echo e($readonly); ?> id="fch_fabricacion<?php echo e($i); ?>" name="fch_fabricacion[]" value="<?php echo e($fila->fch_fabricacion); ?>"></td>
		<td><input type="date" class="form-control" <?php echo e($readonly); ?> id="fch_vencimiento<?php echo e($i); ?>" name="fch_vencimiento[]" value="<?php echo e($fila->fch_vencimiento); ?>"></td>
		<td><input type="text" class="form-control" <?php echo e($readonly); ?> id="lote<?php echo e($i); ?>" name="lote[]" value="<?php echo e($fila->lote); ?>"></td>
		<td><input type="number" step="Any" min="<?php echo e(($fila->cant_movimiento==0)?0.1:0); ?>" class="form-control" id="cantidad_lote<?php echo e($i); ?>" name="cantidad_lote[]" required item="<?php echo e($i); ?>" value="<?php echo e($fila->cantidad_lote); ?>" onkeyup="sumasubtotal();" onmouseup="sumasubtotal();"><input type="hidden" id="cantidad_lote_min<?php echo e($i); ?>" name="cantidad_lote_min[]" value="<?php echo e($fila->cantidad_lote_min); ?>"></td>
	            
        <td class='info' width='5%' align='center'>
        	<?php if($fila->cant_movimiento==0): ?>
        	<a href='javascript:void(0);' class='elimina btn' title = 'Quitar lote'><i class='glyphicon glyphicon-remove-circle txt-color-red'></i></a>
        	<?php endif; ?>
        </td>

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
							<div class=""><strong>Cantidad:</strong> <span class="badge badge-primary mt-2" id="info_cant">0</span> <span id="info_cant_um"><?php echo e($info->unidad_medida); ?></span></div>
							<div class=""><strong>Cantidad:</strong> <span class="badge badge-info mt-2" id="info_cant_min">0</span> <span id="info_cant_um_min"><?php echo e($info->unidad_med_min); ?></span></div>
						</div>
					</div>

				 
					 
				</div>
				<div class="modal-footer">
					<input type="hidden" name="equipo_id" value="<?php echo e($info->id); ?>">
					<input type="hidden" name="laboratorio_id" value="<?php echo e($infolab->id); ?>">
					
					<input type="hidden" name="tipo_equipo_id" value="<?php echo e($infolab->tipo_equipo_id); ?>"><!-- 3 Insumo-->
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
		cadena = cadena + '<td><input type="hidden" class="form-control" id="lote_equipo_id'+item+'" name="lote_equipo_id[]" value=""><input type="date" class="form-control" id="fch_fabricacion'+item+'" name="fch_fabricacion[]" value=""></td>';
		cadena = cadena + '<td><input type="date" class="form-control" id="fch_vencimiento'+item+'" name="fch_vencimiento[]" value=""></td>';
		cadena = cadena + '<td><input type="text" class="form-control" id="lote'+item+'" name="lote[]" value=""></td>';
		cadena = cadena + '<td><input type="number" step="Any" class="form-control" id="cantidad_lote'+item+'" name="cantidad_lote[]" required item="'+item+'" value="" onkeyup="sumasubtotal();" onmouseup="sumasubtotal();"><input type="hidden" id="cantidad_lote_min'+item+'" name="cantidad_lote_min[]" value=""></td>';
	            
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

    $("#info_cant").html(suma.toFixed(3)); 
    $("#info_cant_min").html(sumamin.toFixed(0)); 
}

sumasubtotal();
//agregarLote();
	</script><?php /**PATH C:\wamp64\www\sistemauncp\laboratorio\resources\views/equipos/modal_form_stock_insumos.blade.php ENDPATH**/ ?>