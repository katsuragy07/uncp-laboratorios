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
				<form class="form-horizontal" action="{{ route('guardar.stock_insumo') }}" method="POST">
					@csrf
				<div class="modal-body">
					<table class="table mb-0">
						<tbody>
							<tr>
								<td class="py-2 px-0" style="width: 30%"> <span class="font-weight-semibold w-50">Laboratorio </span> </td>
								<td class="py-2 px-0">{{ $infolab->nombre_lab }}</td>
							</tr>
							<tr>
								<td class="py-2 px-0"> <span class="font-weight-semibold w-50">Tipo de fiscalización </span> </td>
								<td class="py-2 px-0">{{ $info->tipo_fiscalizado }}</td>
							</tr>
							<tr>
								<td class="py-2 px-0"> <span class="font-weight-semibold w-50">Nombre Insumo </span> </td>
								<td class="py-2 px-0"><b>{{ $info->nom_equipo }}</b></td>
							</tr>
							<tr>
								<td class="py-2 px-0"> <span class="font-weight-semibold w-50">Marca </span> </td>
								<td class="py-2 px-0">{{ $info->marca }}</td>
							</tr>
							<tr>
								<td class="py-2 px-0"> <span class="font-weight-semibold w-50">Concentración </span> </td>
								<td class="py-2 px-0">{{ $info->concentracion }}</td>
							</tr>
							<tr>
								<td class="py-2 px-0"> <span class="font-weight-semibold w-50">Especificación </span> </td>
								<td class="py-2 px-0">{{ $info->especificacion }}</td>
							</tr>
							<tr>
								<td class="py-2 px-0"> <span class="font-weight-semibold w-50">Unidad Medida </span> </td>
								<td class="py-2 px-0">{{ $info->unidad_medida }}</td>
							</tr>
							<tr>
								<td class="py-2 px-0"> <span class="font-weight-semibold w-50">Unidad Medida en Almacen </span> </td>
								<td class="py-2 px-0">{{ $info->unidad_med_min }}</td>
							</tr>
							<tr>
								<td class="py-2 px-0"> <span class="font-weight-semibold w-50">Equivalencia en cantidad </span> </td>
								<td class="py-2 px-0">{{ $info->cantidad_min }}<input type="hidden" name="cantidad_min" id="cantidad_min" class="form-control"  required="" value="{{ @$info->cantidad_min }}"></td>
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
									@foreach($lote_equipo  as $fila)
									<?php
									$readonly = '';
									 if($fila->cant_movimiento>0){
									 	$readonly = 'readonly=""';
									 } ?>
<tr>  
		<td><input type="hidden" class="form-control" {{ $readonly }} id="lote_equipo_id{{ $i }}" name="lote_equipo_id[]" value="{{ $fila->id }}">
			<input type="date" class="form-control" {{ $readonly }} id="fch_fabricacion{{ $i }}" name="fch_fabricacion[]" value="{{ $fila->fch_fabricacion }}"></td>
		<td><input type="date" class="form-control" {{ $readonly }} id="fch_vencimiento{{ $i }}" name="fch_vencimiento[]" value="{{ $fila->fch_vencimiento }}"></td>
		<td><input type="text" class="form-control" {{ $readonly }} id="lote{{ $i }}" name="lote[]" value="{{ $fila->lote }}"></td>
		<td><input type="number" step="Any" min="{{ ($fila->cant_movimiento==0)?0.1:0 }}" class="form-control" id="cantidad_lote{{ $i }}" name="cantidad_lote[]" required item="{{ $i }}" value="{{ $fila->cantidad_lote }}" onkeyup="sumasubtotal();" onmouseup="sumasubtotal();"><input type="hidden" id="cantidad_lote_min{{ $i }}" name="cantidad_lote_min[]" value="{{ $fila->cantidad_lote_min }}"></td>
	            
        <td class='info' width='5%' align='center'>
        	@if($fila->cant_movimiento==0)
        	<a href='javascript:void(0);' class='elimina btn' title = 'Quitar lote'><i class='glyphicon glyphicon-remove-circle txt-color-red'></i></a>
        	@endif
        </td>

    </tr>
									@endforeach
								</tbody>
							</table>

						  	
						</div>
						<div class="col-lg-7">
							<a href="javascript:void(0);" onclick="agregarLote();" class="btn btn-outline-info " title="Agregar un item">
						  		<i class="fa fa-plus "></i>
						  	</a>
						</div>
						<div class="col-lg-5">
							<div class=""><strong>Cantidad:</strong> <span class="badge badge-primary mt-2" id="info_cant">0</span> <span id="info_cant_um">{{ $info->unidad_medida }}</span></div>
							<div class=""><strong>Cantidad:</strong> <span class="badge badge-info mt-2" id="info_cant_min">0</span> <span id="info_cant_um_min">{{ $info->unidad_med_min }}</span></div>
						</div>
					</div>

				 
					 
				</div>
				<div class="modal-footer">
					<input type="hidden" name="equipo_id" value="{{ $info->id }}">
					<input type="hidden" name="laboratorio_id" value="{{ $infolab->id }}">
					
					<input type="hidden" name="tipo_equipo_id" value="{{ $infolab->tipo_equipo_id }}"><!-- 3 Insumo-->
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
	</script>