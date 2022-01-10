@inject('m_laboratorio','App\Models\Laboratorio')
@inject('m_persona','App\Models\Persona')
@extends('layouts.principal')
@section('titulo','Lista de requerimientos')
@section('contenido')
<div class=""> <!-- container -->
   
   <!-- Modal Nuevo y editar -->
	<div id="div_ModalMant">		
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
					<form action="{{ route('borrar.requerimiento') }}" method="POST">
						@csrf
						<input type="hidden" name="id" id="id_borrar">
						<input type="hidden" name="tipo_equipo_id" value="3">
						
						<textarea class="form-control mb-2" placeholder="Escribe el motivo" rows="2" required="" name="motivo"></textarea>

					<button aria-label="Close" class="btn btn-secondary pd-x-25" data-dismiss="modal" type="button">Cancelar</button>
					<button type="submit" class="btn btn-primary">Eliminar</button>
					</form>
				</div>
			</div>
		</div>
	</div> 
	<!-- Fin Modal eliminar -->
		<!-- Modal atencion -->
	<div class="modal" id="modal_atencion">
		<div class="modal-dialog modal-dialog-centered text-center" role="document">
			<div class="modal-content tx-size-sm">
				<div class="modal-body text-center p-4">
					<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					<i class="fe fe-alert-circle fs-100 text-success lh-1 mb-5 d-inline-block"></i>
					<h4 class="text-info"> Estás seguro atender todo los insumos del requerimiento? </h4>
					<p class="mg-b-20 mg-x-20" id="lblmensaje_atencion" style="font-size: 1.2rem;">  </p>
					<form action="{{ route('aceptar.requerimiento') }}" method="POST">
						@csrf
						<input type="hidden" name="requerimiento_id" id="requerimiento_id">
						<input type="hidden" name="tipo_equipo_id" value="3">
					
						<div class="form-group row">
							<label class="col-md-3 form-label">Responsable de atención</label>
							<div class="col-md-9">
								<select name="resp_atencion_id" class="form-control" required="" >
									<option value="">-- Seleccionar --</option>
									@foreach($m_persona::orderby('nombres','ASC')->get() as $persona)
									<option value="{{ $persona->id }}">{{ $persona->nombres }} {{ $persona->apellidos }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group"> 
							<label class="custom-switch"> 
								<span class="custom-switch-description mr-2">Estoy conforme</span> 
								<input type="checkbox" id="ck_conforme" name="custom-switch-checkbox1" class="custom-switch-input"> 
								<span class="custom-switch-indicator custom-switch-indicator-lg"></span> 
							</label> 
						</div>


					<button aria-label="Close" class="btn btn-secondary pd-x-25" data-dismiss="modal" type="button">Cancelar</button>
					<button type="submit" id="btn_aceptar" class="btn btn-primary">Si, Atender</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- Fin Modal atencion -->

    <div class="row justify-content-center">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                	<form action="{{ route('listar.requerimiento') }}" method="GET">
                    <div class="row">
                        <div class="col-lg">
                            <label class="form-label"> Laboratorio Atención</label>
                            <select name="laboratorio_dest_id" class="form-control" >
								<option value="">-- Todos --</option>
								@foreach($m_laboratorio::orderby('nombre_lab','ASC')->get() as $laboratorio)
								<option @if($laboratorio->id == $databusqueda->laboratorio_dest_id) selected @endif value="{{ $laboratorio->id }}">{{ $laboratorio->nombre_lab }}</option>
								@endforeach
							</select>
                        </div>
                        <div class="col-lg">
                            <label class="form-label"> Entrega desde</label>
                            <input class="form-control mb-4" placeholder="" type="date" name="fch_entrega_desde" value="{{ $databusqueda->fch_entrega_desde }}">
                        </div>
                        <div class="col-lg">
                            <label class="form-label"> Entrega hasta</label>
                            <input class="form-control mb-4" placeholder="" type="date" name="fch_entrega_hasta" value="{{ $databusqueda->fch_entrega_hasta }}">
                        </div>
                        <div class="col-lg "><br>
                           <button type="submit" class="btn btn-primary"> 
                                <i class="fa fa-search"></i> Buscar
                            </button>
                           
                            <button type="button" id="btnnuevo" class="btn btn-success" > 
                                <i class="fa fa-plus"></i> Nuevo
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
									<th>Fecha</th>
									<th>Hora</th>
									<th>Fecha Entrega</th>
									<th>Hora Entrega</th>
									<th>Laboratorio Atención</th>
									<th>Encargado</th>
									<th>Recibido</th>
									<th>Estado</th>
									<th></th>
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
								<?php $i++;  ?>
									<tr>
										<td>{{ $i }}</td> 
										<td>{{ fechaUsu($fila->fch_requerimiento) }}</td>
										<td>{{ $fila->hora_requerimiento }}</td>
										<td>{{ fechaUsu($fila->fch_entrega) }}</td>
										<td>{{ $fila->hora_entrega }}</td>
										<td>{{ $fila->nombre_lab }}</td>
										<td>{{ $fila->encargado }}</td>
										<td>{{ $fila->resp_recibir }}</td>
										<td>
											@if($fila->atencion_id=='')
												POR ATENDER
											@elseif($fila->cantDevuelto<$fila->cantDevolver)
												POR DEVOLVER
											@else
												ATENDIDO
											@endif

										</td>										 
										 
										<td>
					        				
					                        
					                        @if($fila->atencion_id=='')
					                        <button type="button" class="btn-info editardato" value="{{ $fila->id }}" > 
					                            <i class="glyphicon glyphicon-edit"></i> 
					                        </button>
					                        <button class="btn-danger" data-toggle="modal" data-target="#modal_eliminar" onclick="eliminar({{ $fila->id}},'{{ $fila->resp_recibir }}')"> 
					                            <i class="glyphicon glyphicon-trash"></i> 
					                        </button>
					                        <button class="btn-success atender" title="Atención" data-toggle="modal" data-target="#modal_atencion" onclick="atender({{ $fila->id}},'<b>Requerimiento:</b> N.{{ $fila->id }} <b>Fecha:</b> {{ fechaUsu($fila->fch_requerimiento) }} <b><br>Solicitado por:</b> {{ $fila->resp_recibir }}')"> 
					                            <i class="glyphicon glyphicon-check"></i> 
					                        </button>
					                        @endif
					                        @if($fila->cantDevuelto<$fila->cantDevolver)
					                        	<button class="btn-warning devolver" title="Devolución" onclick="devolver({{ $fila->atencion_id}})"> 
						                            <i class="fa fa-rotate-left"></i> 
						                        </button> 
					                        @endif
					                        <a href="{{ url('pdf/requerimiento?id='.$fila->id) }}" class="text-info" target="_blank" title="Descargar"><i class="fa fa-file-pdf-o" aria-hidden="true" style="font-size:20px;color:red"></i></a>
										</td> 
									</tr>									
								@endforeach
							</tbody>
						</table>
					</div>
					<hr class="m-1">
				    <div class="text-center">
				        {!! $lista->render()!!}
				    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
   $("#btnnuevo").click(function(event){ 
    event.preventDefault();        
    var urlnuevo = "{{ route('mant.requerimiento') }}";
    $( "#div_ModalMant" ).html('Cargando...');
    $( "#div_ModalMant" ).load(urlnuevo );
  }); 

	$(".editardato").click(function(event){
    	event.preventDefault();     
	    //var idtablas = $(this).val();
	    var idtablas = $(this).attr("value");
	    var url = "{{ route('mant.requerimiento') }}?id="+idtablas;
	    $( "#div_ModalMant" ).html('Cargando...');
	    $( "#div_ModalMant" ).load(url);
   }); 


	function eliminar(idfila,nombre){
		$('#lblmensaje').text( nombre);
		$('#id_borrar').val(idfila);
	}

	function devolver(atencion_id){
		var url = "{{ route('mant.devolver') }}?atencion_id="+atencion_id;
	    $( "#div_ModalMant" ).html('Cargando...');
	    $( "#div_ModalMant" ).load(url);
	}


	function atender(idfila,nombre){
		$('#ck_conforme').prop('checked',false);
		//$('#btn_aceptar').prop('disabled',false);
	    $( "#btn_aceptar" ).prop("disabled", true );

		$('#lblmensaje_atencion').html( nombre);
		$('#requerimiento_id').val(idfila);
	}

	$("#ck_conforme").click(function(event){
		if ($('#ck_conforme').is(':checked')) {
			$( "#btn_aceptar" ).prop("disabled", false);
		}else{
			$( "#btn_aceptar" ).prop("disabled", true );
		}
	})

$(document).ready(function() {
	

});
</script>
@endsection