@inject('funciones','App\Http\Controllers\FuncionesController')
@inject('m_laboratorio','App\Models\Laboratorio')
@extends('layouts.principal')
@section('titulo','Movimiento - Kardex')
@section('contenido')
<?php $PrivUsuario = $funciones->PrivUsuario();	?>
<div class=""> <!-- container -->
    

    <div class="row justify-content-center">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                	<form action="{{ route('listar.movimiento') }}" method="GET">
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
                            <label class="form-label"> Equipo</label>
                            <input class="form-control mb-4" placeholder="" type="text" name="nom_equipo" value="{{ $databusqueda->nom_equipo }}">
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
									<th>Fecha / Hora</th>
									
									<th>Material/Insumo</th>
									<th>Marca</th>
									<th>Especificación</th>
									<th>Lote/F. VENC</th>
									<th>Cantidad</th>
									<th>Stock</th>
									<th>Tipo Movimiento</th>
									<th>Atención</th>
									<th>Compra</th>
									<th>Origen</th>
									<th>Destino</th>
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
										<td>{!! fechaHoraUsuBR($fila->created_at) !!}</td>
										<td><b>{{ $fila->nom_equipo }}</b></td>
										<td>{{ $fila->marca }}</td>
										<td>{{ $fila->especificacion }}</td>
										<td>{{ $fila->lote }}<br>{{ fechaUsu($fila->fch_vencimiento) }}</td>
										<td><b>{{ signo_cant_mov($fila->cantidad_movimiento,$fila->tipo_movimiento_id) }}</b></td>
										<td><b>{{ $fila->stock_equipo_lab }}</b></td>
										<td>{{ $fila->tipo_movimiento }}</td>
										<td>@if($fila->num_atencion>0) # @endif {{ $fila->num_atencion }}</td>
										<td>{{ $fila->numdoc_sustento }}</td>
										<td>{{ $fila->laboratorio_origen }}</td>
										<td>{{ $fila->laboratorio_destino }}</td>
										<td>{{ $fila->persona_recibido }}</td>


										 
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

	function editar(id,movimiento) {
		$('#txtid').val(id);
		$('#txtmovimiento').val(movimiento);
	}

	function eliminar(id,mensaje){
		$('#id_borrar').val(id);
		$('#lblmensaje').text( mensaje);
	}
 
$(document).ready(function() {
});

</script>
@endsection
