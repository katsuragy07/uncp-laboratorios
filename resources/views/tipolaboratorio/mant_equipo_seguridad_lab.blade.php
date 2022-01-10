@inject('m_laboratorio','App\Models\Laboratorio')
@extends('layouts.principal')
@section('titulo','Equipos de seguridad')
@section('contenido')
<div class=""> <!-- container -->
   
   <!-- Modal Nuevo y editar -->
	<div class="modal fade" id="modal_nuevo" tabindex="-1" role="dialog" aria-labelledby="largemodal" aria-hidden="true">
		<div class="modal-dialog modal-lg " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="largemodal1"> <i class="fa fa-plus"></i> Nuevo</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form class="form-horizontal" action="{{ route('guardar.equipo_seguridad') }}" method="POST">
					@csrf					
				<div class="modal-body">					
					<div class="form-group row">
						<label class="col-md-3 form-label">Equipo de seguridad</label>
						<div class="col-md-9">
							<input type="text" name="equipo_seguridad" class="form-control"  placeholder="" required="" id="txtequipo_seguridad">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Tipo</label>
						<div class="col-md-6">
							<select name="tipo" id="cmbtipo" required="" class="form-control">
								<option value="">Selecionar</option>
								<option value="EPP Individual">EPP Individual</option>
								<option value="EPP Colectivo">EPP Colectivo</option>								
							</select>
							
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id" id="txtid">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Fin Modal nuevo y editar -->

	<!-- Modal eliminar -->
	<div class="modal" id="modal_eliminar">
		<div class="modal-dialog modal-dialog-centered text-center" role="document">
			<div class="modal-content tx-size-sm">
				<div class="modal-body text-center p-4">
					<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					<i class="fe fe-x-circle fs-100 text-danger lh-1 mb-5 d-inline-block"></i>
					<h4 class="text-danger"> Estás seguro eliminar? </h4>
					<p class="mg-b-20 mg-x-20" id="lblmensaje" style="font-size: 1.2rem;">  </p>
					<form action="{{ route('borrar.equipo_seguridad') }}" method="POST">
						@csrf
						<input type="hidden" name="id" id="id_borrar">
						<button aria-label="Close" class="btn btn-secondary pd-x-25" data-dismiss="modal" type="button">Cancelar</button>
						<button type="submit" class="btn btn-primary">Eliminar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- Fin Modal eliminar -->

    <div class="row justify-content-center">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                	<form action="{{ route('listar.equipo_seguridad_lab') }}" method="GET">
                    <div class="row">
                        <div class="col-lg">
                            <label class="form-label"> Laboratorio</label>
                            <select name="laboratorio_id" class="form-control" >
								<option value="">-- Todos --</option>
								@foreach($m_laboratorio::orderby('nombre_lab','ASC')->get() as $laboratorio)
								<option @if($laboratorio->id == $databusqueda->laboratorio_id) selected @endif value="{{ $laboratorio->id }}">{{ $laboratorio->nombre_lab }}</option>
								@endforeach
							</select>
                        </div>
                        <div class="col-lg "><br>
                           <button type="submit" class="btn btn-primary"> 
                                <i class="fa fa-search"></i> Buscar
                            </button>
                            
                        </div>
                    </div>
                    </form>

                </div>
            </div>
            <div class="card">
                <div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover card-table table-vcenter text-nowrap mb-0">
							<thead>
								<tr>
									<th>#</th>
									<th>Equipos de seguridad</th>
									<th>Tipo</th>
									<th>¿Tiene?</th>
								</tr>
							</thead>
							<tbody>

								<?php 
								$i = 0;
								if(isset($_GET['page'])){
									$i = ($_GET['page']*10)-10;
								} 
								 ?>
								@foreach($lista  as $fila)
								<?php 

								$i++;  ?>
									<tr>
										<td>{{ $i }}</td>
										<td>{{ $fila->equipo_seguridad }}</td>
										<td>{{ $fila->tipo }}</td>
										 
										<td >
											@if($databusqueda->laboratorio_id>0)
											<input  id="est_privilegio<?php echo $fila->id; ?>" <?php if (in_array($fila->id, $equipo_seguridad_lab)) {    echo "checked"; }?> name="checkbox[<?php echo $fila->id; ?>]" type="checkbox" onclick="permiso(<?php echo $fila->id; ?>);" value="<?php echo $fila->id; ?>"/>
											@else
											-
											@endif
 
										</td> 
									</tr>									
								@endforeach
							</tbody>
						</table>
					</div>
					<hr class="m-1">
				    <div class="text-center">
				        
				    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
 
function permiso(id){  
    var estado = "";    
    if( $("#est_privilegio"+id).prop('checked') ) {
        estado = 1;
    }else{
        estado = 0;
    }   
      
    $.ajax({ 
        type: "post",
        url: "{{ route('mant.equipo_seguridad_lab') }}", cache: false, 
        data:{
        	"_token": "{{ csrf_token() }}",
            equipo_seguridad_id:id,
            estado:estado,
            laboratorio_id   : '<?php echo $databusqueda->laboratorio_id;?>'
        },
        success: function(response){    
                                
                var obj_mensaje = JSON.parse(response); 
                                
                if(obj_mensaje.length>0){                         
                    if(obj_mensaje.substr(0, 8) == 'Activado')
                    {
                       	notif({
							msg: "<i class='fa fa-check swing animated'></i> Se agregó el equipo de forma satisfactoria",
							type: "success",
							position: "right"
						});
                    }else{
                        event.preventDefault();  
                        notif({
							msg: "<i class='fa fa-info-circle swing animated'></i> Se retiró el equipo de forma satisfactoria",
							type: "warning",
							position: "right"
						}); 
                    }                                               
                }       
         }
    }); 
  
}
 
$(document).ready(function() {
});

</script>
@endsection
