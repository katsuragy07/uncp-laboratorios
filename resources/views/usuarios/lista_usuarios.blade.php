@inject('m_laboratorio','App\Models\Laboratorio')
@extends('layouts.principal')
@section('titulo','Usuarios')
@section('contenido')
<div class=""> <!-- container -->
   
   <!-- Modal Nuevo y editar -->
	<div class="modal fade" id="modal_nuevousuario" tabindex="-1" role="dialog" aria-labelledby="largemodal" aria-hidden="true">
		<div class="modal-dialog modal-lg " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="largemodal1"> <i class="fa fa-user-plus"></i> Usuario</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form class="form-horizontal" action="{{ route('guardar.usuario') }}" method="POST">
					@csrf
					<input type="hidden" name="id_usuario" id="id_usuario">
				<div class="modal-body">
					<div class="form-group row">
						<label class="col-md-3 form-label">Laboratorio</label>
						<div class="col-md-6">
							<select name="laboratorio_id" required="" class="form-control" id="cmbcargo">
								<option value="">Seleccionar...</option>
								@foreach($m_laboratorio::orderby('nombre_lab','ASC')->get() as $laboratorio)
								<option value="{{ $laboratorio->id }}">{{ $laboratorio->nombre_lab }}</option>
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
						<label class="col-md-3 form-label">Usuario</label>
						<div class="col-md-9">
							<input type="text" name="username" class="form-control"  placeholder="Usuario" required="" id="txtusuario">
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

	<!-- Modal Cambiar Clave -->
	<div class="modal fade" id="modal_cambiarclave" tabindex="-1" role="dialog" aria-labelledby="largemodal" aria-hidden="true">
		<div class="modal-dialog modal-lg " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="largemodal1"> <i class="fa fa-user-plus"></i> Cambiar Clave</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form class="form-horizontal" action="{{ route('actualizar.clave') }}" method="POST">
					@csrf
					<input type="hidden" name="id_usuario" id="cc_id_usuario">
					<input type="hidden" name="tipo" value="editar_cambiarclave">
				<div class="modal-body">
					<div class="form-group row">
						<label class="col-md-3 form-label">Nombres</label>
						<div class="col-md-9">
							<input type="text" disabled="" name="nombre_usuario" class="form-control"  placeholder="Nombres" required="" id="cc_nombres">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Correo</label>
						<div class="col-md-9">
							<input type="email" disabled="" name="email" class="form-control"  placeholder="Correo electrónico" required="" id="cc_correo">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Usuario</label>
						<div class="col-md-9">
							<input type="text" disabled name="username" class="form-control"  placeholder="Usuario" required="" id="cc_usuario">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Contraseña</label>
						<div class="col-md-9">
							<input type="text" autocomplete="off" name="clave" class="form-control" placeholder="Contraseña" id="cc_clave">
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
	<!-- Fin Modal Cambiar clave -->

	<!-- Modal eliminar -->
	<div class="modal" id="modal_eliminar">
		<div class="modal-dialog modal-dialog-centered text-center" role="document">
			<div class="modal-content tx-size-sm">
				<div class="modal-body text-center p-4">
					<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					<i class="fe fe-x-circle fs-100 text-danger lh-1 mb-5 d-inline-block"></i>
					<h4 class="text-danger"> Estás seguro eliminar? </h4>
					<p class="mg-b-20 mg-x-20" id="lblmensaje" style="font-size: 1.2rem;">  </p>
					<form action="{{ route('borrar.usuario') }}" method="POST">
						@csrf
						<input type="hidden" name="id_usuario" id="id_borrar">
						
						<textarea class="form-control mb-2" placeholder="Escribe el motivo" rows="2" required="" name="motivo"></textarea>

					<button aria-label="Close" class="btn btn-secondary pd-x-25" data-dismiss="modal" type="button">Cancelar</button>
					<button type="submit" class="btn btn-primary">Eliminar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- Fin Modal eliminar -->


   <!-- Modal permisos-->
	<div class="modal fade" id="modal_permisos" tabindex="-1" role="dialog" aria-labelledby="largemodal" aria-hidden="true">
		<div class="modal-dialog modal-lg " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="largemodal1"> <i class="fa fa-edit"></i> Asignación de permisos</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form class="form-horizontal" action="{{ route('guardar.permisos') }}" method="POST">
					@csrf
					<input type="hidden" name="id_usuario" id="id_usuariopermiso">
				<div class="modal-body">
				
				<div class="form-group row">
					<label class="col-md-3 form-label">Permisos</label>
					<div class="col-md-9">
						<div class="form-group m-0">
							<div class="custom-controls-stacked" id="lista_permisos">
								<!-- 
								<label class="custom-control custom-checkbox" style="cursor: pointer;">
									<input type="checkbox" class="custom-control-input" name="permiso[]" value="1">
									<span class="custom-control-label">Lista de usuarios</span>
								</label>
			 					-->
							</div>
						</div>
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
	<!-- Fin Modal permisos -->



    <div class="row justify-content-center">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                	<form action="{{ route('listar.usuarios') }}" method="GET">
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
                        <div class="col-lg">
                            <label class="form-label"> Nombre</label>
                            <input class="form-control mb-4" placeholder="" type="text" name="nombre_usuario" value="{{ $databusqueda->nombre_usuario }}">
                        </div>
                        <div class="col-lg">
                            <label class="form-label"> Usuario</label>
                            <input class="form-control mb-4" placeholder="" type="text" name="username" value="{{ $databusqueda->username }}">
                        </div>
                        <div class="col-lg "><br>
                           <button type="submit" class="btn btn-primary"> 
                                <i class="fa fa-search"></i> Buscar
                            </button>
                           
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_nuevousuario" onclick="nuevo()"> 
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
									<th>Laboratorio</th>
									<th>Nombres</th>
									<th>Usuario</th>
									<th>Correo</th>
									<th>Cambio de clave</th>
									<th>Estado</th>
									<th>Permisos</th>
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
								@foreach($listausers  as $usuario)
								<?php $i++;  ?>
									<tr>
										<td>{{ $i }}</td>
										<td>{{ $usuario->nombre_lab }}</td>
										<td>{{ $usuario->nombre_usuario }}</td>
										<td>{{ $usuario->username }}</td>
										<td>{{ $usuario->email }}</td>
										<td>{{ fechaHoraUsu($usuario->fecha_cambioclave) }}</td>
										<td>{{ estado($usuario->sts_usuario) }}</td>
										<td>
											<img src="{{ asset('images/permisos.png') }}" width="30" style="cursor: pointer;" title="Permisos"  data-toggle="modal" data-target="#modal_permisos" onclick="permisos({{ $usuario->id }})">	
										</td>
										<td>
					        				<button type="button" class="btn-info" data-toggle="modal" data-target="#modal_nuevousuario" onclick="editar({{ $usuario->id }},{{ $usuario->laboratorio_id }},'{{ $usuario->nombre_usuario }}','{{ $usuario->email }}','{{ $usuario->sts_usuario }}')" > 
					                            <i class="glyphicon glyphicon-edit"></i> 
					                        </button>

					                        <button type="button" class="btn-warning" data-toggle="modal" title="Cambiar clave" data-target="#modal_cambiarclave" onclick="cambiarclave({{ $usuario->id }},'{{ $usuario->username }}','{{ $usuario->nombre_usuario }}','{{ $usuario->email }}','{{ $usuario->sts_usuario }}')" > 
					                            <i class="fa fa-refresh"></i> 
					                        </button>

					                        <button class="btn-danger" data-toggle="modal" data-target="#modal_eliminar" onclick="eliminar({{ $usuario->id}},'{{ $usuario->nombre_usuario }}')"> 
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
				        {!! $listausers->render()!!}
				    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
	function nuevo(){
		$('#id_usuario').val('');
		$('#txtusuario').prop('disabled',false);		
		$('#txtclave').prop('disabled',false);
		$('#row_estados').hide();
	}

	function editar(idusuario,laboratorio,nombre,email,sts) {
		// id usuerio
		$('#id_usuario').val(idusuario);
		$('#cmbcargo').val(laboratorio);
		$('#txtnombres').val(nombre);
		$('#txtcorreo').val(email);
		$("input[name=sts_usuario][value=" + sts + "]").attr('checked', 'checked');
		$('#txtusuario').prop('disabled',true);
		$('#txtclave').prop('disabled',true);
		$('#txtusuario').val('');
		$('#txtclave').val('');
		$('#row_estados').show();
	}

	function cambiarclave(idusuario,username,nombre,email,sts) {
		// id usuerio
		$('#cc_id_usuario').val(idusuario); 
		$('#cc_nombres').val(nombre);
		$('#cc_correo').val(email);
		 
		$('#cc_usuario').val(username);
		$('#cc_clave').val(''); 
	}

	


	function eliminar(idusuario,nombre){
		$('#lblmensaje').text( nombre);
		$('#id_borrar').val(idusuario);
	}

	function permisos(idusuario){
		$('#id_usuariopermiso').val(idusuario);
		$.ajax({
		    url:"{{ route('ver.permisos') }}",  
		    method:'GET',
		    data:{id_usuario:idusuario},
		    dataType:'json',
		    success:function(data){ 
		    	$('#lista_permisos').html(data.permisos);
		    }  
		});
	}


$(document).ready(function() {
	

});

</script>
@endsection
