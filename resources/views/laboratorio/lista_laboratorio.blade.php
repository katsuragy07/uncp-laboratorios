@inject('lstfacultad','App\Models\Facultad')
@inject('m_periodo','App\Models\Periodo')
@extends('layouts.principal')
@section('titulo','Laboratorios')
@section('contenido')
<div class=""> <!-- container -->
   
   <!-- Modal Nuevo y editar -->
	<div class="modal fade" id="modal_nuevousuario" tabindex="-1" role="dialog" aria-labelledby="largemodal" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="largemodal1"> <i class="fa fa-user-plus"></i> Nuevo Laboratorio</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form class="form-horizontal" action="{{ route('guardar.usuario') }}" method="POST">
					@csrf
					<input type="hidden" name="id_laboratorio" id="id_laboratorio">
				<div class="modal-body">
					<div class="form-group row">
						<label class="col-md-3 form-label">Facultad:</label>
						<div class="col-md-3">
							<select name="id_laboratorio" required="" class="form-control" id="id_laboratorio">
								<option value="">Seleccionar...</option>
								@foreach($lstfacultad::orderby('nom_facultad','ASC')->get() as $facultad)
								<option value="{{ $facultad->id }}">{{ $facultad->nom_facultad }}</option>
								@endforeach
							</select>
						</div>

					</div>					
					<div class="form-group row">
						<label class="col-md-3 form-label">Nombres</label>
						<div class="col-md-9">
							<input type="text" name="nombre_usuario" class="form-control"  placeholder="Nombres" required="" id="txtnombres">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Correo</label>
						<div class="col-md-9">
							<input type="email" name="email" class="form-control"  placeholder="Correo electrónico" required="" id="txtcorreo">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Contraseña</label>
						<div class="col-md-9">
							<input type="password" name="clave" class="form-control" placeholder="Contraseña" id="txtclave">
						</div>
					</div>

					<div class="form-group row" style="display: none;" id="row_estados">
						<label class="col-md-3 form-label"></label>
						<div class="col-md-3">
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="sts_usuario" value="AC" id="rbtac">
								<span class="custom-control-label">Activo</span>
							</label>
						</div>
						<div class="col-md-3">
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="sts_usuario" value="SP">
								<span class="custom-control-label">Suspendido</span>
							</label>
						</div>
					</div>
				</div>
				<div class="modal-footer">
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
					<form action="{{ route('borrar_laboratorio') }}" method="POST">
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

		<!-- Modal eliminar -->
	<div class="modal" id="modal_caledario">
		<div class="modal-dialog modal-dialog-centered text-center" role="document">
			<div class="modal-content tx-size-sm">
				<div class="modal-body text-center p-4">
					<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					<i class="fe fe-alert-circle fs-100 text-info lh-1 mb-5 d-inline-block"></i>
					<h4 class="text-info"> Seleccione Periodo </h4>
					<p class="mg-b-20 mg-x-20" id="lblcalendario" style="font-size: 1.2rem;">  </p>
					<form action="{{ route('pdf.calendario') }}" method="get" target="_blank">
						@csrf
						<input type="hidden" name="laboratorio_id" id="laboratorio_id">

						<select name="periodo" required="" class="form-control" id="periodo">
								<option value="">Seleccionar...</option>
								@foreach($m_periodo::orderby('periodo','ASC')->get() as $periodo)
								<option value="{{ $periodo->periodo }}">{{ $periodo->periodo }}</option>
								@endforeach
							</select>
						

					<button aria-label="Close" class="btn btn-secondary pd-x-25" data-dismiss="modal" type="button">Cancelar</button>
					<button type="submit" class="btn btn-primary">Mostrar</button>
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
                	<form action="{{ route('listar.laboratorios') }}" method="GET">
                    <div class="row">
                        <div class="col-lg">
                            <label class="form-label"> Facultad:</label>
                            
							<select name="facultad_id" id="facultad_id" class="form-control select2-show-search select2-hidden-accessible" data-placeholder="Seleccione Facultad/Dependencia" tabindex="-1">
								<option value="">Todos...</option>
								@foreach($lstfacultad::orderby('nom_facultad','ASC')->get() as $facultad)
								<option @if($facultad->id == $databusqueda->facultad_id) selected @endif value="{{ $facultad->id }}">{{ $facultad->nom_facultad }}</option>
								@endforeach
							</select>
                        </div>
                        <div class="col-lg">
                            <label class="form-label"> Ingrese Descripcion:</label>
                            <input class="form-control mb-4" placeholder="Ingrese Campos" type="text" name="txtbuscar" value="{{ $databusqueda->cod_sunedu }}">
                        </div>
                        
                        <div class="col-lg "><br>
                           <button type="submit" class="btn btn-primary"> 
                                <i class="fa fa-search"></i> Buscar
                            </button>
                           
                    		<a href="{{ route('crear.laboratorios') }}" class="btn  btn-success"> <i class="fa fa-plus"></i> Nuevo</a>

							<?php 
						$v1='all';
						$v2='all';
						if($databusqueda->facultad_id!=''){
							$v1=$databusqueda->facultad_id;
						}

						if($databusqueda->txtbuscar!=''){
							$v2=$databusqueda->txtbuscar;
						}

						?>

						<a href="{{ route('exportarxls',['idfacu'=>$v1,'descrip'=>$v2 ]) }}" class="btn btn-outline-success" target="_blank">
                            <i class="fa fa-file-excel-o"></i> 
                        </a>
						
						
						</div>
                    </div>
                    </form>

                </div>
            </div>
            <div class="card">
                <div class="card-body">
					<div class="table-responsive" style="min-height: 300px">
						<table class="table table-hover card-table table-vcenter text-nowrap mb-0">
							<thead>
								<tr>
									<th>#</th>
									<th>Cod. Sunedu</th>
									<th>Nombre</th>
									<th>Aula</th>
									<th>Pabellon</th>
									<th>Aforo</th>
									<th>area Total m2</th>
									
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
								@foreach($listalaboratio  as $laboratorio)
								<?php $i++;  ?>
									<tr>
										<td>{{ $i }}</td>
										<td>{{ $laboratorio->cod_sunedu }}</td>
										<td>{{ $laboratorio->nombre_lab }}</td>
										<td>{{ $laboratorio->num_aula }}</td>
										<td>{{ $laboratorio->pabellon }}</td>
										<td>{{ $laboratorio->aforo }}</td>
										<td>{{ $laboratorio->area_total }}</td>
										
										
										<td>
											<div class="dropdown">
												<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
												</button>
												<div class="dropdown-menu dropdown-menu-right" style="">
													<a href="{{route('editar.laboratorios',$laboratorio->id) }}" class="dropdown-item">Editar</a>
													<a href="{{ route('lista.tipo_laboratorio') }}?laboratorio_id={{ $laboratorio->id }}" class="dropdown-item">Tipo de laboratorio</a>
													<a href="{{ route('listar.equipos') }}?laboratorio_id={{ $laboratorio->id }}" class="dropdown-item">Equipos</a>
													<a href="{{ route('listar.material') }}?laboratorio_id={{ $laboratorio->id }}" class="dropdown-item">Materiales</a>
													<a href="{{ route('listar.insumos') }}?laboratorio_id={{ $laboratorio->id }}" class="dropdown-item">Insumos</a>

													<a class="dropdown-item d-none" data-toggle="modal" data-target="#modal_caledario" onclick="calendario({{ $laboratorio->id}},'{{ $laboratorio->nombre_lab }}')">Calendario</a>

													<a class="dropdown-item" data-toggle="modal" data-target="#modal_eliminar" onclick="eliminar({{ $laboratorio->id}},'{{ $laboratorio->nombre_lab }}')">Eliminar</a>
													 
												</div>
											</div>

                            				
											<!-- <a href="{{route('show.laboratorios',$laboratorio->id) }}" class="btn btn-sm btn-primary"> <i class="glyphicon glyphicon-list-alt"></i> </a> -->

					        			 
										</td> 
									</tr>									
								@endforeach
							</tbody>
						</table>
					</div>
					<hr class="m-1">
				    <div class="text-center">
				        {!! $listalaboratio->render()!!}
				    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

	
	function eliminar(idfila,nombre){
		$('#lblmensaje').text( nombre);
		$('#id_borrar').val(idfila);
	}

	function calendario(laboratorio_id, nombre){
		$('#lblcalendario').html( nombre);
		$('#laboratorio_id').val(laboratorio_id);
	}


$(document).ready(function() {
	

});

</script>
@endsection
