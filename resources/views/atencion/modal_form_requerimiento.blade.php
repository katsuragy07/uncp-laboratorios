@inject('m_laboratorio','App\Models\Laboratorio')
@inject('m_unidadmedida','App\Models\Unidad_medida')
@inject('m_proveedor','App\Models\Proveedor')
@inject('m_persona','App\Models\Persona')
@inject('m_cargo','App\Models\Cargo')
@inject('funciones','App\Http\Controllers\FuncionesController')
<?php 
	$unidad_medida = $m_unidadmedida::orderby('unidad_medida','ASC')->get();
?>
<script>
$(function(){
	$('#modal_mante').modal('show');
})
</script>
<style type="text/css" >
	#tb_requerimiento p {
		line-height: 12px;
	}
	
</style>
<div class="modal fade" id="modal_mante" tabindex="-1" role="dialog" aria-labelledby="largemodal" aria-hidden="true">
		<div class="modal-dialog modal-lg " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="largemodal1"> <i class="fa fa-plus"></i> Nuevo requerimiento</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form class="form-horizontal" action="{{ route('guardar.requerimiento') }}" method="POST">
					@csrf
				<div class="modal-body"> 

					<div class="form-group row">
						<label class="col-md-3 form-label">Laboratorio Destino</label>
						<div class="col-md-6">
							<select name="laboratorio_dest_id" required="" class="form-control" >
								<option value="">-- Seleccionar --</option>
								@foreach($m_laboratorio::orderby('nombre_lab','ASC')->get() as $laboratorio)
								<option @if($laboratorio->id == @$info->laboratorio_dest_id) selected @endif  value="{{ $laboratorio->id }}">{{ $laboratorio->nombre_lab }}</option>
								@endforeach
							</select>
						</div>
					</div> 				
					  

					<div class="form-group row">
						<label class="col-md-3 form-label">Encargado del Laboratorio de destino</label>
						<div class="col-md-7">
							<select  id='encargado_lab_dest_id' name="encargado_lab_dest_id"  style="width: 100%;" class="select2AjaxPersona">
								@if(@$info->encargado_lab_dest_id>0)
									<option selected value="{{ $info->encargado_lab_dest_id }}">{{ $funciones->info_persona($info->encargado_lab_dest_id) }}</option>
								@endif
							</select>	
														
						</div>
						<div class="col-md-2">
							<button type="button" class="btn btn-warning" onclick="abrirModalPersona('encargado_lab_dest_id');" > 
                                	<i class="fa fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-success" onclick="abrirModalPersona('encargado_lab_dest_id','Nuevo');" > 
                                	<i class="fa fa-plus"></i>
                            </button>
						</div>
					</div>

				  
					<div class="form-group row">
						<label class="col-md-3 form-label">Solicitante</label>
						<div class="col-md-7">
							<select  id='solicitante_id' name="solicitante_id"  style="width: 100%;" class="select2AjaxPersona">
								@if(@$info->solicitante_id>0)
									<option selected value="{{ $info->solicitante_id }}">{{ $funciones->info_persona($info->solicitante_id) }}</option>
								@endif
							</select>	
														
						</div>
						<div class="col-md-2">
							<button type="button" class="btn btn-warning" onclick="abrirModalPersona('solicitante_id');" > 
                                	<i class="fa fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-success" onclick="abrirModalPersona('solicitante_id','Nuevo');" > 
                                	<i class="fa fa-plus"></i>
                            </button>
						</div>
					</div>


					<div class="form-group row">
						<label class="col-md-3 form-label">Nota</label>
						<div class="col-md-7">
							<textarea name="nota_requerimiento" class="form-control">{{ @$info->nota_requerimiento }}</textarea> 
							 
						</div>
					</div>

				 
 
					<hr>
					<?php if(@$info->id >0){?>
						<!--<div class="alert alert-info" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>No puede modificar el detalle de la atención</div>-->
					<?php }else{ ?>
						<div class="form-group row ">
							<label class="col-md-3 form-label">Buscar Equipo/Material/Insumo:</label>
							<div class="col-md-8">
								<select  id='equipo_id' name="equipo_id"  style="width: 100%;" class="select2AjaxProductoLab"></select>
								
							</div>
							<div class="col-md-1">
								<a href="javascript:void(0);" onclick="addProd();" class="btn btn-outline-info " title="Agregar un item">
							  		<i class="fa fa-plus "></i>
							  	</a>
							</div>
							 
						</div>
						<div class="form-group row">
							<div class="table-responsive">
								<table id="tb_requerimiento" class="table table-hover card-table table-vcenter text-nowrap mb-0">
								<thead>
									<tr> 
										<th>Insumo</th>
										 
										<th>Unidad Medida</th>
										<th>Cantidad</th>
										<th>Lote</th>
										<th></th>
									</tr>
								</thead>
								<tbody> 
									<?php $i = 1; ?>	 
								</tbody>
							</table>

							  	
							</div> 
						</div>
					<?php } ?>

				 
					 
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id" value="{{ @$info->id }}">
					<input type="hidden" name="laboratorio_origen_id" id="b_laboratorio_id" value="{{ Auth::user()->laboratorio_id }}">
					<input type="hidden" name="tipo_equipo_id" id="b_tipo_equipo_id" value="3"><!-- 3 Insumo-->
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	<script >
 recargarAjaxPersona();
 	var x_combo_persona = '';
	function abrirModalPersona(tipo,accion){
   		if(accion=='Nuevo'){
   			x_id = '';
   		}else{
   			x_id = $("#"+tipo).val();
   		}
   		x_combo_persona = tipo;
   		var urlnuevo = "{{ route('mant.persona') }}?id="+x_id;
		$( "#div_mantPersona" ).html('Cargando...');
		$( "#div_mantPersona" ).load(urlnuevo );
    }

	function x_fn_insertRS(){
		option = $('#div_OptionPersona').html();
		if(x_combo_persona == 'solicitante_id'){
			$("#solicitante_id").html(option);
		}else if(x_combo_persona == 'encargado_lab_dest_id'){
			$("#encargado_lab_dest_id").html(option);
		}

		 recargarAjaxPersona();
		//console.log('sdfdsf');
		
	}


