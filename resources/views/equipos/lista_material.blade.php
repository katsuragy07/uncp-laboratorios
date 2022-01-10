@inject('funciones','App\Http\Controllers\FuncionesController')
@inject('m_laboratorio','App\Models\Laboratorio')
@inject('m_persona','App\Models\Persona')
@extends('layouts.principal')
@section('titulo','Materiales')
@section('contenido')
<?php $PrivUsuario = $funciones->PrivUsuario();	?>
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
					<form action="{{ route('borrar.equipo') }}" method="POST">
						@csrf
						<input type="hidden" name="id" id="id_borrar">
						<input type="hidden" name="tipo_equipo_id" value="2">
						
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
                	<form action="{{ route('listar.material') }}" method="GET">
                    <div class="row">
                    	<?php  if(in_array("admin_todo_laboratorio", $PrivUsuario)) {  	?>
                        <div class="col-md-3">
                            <label class="form-label"> Laboratorio</label>
                            <select name="laboratorio_id" class="form-control" >
								<option value="TODOS">-- Todos --</option>
								@foreach($m_laboratorio::orderby('nombre_lab','ASC')->get() as $laboratorio)
								<option @if($laboratorio->id == $databusqueda->laboratorio_id) selected @endif value="{{ $laboratorio->id }}">{{ $laboratorio->nombre_lab }}</option>
								@endforeach
							</select>
                        </div>
                        <?php }else{ ?>
                        	<input type="hidden" name="laboratorio_id" value="{{ Auth::user()->laboratorio_id }}">
                        <?php  } ?>


                        <div class="col-md-3">
                            <label class="form-label"> Nombre material</label>
                            <input class="form-control mb-4" placeholder="" type="text" name="nom_equipo" value="{{ $databusqueda->nom_equipo }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label"> Marca</label>
                            <input class="form-control mb-4" placeholder="" type="text" name="marca" value="{{ $databusqueda->marca }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label"> Stock</label>
                            <div class="form-group   no-padding"> 
                                <select class="form-control" name="stock" id="stock">
                                  <option @if('todos' == $databusqueda->stock) selected @endif value="todos">--TODOS--</option>
                                  <option @if('skmin' == $databusqueda->stock) selected @endif value="skmin">Stock mínimo</option>
                                  <option @if('consk' == $databusqueda->stock) selected @endif value="consk">Con Stock</option>
                                  <option @if('sk0' == $databusqueda->stock) selected @endif value="sk0">Stock 0</option>
                                  <option @if('skneg' == $databusqueda->stock) selected @endif value="skneg">Stock Negativo</option>
                                </select>
                              </div>
                        </div>
                        <div class="col-md-3"><br>
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
									<th>Material</th>
									<th>Marca</th>
									<th>Especificación</th>
									<th>Unidad Medida</th>
									<th>Cantidad</th>
									 
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
										<td>{{ $fila->nom_equipo }}</td>
										<td>{{ $fila->marca }}</td>
										<td>{{ $fila->especificacion }}</td>
										<td>{{ $fila->unidad_medida }}</td>
										<td>{{ $fila->cantidad_lote }}</td>
										 
										 
										<td>
					        				<button type="button" class="btn-info editardato" value="{{ $fila->id }}" > 
					                            <i class="glyphicon glyphicon-edit"></i> 
					                        </button>
					                        <button class="btn-danger" data-toggle="modal" data-target="#modal_eliminar" onclick="eliminar({{ $fila->id}},'{{ $fila->nom_equipo }}')"> 
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
    var urlnuevo = "{{ route('mant.material') }}";
    $( "#div_ModalMant" ).html('Cargando...');
    $( "#div_ModalMant" ).load(urlnuevo );
  }); 

	$(".editardato").click(function(event){
    	event.preventDefault();     
	    //var idtablas = $(this).val();
	    var idtablas = $(this).attr("value");
	    var url = "{{ route('mant.material') }}?id="+idtablas;
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
