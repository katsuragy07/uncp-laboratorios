@inject('m_laboratorio','App\Models\Laboratorio')
@inject('m_persona','App\Models\Persona')
@extends('layouts.principal')
@section('titulo','Lista de recepciones')
@section('contenido')
<div class=""> <!-- container -->
   
   <!-- Modal Nuevo y editar -->
	<div id="div_ModalMant">		
	</div>
	<!-- Fin Modal nuevo y editar -->

	<!-- Modal eliminar -->
	<div class="modal" id="modal_recepcionar">
		<div class="modal-dialog modal-dialog-centered text-center" role="document">
			<div class="modal-content tx-size-sm">
				<div class="modal-body text-center p-4">
					<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					<i class="fe fe-alert-circle fs-100 text-success lh-1 mb-5 d-inline-block"></i>
					<h4 class="text-info"> Estás seguro aceptar la recepción de todo los insumos? </h4>
					<p class="mg-b-20 mg-x-20" id="lblmensaje" style="font-size: 1.2rem;">  </p>
					<form action="{{ route('aceptar.recepcion') }}" method="POST">
						@csrf
						<input type="hidden" name="atencion_id" id="atencion_id">
						<input type="hidden" name="tipo_equipo_id" value="3">
						
						<div class="form-group"> 
							<label class="custom-switch"> 
								<span class="custom-switch-description mr-2">Estoy conforme</span> 
								<input type="checkbox" id="ck_conforme" name="custom-switch-checkbox1" class="custom-switch-input"> 
								<span class="custom-switch-indicator custom-switch-indicator-lg"></span> 
							</label> 
						</div>


					<button aria-label="Close" class="btn btn-secondary pd-x-25" data-dismiss="modal" type="button">Cancelar</button>
					<button type="submit" id="btn_aceptar" class="btn btn-primary">Si, Aceptar</button>
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
                	<form action="{{ route('listar.recepcion') }}" method="GET">
                    <div class="row">
                        <div class="col-lg">
                            <label class="form-label"> Recepción desde</label>
                            <input class="form-control mb-4" placeholder="" type="date" name="fch_recepcion_desde" value="{{ $databusqueda->fch_recepcion_desde }}">
                        </div>
                        <div class="col-lg">
                            <label class="form-label"> Recepción hasta</label>
                            <input class="form-control mb-4" placeholder="" type="date" name="fch_recepcion_hasta" value="{{ $databusqueda->fch_recepcion_hasta }}">
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
                	<!-- sadasd-->
                	
                	<div class="tab_wrapper first_tab"> 
                		<ul class="tab_list"> 
                			<li class="active" rel="tab_1_1">Lista de recepciones</li> 
                			<li rel="tab_1_2" class="">Pendientes por recibir <span class="badge badge-default">{{ count($listapendiente) }}</span></li> 
                		</ul>
                		<div class="content_wrapper"> 
                			<!-- Tab 1-->
                			<div class="tab_content first tab_1_1 p-0 active" title="tab_1_1" style="display: block;">

					<div class="table-responsive">
						<table class="table table-hover card-table table-vcenter text-nowrap mb-0">
							<thead>
								<tr>
									<th>#</th>
									<th>Fecha Pedido</th>
									<th>Fecha Recepción</th>
									<th># Atención</th>
									<th>Compra</th>
									<th>Proveedor</th>
									
									<th>Recibido</th>
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
										<td>{{ fechaUsu($fila->fecha_solicitud) }}</td>
										<td>{{ fechaUsu($fila->fecha_recepcion) }}</td>
										<td>{{ $fila->atencion_id }}</td>
										<td>
											<?php if($fila->doc_sustento!=''){ ?>
												<a href="files/doc_sustento/{{$fila->doc_sustento}}" class="text-info" target="_blank" title="Descargar"><?php  echo $fila->numdoc_sustento; ?></a>
											<?php }else{?>
												{{ $fila->numdoc_sustento }}
											<?php }?>
											
										</td>
										<td>{{ $fila->proveedor }}</td>
										
										<td>{{ $fila->resp_recepcion }}</td>
										 
										 
										<td>
					        				<button type="button" class="btn-info editardato" value="{{ $fila->id }}" > 
					                            <i class="glyphicon glyphicon-edit"></i> 
					                        </button>
					                        
										</td> 
									</tr>									
								@endforeach
							</tbody>
						</table>
					</div>
					<hr class="m-2">
				    <div class="text-center">
				        {!! $lista->render()!!}
				    </div>

                			</div> 
                			<!-- fin tab1-->
                			<!-- tab1-->
                			<div class="tab_content tab_1_2 p-0" title="tab_1_2" style="display: none;"> 

					<div class="table-responsive">
						<table class="table table-hover card-table table-vcenter text-nowrap mb-0">
							<thead>
								<tr>
									<th>#</th>
									<th>Fecha Pedido</th>
									<th>Hora Pedido</th>
									<th>Fecha Entrega</th>
									<th>Hora Entrega</th>
									<th>Laboratorio Origen</th>
									<th>Atendido</th>
									<th>Recibido</th>
									<th></th>
								</tr>
							</thead>
							<tbody>

								<?php 
									$i = 0;
								 ?>
								@foreach($listapendiente  as $fila)
								<?php $i++;  ?>
									<tr>
										<td>{{ $i }}</td> 
										<td>{{ fechaUsu($fila->fch_pedido) }}</td>
										<td>{{ $fila->hora_pedido }}</td>
										<td>{{ fechaUsu($fila->fch_entrega) }}</td>
										<td>{{ $fila->hora_entrega }}</td>
										<td>{{ $fila->nombre_lab }}</td>
										<td>{{ $fila->resp_atencion }}</td>
										<td>{{ $fila->resp_recibir }}</td>

										<td> 
											<button class="btn-info recepcionar" data-toggle="modal" data-target="#modal_recepcionar" onclick="recepcionar({{ $fila->id}},'<b>Atención:</b> N.{{ $fila->id }} <b>Fecha Entrega:</b> {{ fechaUsu($fila->fch_entrega) }} <b><br>Recibido por:</b> {{ $fila->resp_recibir }}')"> 
					                            <i class="glyphicon glyphicon-check"></i> 
					                        </button> 
										</td> 
									</tr>									
								@endforeach
							</tbody>
						</table>
					</div>
                			</div>   
                			<!-- tab1-->
                		</div>
                	</div>


                </div>
            </div>
        </div>
    </div>
</div>

<script>
   $("#btnnuevo").click(function(event){ 
    event.preventDefault();        
    var urlnuevo = "{{ route('mant.recepcion') }}";
    $( "#div_ModalMant" ).html('Cargando...');
    $( "#div_ModalMant" ).load(urlnuevo );
  }); 

	$(".editardato").click(function(event){
    	event.preventDefault();     
	    //var idtablas = $(this).val();
	    var idtablas = $(this).attr("value");
	    var url = "{{ route('mant.recepcion') }}?id="+idtablas;
	    $( "#div_ModalMant" ).html('Cargando...');
	    $( "#div_ModalMant" ).load(url);
   }); 


	function recepcionar(idfila,nombre){
		$('#ck_conforme').prop('checked',false);
		//$('#btn_aceptar').prop('disabled',false);
	    $( "#btn_aceptar" ).prop("disabled", true );

		$('#lblmensaje').html( nombre);
		$('#atencion_id').val(idfila);
	}

	$("#ck_conforme").click(function(event){
		if ($('#ck_conforme').is(':checked')) {
			$( "#btn_aceptar" ).prop("disabled", false);
		}else{
			$( "#btn_aceptar" ).prop("disabled", true );
		}
	})


$(document).ready(function() {
	

});
</script>
@endsection