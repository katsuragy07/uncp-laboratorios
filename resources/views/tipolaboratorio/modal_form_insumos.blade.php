@inject('m_laboratorio','App\Models\Laboratorio')
@inject('m_unidadmedida','App\Models\Unidad_medida')
@inject('m_proveedor','App\Models\Proveedor')
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
				<form class="form-horizontal" action="{{ route('guardar.equipo') }}" method="POST">
					@csrf
				<div class="modal-body">
					<div class="form-group row">
						<label class="col-md-3 form-label">Laboratorio</label>
						<div class="col-md-6">
							<select name="laboratorio_id" required="" class="form-control" >
								<option value="">Seleccionar...</option>
								@foreach($m_laboratorio::orderby('nombre_lab','ASC')->get() as $laboratorio)
								<option @if($laboratorio->id == @$info->laboratorio_id) selected @endif  value="{{ $laboratorio->id }}">{{ $laboratorio->nombre_lab }}</option>
								@endforeach
							</select>
						</div>
					</div> 				
					<div class="form-group row">
						<label class="col-md-3 form-label">Nombre Insumo</label>
						<div class="col-md-9">
							<input type="text" name="nom_equipo" class="form-control"  required="" value="{{ @$info->nom_equipo }}">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Marca</label>
						<div class="col-md-9">
							<input type="text" name="marca" class="form-control"  value="{{ @$info->marca }}">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">concentración</label>
						<div class="col-md-9">
							<input type="text" name="concentracion" class="form-control"   value="{{ @$info->concentracion }}">
						</div>
					</div>
					 
					 <div class="form-group row">
						<label class="col-md-3 form-label">Presentación</label>
						<div class="col-md-9">
							<input type="text" name="presentacion" class="form-control"  value="{{ @$info->presentacion }}">
						</div>
					</div>
					  
					<div class="form-group row">
						<label class="col-md-3 form-label">Unidad Medida</label>
						<div class="col-md-6">
							<select name="unidad_medida_id" class="form-control" required="" >
								<option value="">-- Seleccionar --</option>
								@foreach($unidad_medida as $unidad)
								<option @if($unidad->id == @$info->unidad_medida_id) selected @endif value="{{ $unidad->id }}">{{ $unidad->unidad_medida }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<hr>
					 
					<div class="form-group row">
						<label class="col-md-3 form-label">Unidad Medida Mínima</label>
						<div class="col-md-6">
							<select name="unidad_med_min_id" id="unidad_med_min_id" class="form-control" required="" >
								<option value="">-- Seleccionar --</option>
								@foreach($unidad_medida as $unidad)
								<option @if($unidad->id == @$info->unidad_medida_id) selected @endif value="{{ $unidad->id }}">{{ $unidad->unidad_medida }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">¿Cuanta cantidad mínima compone cada insumo?</label>
						<div class="col-md-9">
							<input type="number" onkeyup="sumasubtotal();" onmouseup="sumasubtotal();" name="cantidad_min" id="cantidad_min" class="form-control"  required="" value="{{ @$info->cantidad_min }}">
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
								</tbody>
							</table>

						  	
						</div>
						<div class="col-lg-7">
							<a href="javascript:void(0);" onclick="agregarLote();" class="btn btn-outline-info " title="Agregar un item">
						  		<i class="fa fa-plus "></i>
						  	</a>
						</div>
						<div class="col-lg-5">
							<div class=""><strong>Cantidad:</strong> <span class="badge badge-primary mt-2" id="info_cant">0</span></div>
							<div class=""><strong>Cantidad Mín:</strong> <span class="badge badge-info mt-2" id="info_cant_min">0</span></div>
						</div>
					</div>

				 
					 
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id" value="{{ @$info->id }}">
					<input type="hidden" name="tipo_equipo_id" value="3"><!-- 3 Insumo-->
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	<script >
 
 item = 1;
function agregarLote()
{   
	item = item + 1;
    cadena ='<tr>'; 
		cadena = cadena + '<td><input type="date" class="form-control" id="fch_fabricacion'+item+'" name="fch_fabricacion[]" value=""></td>';
		cadena = cadena + '<td><input type="date" class="form-control" id="fch_vencimiento'+item+'" name="fch_vencimiento[]" value=""></td>';
		cadena = cadena + '<td><input type="text" class="form-control" id="lote'+item+'" name="lote[]" value=""></td>';
		cadena = cadena + '<td><input type="number" class="form-control" id="cantidad_lote'+item+'" name="cantidad_lote[]" item="'+item+'" value="" onkeyup="sumasubtotal();" onmouseup="sumasubtotal();"><input type="hidden" id="cantidad_lote_min'+item+'" name="cantidad_lote_min[]" value=""></td>';
	            
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
agregarLote();
	</script>