@inject('funciones','App\Http\Controllers\FuncionesController')
<script>
$(function(){
	$('#modal_mante_agregar').modal('show');
})
</script>
<div class="modal fade" id="modal_mante_agregar" tabindex="-1" role="dialog" aria-labelledby="largemodal" aria-hidden="true">
		<div class="modal-dialog modal-lg " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="largemodal1"> <i class="fa fa-edit"></i> Agregar insumo</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form class="form-horizontal" action="{{ route('guardar.equipo') }}" method="POST">
					@csrf 
				<div class="modal-body">
					<div class="form-group row ">
							<label class="col-md-2 form-label">Buscar Insumo:</label>
							<div class="col-md-8">
								<select  id='equipo_id' name="equipo_id"  style="width: 100%;" class="select2AjaxProductoLab"></select>
								
							</div>
							<div class="col-md-2"> 
							  	<button type="button" id="btnnuevo_insumo" onclick="nuevo_insumo();" class="btn btn-success" > 
                                	<i class="fa fa-plus"></i> Nuevo
                            	</button>
							</div>
							 
						</div>
					<table class="table mb-0">
						<tbody>
							<tr>
								<td class="py-2 px-0" style="width: 30%"> <span class="font-weight-semibold w-50">Laboratorio </span> </td>
								<td class="py-2 px-0" id="nombre_lab">{{ $funciones->Nombre_Laboratorio(Auth::user()->laboratorio_id) }}</td>
							</tr>
							<tr>
								<td class="py-2 px-0"> <span class="font-weight-semibold w-50">Tipo de fiscalización </span> </td>
								<td class="py-2 px-0" id="tipo_fiscalizado"></td>
							</tr>
							<tr>
								<td class="py-2 px-0"> <span class="font-weight-semibold w-50">Nombre Insumo </span> </td>
								<td class="py-2 px-0" id="nom_equipo"><b></b></td>
							</tr>
							<tr>
								<td class="py-2 px-0"> <span class="font-weight-semibold w-50">Marca </span> </td>
								<td class="py-2 px-0" id="marca"></td>
							</tr>
							<tr>
								<td class="py-2 px-0"> <span class="font-weight-semibold w-50">Concentración </span> </td>
								<td class="py-2 px-0" id="concentracion"></td>
							</tr>
							<tr>
								<td class="py-2 px-0"> <span class="font-weight-semibold w-50">Especificación </span> </td>
								<td class="py-2 px-0" id="especificacion"></td>
							</tr>
							<tr>
								<td class="py-2 px-0"> <span class="font-weight-semibold w-50">Unidad Medida </span> </td>
								<td class="py-2 px-0" id="unidad_medida"></td>
							</tr>
							<tr>
								<td class="py-2 px-0"> <span class="font-weight-semibold w-50">Unidad Medida en Almacen </span> </td>
								<td class="py-2 px-0" id="unidad_med_min"></td>
							</tr>
							<tr>
								<td class="py-2 px-0"> <span class="font-weight-semibold w-50">Equivalencia en cantidad </span> </td>
								<td class="py-2 px-0" id="td_cantidad_min"></td>
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
					<input type="hiddenx" name="cantidad_min" id="cantidad_min" class="form-control"  required="" value="">					
					<input type="hiddenx" name="laboratorio_id" value="{{ Auth::user()->laboratorio_id }}"> 
					<input type="hidden" name="tipo_equipo_id" id="b_tipo_equipo_id" value="3">
					<input type="hidden" name="accion" value="solo_agregar_lote">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	<script >
 $("#equipo_id").change(function(){ 
 	equipo_id = $("#equipo_id").val()
     $.ajax({ 
            type: "post", 
                //url: urlajax+producto_id, cache: false,
                url: "{{ route('ajax.info_producto') }}", cache: false,
              data:{
              	"_token": "{{ csrf_token() }}",
                id:equipo_id,
               } ,          
            success: function(response){ 
                var obj = JSON.parse(response);  
                if(obj==''){
                    notif({
						msg: "<i class='fa fa-info-circle swing animated'></i> No existe información del insumo seleccionado",
						type: "error",
						position: "right"
					}); 
					$("#equipo_id").focus();
                    return false;
                }
                equipo_id = obj.id;
                nom_equipo = obj.nom_equipo;
                marca = obj.marca;
                concentracion = obj.concentracion;
                especificacion = obj.especificacion;
                unidad_med_min = obj.unidad_med_min;
                unidad_medida = obj.unidad_medida;
                cantidad_min = obj.cantidad_min;
                tipo_fiscalizado = obj.tipo_fiscalizado;
               
                if(jQuery.isEmptyObject(obj.marca)){
                    marca = '';
                }

                $("#nom_equipo").html(nom_equipo);
                $("#marca").html(marca);
                $("#concentracion").html(concentracion);
                $("#especificacion").html(especificacion);
                $("#unidad_medida").html(unidad_medida);
                $("#unidad_med_min").html(unidad_med_min);
                $("#cantidad_min").val(cantidad_min);
                $("#td_cantidad_min").html(cantidad_min);
                $("#tipo_fiscalizado").html(tipo_fiscalizado);
               // $("#unidad_medida_min").val(unidad_medida_min);


            }//.Fin Success
        })
});


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

agregarLote();
recargarAjaxProdLab();
//agregarLote();
	</script>