<?php $m_laboratorio = app('App\Models\Laboratorio'); ?>
<?php $m_persona = app('App\Models\Persona'); ?>
<?php $m_unidadmedida = app('App\Models\Unidad_medida'); ?>
<?php $m_proveedor = app('App\Models\Proveedor'); ?>
<?php $funciones = app('App\Http\Controllers\FuncionesController'); ?>
<?php $PrivUsuario = $funciones->PrivUsuario();	?>
<script>
$(function(){
	$('#modal_mante').modal('show');
})
</script>
<style type="text/css" media="screen">
	.btn-file {
  position: relative;
  overflow: hidden;
}
.btn-file input[type=file] {
  position: absolute;
  top: 0;
  right: 0;
  min-width: 100%;
  min-height: 100%;
  font-size: 100px;
  text-align: right;
  filter: alpha(opacity=0);
  opacity: 0;
  outline: none;
  background: white;
  cursor: inherit;
  display: block;
}
	
</style>
<div class="modal fade" id="modal_mante" tabindex="-1" role="dialog" aria-labelledby="largemodal" aria-hidden="true">
		<div class="modal-dialog modal-lg " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="largemodal1"> <i class="fa fa-plus"></i> Nuevo Equipo</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form class="form-horizontal" action="<?php echo e(route('guardar.equipo')); ?>" method="POST" enctype="multipart/form-data">
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
						<label class="col-md-3 form-label">Cod Patrimonial</label>
						<div class="col-md-7">
							<input type="text" name="cod_patrimonio" id="cod_patrimonio" class="form-control" value="<?php echo e(@$info->cod_patrimonio); ?>">
						</div>
						<div class="col-md-2">
							<button type="button" id="btn_buscarpatrimonio" class="btn btn-primary"> 
                                <i class="fa fa-search"></i> Buscar
                            </button>
						</div>
					</div>				
					<div class="form-group row">
						<label class="col-md-3 form-label">Nombre Equipo</label>
						<div class="col-md-9">
							<input type="text" name="nom_equipo" id="nom_equipo" class="form-control"  required="" value="<?php echo e(@$info->nom_equipo); ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Ubicación</label>
						<div class="col-md-9">
							<input type="text" name="ubicacion" id="ubicacion" class="form-control"  required="" value="<?php echo e(@$info->ubicacion); ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Responsable</label>
						<div class="col-md-7">
							<select  id='responsable_id' name="responsable_id"  style="width: 100%;" class="select2AjaxPersona">
								<?php if(@$info->responsable_id>0): ?>
									<option selected value="<?php echo e($info->responsable_id); ?>"><?php echo e($funciones->info_persona($info->responsable_id)); ?></option>
								<?php endif; ?>
							</select>	
														
						</div>
						<div class="col-md-2">
							<button type="button" class="btn btn-warning" onclick="abrirModalPersona('responsable_id');" > 
                                	<i class="fa fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-success" onclick="abrirModalPersona('responsable_id','Nuevo');" > 
                                	<i class="fa fa-plus"></i>
                            </button>
						</div>
					</div>
				 
					<div class="form-group row">
						<label class="col-md-3 form-label">Proveedor</label>
						<div class="col-md-6">
							<select name="proveedor_id" class="form-control"  >
								<option value="">-- Seleccionar --</option>
								<?php $__currentLoopData = $m_proveedor::orderby('ruc','ASC')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proveedor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option <?php if($proveedor->id == @$info->proveedor_id): ?> selected <?php endif; ?> value="<?php echo e($proveedor->id); ?>"><?php echo e($proveedor->ruc); ?> <?php echo e($proveedor->proveedor); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Fecha Inicio de Garantía</label>
						<div class="col-md-3">
							<input type="date" name="fch_ini_garantia" class="form-control"  value="<?php echo e(@$info->fch_ini_garantia); ?>">
						</div>
						<label class="col-md-3 form-label">Fecha Fin de Garantía</label>
						<div class="col-md-3">
							<input type="date" name="fch_fin_garantia" class="form-control"  value="<?php echo e(@$info->fch_fin_garantia); ?>">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-md-3 form-label">Plan de mantenimiento (.pdf)</label>
						<div class="col-md-9">
							<input  type="file" name="plan_mantenimiento" class="form-control" accept=".pdf">
							<?php 
								if(@$info->plan_mantenimiento!=''){
								?><a href="files/plan_mantenimiento/<?php echo e(@$info->plan_mantenimiento); ?>" class="f_plan_mantenimiento text-info" target="_blank" title="Descargarddd"><?php  echo @$info->plan_mantenimiento; ?></a>
								<input type="hidden" name="f_plan_mantenimiento" id="f_plan_mantenimiento" value="<?php echo e(@$info->plan_mantenimiento); ?>">
								<i onclick="elimfile('f_plan_mantenimiento');" class="f_plan_mantenimiento fa fa-lg fa-times-circle  txt-color-red" style="cursor: pointer;"></i>
							<?php }?>
						</div> 
						
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Ultimo mantenimiento</label>
						<div class="col-md-6">
							<input type="date" name="fecha_ult_mantenimiento" id="ubicacion" class="form-control"   value="<?php echo e(@$info->fecha_ult_mantenimiento); ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Próximo mantenimiento</label>
						<div class="col-md-6">
							<input type="date" name="fecha_prox_mantenimiento" id="ubicacion" class="form-control"  value="<?php echo e(@$info->fecha_prox_mantenimiento); ?>">
						</div>
					</div>
 
					<div class="form-group row">
						<label class="col-md-3 form-label">Estado</label>
						<div class="col-md-6">
							<select name="estado_equipo" class="form-control"  >
								<option value="">-- Seleccionar --</option>
								<option <?php if(@$info->estado_equipo =='NU'): ?> selected <?php endif; ?> value="NU">Nuevo</option>
								<option <?php if(@$info->estado_equipo =='BU'): ?> selected <?php endif; ?> value="BU">Bueno</option>
								<option <?php if(@$info->estado_equipo =='RE'): ?> selected <?php endif; ?> value="RE">Regular</option>
								<option <?php if(@$info->estado_equipo =='ML'): ?> selected <?php endif; ?> value="ML">Malo</option> 
							</select>
						</div>
					</div>

					 
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id" id="" value="<?php echo e(@$info->id); ?>">
					<input type="hidden" name="unidad_medida_id" value="1"><!--La unidad de medida de equipo es 1 UNIDAD-->
					<input type="hidden" name="tipo_equipo_id" value="1"><!-- 1 EQUIPO DE ESPECIALIDAD-->
					<input type="hidden" name="tipo_fiscalizado_id" value="1"><!-- 1 No fiscalizado-->
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</div>
				</form>
			</div>
		</div>
	</div>

	

