@inject('m_laboratorio','App\Models\Laboratorio')
@inject('m_persona','App\Models\Persona')
@inject('m_asignatura','App\Models\Asignatura')
@inject('m_unidadmedida','App\Models\Unidad_medida')
@inject('m_proveedor','App\Models\Proveedor')
<script>
$(function(){
	$('#modal_mante').modal('show');
})
</script>
<div class="modal fade" id="modal_mante" tabindex="-1" role="dialog" aria-labelledby="largemodal" aria-hidden="true">
		<div class="modal-dialog modal-lg " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="largemodal1"> <i class="fa fa-plus"></i> Nuevo Documento</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form class="form-horizontal" action="{{ route('guardar.docgeneral') }}" method="POST" enctype="multipart/form-data" id="frmproy">
					@csrf
				<div class="modal-body">
								
					<div class="form-group row">
						<label class="col-md-3 form-label">Nombre</label>
						<div class="col-md-9">
							<textarea class="form-control" name="nombre" id="nombre" required="" rows="3"> {{ @$info->nombre }}</textarea>
						</div>
					</div>
					
				

										 
					<div class="form-group row">
						<label class="col-md-3 form-label">Docuemento Adjunto</label>
						<div class="col-md-9">
							<input type="file" name="archivo" id="archivo"  accept=".pdf" class="form-control"  value="{{ @$info->archivo }}" style="display:none;">
							<div class="flex mt-2" style="padding: 5px;align-items: center;text-align: center;border-radius: 5px;border: dashed 1px #29327f;cursor: pointer;color: #29327f;" id="op_archivo">
								<i class="las la-cloud-upload-alt" style="font-size: 40px;"></i> 
							</div>
							<div class="flex m-2" style="color: #29327f;font-size: 1.1rem;max-width: 100%;" id="val_archivo" value="{{ @$info->archivo }}"></div>

							<?php 
								if(@$info->archivo!=''){
								?><a href="files/docgeneral/{{@$info->archivo}}" class="text-info" target="_blank" title="Descargar"><?php  echo @$info->archivo; ?></a>
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
	$(document).ready(function() {
		$('#op_archivo').click(function() { $('#archivo').click(); });
		$('#archivo').change(function() {
			if(jQuery.isEmptyObject($(this)[0].files[0])){
				$('#val_archivo').html('');	
				return;
			}
			$('#val_archivo').html($(this)[0].files[0].name);
		});		
	});

</script>