@inject('m_laboratorio','App\Models\Laboratorio')
@extends('layouts.principal')
@section('titulo','Ubigeo')
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
				<form class="form-horizontal" action="{{ route('guardar.ubigeo') }}" method="POST">
					@csrf					
				<div class="modal-body">					
					<div class="form-group row">
						<label class="col-md-3 form-label">Ubigeo</label>
						<div class="col-md-9">
							<input type="text" name="ubigeo" class="form-control"  placeholder="" required="" id="txtubigeo">
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
 

    <div class="row justify-content-center">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                	<form action="{{ route('listar.ubigeo') }}" method="GET">
                    <div class="row">
                        <div class="col-lg">
                            <label class="form-label"> Ubigeo</label>
                            <input class="form-control mb-4" placeholder="" type="text" name="ubigeo" value="{{ $databusqueda->ubigeo }}">
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
									<th>Ubigeo</th>
									<th>Distrito</th>
									<th>Provincia</th>
									<th>Departamento</th>
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
										<td>{{ $fila->ubigeo }}</td>
										<td>{{ $fila->distrito }}</td>
										<td>{{ $fila->provincia }}</td>
										<td>{{ $fila->departamento }}</td>
										 
										<td>
					        				 
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

	function editar(id,ubigeo) {
		$('#txtid').val(id);
		$('#txtubigeo').val(ubigeo);
	}

	function eliminar(id,mensaje){
		$('#id_borrar').val(id);
		$('#lblmensaje').text( mensaje);
	}
 
$(document).ready(function() {
});

</script>
@endsection
