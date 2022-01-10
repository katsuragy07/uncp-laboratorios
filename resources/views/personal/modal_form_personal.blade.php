@inject('m_laboratorio','App\Models\Laboratorio')
@inject('m_persona','App\Models\Persona')
@inject('m_tipopersonal','App\Models\Tipopersonal')
@inject('m_cargo','App\Models\Cargo')
@inject('m_unidadmedida','App\Models\Unidad_medida')
@inject('m_proveedor','App\Models\Proveedor')
@inject('funciones','App\Http\Controllers\FuncionesController')
<script>
$(function(){
	$('#modal_mante').modal('show');
})
</script>
<div class="modal fade" id="modal_mante" tabindex="-1" role="dialog" aria-labelledby="largemodal" aria-hidden="true">
		<div class="modal-dialog modal-lg " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="largemodal1"> <i class="fa fa-plus"></i> Nuevo Personal</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form class="form-horizontal" action="{{ route('guardar.personal') }}" method="POST" enctype="multipart/form-data" id="frmproy">
					@csrf 
				<div class="modal-body">
					<div class="form-group row">
						<label class="col-md-3 form-label">Laboratorio</label>
						<div class="col-md-6">

							<select name="laboratorio_id" id="laboratorio_id" required="" class="form-control">
								<option value="">Seleccionar...</option>
								@foreach($laboratorio_det as $laboratorio)
								<option @if($laboratorio->id == @$info->laboratorio_id) selected @endif value="{{ $laboratorio->id }}">{{ $laboratorio->full_name }}</option>
								@endforeach
							</select>
						</div>
					</div> 
					<div class="form-group row">
						<label class="col-md-3 form-label">Personal</label>
						<div class="col-md-7">
							<select  id='persona_id' name="persona_id"  style="width: 100%;" class="select2AjaxPersona">
								@if(@$info->persona_id>0)
									<option selected value="{{ $info->persona_id }}">{{ $funciones->info_persona($info->persona_id) }}</option>
								@endif
							</select>	
														
						</div>
						<div class="col-md-2">
							<button type="button" class="btn btn-warning" onclick="abrirModalPersona('persona_id');" > 
                                	<i class="fa fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-success" onclick="abrirModalPersona('persona_id','Nuevo');" > 
                                	<i class="fa fa-plus"></i>
                            </button>
						</div>
					</div>
					
					<div class="form-group row">
						<label class="col-md-3 form-label">Tipo</label>
						<div class="col-md-9">
							<select name="tipopersonal_id" id="tipopersonal_id"  required="" class="form-control" > 
								<option value="">-- Seleccionar --</option>
								@foreach($m_tipopersonal::orderby('tipo_personal','ASC')->get() as $tipopersonal)
								<option @if($tipopersonal->id == @$info->tipopersonal_id) selected @endif value="{{ $tipopersonal->id }}">{{ $tipopersonal->tipo_personal }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-md-3 form-label">Cargo</label>
						<div class="col-md-9">
							<select name="cargo_id" id="cargo_id"  required="" class="form-control" > 
								<option value="">-- Seleccionar --</option>
								@foreach($m_cargo::orderby('cargo','ASC')->get() as $cargo)
								<option @if($cargo->id == @$info->cargo_id) selected @endif value="{{ $cargo->id }}">{{ $cargo->cargo }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-md-3 form-label">Especialidad</label>
						<div class="col-md-9">
							<input type="text" name="especialidad" required="" class="form-control"  value="{{ @$info->especialidad }}">
						</div>
					</div>		
					<div class="form-group row">
						<label class="col-md-3 form-label">Fecha Ingreso al Cargo</label>
						<div class="col-md-9">
							<input type="date" name="fch_ingreso" class="form-control"  value="{{ @$info->fch_ingreso }}">
						</div>
					</div>	
					
					<div class="form-group row">
						<label class="col-md-3 form-label">Fecha Término de Cargo</label>
						<div class="col-md-9">
							<input type="date" name="fch_cese" class="form-control"  value="{{ @$info->fch_cese }}">
						</div>
					</div>	


					<div class="form-group row">
						<label class="col-md-3 form-label">Hoja de Vida</label>
						<div class="col-md-9">
							<input type="file" name="hoja_vida" id="hoja_vida" accept=".pdf" class="form-control"  value="{{ @$info->hoja_vida }} " style="display:none;">
							<div class="flex mt-2" style="padding: 5px;align-items: center;text-align: center;border-radius: 5px;border: dashed 1px #29327f;cursor: pointer;color: #29327f;" id="op_hoja_vida">
								<i class="las la-cloud-upload-alt" style="font-size: 40px;"></i> 
							</div>
							<div class="flex m-2" style="color: #29327f;font-size: 1.1rem;max-width: 100%;" id="val_hoja_vida"></div>

							<?php 
								if(@$info->hoja_vida!=''){
								?><a href="files/personal/{{@$info->hoja_vida}}" class="f_hoja_vida text-info" target="_blank" title="Descargarddd"><?php  echo @$info->hoja_vida; ?></a>
								<input type="hidden" name="f_hoja_vida" id="f_hoja_vida" value="{{@$info->hoja_vida}}">
								<i onclick="elimfile('f_hoja_vida');" class="f_hoja_vida fa fa-lg fa-times-circle  txt-color-red" style="cursor: pointer;"></i>
							<?php }?>
						</div>
					</div>
					 
					<div class="form-group row">
						<label class="col-md-3 form-label">Resolución de Encargatura</label>
						<div class="col-md-9">
							<input type="file" name="resolucion" id="resolucion"  accept=".pdf" class="form-control"  value="{{ @$info->resolucion }}" style="display:none;">
							<div class="flex mt-2" style="padding: 5px;align-items: center;text-align: center;border-radius: 5px;border: dashed 1px #29327f;cursor: pointer;color: #29327f;" id="op_resolucion">
								<i class="las la-cloud-upload-alt" style="font-size: 40px;"></i> 
							</div>
							<div class="flex m-2" style="color: #29327f;font-size: 1.1rem;max-width: 100%;" id="val_resolucion" value="{{ @$info->resolucion }}"></div>

							<?php 
								if(@$info->resolucion!=''){
								?><a href="files/personal/{{@$info->resolucion}}" class="f_resolucion text-info" target="_blank" title="Descargar"><?php  echo @$info->resolucion; ?></a>
								<input type="hidden" name="f_resolucion" id="f_resolucion" value="{{@$info->resolucion}}">
								<i onclick="elimfile('f_resolucion');" class="f_resolucion fa fa-lg fa-times-circle  txt-color-red" style="cursor: pointer;"></i>
							<?php }?>


							
						</div>
					</div>

		
				
				</div>

				
					
				<div class="modal-footer">
					<input type="hidden" name="id" value="{{ @$info->id }}">
					<input type="hidden" name="tipo_equipo_id" value="2"><!-- 2 Material-->
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
		if(x_combo_persona == 'persona_id'){
			$("#persona_id").html(option);
			//recargarAjaxPersona();
		}
		 recargarAjaxPersona();
		//console.log('sdfdsf');
		
	}

	$(document).ready(function() {
		agregarDetalle();

		$('#op_hoja_vida').click(function() { $('#hoja_vida').click(); });
		$('#hoja_vida').change(function() {
			if(jQuery.isEmptyObject($(this)[0].files[0])){
				$('#val_hoja_vida').html('');	
				return;
			}
			$('#val_hoja_vida').html($(this)[0].files[0].name);
		});
		$('#op_resolucion').click(function() { $('#resolucion').click(); });
		$('#resolucion').change(function() {
			if(jQuery.isEmptyObject($(this)[0].files[0])){
				$('#val_resolucion').html('');	
				return;
			}
			$('#val_resolucion').html($(this)[0].files[0].name);
		});

		
	});


	item = 0;
	function agregarDetalle()
			{   
				item = item + 1;
				cadena ='<tr>'; 
					//cadena = cadena + '<td>'+item+'</td>';
					cadena += '<td  >';        
           			cadena += '<select class="form-control" id="tipopersonal_id'+item+'" name="tipopersonal_id" required>';
            		cadena += '<option selected="selected"  value="">-Seleccione-</option><?php 
               		 if(isset($m_tipopersonal))
                    if($m_tipopersonal){
                    foreach ($m_tipopersonal::orderby('tipo_personal','ASC')->get() as $tipopersonal) {
					   echo  '<option value="'.$tipopersonal->id.'">'.$tipopersonal->tipo_personal.'</option>';
                   	 }
               	 } 
           		 ?>';
				cadena += '</select>';
				cadena += '</td>';

			

					cadena += '<td  >';        
           			cadena += '<select class="form-control" id="cargo_id'+item+'" name="cargo_id" required>';
            		cadena += '<option selected="selected"  value="">-Seleccione-</option><?php 
               		 if(isset($m_cargo))
                    if($m_cargo){
                    foreach ($m_cargo::orderby('cargo','ASC')->get() as $cargo) {
					   echo  '<option value="'.$cargo->id.'">'.$cargo->cargo.'</option>';
                   	 }
               	 } 
           		 ?>';
				cadena += '</select>';
				cadena += '</td>';

				cadena = cadena + "<td class='info' width='5%' align='center'><a href='javascript:void(0);' class='elimina btn' title = 'Quitar'><i class='glyphicon glyphicon-remove-circle txt-color-red'></i></a></td>";
				cadena = cadena + '</tr>';
							
					$("#tb_personal tbody").append(cadena);  
					fn_dar_eliminar();  
					$("#dia_semana"+item).focus();
			}

	
	function fn_dar_eliminar(){
		$("a.elimina").click(function(){        
				$(this).parents("#tb_personal tbody tr").remove();                               
				//sumasubtotal();
		});    
	};
	$("a.elimina").click(function(){        
				$(this).parents("#tb_personal tbody tr").remove();                               
				//sumasubtotal();
		});
	
	


	</script>