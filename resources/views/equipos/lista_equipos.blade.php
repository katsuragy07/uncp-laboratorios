@inject('funciones','App\Http\Controllers\FuncionesController')
@inject('m_laboratorio','App\Models\Laboratorio')
@inject('m_persona','App\Models\Persona')
@extends('layouts.principal')
@section('titulo','Equipos')
@section('contenido')
<?php $PrivUsuario = $funciones->PrivUsuario();	?>
<script>
	function generarexcel(){  
        //generarruta();  
        var form = document.forms.form_buscador;
        form.action ='{{ route('xls.lista_equipos') }}';
        form.setAttribute("target", "_blank");
        form.submit();
        //Volver a su normalidad
        form.setAttribute("target", "");
        form.action ='{{ route('listar.equipos') }}';
    }
</script>
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
						<input type="hidden" name="tipo_equipo_id" value="1">						
						<textarea class="form-control mb-2" placeholder="Escribe el motivo" rows="2" required="" name="motivo"></textarea>

					<button aria-label="Close" class="btn btn-secondary pd-x-25" data-dismiss="modal" type="button">Cancelar</button>
					<button type="submit" class="btn btn-primary">Eliminar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- Fin Modal eliminar -->

	<!-- Modal cambiar estado -->
	<div class="modal" id="modal_cambiarestado">
		<div class="modal-dialog modal-dialog-centered text-center" role="document">
			<div class="modal-content tx-size-sm">
				<div class="modal-body text-center p-4">
					<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					<i class="fe fe-alert-circle fs-100 text-info lh-1 mb-5 d-inline-block"></i>
					<h4 class="text-info"> Cambiar estado </h4>
					<p class="mg-b-20 mg-x-20" id="lblmensaje" style="font-size: 1.2rem;">  </p>
					<form action="{{ route('borrar.equipo') }}" method="POST">
						@csrf
						<div class="form-group row">
							<label class="col-md-3 form-label">Estado</label>
							<div class="col-md-6">
								<select name="estado_equipo" class="form-control"  >
									<option value="">-- Seleccionar --</option>
									<option @if(@$info->estado_equipo =='NU') selected @endif value="NU">Nuevo</option>
									<option @if(@$info->estado_equipo =='BU') selected @endif value="BU">Bueno</option>
									<option @if(@$info->estado_equipo =='RE') selected @endif value="RE">Regular</option>
									<option @if(@$info->estado_equipo =='ML') selected @endif value="ML">Malo</option> 
									<option @if(@$info->estado_equipo =='BJ') selected @endif value="BJ">Baja</option> 
								</select>
							</div>
						</div>

						<input type="hidden" name="id" id="id_equipo">
						<input type="hidden" name="tipo_equipo_id" value="1">						
						<textarea class="form-control mb-2" placeholder="Escribe el motivo" rows="2" required="" name="motivo"></textarea>

					<button aria-label="Close" class="btn btn-secondary pd-x-25" data-dismiss="modal" type="button">Cancelar</button>
					<button type="submit" class="btn btn-primary">Cambiar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- Fin Modal cambiar estado -->

    <div class="row justify-content-center">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                	<form action="{{ route('listar.equipos') }}" method="GET" id="form_buscador">
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
                            <label class="form-label"> Nombre equipo</label>
                            <input class="form-control mb-4" placeholder="" type="text" name="nom_equipo" value="{{ $databusqueda->nom_equipo }}">
                        </div>
                        <div class="col-lg">
                            <label class="form-label"> Responsable</label>
                            <select name="responsable_id" class="form-control" >
								<option value="">-- Todos --</option>
								@foreach($m_persona::orderby('apellidos','ASC')->get() as $persona)
								<option @if($persona->id == $databusqueda->responsable_id) selected @endif value="{{ $persona->id }}">{{ $persona->apellidos }} {{ $persona->nombres }}</option>
								@endforeach
							</select>
                        </div>
                        <div class="col-lg "><br>
                           <button type="submit" class="btn btn-primary"> 
                                <i class="fa fa-search"></i> Buscar
                            </button>
                           
                            <button type="button" id="btnnuevo" class="btn btn-success" > 
                                <i class="fa fa-plus"></i> Nuevo
                            </button>

                            <a href="#" onClick="generarexcel();" class="btn btn-outline-success" >
	                            <i class="fa fa-file-excel-o"></i> 
	                        </a>
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
									<th>Cod. patrimonial</th>
									<th>Nombre Equipo</th>
									<th>Ubicación</th>
								 
									<th>Responsable</th>
									<th>Proveedor</th>
									<th>Estado</th>
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
										<td>{{ $fila->cod_patrimonio }}</td>
										<td>{{ $fila->nom_equipo }}</td>
										<td>{{ $fila->ubicacion }}</td>
									 
										<td>{{ $fila->nombres }} {{ $fila->apellidos }}</td>
										<td>{{ $fila->proveedor }}</td>
										<td>{{ estado($fila->estado_equipo) }}</td> 
										<td>
											

					        				<button type="button" class="btn-info editardato" value="{{ $fila->id }}" > 
					                            <i class="glyphicon glyphicon-edit"></i> 
					                        </button>
					                        <button class="btn-warning" data-toggle="modal" data-target="#modal_cambiarestado" onclick="cambiarestado({{ $fila->id}},'{{ $fila->cod_patrimonio }} - {{ $fila->nom_equipo }}')"> 
					                            <i class="fa fa-refresh"></i> 
					                        </button>

					                        <button class="btn-danger" data-toggle="modal" data-target="#modal_eliminar" onclick="eliminar({{ $fila->id}},'{{ $fila->cod_patrimonio }} - {{ $fila->nom_equipo }}')"> 
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
    var urlnuevo = "{{ route('mant.equipo') }}";
    $( "#div_ModalMant" ).html('Cargando...');
    $( "#div_ModalMant" ).load(urlnuevo );
  }); 

	$(".editardato").click(function(event){
    	event.preventDefault();     
	    //var idtablas = $(this).val();
	    var idtablas = $(this).attr("value");
	    var url = "{{ route('mant.equipo') }}?id="+idtablas;
	    $( "#div_ModalMant" ).html('Cargando...');
	    $( "#div_ModalMant" ).load(url);
   }); 


	function eliminar(idfila,nombre){
		$('#lblmensaje').text( nombre);
		$('#id_borrar').val(idfila);
	}
	function cambiarestado(idfila,nombre){
		$('#lblmensaje').text( nombre);
		$('#id_equipo').val(idfila);
	}

$(document).ready(function() {
	

});
</script>
@endsection
