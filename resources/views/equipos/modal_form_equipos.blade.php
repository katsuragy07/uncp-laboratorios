@inject('m_laboratorio','App\Models\Laboratorio')
@inject('m_persona','App\Models\Persona')
@inject('m_unidadmedida','App\Models\Unidad_medida')
@inject('m_proveedor','App\Models\Proveedor')
@inject('funciones','App\Http\Controllers\FuncionesController')
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
				<form class="form-horizontal" action="{{ route('guardar.equipo') }}" method="POST" enctype="multipart/form-data">
					@csrf
				<div class="modal-body">
					<?php  if(in_array("admin_todo_laboratorio", $PrivUsuario)) {  	?>					
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
					<?php }else{ ?>
						<div class="form-group row">
							<label class="col-md-3 form-label">Laboratorio</label>
							<div class="col-md-9">
								{{ $funciones->Nombre_Laboratorio(Auth::user()->laboratorio_id) }}
								<input type="hidden" name="laboratorio_id" value="{{ Auth::user()->laboratorio_id }}">
							</div>						 
						</div>
					<?php  } ?>

					<div class="form-group row">
						<label class="col-md-3 form-label">Cod Patrimonial</label>
						<div class="col-md-7">
							<input type="text" name="cod_patrimonio" id="cod_patrimonio" class="form-control" value="{{ @$info->cod_patrimonio }}">
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
							<input type="text" name="nom_equipo" id="nom_equipo" class="form-control"  required="" value="{{ @$info->nom_equipo }}">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Ubicación</label>
						<div class="col-md-9">
							<input type="text" name="ubicacion" id="ubicacion" class="form-control"  required="" value="{{ @$info->ubicacion }}">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Responsable</label>
						<div class="col-md-7">
							<select  id='responsable_id' name="responsable_id"  style="width: 100%;" class="select2AjaxPersona">
								@if(@$info->responsable_id>0)
									<option selected value="{{ $info->responsable_id }}">{{ $funciones->info_persona($info->responsable_id) }}</option>
								@endif
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
								@foreach($m_proveedor::orderby('ruc','ASC')->get() as $proveedor)
								<option @if($proveedor->id == @$info->proveedor_id) selected @endif value="{{ $proveedor->id }}">{{ $proveedor->ruc }} {{ $proveedor->proveedor }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Fecha Inicio de Garantía</label>
						<div class="col-md-3">
							<input type="date" name="fch_ini_garantia" class="form-control"  value="{{ @$info->fch_ini_garantia }}">
						</div>
						<label class="col-md-3 form-label">Fecha Fin de Garantía</label>
						<div class="col-md-3">
							<input type="date" name="fch_fin_garantia" class="form-control"  value="{{ @$info->fch_fin_garantia }}">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-md-3 form-label">Plan de mantenimiento (.pdf)</label>
						<div class="col-md-9">
							<input  type="file" name="plan_mantenimiento" class="form-control" accept=".pdf">
							<?php 
								if(@$info->plan_mantenimiento!=''){
								?><a href="files/plan_mantenimiento/{{@$info->plan_mantenimiento}}" class="f_plan_mantenimiento text-info" target="_blank" title="Descargarddd"><?php  echo @$info->plan_mantenimiento; ?></a>
								<input type="hidden" name="f_plan_mantenimiento" id="f_plan_mantenimiento" value="{{@$info->plan_mantenimiento}}">
								<i onclick="elimfile('f_plan_mantenimiento');" class="f_plan_mantenimiento fa fa-lg fa-times-circle  txt-color-red" style="cursor: pointer;"></i>
							<?php }?>
						</div> 
						
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Ultimo mantenimiento</label>
						<div class="col-md-6">
							<input type="date" name="fecha_ult_mantenimiento" id="ubicacion" class="form-control"   value="{{ @$info->fecha_ult_mantenimiento }}">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Próximo mantenimiento</label>
						<div class="col-md-6">
							<input type="date" name="fecha_prox_mantenimiento" id="ubicacion" class="form-control"  value="{{ @$info->fecha_prox_mantenimiento }}">
						</div>
					</div>
 
					<div class="form-group row">
						<label class="col-md-3 form-label">Estado</label>
						<div class="col-md-6">
							<select name="estado_equipo" class="form-control"  >
								<option value="">-- Seleccionar --</option>
								<option @if(@$info->estado_equipo =='NU') selected @endif value="NU">Nuevo</option>
								<option @if(@$info->estado_equipo =='BU') selected @endif value="BU">Bueno</option>
								<option @if(@$info->estado_equipo =='RE') selected @endif value="RE">Regular</option>
								<option @if(@$info->estado_equipo =='ML') selected @endif value="ML">Malo</option> 
							</select>
						</div>
					</div>

					 
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id" id="" value="{{ @$info->id }}">
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
   		var urlnuevo = "{{ route('mant.persona') }}?id="+x_id;
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
                url: "{{ route('ajax.info_inventario_data') }}", cache: false,
              data:{
              	"_token": "{{ csrf_token() }}",
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


</script>