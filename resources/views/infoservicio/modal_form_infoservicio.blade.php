@inject('m_laboratorio','App\Models\Laboratorio')
@inject('m_persona','App\Models\Persona')
@inject('m_asignatura','App\Models\Asignatura')
@inject('m_unidadmedida','App\Models\Unidad_medida')
@inject('m_proveedor','App\Models\Proveedor')
@inject('m_periodo','App\Models\Periodo')
@inject('funciones','App\Http\Controllers\FuncionesController')
<script>
$(function(){
	$('#modal_mante').modal('show');
})
recargarAjaxUbigeo();
</script>
<div class="modal fade" id="modal_mante"   role="dialog" aria-labelledby="largemodal" aria-hidden="true" >
		<div class="modal-dialog modal-lg " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="largemodal1"> <i class="fa fa-plus"></i> Nuevo Servicio</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form class="form-horizontal" action="{{ route('guardar.infoservicio') }}" method="POST" enctype="multipart/form-data">
					@csrf
				<div class="modal-body">
					<div class="form-group row">
						<label class="col-md-3 form-label">Laboratorio</label>
						<div class="col-md-6">

							<select name="laboratoriodet_id" id="laboratoriodet_id" required="" class="form-control" >
								<option value="">Seleccionar...</option>
								@foreach($laboratorio_det as $laboratorio)
								<option @if($laboratorio->id == @$info->laboratoriodet_id) selected @endif value="{{ $laboratorio->id }}">{{ $laboratorio->full_name }}</option>
								@endforeach
							</select>
						</div>
					</div>		

					<div class="form-group row">
						<label class="col-md-3 form-label">Semestre Académico:</label>
						<div class="col-md-6">

							<select name="periodo_id" id="periodo_id" required="" class="form-control">				
								<option value="">-- Seleccionar --</option>
								@foreach($m_periodo::orderby('periodo','DESC')->get() as $periodo)
								<option @if($periodo->id == @$info->periodo_id) selected @endif value="{{ $periodo->id }}">{{ $periodo->periodo }}</option>
								@endforeach
							</select>
						</div>
					</div> 
					
					<div class="form-group row">
						<label class="col-md-3 form-label">Solicitante</label>
						<div class="col-md-7">
							<select  id='solicitante_id' name="solicitante_id" required="" style="width: 100%;" class="select2AjaxPersona">
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
						<label class="col-md-3 form-label">Representante Legal</label>
						<div class="col-md-7">
							<select  id='representante_id' name="representante_id" required=""  style="width: 100%;" class="select2AjaxPersona">
								@if(@$info->representante_id>0)
									<option selected value="{{ $info->representante_id }}">{{ $funciones->info_persona($info->representante_id) }}</option>
								@endif
							</select>	
														
						</div>
						<div class="col-md-2">
							<button type="button" class="btn btn-warning" onclick="abrirModalPersona('representante_id');" > 
                                	<i class="fa fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-success" onclick="abrirModalPersona('representante_id','Nuevo');" > 
                                	<i class="fa fa-plus"></i>
                            </button>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-md-3 form-label">Personal Contacto</label>
						<div class="col-md-7">
							<select  id='personal_contacto_id' name="personal_contacto_id" required="" style="width: 100%;" class="select2AjaxPersona">
								@if(@$info->personal_contacto_id>0)
									<option selected value="{{ $info->personal_contacto_id }}">{{ $funciones->info_persona($info->personal_contacto_id) }}</option>
								@endif
							</select>	
														
						</div>
						<div class="col-md-2">
							<button type="button" class="btn btn-warning" onclick="abrirModalPersona('personal_contacto_id');" > 
                                	<i class="fa fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-success" onclick="abrirModalPersona('personal_contacto_id','Nuevo');" > 
                                	<i class="fa fa-plus"></i>
                            </button>
						</div>
					</div>
					 
 

					<div class="form-group row">
						<label class="col-md-3 form-label">Producto/Servicio</label>
						<div class="col-md-9">
							<input type="text" name="producto" id="producto" class="form-control" required="" autocomplete="off" value="{{ @$info->producto }}">
						</div>
					</div>
					
					<div class="form-group row">
						<label class="col-md-3 form-label">Servicio Solicitado</label>
						<div class="col-md-9">
						<input type="text" name="servicio_solicitado" id="servicio_solicitado"  class="form-control" autocomplete="off" value="{{ @$info->servicio_solicitado }}">								
						</div>
					</div>

				
					<div class="container" id="contenidos_aliment" style="display: none">
					<div class="form-group row" >
						<label class="col-md-3 form-label">Marca</label>
						<div class="col-md-4">
							<input type="text" name="marca" id="marca" class="form-control"  value="{{ @$info->marca }}">
						</div>

						<div class="col-md-2">
							<input type="text" name="ds_marca" placeholder="DS Marca" class="form-control"  value="{{ @$info->ds_marca }}">
						</div>

						<div class="col-md-2">
							<input type="text" name="ie_marca" placeholder="IE Marca" class="form-control"  value="{{ @$info->ie_marca }}">
						</div>

					</div>

					<div class="form-group row">
						<label class="col-md-3 form-label">Presentación, Tipo de Envase:</label>
						<div class="col-md-9">
							<input type="text" name="presentacion" class="form-control"  value="{{ @$info->presentacion }}">
						</div>
					</div>


					<div class="form-group row">

					<label class="col-md-3 form-label">Cantidad Muestra</label>
						<div class="col-md-3">
							<input type="number" name="cantidad_muestra" class="form-control"  value="{{ @$info->cantidad_muestra }}">
						</div>

						<label class="col-md-2 form-label">Cant. Lote declarado</label>
						<div class="col-md-4">
							<input type="number" name="cantidad_lote" class="form-control"  value="{{ @$info->cantidad_lote }}">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-md-3 form-label">Identificación</label>
						<div class="col-md-9">
							<input type="text" name="identificacion" class="form-control"  value="{{ @$info->identificacion }}">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-md-3 form-label">F. Producción</label>
						<div class="col-md-4">
							<input type="date" name="fecha_produccion" class="form-control"  value="{{ @$info->fecha_produccion }}">
						</div>

						<label class="col-md-1 form-label">DS Fecha</label>
						<div class="col-md-4">
							<input type="date" name="ds_fecha_produccion" class="form-control"  value="{{ @$info->ds_fecha_produccion }}">
						</div>

						<label class="col-md-3 form-label">IE Fecha</label>
						<div class="col-md-4">
							<input type="date" name="ie_fecha_produccion" class="form-control"  value="{{ @$info->ie_fecha_produccion }}">
						</div>

					</div>

					<div class="form-group row">
						<label class="col-md-3 form-label">F. Vencimiento</label>
						<div class="col-md-4">
							<input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control"  value="{{ @$info->fecha_vencimiento }}">
						</div>

						<label class="col-md-1 form-label">DS Fecha</label>
						<div class="col-md-4">
							<input type="date" name="ds_fecha_vencimiento" class="form-control"  value="{{ @$info->ds_fecha_vencimiento }}">
						</div>

						<label class="col-md-3 form-label">IE Fecha</label>
						<div class="col-md-4">
							<input type="date" name="ie_fecha_vencimiento" class="form-control"  value="{{ @$info->ie_fecha_vencimiento }}">
						</div>

					</div>


					</div> <!--FIN CONTENIDO-->
				
					<div class="form-group row">
						<label class="col-md-3 form-label">Observaciones</label>
						<div class="col-md-9">
						
							<textarea class="form-control" name="observacion" id="observacion" rows="3"> {{ @$info->observacion }}</textarea>
							
						</div>
					</div>


				<div class="container" id="contenidos_otros_servicios" >
					<div class="form-group row" id="m_punto_muestreo">
						<label class="col-md-3 form-label">Punto de Muestreo</label>
						<div class="col-md-9">
							<input type="text" name="punto_muestreo" id="punto_muestreo" class="form-control"  value="{{ @$info->punto_muestreo }}">
						</div>
					</div>

					<div class="form-group row" id="m_coordenadas">
						<label class="col-md-3 form-label">Coordenadas</label>
						<div class="col-md-9">
							<input type="text" name="coordenadas" id="coordenadas" class="form-control"  value="{{ @$info->coordenadas }}">
						</div>
					</div>

		


					<div class="form-group row" id="m_ubigeo">
						<label class="col-md-3 form-label">Ubigeo</label>
						<div class="col-md-9">
							<select  id='ubigeo' name="ubigeo" id="ubigeo" style="width: 100%;" class="select2AjaxUbigeo">
								@if(@$info->ubigeo!='')
									<option selected value="{{ $info->ubigeo }}">{{ $funciones->info_ubigeo($info->ubigeo) }}</option>
								@endif

							</select>

						

						</div>
					</div>

					<div class="form-group row" id="m_lugar">
						<label class="col-md-3 form-label">Lugar</label>
						<div class="col-md-9">
							<input type="text" name="lugar" id="lugar" class="form-control"  value="{{ @$info->lugar }}">
						</div>
					</div>
					 
					<div class="form-group row" id="m_fuente_origen">
						<label class="col-md-3 form-label" >Fuente de Origen</label>
						<div class="col-md-9">
							<input type="text" name="fuente_origen" id="fuente_origen" class="form-control"  value="{{ @$info->fuente_origen }}">
						</div>
					</div>
 
					<div class="form-group row">
						<label class="col-md-3 form-label">Persona Muestreo</label>
						<div class="col-md-7">
							<select  id='persona_muestreo_id' name="persona_muestreo_id"   style="width: 100%;" class="select2AjaxPersona">
								@if(@$info->persona_muestreo_id>0)
									<option selected value="{{ $info->persona_muestreo_id }}">{{ $funciones->info_persona($info->persona_muestreo_id) }}</option>
								@endif
							</select>	
														
						</div>
						<div class="col-md-2">
							<button type="button" class="btn btn-warning" onclick="abrirModalPersona('persona_muestreo_id');" > 
                                	<i class="fa fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-success" onclick="abrirModalPersona('persona_muestreo_id','Nuevo');" > 
                                	<i class="fa fa-plus"></i>
                            </button>
						</div>
					</div>

					

					<div class="form-group row">
						<label class="col-md-3 form-label">Fecha Muestreo</label>
						<div class="col-md-4">
							<input type="date" name="fecha_muestreo" class="form-control"  value="{{ @$info->fecha_muestreo }}">
						</div>

						<label class="col-md-1 form-label">Hora muestreo</label>
						<div class="col-md-4">
							<input type="time" name="hora_muestreo" class="form-control"  value="{{ @$info->hora_muestreo }}">
						</div>

					</div>



					<div class="form-group row" id="m_tipo_envase">
						<label class="col-md-3 form-label">Tipo Envase</label>
						<div class="col-md-9">
							<input type="text" name="tipo_envase" id="tipo_envase" class="form-control"  value="{{ @$info->tipo_envase }}">
						</div>
					</div>
					

					<div class="form-group row" id="m_conservacion">
						<label class="col-md-3 form-label">Conservación</label>
						<div class="col-md-9">
							<input type="text" name="conservacion" id="conservacion" class="form-control"  value="{{ @$info->conservacion }}">
						</div>
					</div>

					<div class="form-group row" id="m_preservacion">
						<label class="col-md-3 form-label">Preservación</label>
						<div class="col-md-9">
							<input type="text" name="preservacion" id="preservacion" class="form-control"  value="{{ @$info->preservacion }}">
						</div>
					</div>

					<div class="form-group row" id="m_tipo_muestra">
						<label class="col-md-3 form-label">Tipo Muestra</label>
						<div class="col-md-9">
							<input type="text" name="tipo_muestra" id="tipo_muestra" class="form-control"  value="{{ @$info->tipo_muestra }}">
						</div>
					</div>
					
					<div class="form-group row" id="m_descripcion_servicio">
						<label class="col-md-3 form-label">Descripción Servicio</label>
						<div class="col-md-9">
							<textarea class="form-control" name="descripcion_servicio" id="descripcion_servicio" rows="3"> {{ @$info->descripcion_servicio }}</textarea>

						</div>
					</div> 

				
					
					<div class="form-group row" id="m_tipo_comprobante">
						<label class="col-md-3 form-label">Tipo Comprobante</label>
						<div class="col-md-9">
							<select name="tipo_comprobante_id" id="tipo_comprobante_id"  class="form-control" >
								<option value="">-- Seleccionar --</option>			
							<option value="1" <?php if(@$info->tipo_comprobante_id == '1') { echo ' selected="selected"'; } ?>>RECIBO INTERNO</option>
								<option value="2" <?php if(@$info->tipo_comprobante_id  == '2') { echo ' selected="selected"'; } ?>>FACTURA</option>

								
								
							</select>
						</div>
					</div>

					<div class="form-group row" id="m_precio">
						<label class="col-md-3 form-label">Precio</label>
						<div class="col-md-9">
							<input type="text" name="precio" id="precio" class="form-control" value="{{ @$info->precio }}">
						</div>
					</div>

					<!--
					<div class="form-group row" id="m_retencion"> 
						<label class="col-md-3 form-label">Retención</label>
						<div class="col-md-9">
							<input type="text" name="retencion" id="retencion" class="form-control"  value="{{ @$info->retencion }}">
						</div>
					</div> -->

				</div> <!--fin contenido-->

					<div class="form-group row">
						<label class="col-md-3 form-label">Documento de Resultados</label>
						<div class="col-md-9">
						<input type="file" name="doc_resultado" id="doc_resultado" accept=".pdf" class="form-control"  value="{{ @$info->doc_resultado }}" style="display:none;">
							<div class="flex mt-2" style="padding: 5px;align-items: center;text-align: center;border-radius: 5px;border: dashed 1px #29327f;cursor: pointer;color: #29327f;" id="op_doc_resultado">
								<i class="las la-cloud-upload-alt" style="font-size: 40px;"></i> 
							</div>
							<div class="flex m-2" style="color: #29327f;font-size: 1.1rem;max-width: 100%;" id="val_doc_resultado"></div>
							<?php 
								if(@$info->doc_resultado!=''){
									
								?><a href="files/infoservicio/{{@$info->doc_resultado}}" class="f_doc_resultado text-info" target="_blank" title="Descargar"><?php  echo @$info->doc_resultado; ?></a> 
								<input type="hidden" name="f_doc_resultado" id="f_doc_resultado" value="{{@$info->doc_resultado}}">
								<i onclick="elimfile('f_doc_resultado');" class="f_doc_resultado fa fa-lg fa-times-circle  txt-color-red" style="cursor: pointer;"></i>
							<?php }?>
						</div>
					</div>
 

					<div class="form-group row">
						<label class="col-md-3 form-label">Responsable Atención</label>
						<div class="col-md-7">
							<select  id='responsable_atencion_id' name="responsable_atencion_id"  style="width: 100%;" class="select2AjaxPersona">
								@if(@$info->responsable_atencion_id>0)
									<option selected value="{{ $info->responsable_atencion_id }}">{{ $funciones->info_persona($info->responsable_atencion_id) }}</option>
								@endif
							</select>	
														
						</div>
						<div class="col-md-2">
							<button type="button" class="btn btn-warning" onclick="abrirModalPersona('responsable_atencion_id');" > 
                                	<i class="fa fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-success" onclick="abrirModalPersona('responsable_atencion_id','Nuevo');" > 
                                	<i class="fa fa-plus"></i>
                            </button>
						</div>
					</div>


					<div class="form-group row">
						<label class="col-md-3 form-label">observación de Resultado</label>
						<div class="col-md-9">
							<textarea class="form-control" name="observacion_resultado" id="observacion_resultado" rows="3"> {{ @$info->observacion_resultado }}</textarea>
						</div>
					</div>



				</div>
				<div class="modal-footer">
					<input type="hidden" name="id" value="{{ @$info->id }}">
					<input type="hidden" name="tipo_equipo_id" value="2"><!-- 2 Material-->
					<input type="hidden" name="usuario_id" id="usuario_id" value="18">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</div>
				</form>
			</div>
		</div>
	</div>
