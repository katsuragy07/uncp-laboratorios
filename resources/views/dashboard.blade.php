@extends('layouts.principal')
@section('contenido')
<div class="container">
    <div class="row justify-content-center">
         			<div class="col-sm-12 col-lg-4">
						<div class="card">
							<div class="card-body text-center list-icons">
								<i class="mdi mdi-file-outline card-custom-icon icon-dropshadow-primary text-primary fs-60"></i>
								<p class="card-text mt-3 mb-0">Cantidad de <br>Documentos</p>
								<p class="h2 text-center font-weight-bold">{{ $cantDoc->cantidaddoc }}</p>
							</div>
						</div>
					</div>

					<div class="col-sm-12 col-lg-4"> 
						<div class="card"> 
							<div class="card-body"> 
								<i class="mdi mdi-account-multiple-outline card-custom-icon icon-dropshadow-secondary text-secondary fs-60"></i>
								 <p class=" mb-1">Cantidad de <br>Personales</p>
								 <h2 class="mb-1 font-weight-bold">{{ $cantPersonal->cantidadpersonal }}</h2> <span class="mb-1 text-muted"> </div> </div> </div>

					<div class="col-xl-4 col-lg-4 col-md-12"> <div class="card"> <div class="card-body"> <svg class="card-custom-icon text-success icon-dropshadow-success" x="1008" y="1248" viewBox="0 0 24 24" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false"> <path opacity=".0" d="M3.31,11 L5.51,19.01 L18.5,19 L20.7,11 L3.31,11 Z M12,17 C10.9,17 10,16.1 10,15 C10,13.9 10.9,13 12,13 C13.1,13 14,13.9 14,15 C14,16.1 13.1,17 12,17 Z"></path> <path d="M22,9 L17.21,9 L12.83,2.44 C12.64,2.16 12.32,2.02 12,2.02 C11.68,2.02 11.36,2.16 11.17,2.45 L6.79,9 L2,9 C1.45,9 1,9.45 1,10 C1,10.09 1.01,10.18 1.04,10.27 L3.58,19.54 C3.81,20.38 4.58,21 5.5,21 L18.5,21 C19.42,21 20.19,20.38 20.43,19.54 L22.97,10.27 L23,10 C23,9.45 22.55,9 22,9 Z M12,4.8 L14.8,9 L9.2,9 L12,4.8 Z M18.5,19 L5.51,19.01 L3.31,11 L20.7,11 L18.5,19 Z M12,13 C10.9,13 10,13.9 10,15 C10,16.1 10.9,17 12,17 C13.1,17 14,16.1 14,15 C14,13.9 13.1,13 12,13 Z"></path> </svg> <p class=" mb-1 ">Equipos</p><h2 class="mb-1 font-weight-bold">{{ $cantEquipo->cantidadequipo }}</h2> <div class="progress progress-sm mt-3 bg-success-transparent"> <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" style="width: 78%"></div> </div> </div> </div> </div>
    </div>
</div>
@endsection
