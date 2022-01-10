@inject('lstcargos','App\Models\Cargos')
@extends('layouts.principal')
@section('titulo','Facultades')
@section('contenido')
<div class=""> <!-- container -->
   
   <!-- Modal Nuevo y editar -->
	<div class="modal fade" id="modal_nuevafacultad" tabindex="-1" role="dialog" aria-labelledby="largemodal" aria-hidden="true">
		<div class="modal-dialog modal-lg " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="largemodal1"> <i class="fa fa-user-plus"></i> Nueva facultad</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form class="form-horizontal" action="{{ route('guardar.facultad') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="id_facultad" id="id_facultad">
				<div class="modal-body">						
					<div class="form-group row">
						<label class="col-md-3 form-label">Nombre Facultad</label>
						<div class="col-md-9">
							<input type="text" name="nombre_facultad" class="form-control"  placeholder="Nombres" required="" id="txtnombrefacultad">	
						</div>

						<br>
						<br>

						
						<br>
						<br>

						<label class="col-md-3 form-label">Organigrama</label>
						<div class="col-md-9">
							<input type="file" name="organigrama_facultad" class="form-control"  placeholder="Nombres" required="" id="organigrama_facultad">					
						</div>


					</div>



					<div class="form-group row" style="display: none;" id="row_estadosfacultad">
						<label class="col-md-3 form-label"></label>
						<div class="col-md-3">
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="sts_facultad" value="AC" id="rbtac">
								<span class="custom-control-label">Activo</span>
							</label>
						</div>
						<div class="col-md-3">
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="sts_facultad" value="SP">
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

	<!-- Modal eliminar  -->

	<div class="modal" id="modal_eliminarfacultad">
		<div class="modal-dialog modal-dialog-centered text-center" role="document">
			<div class="modal-content tx-size-sm">
				<div class="modal-body text-center p-4">
					<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					<i class="fe fe-x-circle fs-100 text-danger lh-1 mb-5 d-inline-block"></i>
					<h4 class="text-danger"> Estás seguro eliminar? </h4>
					<p class="mg-b-20 mg-x-20" id="lblmensaje" style="font-size: 1.2rem;">  </p>
					<form action="{{ route('borrar.facultad') }}" method="POST">
						@csrf
						<input type="hidde" name="id_facultad" id="id_borrarfacultad">
						
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
                	<form action="{{ route('listar.facultades') }}" method="GET">
                    <div class="row">
                      
                        <div class="col-lg">
                            <label class="form-label"> Facultad</label>
                            <input class="form-control mb-4" placeholder="Nombe Facultad" type="text" name="nombre_facultad" value="{{ $databusqueda->nombre_facultad}}">
                        </div>
                      
                        <div class="col-lg "><br>
                           <button type="submit" class="btn btn-primary"> 
                                <i class="fa fa-search"></i> Buscar
                            </button>
                           
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_nuevafacultad" onclick="nuevo()"> 
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

					

					<a href="{{ route('listar.reportes') }}">Lista reportes</a>

						<table class="table table-hover card-table table-vcenter text-nowrap mb-0">
							<thead>
								<tr>
									<th>#</th>
							
									<th>Nombre </th>
									<th>Estado</th>
									<th>Organigrama</th>

				
									
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
								@foreach($listafacultades as $facultad)
								<?php $i++;  ?>
									<tr>
									<td>{{ $i }}</td>
									<td>{{ $facultad->nombre_facultad }}</td>	
									<td>{{ $facultad->sts_facultad }}</td>
                                    <td><a class="btn-dark"" href="imagenes/facultades/{{ $facultad->organigrama_facultad }}" target="blank_">Ver documento</a></td>
									
									
									
									<td>
									
							

					        				<button type="button" class="btn-info" data-toggle="modal" data-target="#modal_nuevafacultad" onclick="editar('{{ $facultad->id }}','{{ $facultad->nombre_facultad }}','{{ $facultad->sts_facultad }}','{{ $facultad->organigrama_facultad }}')" > 
					                            <i class="glyphicon glyphicon-edit"></i> 
					                        </button>

			

					                        <button class="btn-danger" data-toggle="modal" data-target="#modal_eliminarfacultad" onclick="eliminar('{{ $facultad->id}}','{{ $facultad->nombre_facultad }}','{{ $facultad->organigrama_facultad }}')"> 
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
				        {!! $listafacultades->render()!!}
				    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
	function nuevo(){
		$('#id_facultad').val('');
		$('#txtnombrefacultad').prop('disabled',false);
		$('#organigrama_facultad').prop('disabled',false);
		$('#row_estadosfacultad').hide();

		
	}

	function editar(idfacultad,nombre,sts,organigrama) {
	
		$('#id_facultad').val(idfacultad);
		
		$('#txtnombrefacultad').val(nombre);

		


		$("input[name=sts_facultad][value=" + sts + "]").attr('checked', 'checked');	

		
		$('#row_estadosfacultad').show();
	}

	function eliminar(idfacultad,nombre){
		$('#lblmensaje').text( nombre);
		$('#id_borrarfacultad').val(idfacultad);
		
	}


	$(document).ready(function() {
	

});
</script>
@endsection
