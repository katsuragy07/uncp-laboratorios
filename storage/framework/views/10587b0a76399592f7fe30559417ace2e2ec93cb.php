<?php $m_laboratorio = app('App\Models\Laboratorio'); ?>
<?php $m_unidadmedida = app('App\Models\Unidad_medida'); ?>
<?php $m_proveedor = app('App\Models\Proveedor'); ?>
<?php $m_persona = app('App\Models\Persona'); ?>
<?php $m_cargo = app('App\Models\Cargo'); ?>
<?php $funciones = app('App\Http\Controllers\FuncionesController'); ?>
<?php 
	$unidad_medida = $m_unidadmedida::orderby('unidad_medida','ASC')->get();
?>
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
					<h5 class="modal-title" id="largemodal1"> <i class="fa fa-plus"></i> Nueva Atención</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form class="form-horizontal" action="<?php echo e(route('guardar.atencion')); ?>" method="POST">
					<?php echo csrf_field(); ?>
				<div class="modal-body"> 

					<div class="form-group row">
						<label class="col-md-3 form-label">Laboratorio Destino</label>
						<div class="col-md-6">
							<select name="laboratorio_dest_id" required="" class="form-control" >
								<option value="">-- Seleccionar --</option>
								<?php $__currentLoopData = $m_laboratorio::orderby('nombre_lab','ASC')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $laboratorio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option <?php if($laboratorio->id == @$info->laboratorio_dest_id): ?> selected <?php endif; ?>  value="<?php echo e($laboratorio->id); ?>"><?php echo e($laboratorio->nombre_lab); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
					</div> 				
					<div class="form-group row">
						<label class="col-md-3 form-label">Fecha Pedido</label>
						<div class="col-md-3">
							<input type="date" name="fch_pedido" class="form-control"  required="" value="<?php echo e(@$info->fch_pedido); ?>">
						</div> 
						<label class="col-md-3 form-label">Hora Pedido</label>
						<div class="col-md-3">
							<input type="time" name="hora_pedido" class="form-control"  value="<?php echo e(@$info->hora_pedido); ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Fecha atención</label>
						<div class="col-md-3">
							<input type="date" name="fch_entrega" class="form-control"   value="<?php echo e((@$info->fch_entrega!='')?@$info->fch_entrega:date('Y-m-d')); ?>">
						</div>
						<label class="col-md-3 form-label">Hora Atención</label>
						<div class="col-md-3">
							<input type="time" name="hora_entrega" class="form-control"  value="<?php echo e((@$info->hora_entrega!='')?@$info->hora_entrega:date('H:i')); ?>">
						</div>
					</div>
					    
					<div class="form-group row">
						<label class="col-md-3 form-label">Encargado Laboratorio destino</label>
						<div class="col-md-7">
							<select  id='encargado_lab_id' name="encargado_lab_id"  style="width: 100%;" class="select2AjaxPersona">
								<?php if(@$info->encargado_lab_id>0): ?>
									<option selected value="<?php echo e($info->encargado_lab_id); ?>"><?php echo e($funciones->info_persona($info->encargado_lab_id)); ?></option>
								<?php endif; ?>
							</select>	
														
						</div>
						<div class="col-md-2">
							<button type="button" class="btn btn-warning" onclick="abrirModalPersona('encargado_lab_id');" > 
                                	<i class="fa fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-success" onclick="abrirModalPersona('encargado_lab_id','Nuevo');" > 
                                	<i class="fa fa-plus"></i>
                            </button>
						</div>
					</div>


					<div class="form-group row">
						<label class="col-md-3 form-label">Recibido por</label>
						<div class="col-md-7">
							<select  id='recibido_id' name="recibido_id"  style="width: 100%;" class="select2AjaxPersona">
								<?php if(@$info->recibido_id>0): ?>
									<option selected value="<?php echo e($info->recibido_id); ?>"><?php echo e($funciones->info_persona($info->recibido_id)); ?></option>
								<?php endif; ?>
							</select>	
														
						</div>
						<div class="col-md-2">
							<button type="button" class="btn btn-warning" onclick="abrirModalPersona('recibido_id');" > 
                                	<i class="fa fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-success" onclick="abrirModalPersona('recibido_id','Nuevo');" > 
                                	<i class="fa fa-plus"></i>
                            </button>
						</div>
					</div>
 
					<div class="form-group row">
						<label class="col-md-3 form-label">Solicitado por</label>
						<div class="col-md-7">
							<select  id='solicitado_id' name="solicitado_id"  style="width: 100%;" class="select2AjaxPersona">
								<?php if(@$info->solicitado_id>0): ?>
									<option selected value="<?php echo e($info->solicitado_id); ?>"><?php echo e($funciones->info_persona($info->solicitado_id)); ?></option>
								<?php endif; ?>
							</select>				
						</div>
						<div class="col-md-2">
							<button type="button" class="btn btn-warning" onclick="abrirModalPersona('solicitado_id');" > 
                                	<i class="fa fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-success" onclick="abrirModalPersona('solicitado_id','Nuevo');" > 
                                	<i class="fa fa-plus"></i>
                            </button>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-md-3 form-label">Cargo</label>
						<div class="col-md-3">
							<select name="cargo_solicitado" class="form-control" required="" >
								<option value="">-- Seleccionar --</option>
								<?php $__currentLoopData = $m_cargo::orderby('cargo','ASC')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cargo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option <?php if($cargo->id == @$info->cargo_solicitado): ?> selected <?php endif; ?> value="<?php echo e($cargo->id); ?>"><?php echo e($cargo->cargo); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
						<label class="col-md-3 form-label">Núm. Documento</label>
						<div class="col-md-3">
							<input type="text" name="numdoc_solicitado" class="form-control"  value="<?php echo e(@$info->numdoc_solicitado); ?>">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-md-3 form-label">Autorizado por</label>
						<div class="col-md-7">
							<select  id='autorizado_id' name="autorizado_id"  style="width: 100%;" class="select2AjaxPersona">
								<?php if(@$info->autorizado_id>0): ?>
									<option selected value="<?php echo e($info->autorizado_id); ?>"><?php echo e($funciones->info_persona($info->autorizado_id)); ?></option>
								<?php endif; ?>
							</select>				
						</div>
						<div class="col-md-2">
							<button type="button" class="btn btn-warning" onclick="abrirModalPersona('autorizado_id');" > 
                                	<i class="fa fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-success" onclick="abrirModalPersona('autorizado_id','Nuevo');" > 
                                	<i class="fa fa-plus"></i>
                            </button>
						</div>
					</div>
 
					<div class="form-group row">
						<label class="col-md-3 form-label">Cargo</label>
						<div class="col-md-3">
							<select name="cargo_autorizado" class="form-control" required="" >
								<option value="">-- Seleccionar --</option>
								<?php $__currentLoopData = $m_cargo::orderby('cargo','ASC')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cargo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option <?php if($cargo->id == @$info->cargo_autorizado): ?> selected <?php endif; ?> value="<?php echo e($cargo->id); ?>"><?php echo e($cargo->cargo); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
						<label class="col-md-3 form-label">Núm. Documento</label>
						<div class="col-md-3">
							<input type="text" name="numdoc_autorizado" class="form-control"  value="<?php echo e(@$info->numdoc_autorizado); ?>">
						</div>
					</div>
				  
					<div class="form-group row">
						<label class="col-md-3 form-label">Responsable de atención</label>
						<div class="col-md-7">
							<select  id='resp_atencion_id' name="resp_atencion_id"  style="width: 100%;" class="select2AjaxPersona">
								<?php if(@$info->resp_atencion_id>0): ?>
									<option selected value="<?php echo e($info->resp_atencion_id); ?>"><?php echo e($funciones->info_persona($info->resp_atencion_id)); ?></option>
								<?php endif; ?>
							</select>
						</div>
						<div class="col-md-2">
							<button type="button" class="btn btn-warning" onclick="abrirModalPersona('resp_atencion_id');" > 
                                	<i class="fa fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-success" onclick="abrirModalPersona('resp_atencion_id','Nuevo');" > 
                                	<i class="fa fa-plus"></i>
                            </button>
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
					<input type="hidden" name="id" value="<?php echo e(@$info->id); ?>">
					<input type="hidden" name="laboratorio_origen_id" id="b_laboratorio_id" value="<?php echo e(Auth::user()->laboratorio_id); ?>">
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
   		var urlnuevo = "<?php echo e(route('mant.persona')); ?>?id="+x_id;
		$( "#div_mantPersona" ).html('Cargando...');
		$( "#div_mantPersona" ).load(urlnuevo );
    }

	function x_fn_insertRS(){
		option = $('#div_OptionPersona').html();
		if(x_combo_persona == 'encargado_lab_id'){
			$("#encargado_lab_id").html(option);
		}else if(x_combo_persona == 'recibido_id'){
			$("#recibido_id").html(option);
		}else if(x_combo_persona == 'solicitado_id'){
			$("#solicitado_id").html(option);
		}else if(x_combo_persona == 'autorizado_id'){
			$("#autorizado_id").html(option);
		}else if(x_combo_persona == 'resp_atencion_id'){
			$("#resp_atencion_id").html(option);
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
    urlajax = "<?php echo e(route('ajax.info_producto')); ?>";
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
              	"_token": "<?php echo e(csrf_token()); ?>",
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
                combo_lote = obj.combo_lote;
                if(jQuery.isEmptyObject(obj.marca)){
                    marca = '';
                }


	cadena = '<tr>';
		cadena = cadena + '<td><input type="hidden" value="'+equipo_id+'" name="equipo_id[]" id="equipo_id'+id_item+'"><b>'+nom_equipo+'</b><p class="mb-0 text-muted fs-13"><b>Marca:</b> '+marca+'</p><p class="mb-0 text-muted fs-13"><b>Concentración:</b> '+concentracion+'</p><p class="mb-0 text-muted fs-13"><b>Especificación:</b> '+especificacion+'</p></td>';
	  
		cadena = cadena + '<td><input type="hidden" value="'+unidad_med_min_id+'" name="unidad_med_min_id[]" id="unidad_med_min_id'+id_item+'">'+unidad_med_min+'</td>';
		cadena = cadena + '<td width="15%"><input type="hidden" id="cantidad_equivalencia'+id_item+'" name="cantidad_equivalencia[]" required  value="'+cantidad_min+'"><input type="number" required min="1" max="0" class="form-control" id="cantidad_atencion_min'+id_item+'" name="cantidad_atencion_min[]" value=""></td>';
		cadena = cadena + '<td><select required class="form-control" id="lote_equipo_id'+id_item+'" item="'+id_item+'" name="lote_equipo_id[]" onChange="comboLote();">'+combo_lote+'</select></td>';
		cadena = cadena + "<td class='info' width='5%' align='center'><a href='javascript:void(0);' class='elimina btn' title = 'Quitar'><i class='glyphicon glyphicon-remove-circle text-danger'></i></a></td>";
	cadena = cadena + '</tr>';
$("#tb_atencion tbody").append(cadena);  
           
        fn_dar_eliminar();    
        comboLote();
        $("#cantidad_atencion_min"+id_item).focus();


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
        $("#cantidad_atencion_min"+item).attr('max',cantidad_lote_min);
    }) 
};
 
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

	</script><?php /**PATH C:\wamp64\www\sistemauncp\laboratorio\resources\views/atencion/modal_form_atencion.blade.php ENDPATH**/ ?>