<script>


/*$('#laboratoriodet_id').change(function(){
   // var ids = $(this).val(); 
	
	var valorBoton = $('#usuario_id').val();
	if(valorBoton != 18){
		
		$('#contenidos_servicios').hide();
		$('#contenidos_aliment').show();
	}

	else {
		$('#contenidos_servicios').show();
		$('#contenidos_aliment').hide();
	}
	}) */

//personal_contacto_id
	$(document).ready(function() {
		$('#op_doc_resultado').click(function() { $('#doc_resultado').click(); });
		$('#doc_resultado').change(function() {
			if(jQuery.isEmptyObject($(this)[0].files[0])){
				$('#val_doc_resultado').html('');	
				return;
			}
			$('#val_doc_resultado').html($(this)[0].files[0].name);
		});
		
	});

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
		}else if(x_combo_persona == 'representante_id'){
			$("#representante_id").html(option);
		}else if(x_combo_persona == 'personal_contacto_id'){
			$("#personal_contacto_id").html(option);
		}else if(x_combo_persona == 'persona_muestreo_id'){
			$("#persona_muestreo_id").html(option);
		}else if(x_combo_persona == 'responsable_atencion_id'){
			$("#responsable_atencion_id").html(option);
		}

		 recargarAjaxPersona();
		//console.log('sdfdsf');
		
	}

</script>
