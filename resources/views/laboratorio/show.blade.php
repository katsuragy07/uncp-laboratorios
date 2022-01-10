@inject('lstfacultad','App\Models\Facultad')
@extends('layouts.principal')
@section('titulo','Detalle del Registro')
@section('contenido')

<form class="needs-validation was-validated" action="{{ route('update.laboratorios',$laboratorios->id) }}" method="POST">
@csrf

<div class="row row-sm">
		<div class="col-lg-6">

		
	
			 <div class="form-group"> 
				<input class="form-control  mb-4 is-valid state-valid" name="cod_sunedu" id="cod_sunedu" placeholder="Codigo Sunedu" required="" type="text"  value="{{$laboratorios->cod_sunedu }}">
				<textarea class="form-control mb-4 is-valid state-valid" name="nombre_lab" id="nombre_lab" placeholder="Nombre de Laboratorio" required="" rows="3">{{$laboratorios->nombre_lab}}</textarea>
				<textarea class="form-control mb-4 is-valid state-valid" name="decripcion_lab" id="decripcion_lab" placeholder="Descripcion"  rows="5">{{$laboratorios->decripcion_lab}}</textarea>

						<select name="facultad_id" required="" class="form-control mb-4 is-valid state-valid" id="facultad_id">
						@foreach($lstfacultad::orderby('nom_facultad','ASC')->get() as $facultad)
						<option @if($facultad->id == $laboratorios->facultad_id) selected @endif value="{{ $facultad->id }}">{{ $facultad->nom_facultad }}</option>
						@endforeach
						</select>

				<input class="form-control  mb-4 is-valid state-valid" name="pabellon" id="pabellon" placeholder="Pabellon" type="text"  value="{{$laboratorios->pabellon }}">
				<input class="form-control  mb-4 is-valid state-valid" name="num_aula" id="num_aula" placeholder="Numero de Aula" type="text"  value="{{$laboratorios->num_aula }}">
				<input class="form-control  mb-4 is-valid state-valid" name="piso" id="piso" placeholder="Piso" type="text"  value="{{$laboratorios->piso }}">
				<input class="form-control  mb-4 is-valid state-valid" name="aforo" id="aforo" placeholder="Aforo" type="number"  value="{{$laboratorios->aforo }}">
				<input class="form-control mb-4 is-invalid state-invalid" name="area_total" id="area_total" placeholder="Area Total" type="text" value="{{$laboratorios->area_total }}">
				<input class="form-control mb-4 is-invalid state-invalid" name="area_libre" id="area_libre" placeholder="Area Libre" type="text" value="{{$laboratorios->area_libre }}">
				<input class="form-control mb-4 is-invalid state-invalid" name="area_ocupada" id="area_ocupada" placeholder="Area Ocupada" type="text" value="{{$laboratorios->area_ocupada }}">

				

						
												

			</div>
		</div>
												
		<div class="col-lg-6">								
			<div class="form-group">
				 <label for="size_2">Foto del Laboratorio:&nbsp;&nbsp;&nbsp;</label>
				<input class="form-control mb-4 is-invalid state-invalid" name="foto_laboratorio" id="foto_laboratorio" placeholder="Fotografia" type="file">

				<label for="size_2">Organigrama del Laboratorio:&nbsp;&nbsp;&nbsp;</label>
				<input class="form-control mb-4 is-invalid state-invalid" name="organigrama" id="organigrama" placeholder="Organigrama" type="file">

				<label for="size_2">Resolucion de Creacion del Laboratorio:&nbsp;&nbsp;&nbsp;</label>
				<input class="form-control mb-4 is-invalid state-invalid" name="resolucion_creacion" id="resolucion_creacion" placeholder="Resolucion" type="file">

				<label for="size_2">Horario de Atencion del Laboratorio (.pdf) Descargar archivo:&nbsp;&nbsp;&nbsp;</label>
				<input class="form-control mb-4 is-invalid state-invalid" accept=".pdf" name="horario_atencion" id="horario_atencion" placeholder="Horario de Atencion" type="file">
 <br>
			 <br>

			<label for="size_2">¿Cuenta con Internet?:&nbsp;&nbsp;&nbsp;</label>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			 <input class="form-check-input settings"type="checkbox" name="flg_internet" value="1"<?php echo ($laboratorios->flg_internet == 1 ? ' checked' : '')?> id="flg_internet">
