@inject('funciones','App\Http\Controllers\FuncionesController')
@inject('m_laboratorio','App\Models\Laboratorio')
@inject('m_tipo_fiscalizado','App\Models\Tipo_fiscalizado')
@extends('layouts.principal')
@section('titulo','Insumos')
@section('contenido')
<?php $PrivUsuario = $funciones->PrivUsuario();	?>
<div class=""> <!-- container -->   
   <!-- Modal Nuevo y editar -->
	<div id="div_ModalMant">		
	</div>
	<div id="div_ModalMantNuevo">		
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

    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                	<form action="{{ route('listar.insumos') }}" method="GET">
                    <div class="row">
                    	<?php  if(in_array("admin_todo_laboratorio", $PrivUsuario)) {  	?>
                        <div class="col-lg">
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
                        <div class="col-lg">
                            <label class="form-label"> Tipo Fiscalizado</label>
                            <select name="tipo_fiscalizado_id" class="form-control" >
								<option value="">-- Todos --</option>
								@foreach($m_tipo_fiscalizado::orderby('tipo_fiscalizado','ASC')->get() as $laboratorio)
								<option @if($laboratorio->id == $databusqueda->tipo_fiscalizado_id) selected @endif value="{{ $laboratorio->id }}">{{ $laboratorio->tipo_fiscalizado }}</option>
								@endforeach
							</select>
                        </div>

                        <div class="col-lg">
                            <label class="form-label"> Nombre insumos</label>
                            <input class="form-control mb-4" placeholder="" type="text" name="nom_equipo" value="{{ $databusqueda->nom_equipo }}">
                        </div>
                        <div class="col-lg">
                            <label class="form-label"> Marca</label>
                            <input class="form-control mb-4" placeholder="" type="text" name="marca" value="{{ $databusqueda->marca }}">
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
									<th>Tipo fiscalizado</th>
									<th>Insumo</th>
									<th>Marca</th>
									<th>Concentración</th>
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

								$laboratorio_id = $databusqueda->laboratorio_id;

								 ?>
								@foreach($lista  as $fila)
								<?php $i++;  ?>
									<tr>
										<td>{{ $i }}</td> 
										<td>{{ $fila->tipo_fiscalizado }}</td>
										<td>{{ $fila->nom_equipo }}</td>
										<td>{{ $fila->marca }}</td>
										<td>{{ $fila->concentracion }}</td>
										<td>{{ $fila->especificacion }}</td>
										<td>{{ $fila->unidad_medida }}</td>
										<td>{{ $fila->cantidad_lote*1 }}</td>
										 
										<td>
											@if($laboratorio_id>0)
						        				<button type="button" class="btn-info editardato" value="{{ $fila->id }}" idlab="{{ $laboratorio_id }}" > 
						                            <i class="glyphicon glyphicon-edit"></i> 
						                        </button>
						                        
						                        <button type="button" class="btn-info editarstock" value="{{ $fila->id }}" idlab="{{ $laboratorio_id }}" > 
						                            <i class="fa fa-hourglass-3"></i>
						                        </button>
					                        @endif
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
   // var urlnuevo = "{{ route('mant.insumo') }}";
    var urlnuevo = "{{ route('mant.agregar_insumo_lab') }}";
    $( "#div_ModalMant" ).html('Cargando...');
    $( "#div_ModalMant" ).load(urlnuevo );
  }); 

 
 function nuevo_insumo(){
 	$('#modal_mante_agregar').modal('hide');
 	$('#modal_mante_agregar').on('hidden.bs.modal', function () {
	    var urlnuevo = "{{ route('mant.insumo') }}";  
	    $( "#div_ModalMant" ).html('');
	    $( "#div_ModalMantNuevo" ).html('Cargando...');
	    $( "#div_ModalMantNuevo" ).load(urlnuevo );
	});
  	
}; 
   

	$(".editardato").click(function(event){
    	event.preventDefault();     
	    //var idtablas = $(this).val();
	    var idtablas = $(this).attr("value");
	    var idlab = $(this).attr("idlab");
	    var url = "{{ route('mant.insumo') }}?id="+idtablas+'&laboratorio_id='+idlab;
	    $( "#div_ModalMant" ).html('Cargando...');
	    $( "#div_ModalMant" ).load(url);
   }); 

	$(".editarstock").click(function(event){
    	event.preventDefault();     
	    //var idtablas = $(this).val();
	    var idtablas = $(this).attr("value");
	    var idlab = $(this).attr("idlab");	    
	    var url = "{{ route('mant.stock_insumo') }}?id="+idtablas+'&laboratorio_id='+idlab;
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