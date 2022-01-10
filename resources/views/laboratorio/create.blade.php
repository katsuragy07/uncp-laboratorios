@inject('lstfacultad','App\Models\Facultad')
@extends('layouts.principal')
@section('titulo','Nuevo Registro')
@section('contenido')
<form class="needs-validation was-validated" action="{{ route('guardar.laboratorios') }}" method="GET">
@csrf
	<div class="row row-sm">
		<div class="col-lg-6">

		
	
			 <div class="form-group"> 
			 <label for="size_2">Código Sunedu:&nbsp;&nbsp;&nbsp;</label>
				<input class="form-control  mb-4 is-valid state-valid" name="cod_sunedu" id="cod_sunedu" placeholder="Codigo Sunedu" required="" type="text"  value="">

				<label for="size_2">Nombre de Laboratorio:&nbsp;&nbsp;&nbsp;</label>
				<textarea class="form-control mb-4 is-valid state-valid" name="nombre_lab" id="nombre_lab" placeholder="Nombre de Laboratorio" required="" rows="2"></textarea>

				<label for="size_2">Facultad:&nbsp;&nbsp;&nbsp;</label>				
						<select name="facultad_id" required="" class="form-control mb-4 is-valid state-valid" id="facultad_id">
							<option value="">Seleccione Facultad...</option>
											@foreach($lstfacultad::orderby('nom_facultad','ASC')->get() as $facultad)
											<option value="{{ $facultad->id }}">{{ $facultad->nom_facultad }}</option>
											@endforeach
						</select>


			
				<label for="size_2">Tipo:&nbsp;&nbsp;&nbsp;</label>
				<select name="categoria_lab" required="" class="form-control" id="categoria_lab">
					<option value="">-------Seleccione...........</option>
					<option value="2">Almacén de Laboratorio</option>
					<option value="3">Laboratorio / Taller / Otros</option>
					
				</select> 
				<br>

				<label for="size_2">Descripción de Laboratorio:&nbsp;&nbsp;&nbsp;</label>
				<textarea class="form-control mb-4 is-valid state-valid"  name="decripcion_lab" id="decripcion_lab" placeholder="Descripcion"  rows="3"></textarea>


				

						
				<label for="size_2">Que servicios brinda para la enseñanza?:&nbsp;&nbsp;&nbsp;</label>
				<textarea class="form-control mb-4 is-valid state-valid" name="tipos_de_ensenanza" id="tipos_de_ensenanza" placeholder="Que servicios brinda para la enseñanza?"  rows="5"></textarea>

				<label for="size_2">Ubicación:&nbsp;&nbsp;&nbsp;</label>
				<textarea class="form-control mb-4 is-valid state-valid" required="" name="ubicacion" id="ubicacion" placeholder="Ubicación de Laboratorio"  rows="3"></textarea>




						
												

			</div>
		</div>
												
		<div class="col-lg-6">								
		 <div class="form-group">
			
				<label for="size_2">Observaciones:&nbsp;&nbsp;&nbsp;</label>	
				<textarea class="form-control mb-4 is-valid state-valid" name="observaciones_lab" id="observaciones_lab" placeholder="Observaciones"  rows="5"></textarea>



			<label for="size_2">Pabellón:&nbsp;&nbsp;&nbsp;</label>
			<input class="form-control  mb-4 is-valid state-valid" required="" name="pabellon" id="pabellon" placeholder="Pabellón" type="text"  value="">

			<label for="size_2">Numero de Aula:&nbsp;&nbsp;&nbsp;</label>
			<input class="form-control  mb-4 is-valid state-valid" required="" name="num_aula" id="num_aula" placeholder="Numero de Aula" type="text"  value="">

			<label for="size_2">Piso:&nbsp;&nbsp;&nbsp;</label>
			<input class="form-control  mb-4 is-valid state-valid" required="" name="piso" id="piso" placeholder="Piso" type="text"  value="">

			<label for="size_2">Aforo:&nbsp;&nbsp;&nbsp;</label>
			<input class="form-control  mb-4 is-valid state-valid" required="" name="aforo" id="aforo" placeholder="Aforo" type="number"  value="">

			<label for="size_2">Area Total m2:&nbsp;&nbsp;&nbsp;</label>
			<input class="form-control mb-4 is-invalid state-invalid" required="" name="area_total" id="area_total" placeholder="Area Total" type="text">

			<label for="size_2">Area Libre m2:&nbsp;&nbsp;&nbsp;</label>
				<input class="form-control mb-4 is-invalid state-invalid"  name="area_libre" id="area_libre" placeholder="Area Libre" type="text">
			
			<label for="size_2">Area Ocupada m2:&nbsp;&nbsp;&nbsp;</label>
			<input class="form-control mb-4 is-invalid state-invalid" name="area_ocupada" id="area_ocupada" placeholder="Area Ocupada" type="text">

				

			</div>
		</div>
	</div>


	<br>										
	<div class="form-group">
		<a href=""> <button class="btn btn-primary" type="submit"> Guardar </button></a>
		<input type="reset" class="btn btn-warning" value="Limpiar">
		<a class="btn btn-danger " href="javascript:history.back()">Atrás</a>

	</div>	
	
	
 </form>   <!-- fin Form-->


<script>
	


$(document).ready(function() {
	

});

</script>
@endsection
