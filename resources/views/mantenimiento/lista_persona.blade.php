@inject('m_tipo_documento','App\Models\Tipo_documento')
@extends('layouts.principal')
@section('titulo','Persona')
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
				<form class="form-horizontal" action="{{ route('guardar.persona') }}" method="POST">
					@csrf					
				<div class="modal-body">
					<div class="form-group row">
						<label class="col-md-3 form-label">Tipo Doc.</label>				
						<div class="col-md-6">
							<select name="tipo_documento_id" required="" class="form-control" id="cmbtipodocumento">
								<option value="">Seleccionar...</option>
								@foreach($m_tipo_documento::orderby('id','ASC')->get() as $tipo_documento)
								<option value="{{ $tipo_documento->id }}">{{ $tipo_documento->tipo_documento }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Num. Doc</label>
						<div class="col-md-9">
							<input type="text" name="num_doc" class="form-control"  autocomplete="off" required="" id="txtnum_doc">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Nombres</label>
						<div class="col-md-9">
							<input type="text" name="nombres" class="form-control"  autocomplete="off" required="" id="txtnombres">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Apellidos</label>
						<div class="col-md-9">
							<input type="text" name="apellidos" class="form-control"  autocomplete="off" required="" id="txtapellidos">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Correo</label>
						<div class="col-md-9">
							<input type="email" name="correo" class="form-control"  autocomplete="off" id="txtcorreo">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Celular</label>
						<div class="col-md-9">
							<input type="text" name="celular" class="form-control"  autocomplete="off"  id="txtcelular">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Fecha de Nacimiento</label>
						<div class="col-md-9">
							<input type="date" name="fch_nacimiento" class="form-control"  autocomplete="off" id="txtfch_nacimiento">
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
					<form action="{{ route('borrar.persona') }}" method="POST">
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
                	<form action="{{ route('listar.persona') }}" method="GET">
                    <div class="row">
                        <div class="col-lg">
                            <label class="form-label"> Nombres</label>
                            <input class="form-control mb-4" placeholder="" type="text" name="nombres" value="{{ $databusqueda->nombres }}">
                        </div>
                        <div class="col-lg">
                            <label class="form-label"> Apellidos</label>
                            <input class="form-control mb-4" placeholder="" type="text" name="apellidos" value="{{ $databusqueda->apellidos }}">
                        </div>
                        <div class="col-lg "><br>
                           <button type="submit" class="btn btn-primary"> 
                                <i class="fa fa-search"></i> Buscar
                            </button>
                           
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_nuevo" onclick="nuevo()"> 
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
									<th>Num. documento</th>
									<th>Nombres</th>
									<th>Apellidos</th>
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
								<?php
								 $i++;  ?>
									<tr>
										<td>{{ $i }}</td>
										<td>{{ $fila->num_doc }}</td>
										<td>{{ $fila->nombres }}</td> 
										<td>{{ $fila->apellidos }}</td>
										 
										<td>
					        				<button type="button" class="btn-info" data-toggle="modal" data-target="#modal_nuevo" onclick="editar({{ $fila->id }},'{{ $fila->tipo_documento_id }}','{{ $fila->num_doc }}','{{ $fila->nombres }}','{{ $fila->apellidos }}','{{ $fila->correo }}','{{ $fila->celular }}','{{ $fila->fch_nacimiento }}')" > 
					                            <i class="glyphicon glyphicon-edit"></i> 
					                        </button>

					                        <button class="btn-danger" data-toggle="modal" data-target="#modal_eliminar" onclick="eliminar({{ $fila->id}},'{{ $fila->nombres }}')"> 
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
	function nuevo(){
		$('#txtid').val('');		
		$('#txtnombres').val("");
		$('#txtapellidos').val("");	
		$('#txtcorreo').val("");	
		$('#txtfch_nacimiento').val("");	
		$('#txtcelular').val("");	
			
	}

	function editar(id,tipo,num_doc,nombres,apellidos,correo,fch_nacimiento,celular) {
		$('#txtid').val(id);
		$('#txtnum_doc').val(num_doc);
		$('#cmbtipodocumento').val(tipo);
		$('#txtnombres').val(nombres);
		$('#txtapellidos').val(apellidos);
		$('#txtcorreo').val(correo);	
		$('#txtfch_nacimiento').val(celular);	
		$('#txtcelular').val(fch_nacimiento);	
	}

	function eliminar(id,mensaje){
		$('#id_borrar').val(id);
		$('#lblmensaje').text( mensaje);
	}
 
$(document).ready(function() {
});

</script>
@endsection