var subtotal = 0;
var cadena = '' ; 
var x_comboproducto = '';
var x_id_item = 200000;
var id_item = x_id_item;
function addProd()
{ 
    x_id_item = parseInt(x_id_item)+1;
    id_item = x_id_item;
    urlajax = "{{ route('ajax.info_producto') }}";
    var equipo_id = $("#equipo_id").val();

    if(equipo_id== null){
    	notif({
			msg: "<i class='fa fa-info-circle swing animated'></i> Busque y seleccione insumo",
			type: "info",
			position: "right"
		}); 
		$("#equipo_id").focus();
    }

    $.ajax({ 
            type: "post", 
                //url: urlajax+producto_id, cache: false,
                url: urlajax, cache: false,
              data:{
              	"_token": "{{ csrf_token() }}",
                id:equipo_id,
                laboratorio_id:$("#b_laboratorio_id").val()
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
                equipo_id = obj.id;//Por que aveces pueden buscar por cod.
                nom_equipo = obj.nom_equipo;
                marca = obj.marca;
                concentracion = obj.concentracion;
                especificacion = obj.especificacion;
                unidad_med_min = obj.unidad_med_min;
                unidad_med_min_id = obj.unidad_med_min_id;
                cantidad_min = obj.cantidad_min;
                tipo_equipo_id = obj.tipo_equipo_id;
                cod_patrimonio = obj.cod_patrimonio;
                combo_lote = obj.combo_lote;
                if(jQuery.isEmptyObject(obj.marca)){
                    marca = '';
                }
                if(jQuery.isEmptyObject(obj.concentracion)){
                    concentracion = '';
                }
                if(jQuery.isEmptyObject(obj.especificacion)){
                    especificacion = '';
                }


	cadena = '<tr>';
		if(tipo_equipo_id==1){
			cadena = cadena + '<td><input type="hidden" value="'+equipo_id+'" name="equipo_id[]" id="equipo_id'+id_item+'"><b>'+nom_equipo+'</b><p class="mb-0 text-muted fs-13"><b>Código:</b> '+cod_patrimonio+'</p></td>';
		}else{
			cadena = cadena + '<td><input type="hidden" value="'+equipo_id+'" name="equipo_id[]" id="equipo_id'+id_item+'"><b>'+nom_equipo+'</b><p class="mb-0 text-muted fs-13"><b>Marca:</b> '+marca+'</p><p class="mb-0 text-muted fs-13"><b>Concentración:</b> '+concentracion+'</p><p class="mb-0 text-muted fs-13"><b>Especificación:</b> '+especificacion+'</p></td>';
		}

			  
		cadena = cadena + '<td><input type="hidden" value="'+unidad_med_min_id+'" name="unidad_med_min_id[]" id="unidad_med_min_id'+id_item+'"><input type="hidden" id="cantidad_equivalencia'+id_item+'" name="cantidad_equivalencia[]" required  value="'+cantidad_min+'">'+unidad_med_min+'</td>';

		if(tipo_equipo_id==1){
			cadena = cadena + '<td width="15%"><input type="number" required min="1"  class="form-control" id="cantidad_requerimiento_min'+id_item+'" name="cantidad_requerimiento_min[]" readonly value="1"></td>';
			cadena = cadena + '<td><select  class="form-control d-none"  id="lote_equipo_id'+id_item+'" item="'+id_item+'" name="lote_equipo_id[]" onChange="comboLote();"><option value="">Select.</option>'+combo_lote+'</select></td>';
		}else{
			cadena = cadena + '<td width="15%"><input type="number" required min="1"  class="form-control" id="cantidad_requerimiento_min'+id_item+'" name="cantidad_requerimiento_min[]" value=""></td>';
			cadena = cadena + '<td><select  class="form-control" required id="lote_equipo_id'+id_item+'" item="'+id_item+'" name="lote_equipo_id[]" onChange="comboLote();"><option value="">Select.</option>'+combo_lote+'</select></td>';
		}



		cadena = cadena + "<td class='info' width='5%' align='center'><a href='javascript:void(0);' class='elimina btn' title = 'Quitar'><i class='glyphicon glyphicon-remove-circle text-danger'></i></a></td>";
	cadena = cadena + '</tr>';
$("#tb_requerimiento tbody").append(cadena);  
           
        fn_dar_eliminar();    
        comboLote();
        $("#cantidad_requerimiento_min"+id_item).focus();


            }//.Fin success
        })//.Fin Ajax
}
//.Fin addProd

$("#equipo_id").change(function(){ 
    addProd("");
});

function comboLote(){
    $('select[name$="lote_equipo_id[]"]').each(function(){  
        var item = $(this).attr("item");
         var cantidad_lote_min = $('option:selected',this).attr('cantidad_lote_min');
        $("#cantidad_requerimiento_min"+item).attr('max',cantidad_lote_min);
    }) 
};
 
function fn_dar_eliminar(){
		$("a.elimina").click(function(){        
				$(this).parents("#tb_requerimiento tbody tr").remove();                               
				//sumasubtotal();
		});    
	};
$("a.elimina").click(function(){        
	$(this).parents("#tb_requerimiento tbody tr").remove();                               
	//sumasubtotal();
});
 

recargarAjaxProdLab();

	</script>