<script>

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
		if(x_combo_persona == 'responsable_id'){
			$("#responsable_id").html(option);
			//recargarAjaxPersona();
		}
		 recargarAjaxPersona();
		//console.log('sdfdsf');
		
	}

 

	 $("#btn_buscarpatrimonio").click(function(){ 
 	equipo_id = $("#cod_patrimonio").val()
 	$("#nom_equipo").val('Buscando...');
     $.ajax({ 
            type: "post", 
                url: "<?php echo e(route('ajax.info_inventario_data')); ?>", cache: false,
              data:{
              	"_token": "<?php echo e(csrf_token()); ?>",
                cod_patrimonio:equipo_id,
               } ,          
            success: function(response){ 
            	$("#nom_equipo").val('');
                var obj = JSON.parse(response);  
                if(obj==null){
                    notif({
						msg: "<i class='fa fa-info-circle swing animated'></i> No existe información con el código de Patrimonial",
						type: "error",
						position: "right"
					}); 
					$("#nom_equipo").focus();
                    return false;
                }
                //equipo_id = obj.id;
                nom_equipo = obj.DENOMINACION_BIEN;
                ubicacion = obj.NOMBRE_LOCAL;
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

                $("#nom_equipo").val(nom_equipo);
                $("#ubicacion").val(ubicacion);
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


</script><?php /**PATH C:\wamp64\www\sistemauncp\laboratorio\resources\views/equipos/modal_form_equipos.blade.php ENDPATH**/ ?>