<br>
			 <label for="size_2">¿Cuenta con Tacho de Residous Solidos Peligroso?:&nbsp;&nbsp;&nbsp;</label>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			 <input class="form-check-input settings"type="checkbox" name="flg_tacho_peligroso" value="1"<?php echo ($laboratorios->flg_tacho_peligroso == 1 ? ' checked' : '')?> id="flg_tacho_peligroso">


			 <label for="size_2">¿Cuenta con Tacho de Residous Solidos Biocontaminante?:&nbsp;&nbsp;&nbsp;</label>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			 <input class="form-check-input settings"type="checkbox" name="flg_tacho_biocont" value="1"<?php echo ($laboratorios->flg_tacho_biocont == 1 ? ' checked' : '')?> id="flg_tacho_biocont">

			 <label for="size_2">¿Cuenta con Recipiente de Residous liquido?:&nbsp;&nbsp;&nbsp;</label>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			 <input class="form-check-input settings"type="checkbox" name="flg_recipiente_rl" value="1"<?php echo ($laboratorios->flg_recipiente_rl == 1 ? ' checked' : '')?> id="flg_recipiente_rl">
			
			

			</div>
		</div>
	</div>
											
	<div class="form-group">
		<a href=""> <button class="btn btn-primary" type="submit"> Grabar </button></a>
		<input type="reset" class="btn btn-sm btn-warning" value="Limpiar">
		<a class="btn-danger" href="javascript:history.back()">Retornar</a>

	</div>	
	
	
 </form>   <!-- fin Form-->
	   
	<div class="card-body p-60">
		<div class="panel panel-primary">
											<div class=" tab-menu-heading p-0 bg-light">
												<div class="tabs-menu1 ">
													<!-- Tabs -->
													<ul class="nav panel-tabs">
														<li class=""><a href="#tab5" class="" data-toggle="tab">Horario de Uso</a></li>
														<li><a href="#tab6" data-toggle="tab" class="">Personal Respponsable</a></li>
														<li><a href="#tab7" data-toggle="tab" class="active">Tipo de Laboratorio</a></li>
														<li><a href="#tab8" data-toggle="tab" class="">Software</a></li>
													</ul>
												</div>
											</div>
											<div class="panel-body tabs-menu-body">
												<div class="tab-content">
													<div class="tab-pane" id="tab5">
														<p>Horario de Uso del Laboratorio:</p>
														<div class="card">
														<div class="card-body">
														<div class="table-responsive">
														<table class="table table-hover card-table table-vcenter text-nowrap mb-0">
															<thead>
																<tr>
																	<th>#</th>
																	<th>Laboratorio</th>
																	<th>Nombre</th>
																	<th>Archivo</th>
																	<th>Opciones</th>
																</tr>
															</thead>
															<tbody>
															 <?php //var_dump($datos); 
															 $i = 0;
															 ?>
															 @foreach($horario_archivo  as $horario)
																<?php $i++;  ?>
																	<tr>
																		<td>{{ $i }}</td>
																		<td>{{ $horario->nombre }}</td>
																		<td>{{ $horario->archivo }}</td>
																		<td>{{ $horario->laboratorio_id }}</td>
																		
																		
																		
																		<td>
											
																			
																			<a href="#" class="btn btn-sm btn-primary"> <i class="glyphicon glyphicon-list-alt"></i> </a>

															
																			<a href="#" class="btn-info"> <i class="glyphicon glyphicon-edit"></i> </a>


																			

																		</td> 
																	</tr>									
																@endforeach
															</tbody>
														</table>
														</div>
														</div>
														</div>
														
													</div>
													<div class="tab-pane" id="tab6">
														<p> default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like</p>
														<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et</p>
													</div>
													<div class="tab-pane active" id="tab7">
														<p>over the years, sometimes by accident, sometimes on purpose (injected humour and the like</p>
														<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et</p>
													</div>
													<div class="tab-pane" id="tab8">
														<p>page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like</p>
														<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et</p>
													</div>
												</div>
											</div>
		</div>
	</div>									
<br>
@endsection



 