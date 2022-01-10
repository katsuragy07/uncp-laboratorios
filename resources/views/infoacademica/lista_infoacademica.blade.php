@inject('lstfacultad','App\Models\Facultad')
@inject('lstlaboratorio','App\Models\Laboratorio')
@inject('lstdocente','App\Models\Persona')
@inject('lstasignatura','App\Models\Asignatura')
@extends('layouts.principal')
@section('titulo','Lab. de Enseñanza')
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
					<form action="{{ route('editar.infoacademica') }}" method="POST">
						@csrf
						<input type="hidden" name="id_infoacademica" id="id_borrar">
						
						<textarea class="form-control mb-2" placeholder="Escribe el motivo" rows="2" required="" name="motivo"></textarea>

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
                	<form action="{{ route('listado.infoacademica') }}" method="GET">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Laboratorio:</label>
                            
							<select name="laboratorio_id" id="laboratorio_id" class="form-control select2-show-search select2-hidden-accessible" data-placeholder="Seleccione Tipo Laboratorio" tabindex="-1">
								<option value="">Todos...</option>
								@foreach($laboratorio_det as $laboratorio)
								<option @if($laboratorio->id == $databusqueda->laboratorio_id) selected @endif value="{{ $laboratorio->id }}">{{ $laboratorio->full_name }}</option>
								@endforeach
							</select>
                        </div>

						<div class="col-md-5">
                            <label class="form-label">Asignatura:</label>
                            
							<select name="asignatura_id"  id="asignatura_id" class="form-control select2-show-search select2-hidden-accessible" data-placeholder="Seleccione una Asignatura" tabindex="-1">
								<option value="">Todos...</option>
								@foreach($lstasignatura::orderby('nom_asignatura','ASC')->get() as $asignatura)
								<option @if($asignatura->id == $databusqueda->asignatura_id) selected @endif value="{{ $asignatura->id }}">{{ $asignatura->nom_asignatura }}</option>
								@endforeach
							</select>
						</div>
						
                    </div>
					
					<br>
					<div class="row">
						<div class="col-md-5">
                            <label class="form-label">Docente:</label>
                            
							<select name="docente_id"  id="docente_id" class="form-control select2-show-search select2-hidden-accessible" data-placeholder="Seleccione un Docente" tabindex="-1">
								<option value="">Todos...</option>
								@foreach($lstdocente::orderby('apellidos','ASC')->get() as $docente)
								<option @if($docente->id == $databusqueda->docente_id) selected @endif value="{{ $docente->id }}">{{ $docente->nombre .' '. $docente->apellidos }}</option>
								@endforeach
							</select>
                        </div>

						<div class="col-md-4">
                            <label class="form-label"> Ingrese Descripcion:</label>
                            <input class="form-control mb-5" placeholder="Ingrese Campos" autocomplete="off" type="text" name="txtbuscar" value="{{ $databusqueda->cod_sunedu }}">
                        </div>

						<div class="col-xm-3"><br>
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
									
									<th>Docente</th>
									<th>Asignatura</th>
									<th>Hora Academica</th>
									<th>Calendario</th>
									<th>Guia/Manual</th>
									
									<th>Opciones</th>
								</tr>
							</thead>
							<tbody>

								<?php 
								$i = 0;
								if(isset($_GET['page'])){
									$i = ($_GET['page']*10)-10;
								}
								 ?>
								@foreach($listainfoacademica  as $infoacademica)
								<?php $i++;  ?>
									<tr>
										<td>{{ $i }}</td>
									
									
										<td>{{ $infoacademica->apellidos .' '.$infoacademica->nombres  }}</td>
										<td>{{ $infoacademica->nom_asignatura }}</td>
										<td>{{ $infoacademica->hra_academica }}</td>
										<td> 
											<?php
					
												$ruta_calen=asset('files/infoacademica').'/'.$infoacademica->calendario_uso;
											
												if($infoacademica->calendario_uso!=''){
											?>

														<a href="{{ $ruta_calen }}" target="_blank" title="Descargar Calendario Academico">
														<i class="fa fa-calendar" style="font-size:20px;color:green"></i>
													</a>
													<?php	} else {?>

														
														<i class="fa fa-times" style="color:red"></i>


														<?php	} ?>
										
											
										</td>
										<td>

										<?php
					
												$ruta_guia=asset('files/infoacademica').'/'.$infoacademica->guia_manual;
											
												if($infoacademica->guia_manual!=''){
											?>

														<a href="{{ $ruta_guia }}" target="_blank">
														<i class="fa fa-file-pdf-o" aria-hidden="true" style="font-size:20px;color:red" title="Descargar Guia/Manual"></i>
														</a>
													<?php	} else {?>
														<i class="fa fa-times" style="color:red"></i>
																
														<?php	} ?>




										</td>
										
										
										<td>

										<button type="button" class="btn-success agregardato" value="{{ $infoacademica->id }}" > 
					                            <i class="glyphicon glyphicon-plus"></i> 
					                    </button>
										
										<button type="button" class="btn-info editardato" value="{{ $infoacademica->id }}" > 
					                            <i class="glyphicon glyphicon-edit"></i> 
					                        </button>
					                        <button class="btn-danger" data-toggle="modal" data-target="#modal_eliminar" onclick="eliminar({{ $infoacademica->id}},'{{ $infoacademica->nom_asignatura }}')"> 
					                            <i class="glyphicon glyphicon-trash"></i> 
					                    </button>
            
										</td> 
									</tr>									
								@endforeach
							</tbody>
						</table>
					</div>
					<hr class="m-1">
				    <div class="text-center">
				        {!! $listainfoacademica->render()!!}
				    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
 $("#btnnuevo").click(function(event){ 
    event.preventDefault();        
    var urlnuevo = "{{ route('mant_academica') }}";
    $( "#div_ModalMant" ).html('Cargando...');
    $( "#div_ModalMant" ).load(urlnuevo );
  }); 

	$(".editardato").click(function(event){
    	event.preventDefault();     
	    //var idtablas = $(this).val();
	    var idtablas = $(this).attr("value");
	    var url = "{{ route('mant_academica') }}?id="+idtablas;
	    $( "#div_ModalMant" ).html('Cargando...');
	    $( "#div_ModalMant" ).load(url);
   }); 


	function eliminar(idfila,nombre){
		$('#lblmensaje').text( nombre);
		$('#id_borrar').val(idfila);
	}


	$(".agregardato").click(function(event){
    	event.preventDefault();     
	    var idtablas = $(this).attr("value");
	    var url = "{{ route('agre_infoacademica') }}?id="+idtablas;
	    $( "#div_ModalMant" ).html('Cargando...');
	    $( "#div_ModalMant" ).load(url);
   }); 
$(document).ready(function() {
	

});

</script>
@endsection
