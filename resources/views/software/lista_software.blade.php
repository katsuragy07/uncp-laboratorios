@inject('lstfacultad','App\Models\Facultad')
@inject('lstlaboratorio','App\Models\Laboratorio')
@inject('lstdocente','App\Models\Persona')
@inject('lstasignatura','App\Models\Asignatura')
@extends('layouts.principal')
@section('titulo','Laboratorio de Cómputo')
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
					<form action="{{ route('editar_software') }}" method="POST">
						@csrf
						<input type="hidden" name="id" id="id_borrar">
						
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
                	<form action="{{ route('listado_software') }}" method="GET">
                    <div class="row">
                        <div class="col-md-8">
                            <label class="form-label">Laboratorio:</label>
                            
							<select name="laboratorio_id" id="laboratorio_id" class="form-control select2-show-search select2-hidden-accessible" data-placeholder="Seleccione Tipo Laboratorio" tabindex="-1">
								<option value="">Todos...</option>
								@foreach($lstlaboratorio::orderby('nombre_lab','ASC')->get() as $laboratorio)
								<option @if($laboratorio->id == @$info->laboratorio_id) selected @endif value="{{ $laboratorio->id }}">{{ $laboratorio->nombre_lab }}</option>
								@endforeach
							</select>
                        </div>

						
						
                    </div>
					
					<br>
					<div class="row">
						

						<div class="col-md-8">
                            <label class="form-label"> Ingrese Descripcion:</label>
                            <input class="form-control mb-5" placeholder="Ingrese Campos" type="text" name="txtbuscar" value="{{ $databusqueda->cod_sunedu }}">
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
									<th>laboratorio</th>
									<th>software</th>
									<th>versión</th>
									<th>año adquisición</th>
									<th>fecha Fin Licencia</th>
									<th>Carta de Garantia</th>
									<th>Manual</th>
									
									
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
								@foreach($lista  as $filas)
								<?php $i++;  ?>
									<tr>
										<td>{{ $i }}</td>
									
										<td>{{ $filas->nombre_lab }}</td>
										<td>{{ $filas->nom_software }}</td>
										<td>{{ $filas->version }}</td>
										<td>{{ $filas->anio_adquisicion }}</td>
										<td>{{ fechaUsu($filas->fch_fin_vigencia) }}</td>
										<td> 
											<?php
					
												$ruta_carta_garantia=asset('files/software').'/'.$filas->carta_garantia;
											
												if($filas->carta_garantia!=''){
											?>

														<a href="{{ $ruta_carta_garantia }}" target="_blank" title="Descargar">
														<i class="fa fa-file-pdf-o" style="font-size:20px;color:green"></i>
													</a>
													<?php	} else {?>

														
														<i class="fa fa-times" style="color:red"></i>


														<?php	} ?>
										
											
										</td>
										<td>

										<?php
					
												$ruta_manual_usuario=asset('files/software').'/'.$filas->manual_usuario;
											
												if($filas->manual_usuario!=''){
											?>

														<a href="{{ $ruta_manual_usuario }}" target="_blank">
														<i class="fa fa-file-pdf-o" aria-hidden="true" style="font-size:20px;color:red" title="Descargar"></i>
														</a>
													<?php	} else {?>
														<i class="fa fa-times" style="color:red"></i>
																
														<?php	} ?>




										</td>
										
										
										<td>
										<button type="button" class="btn-info editardato" value="{{ $filas->id }}" > 
					                            <i class="glyphicon glyphicon-edit"></i> 
					                        </button>
					                        <button class="btn-danger" data-toggle="modal" data-target="#modal_eliminar" onclick="eliminar({{ $filas->id}},'{{ $filas->nom_software }}')"> 
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
    var urlnuevo = "{{ route('mant_software') }}";
    $( "#div_ModalMant" ).html('Cargando...');
    $( "#div_ModalMant" ).load(urlnuevo );
  }); 

	$(".editardato").click(function(event){
    	event.preventDefault();     
	    //var idtablas = $(this).val();
	    var idtablas = $(this).attr("value");
	    var url = "{{ route('mant_software') }}?id="+idtablas;
	    $( "#div_ModalMant" ).html('Cargando...');
	    $( "#div_ModalMant" ).load(url);
   }); 


	function eliminar(idfila,nombre){
		$('#lblmensaje').text( nombre);
		$('#id_borrar').val(idfila);
	}

$(document).ready(function() {
	

});

</script>
@endsection
