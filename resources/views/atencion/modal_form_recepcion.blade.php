@inject('m_persona','App\Models\Persona')
@inject('m_proveedor','App\Models\Proveedor')
@inject('funciones','App\Http\Controllers\FuncionesController')
<script>
$(function(){
	$('#modal_mante').modal('show');
})
</script>
<style type="text/css" >
	#tb_atencion p {
		line-height: 12px;
	}
</style>
<div class="modal fade" id="modal_mante" tabindex="-1" role="dialog" aria-labelledby="largemodal" aria-hidden="true">
		<div class="modal-dialog modal-lg " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="largemodal1"> <i class="fa fa-plus"></i> Recepción del proveedor</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form class="form-horizontal" action="{{ route('guardar.recepcion') }}" method="POST" enctype="multipart/form-data">
					@csrf
				<div class="modal-body"> 
 
					<div class="form-group row">
						<label class="col-md-3 form-label">Laboratorio</label>
						<div class="col-md-9">
							{{ $funciones->Nombre_Laboratorio(Auth::user()->laboratorio_id) }}
							<input type="hidden" name="laboratorio_id" value="{{ Auth::user()->laboratorio_id }}">
						</div>						 
					</div>			
					<div class="form-group row">
						<label class="col-md-3 form-label">Fecha Pedido</label>
						<div class="col-md-3">
							<input type="date" name="fecha_solicitud" class="form-control"  required="" value="{{ @$info->fecha_solicitud }}">
						</div> 
						 
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Fecha recepción</label>
						<div class="col-md-3">
							<input type="date" name="fecha_recepcion" class="form-control"   value="{{ (@$info->fecha_recepcion!='')?@$info->fecha_recepcion:date('Y-m-d') }}">
						</div> 
					</div>
					
					<div class="form-group row">
						<label class="col-md-3 form-label">Proveedor</label>
						<div class="col-md-6">
							<select name="proveedor_id" class="form-control"  >
								<option value="">-- Seleccionar --</option>
								@foreach($m_proveedor::orderby('proveedor','ASC')->get() as $proveedor)
								<option @if($proveedor->id == @$info->proveedor_id) selected @endif value="{{ $proveedor->id }}">{{ $proveedor->proveedor }} - {{ $proveedor->ruc }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-md-3 form-label">Responsable de recepción</label>
						<div class="col-md-6">
							<select name="resp_recepcion_id" class="form-control" required="" >
								<option value="">-- Seleccionar --</option>
								@foreach($m_persona::where('tipo_documento_id','!=','6')->orderby('nombres','ASC')->get() as $persona)
								<option @if($persona->id == @$info->resp_recepcion_id) selected @endif value="{{ $persona->id }}">{{ $persona->nombres }} {{ $persona->apellidos }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-md-3 form-label">Num. documento sustento (O. Compra)</label>
						<div class="col-md-6">
							<input type="text" name="numdoc_sustento" class="form-control"  value="{{ @$info->numdoc_sustento }}">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Documento Sustento (O. Compra)</label>
						<div class="col-md-6">
							<input type="file" name="doc_sustento" class="form-control"  value="{{ @$info->doc_sustento }}">
							<?php 
								if(@$info->doc_sustento!=''){
								?><a href="files/doc_sustento/{{@$info->doc_sustento}}" class="text-info" target="_blank" title="Descargar"><?php  echo @$info->doc_sustento; ?></a>
							<?php }?>
						</div>
					</div>
 
					<hr>
					<?php if(@$info->id >0){?>
						<!--<div class="alert alert-info" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>No puede modificar el detalle de la atención</div>-->
					<?php }else{ ?>
						<div class="form-group row ">
							<label class="col-md-3 form-label">Buscar Insumo:</label>
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
								<table id="tb_atencion" class="table table-hover card-table table-vcenter text-nowrap mb-0">
								<thead>
									<tr> 
										<th>Insumo</th>
										 
										 
										<th>F. fabricación</th>
										<th>F. vencimiento</th>
										<th>Lote</th>
										<th>Cantidad</th>
										<th style="width: 5px"></th>
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
                unidad_medida = obj.unidad_medida;
                unidad_medida_id = obj.unidad_medida_id;

                cantidad_min = obj.cantidad_min;
                combo_lote = obj.combo_lote;
                if(jQuery.isEmptyObject(obj.marca)){
                    marca = '';
                }


	cadena = '<tr>';
		cadena = cadena + '<td><input type="hidden" value="'+equipo_id+'" name="equipo_id[]" id="equipo_id'+id_item+'"><b>'+nom_equipo+'</b><p class="mb-0 text-muted fs-13"><b>Marca:</b> '+marca+'</p><p class="mb-0 text-muted fs-13"><b>Concentración:</b> '+concentracion+'</p><p class="mb-0 text-muted fs-13"><b>Especificación:</b> '+especificacion+'</p><p class="mb-0 text-muted fs-13"><b>Unid. medida: '+unidad_medida+'</b></p><input type="hidden" value="'+unidad_medida_id+'" name="unidad_medida_id[]" id="unidad_medida_id'+id_item+'"></td>';
	  
 
		

		cadena = cadena + '<td><input type="hidden" class="form-control" id="lote_equipo_id'+id_item+'" name="lote_equipo_id[]" value=""><input type="date" class="form-control" id="fch_fabricacion'+id_item+'" name="fch_fabricacion[]" value=""></td>';
		cadena = cadena + '<td><input type="date" class="form-control" id="fch_vencimiento'+id_item+'" name="fch_vencimiento[]" value=""></td>';
		cadena = cadena + '<td><input type="text" class="form-control" id="lote'+id_item+'" name="lote[]" value=""></td>';

		cadena = cadena + '<td  ><input type="hidden" id="cantidad_equivalencia'+id_item+'" name="cantidad_equivalencia[]" required  value="'+cantidad_min+'"><input step="Any" type="number" min="0.1" required class="form-control" id="cantidad_recepcion'+id_item+'" name="cantidad_recepcion[]" value=""></td>';
  
		cadena = cadena + "<td class='info' width='5%' align='center'><a href='javascript:void(0);' class='elimina btn pl-0 pr-0' title = 'Quitar'><i class='glyphicon glyphicon-remove-circle text-danger'></i></a></td>";
	cadena = cadena + '</tr>';
$("#tb_atencion tbody").append(cadena);  
           
        fn_dar_eliminar();    
        comboLote();
        $("#cantidad_recepcion"+id_item).focus();


            }//.Fin success
        })//.Fin Ajax
}
//.Fin addProd

$("#equipo_id").change(function(){ 
    addProd("");
});
 
function fn_dar_eliminar(){
		$("a.elimina").click(function(){        
				$(this).parents("#tb_atencion tbody tr").remove();                               
				//sumasubtotal();
		});    
	};
$("a.elimina").click(function(){        
	$(this).parents("#tb_atencion tbody tr").remove();                               
	//sumasubtotal();
});
 

recargarAjaxProdLab();

	</script>