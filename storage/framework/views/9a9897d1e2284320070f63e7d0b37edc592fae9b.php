<?php $funciones = app('App\Http\Controllers\FuncionesController'); ?>
<!DOCTYPE html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN"
  "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" version="XHTML+RDFa 1.0" dir="ltr"
  xmlns:content="http://purl.org/rss/1.0/modules/content/"
  xmlns:dc="http://purl.org/dc/terms/"
  xmlns:foaf="http://xmlns.com/foaf/0.1/"
  xmlns:og="http://ogp.me/ns#"
  xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#"
  xmlns:sioc="http://rdfs.org/sioc/ns#"
  xmlns:sioct="http://rdfs.org/sioc/types#"
  xmlns:skos="http://www.w3.org/2004/02/skos/core#"
  xmlns:xsd="http://www.w3.org/2001/XMLSchema#">
	<head profile="http://www.w3.org/1999/xhtml/vocab">
		<!-- Meta data -->
  		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta content="Sistema de Gestión de Laboratorios" name="description">
		<meta content="UNCP" name="author">
		
		<!-- CSRF Token -->
    	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

		<!-- Title -->
		<title>UNILAB - UNCP </title>

		<!--Favicon -->
		<link rel="icon" href="<?php echo e(asset('images/logouncp.png')); ?>" type="image/x-icon"/>
		<!-- Bootstrap css -->
		<link href="<?php echo e(asset('zendash/assets/plugins/bootstrap/css/bootstrap.css')); ?>" rel="stylesheet" />

		<!-- Style css -->
		<link href="<?php echo e(asset('zendash/assets/css/style.css')); ?>" rel="stylesheet" />

		<!-- Dark css -->
		<link href="<?php echo e(asset('zendash/assets/css/dark.css')); ?>" rel="stylesheet" />

		<!-- Skins css -->
		<link href="<?php echo e(asset('zendash/assets/css/skins.css')); ?>" rel="stylesheet" />

		<!-- Animate css -->
		<link href="<?php echo e(asset('zendash/assets/css/animated.css')); ?>" rel="stylesheet" />

		<!---Icons css-->
		<link href="<?php echo e(asset('zendash/assets/css/icons.css')); ?>" rel="stylesheet" />

	</head>

	<body class="h-100vh page-style1">


		<div class="page">
			<div class="page-single">
				<div class="container">
					<div class="row">
						<div class="col mx-auto">
							<div class="row justify-content-center">
								<div class="col-md-7 col-lg-4">
									<div class="error-logo">
										<a href="#"><img src="<?php echo e(asset('images/logodtt.png')); ?>" class="header-brand-img" alt="logo"></a>
									</div>
									<div class="card">
									<div class="card-body">
										<form class="form-horizontal" action="<?php echo e(route('actualizar.clave')); ?>" method="POST">
					<?php echo csrf_field(); ?>
											<div class="text-center  mb-6">
												<h2 class="mb-2">Cambiar Clave</h2>
											</div>
											<div class="form-group">
												<label class="form-label text-muted font-weight-normal">Facultad</label>
												<input type="text" class="form-control" disabled="" value="<?php echo e($funciones->Nombre_Facultad(Auth::user()->laboratorio_id)); ?>">


											</div>
											<div class="form-group">
												<label class="form-label text-muted font-weight-normal">Laboratorio</label>
												<input type="text" class="form-control" disabled name="username" value="<?php echo e($funciones->Nombre_Laboratorio(Auth::user()->laboratorio_id)); ?>">
											</div>
											<div class="form-group">
												<label class="form-label text-muted font-weight-normal"><b>Nombres y Apellidos</b></label>
												<input type="text" required="" minlength="6" class="form-control" name="nombre_usuario" value="<?php echo e($info->nombre_usuario); ?>">
											</div>

											<div class="form-group">
												<label class="form-label text-muted font-weight-normal">Usuario</label>
												<input type="text" class="form-control" disabled="" name="username" value="<?php echo e($info->username); ?>">
											</div>

											<div class="form-group">
												<label class="form-label text-muted font-weight-normal"><b>Clave (Min. 6 caracteres)</b></label>
												<input type="password" autofocus="" required="" minlength="6" class="form-control" name="password" value="">
											</div>
											<div class="form-group">
												<label class="form-label text-muted font-weight-normal"><b>Repetir Clave</b></label>
												<input type="password" required="" minlength="6" class="form-control" name="repet_password" value="">
												<span class="" style="color: red">
													<?php if(@$mensaje!=''): ?>
														No coinciden las claves, intente nuevamente
													<?php endif; ?>
												</span>
											</div>
											
											<div class="row">
												<div class="col-12 mt-5">
													<button type="submit" class="btn btn-lg btn-primary btn-block">Actualizar clave - Ingresar</button>

													<a  href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-formx').submit();" class="btn btn-lg btn-default btn-block">Salir</a>
												</div>

											</div>
										</form>
										</div>
										</div>
									</div>
								 
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<form id="logout-formx" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
			                                        <?php echo csrf_field(); ?>
			                                    </form>

		<!-- Jquery js-->
		
		<script src="<?php echo e(asset('zendash/assets/js/jquery-3.5.1.min.js')); ?>"></script>

		<!-- Bootstrap4 js-->
		<script src="../../assets/plugins/bootstrap/popper.min.js"></script>
		<script src="../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

		<!--Othercharts js-->
		<script src="../../assets/plugins/othercharts/jquery.sparkline.min.js"></script>

		<!-- Circle-progress js-->
		<script src="../../assets/js/circle-progress.min.js"></script>

		<!-- Loader js-->
		<script src="../../assets/js/loader.js"></script>

		<!-- Jquery-rating js-->
		<script src="../../assets/plugins/rating/jquery.rating-stars.js"></script>

	</body>
</html>
<?php /**PATH C:\wamp64\www\sistemauncp\laboratorio\resources\views/usuarios/cambiar_clave.blade.php ENDPATH**/ ?>