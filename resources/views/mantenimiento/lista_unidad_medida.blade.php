@inject('m_laboratorio','App\Models\Laboratorio')
@extends('layouts.principal')
@section('titulo','Unidad Medida')
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
				<form class="form-horizontal" action="{{ route('guardar.unidad_medida') }}" method="POST">
					@csrf					
				<div class="modal-body">					
					<div class="form-group row">
						<label class="col-md-3 form-label">Unidad Medida</label>
						<div class="col-md-9">
							<input type="text" name="unidad_medida" class="form-control"  placeholder="" required="" id="txtunidad_medida">
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
					<form action="{{ route('borrar.unidad_medida') }}" method="POST">
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
                	<form action="{{ route('listar.unidad_medida') }}" method="GET">
                    <div class="row">
                        <div class="col-lg">
                            <label class="form-label"> Unidad medida</label>
                            <input class="form-control mb-4" placeholder="" type="text" name="unidad_medida" value="{{ $databusqueda->unidad_medida }}">
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
									<th>Unidad Medida</th>
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
										<td>{{ $fila->unidad_medida }}</td>
										 
										<td>
					        				<button type="button" class="btn-info" data-toggle="modal" data-target="#modal_nuevo" onclick="editar({{ $fila->id }},'{{ $fila->unidad_medida }}')" > 
					                            <i class="glyphicon glyphicon-edit"></i> 
					                        </button>

					                        <button class="btn-danger" data-toggle="modal" data-target="#modal_eliminar" onclick="eliminar({{ $fila->id}},'{{ $fila->unidad_medida }}')"> 
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
	}

	function editar(id,unidad_medida) {
		$('#txtid').val(id);
		$('#txtunidad_medida').val(unidad_medida);
	}

	function eliminar(id,mensaje){
		$('#id_borrar').val(id);
		$('#lblmensaje').text( mensaje);
	}
 
$(document).ready(function() {
});

</script>
@endsection
