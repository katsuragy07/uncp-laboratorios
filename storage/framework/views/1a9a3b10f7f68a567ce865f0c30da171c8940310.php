<?php $funciones = app('App\Http\Controllers\FuncionesController'); ?>
<?php
 $categoria_lab = $funciones->categoria_laboratorio(Auth::user()->laboratorio_id);
 $PrivUsuario = $funciones->PrivUsuario();	
 $userId = Auth::id();
?>
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

		<!--Sidemenu css -->
        <link href="<?php echo e(asset('zendash/assets/css/sidemenu.css')); ?>" rel="stylesheet">

		<!-- P-scroll bar css-->
		<link href="<?php echo e(asset('zendash/assets/plugins/p-scrollbar/p-scrollbar.css')); ?>" rel="stylesheet" />

		<!---Icons css-->
		<link href="<?php echo e(asset('zendash/assets/css/icons.css')); ?>" rel="stylesheet" />

		<!-- INTERNAl Select2 css -->
		<link href="<?php echo e(asset('zendash/assets/plugins/select2/select2.min.css')); ?>" rel="stylesheet" />

		<!-- INTERNAL Date Picker css -->
		<link href="<?php echo e(asset('zendash/assets/plugins/date-picker/date-picker.css')); ?>" rel="stylesheet" />

		<!-- INTERNAL Morris Charts css -->
		<link href="<?php echo e(asset('zendash/assets/plugins/morris/morris.css')); ?>" rel="stylesheet" />

		<!-- INTERNAL Data table css -->
		<link href="<?php echo e(asset('zendash/assets/plugins/datatable/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">

		<!-- INTERNAl Notifications  Css -->
		 
		<link href="<?php echo e(asset('zendash/assets/plugins/notify/css/notifIt.css')); ?>" rel="stylesheet" />

		<!-- INTERNAl Tabs css-->
		<link href="<?php echo e(asset('zendash/assets/plugins/tabs/tabs.css')); ?>" rel="stylesheet" />

		<!-- Jquery js-->
		<script src="<?php echo e(asset('zendash/assets/js/jquery-3.5.1.min.js')); ?>"></script>

<style type="text/css" media="screen">
body {
	font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
}

.table th, .table td{
	padding: 0.2rem;
}

.table th, .text-wrap table th {
	font-size: 0.8rem;
}

table {
	font-size: 0.8rem !important;
}

table td button{
	border-radius: 4px;
	cursor: pointer;
	border: 1px solid transparent;
}

.page-title{
	font-size: 20px;
}
input[type="file"]{
	height: 50px;padding: 5px;align-items: center;text-align: center;border-radius: 5px;border: dashed 1px #29327f;cursor: pointer;color: #29327f; background-color:#f6f9ff
}

.modal {
overflow-y:auto;
}
span.select2-selection--multiple[aria-expanded=true] {
border-color: blue !important;   
}

.select2-container--focus {
border: 1px solid #424e79 !important;
/* background-color: yellow !important; */
}
</style>

	</head>


	<body class="app sidebar-mini">

		<!---Global-loader-->
		<div id="global-loader" >
			<img src="<?php echo e(asset('zendash/assets/images/svgs/loader.svg')); ?>" alt="loader">
		</div>
		<!---/Global-loader-->

		<!-- Page -->
		<div class="page">
			<div class="page-main">

				<!--aside open-->
				<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
				<aside class="app-sidebar">
					<div class="app-sidebar__logo">
						<a class="header-brand" href="<?php echo e(route('home')); ?>">
							<img src="<?php echo e(asset('images/logodtt.png')); ?>" class="header-brand-img desktop-lgo" alt="Covido logo">
							<img src="<?php echo e(asset('images/logodtt.png')); ?>" class="header-brand-img dark-logo" alt="Covido logo">
							<img src="<?php echo e(asset('images/logodtt.png')); ?>" class="header-brand-img mobile-logo" alt="Covido logo">
							<img src="<?php echo e(asset('images/logodtt.png')); ?>" class="header-brand-img darkmobile-logo" alt="Covido logo">
						</a>
					</div>
					<div class="app-sidebar3">
						<div class="app-sidebar__user">
							<div class="dropdown user-pro-body text-center"> 
								<div class="user-info">
									<h5 class=" mb-0 font-weight-normal"><?php echo e(Auth::user()->nombre_usuario); ?></h5>
									<span class="text-muted app-sidebar__user-name text-sm">
										<?php echo e($funciones->Nombre_Laboratorio(Auth::user()->laboratorio_id)); ?>

									</span>
								</div>
							</div>
						</div>
						<ul class="side-menu">
							 
							<li class="slide">
								<a class="side-menu__item"   href="<?php echo e(route('home')); ?>">
									<span class="shape1"></span>
									<span class="shape2"></span>
									<svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path><path d="M22 12A10 10 0 0 0 12 2v10z"></path></svg>
									<span class="side-menu__label">Dashboard</span>
								</a>
							</li>
						<!--	<li><h3>Administracion</h3></li>-->
							
							<li class="slide">
								<a class="side-menu__item" data-toggle="slide" href="#">
								<span class="shape1"></span>
								<span class="shape2"></span>
							<svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
								<span class="side-menu__label">Gestión de Laboratorios</span><i class="angle fa fa-angle-right"></i></a>
								
								<ul class="slide-menu">
									<?php if($userId==1): ?>
										<li><a href="<?php echo e(route('listado.docgeneral')); ?>" class="slide-item">Documentos Generales</a></li>
										<li><a href="<?php echo e(route('listar.facultades')); ?>" class="slide-item">Facultad/Dependencia</a></li>
										<li><a href="<?php echo e(route('listar.laboratorios')); ?>" class="slide-item">Lista de Laboratorios</a></li>
										
									<?php else: ?>
										<li><a href="<?php echo e(route('editar.laboratorios',Auth::user()->laboratorio_id)); ?>" class="slide-item">Editar información General</a></li>
									<?php endif; ?>
									<?php if(Auth::user()->laboratorio_id!=1 or $userId==1): ?>
										<li><a href="<?php echo e(route('lista.tipo_laboratorio')); ?>" class="slide-item">Tipo de Laboratorios</a></li>
									<?php endif; ?>
										<li><a href="<?php echo e(route('listado.docespecifico')); ?>" class="slide-item">Documentos Especificos</a></li>
										<li><a href="<?php echo e(route('listado.personal')); ?>" class="slide-item">Personal Responsable</a></li>

									<?php if($funciones->existe_tipo_laboratorio(Auth::user()->laboratorio_id,1)>0 or $funciones->existe_tipo_laboratorio(Auth::user()->laboratorio_id,4)>0 or $userId==1): ?>
										<li><a href="<?php echo e(route('listado.infoacademica')); ?>" class="slide-item">Laboratorio de Enseñanza</a></li>
									<?php endif; ?>
									<?php if($funciones->existe_tipo_laboratorio(Auth::user()->laboratorio_id,2)>0 or $userId==1): ?>
										<li><a href="<?php echo e(route('listado.infoservicio')); ?>" class="slide-item">Laboratorio de Servicio</a></li>
									<?php endif; ?>
									<?php if($funciones->existe_tipo_laboratorio(Auth::user()->laboratorio_id,3)>0 or $userId==1): ?>
										<li><a href="<?php echo e(route('listado.investigacion')); ?>" class="slide-item">Laboratorio de Investigación</a></li>
									<?php endif; ?>
									

									
								</ul>
							</li>
							<li class="slide">
								<a class="side-menu__item" data-toggle="slide" href="#">
								<span class="shape1"></span>
								<span class="shape2"></span>
							<svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
								<span class="side-menu__label">Gestión de Almacenes</span><i class="angle fa fa-angle-right"></i></a>
								<ul class="slide-menu">
									<?php if($categoria_lab!=3 or $userId==1): ?>
										<li><a href="<?php echo e(route('listar.atencion')); ?>" class="slide-item">Atenciones</a></li>
									<?php endif; ?>

									<li><a href="<?php echo e(route('listar.recepcion')); ?>" class="slide-item">Recepción</a></li>

									 
										<li><a href="<?php echo e(route('listar.requerimiento')); ?>" class="slide-item">Requerimiento Lab.</a></li>
								

									<li><a href="<?php echo e(route('listar.movimiento')); ?>" class="slide-item">Movimiento - Kardex</a></li>

								</ul>
							</li>
							<li class="slide">
								<a class="side-menu__item" data-toggle="slide" href="#">
								<span class="shape1"></span>
								<span class="shape2"></span>
							<svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
								<span class="side-menu__label">Materiales y Equipos</span><i class="angle fa fa-angle-right"></i></a>
								<ul class="slide-menu">
									<li><a href="<?php echo e(route('listar.equipos')); ?>" class="slide-item">Lista de Equipos</a></li>
									<li><a href="<?php echo e(route('listar.material')); ?>" class="slide-item">Lista de Materiales</a></li>
									<li><a href="<?php echo e(route('listar.insumos')); ?>" class="slide-item">Lista de Insumos</a></li>
									<li><a href="<?php echo e(route('listar.equipo_seguridad_lab')); ?>" class="slide-item">Lista de Equipos de Seguridad</a></li>
									<li><a href="<?php echo e(route('listado_software')); ?>" class="slide-item">Lista de Software Original de Lab.</a></li>
									<li><a href="<?php echo e(route('listar.componentes')); ?>" class="slide-item">Lista de Componentes de Lab.</a></li>
								</ul>
							</li>
							<li class="slide">
								<a class="side-menu__item" data-toggle="slide" href="#">
								<span class="shape1"></span>
								<span class="shape2"></span>
							<svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
								<span class="side-menu__label">Mantenimiento</span><i class="angle fa fa-angle-right"></i></a>
								<ul class="slide-menu">
									
									<li><a href="<?php echo e(route('listar.persona')); ?>" class="slide-item">Personas</a></li>
									<li><a href="<?php echo e(route('listar.proveedor')); ?>" class="slide-item">Proveedores</a></li>
									<li><a href="<?php echo e(route('listar.cargo')); ?>" class="slide-item">Cargos</a></li>
									<li><a href="<?php echo e(route('listar.equipo_seguridad')); ?>" class="slide-item">Catálogo de equipos de seguridad</a></li>
									<li><a href="<?php echo e(route('listar.tipo_doc_equipo')); ?>" class="slide-item">Catálogo de doc. equipos</a></li>
									<li><a href="<?php echo e(route('listar.tipo_doc_especifico')); ?>" class="slide-item">Catálogo de doc. lab.</a></li>
									<li><a href="<?php echo e(route('listar.tipo_documento')); ?>" class="slide-item">Tipo doc. identidad</a></li>
									<li><a href="<?php echo e(route('listar.tipo_equipo')); ?>" class="slide-item">Tipo de equipo</a></li>
									<!--<li><a href="<?php echo e(route('listar.tipo_laboratorio')); ?>" class="slide-item">Tipo de laboratorio</a></li>-->
									<li><a href="<?php echo e(route('listar.tipo_personal')); ?>" class="slide-item">Tipo de personal</a></li>
									<li><a href="<?php echo e(route('listar.tipo_fiscalizado')); ?>" class="slide-item">Tipo de fiscalización</a></li>
									<li><a href="<?php echo e(route('listar.ubigeo')); ?>" class="slide-item">Ubigeo</a></li>
									<li><a href="<?php echo e(route('listar.tipo_movimiento')); ?>" class="slide-item">Tipo movimiento</a></li>
									<li><a href="<?php echo e(route('listar.unidad_medida')); ?>" class="slide-item">Unidad de medida</a></li>
									<li><a href="<?php echo e(route('listar.periodo')); ?>" class="slide-item">Semestre académico</a></li>
									<li><a href="<?php echo e(route('listar.asignatura')); ?>" class="slide-item">Asignaturas</a></li>
								</ul>
							</li>

							<li class="slide">
								<a class="side-menu__item" data-toggle="slide" href="#">
								<span class="shape1"></span>
								<span class="shape2"></span>
							<svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>

								<span class="side-menu__label">Reportes</span><i class="angle fa fa-angle-right"></i></a>
								<ul class="slide-menu">
									

									<li><a href="<?php echo e(route('pdf.adeudo_material')); ?>" target="_blank" class="slide-item">Lista de adeudo</a></li>

								</ul>
							</li>

							<?php if($userId==1): ?>
								<li class="slide">
									<a class="side-menu__item" data-toggle="slide" href="#">
									<span class="shape1"></span>
									<span class="shape2"></span>
								<svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
									<span class="side-menu__label">Usuarios</span><i class="angle fa fa-angle-right"></i></a>
									<ul class="slide-menu">
										<li><a href="<?php echo e(route('listar.usuarios')); ?>" class="slide-item">Lista de usuarios</a></li>
									</ul>
								</li>
							<?php endif; ?>

							<li class="slide">
								<a class="side-menu__item"   href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

									<span class="shape1"></span>
									<span class="shape2"></span>
									&nbsp;&nbsp;&nbsp;&nbsp;
									<i class="dropdown-icon mdi  mdi-logout-variant"></i>
									<span class="side-menu__label">Salir</span>
								</a>
							</li>

 

					 

						</ul>
					</div>
				</aside>
				<!--aside closed-->

				<div class="app-content">
					<div class="side-app">

						<!--app header-->
						<div class="app-header header">
							<div class="container-fluid">
								<div class="d-flex">
									<a class="header-brand" href="index.html">
										<img src="<?php echo e(asset('images/logodtt.png')); ?>" class="header-brand-img desktop-lgo" alt="Zendashlogo">
										<img src="<?php echo e(asset('images/logodtt.png')); ?>" class="header-brand-img dark-logo" alt="Zendashlogo">
										<img src="<?php echo e(asset('images/logodtt.png')); ?>" class="header-brand-img mobile-logo" alt="Zendashlogo">
										<img src="<?php echo e(asset('images/logodtt.png')); ?>" class="header-brand-img darkmobile-logo" alt="Zendashlogo">
									</a>
									<div class="app-sidebar__toggle" data-toggle="sidebar">
										<a class="open-toggle" href="#">
											<svg class="header-icon mt-1" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M21 11.01L3 11v2h18zM3 16h12v2H3zM21 6H3v2.01L21 8z"></path></svg>
										</a>
									</div>
									<div class="mt-1">
										 
									</div> 
									<div class="d-flex order-lg-2 ml-auto">
										<a href="#" data-toggle="search" class="nav-link nav-link-lg d-md-none navsearch">
											<svg class="header-icon search-icon" x="1008" y="1248" viewBox="0 0 24 24"  height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
												<path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
											</svg>
										</a>
										<div class="dropdown header-message"  style="display: none">
											 <!-- Mensajes -->
										</div>
										<div class="dropdown header-notify" style="display: none">
											 <!-- Notificaciones -->
										</div>
										<div class="dropdown   header-fullscreen" >
											<a  class="nav-link icon full-screen-link p-0"  id="fullscreen-button">
												<svg class="header-icon" x="1008" y="1248" viewBox="0 0 24 24"  height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false"><path d="M7,14 L5,14 L5,19 L10,19 L10,17 L7,17 L7,14 Z M5,10 L7,10 L7,7 L10,7 L10,5 L5,5 L5,10 Z M17,17 L14,17 L14,19 L19,19 L19,14 L17,14 L17,17 Z M14,5 L14,7 L17,7 L17,10 L19,10 L19,5 L14,5 Z"></path></svg>
											</a>
										</div>
										<div class="dropdown profile-dropdown">
											<a href="#" class="nav-link pr-0 pl-2 leading-none" data-toggle="dropdown">
												<span>
													<img src="<?php echo e(asset('images/logouncp.png')); ?>" alt="img" class="avatar avatar-md brround">
												</span>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow animated p-0">
												<div class="text-center border-bottom pb-4 pt-4">
													<a href="#" class="text-center user pb-0 font-weight-bold">
														<?php echo e(Auth::user()->nombre_usuario); ?>

													</a>
													<p class="text-center user-semi-title mb-0">
														<?php echo e($funciones->Nombre_Laboratorio(Auth::user()->laboratorio_id)); ?>

													</p>
												</div>
												<!--<a class="dropdown-item border-bottom" href="#">
													<i class="dropdown-icon mdi mdi-account-outline"></i> Mi Perfil
												</a> -->
												<a class="dropdown-item border-bottom" href="<?php echo e(route('cambiar.clave')); ?>">
													<i class="dropdown-icon  mdi mdi-settings"></i> Cambiar clave
												</a> 
												
												<a class="dropdown-item border-bottom" target="_blank" href="<?php echo e(url('files/docgeneral/Manual de Usuario - Laboratorio.pdf')); ?>">
													<i class="dropdown-icon mdi mdi-compass-outline"></i> Manual de usuario
												</a>
												<a class="dropdown-item border-bottom" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
													<i class="dropdown-icon mdi  mdi-logout-variant"></i> Salir
												</a>
			                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
			                                        <?php echo csrf_field(); ?>
			                                    </form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--/app header-->

						<h4 class="page-title"><?php echo $__env->yieldContent('titulo',''); ?></h4>
						<hr class="m-1">

						<!-- Contenido Dinámico -->
						<?php echo $__env->yieldContent('contenido'); ?>
						<!-- Contenido Dinámico -->
						<div id="div_mantPersona">
						</div>
						<div id="div_OptionPersona" style="display: none;"></div>

					</div>
				</div><!-- end app-content-->
			</div>

			<!--Footer-->
			<footer class="footer">
				<div class="container">
					<div class="row align-items-center flex-row-reverse">
						<div class="col-md-12 col-sm-12 mt-3 mt-lg-0 text-center">
							Copyright © 2021 <a href="#"> - UNIDAD DE LABORATORIO</a>. Desarrollado por <a href="#"> .. </a> Todos los derechos reservados.
						</div>
					</div>
				</div>
			</footer>
			<!-- End Footer-->

		</div>

		<!-- Back to top -->
		<a href="#top" id="back-to-top"><i class="fe fe-arrow-up"></i></a>



		<!-- Bootstrap4 js-->
		<script src="<?php echo e(asset('zendash/assets/plugins/bootstrap/popper.min.js')); ?>"></script>
		<script src="<?php echo e(asset('zendash/assets/plugins/bootstrap/js/bootstrap.min.js')); ?>"></script>

		<!--Othercharts js-->
		<script src="<?php echo e(asset('zendash/assets/plugins/othercharts/jquery.sparkline.min.js')); ?>"></script>

		<!-- Circle-progress js-->
		<script src="<?php echo e(asset('zendash/assets/js/circle-progress.min.js')); ?>"></script>

		<!-- Jquery-rating js-->
		<script src="<?php echo e(asset('zendash/assets/plugins/rating/jquery.rating-stars.js')); ?>"></script>

		<!--Sidemenu js-->
		<script src="<?php echo e(asset('zendash/assets/plugins/sidemenu/sidemenu.js')); ?>"></script>

		<!-- P-scroll js-->
		<script src="<?php echo e(asset('zendash/assets/plugins/p-scrollbar/p-scrollbar.js')); ?>"></script>
		<script src="<?php echo e(asset('zendash/assets/plugins/p-scrollbar/p-scroll1.js')); ?>"></script>


		<!--INTERNAL Select2 js -->
		<script src="<?php echo e(asset('zendash/assets/plugins/select2/select2.full.min.js')); ?>"></script>
		<script src="<?php echo e(asset('zendash/assets/js/select2.js')); ?>"></script>

		<!-- Timepicker js -->
		<script src="<?php echo e(asset('zendash/assets/plugins/time-picker/jquery.timepicker.js')); ?>"></script>
		<script src="<?php echo e(asset('zendash/assets/plugins/time-picker/toggles.min.js')); ?>"></script>

		<!-- Datepicker js -->
		<script src="<?php echo e(asset('zendash/assets/plugins/date-picker/date-picker.js')); ?>"></script>
		<script src="<?php echo e(asset('zendash/assets/plugins/date-picker/jquery-ui.js')); ?>"></script>
		<script src="<?php echo e(asset('zendash/assets/plugins/input-mask/jquery.maskedinput.js')); ?>"></script>

		<!-- INTERNAL ECharts js -->
		<script src="<?php echo e(asset('zendash/assets/plugins/echarts/echarts.js')); ?>"></script>

		<!-- Peitychart js-->
		<script src="<?php echo e(asset('zendash/assets/plugins/peitychart/jquery.peity.min.js')); ?>"></script>
		<script src="<?php echo e(asset('zendash/assets/plugins/peitychart/peitychart.init.js')); ?>"></script>

		<!--INTERNAL  Apexchart js-->
		<script src="<?php echo e(asset('zendash/assets/js/apexcharts.js')); ?>"></script>

		<!--Moment js-->
		<script src="<?php echo e(asset('zendash/assets/plugins/moment/moment.js')); ?>"></script>

		<!-- INTERNAL Data tables js-->
		<script src="<?php echo e(asset('zendash/assets/plugins/datatable/js/jquery.dataTables.js')); ?>"></script>
		<script src="<?php echo e(asset('zendash/assets/plugins/datatable/js/dataTables.bootstrap4.js')); ?>"></script>
		<script src="<?php echo e(asset('zendash/assets/plugins/datatable/dataTables.responsive.min.js')); ?>"></script>
		<script src="<?php echo e(asset('zendash/assets/plugins/datatable/responsive.bootstrap4.min.js')); ?>"></script>


		<!--INTERNAL Morris Charts js -->
		<script src="<?php echo e(asset('zendash/assets/plugins/morris/raphael-min.js')); ?>"></script>
		<script src="<?php echo e(asset('zendash/assets/plugins/morris/morris.js')); ?>"></script>

		<!--INTERNAL Chart js -->
		<script src="<?php echo e(asset('zendash/assets/plugins/chart/chart.bundle.js')); ?>"></script>
		<script src="<?php echo e(asset('zendash/assets/plugins/chart/custom-chart.js')); ?>"></script>

		<!-- INTERNAL Index js-->
		<script src="<?php echo e(asset('zendash/assets/js/index1-dark.js')); ?>"></script>


		<!-- Form Advanced Element -->
		<!--<script src="<?php echo e(asset('zendash/assets/js/formelementadvnced.js')); ?>"></script>-->
		<script src="<?php echo e(asset('zendash/assets/js/form-elements.js')); ?>"></script>

		<!-- INTERNAl Notifications js -->
		
		<script src="<?php echo e(asset('zendash/assets/plugins/notify/js/notifIt.js')); ?>"></script>
		
		<!--- INTERNAl Tabs js-->
		<script src="<?php echo e(asset('zendash/assets/plugins/tabs/jquery.multipurpose_tabcontent.js')); ?>"></script>
		<script src="<?php echo e(asset('zendash/assets/js/tabs.js')); ?>"></script>

		<!-- Loader js-->
		<script src="<?php echo e(asset('zendash/assets/js/loader.js')); ?>"></script>

		<!-- Custom js-->
		<script src="<?php echo e(asset('zendash/assets/js/custom.js')); ?>"></script>

		<script src="<?php echo e(asset('assets/js/jquery.form.js')); ?>"></script>

		<script>
 
 //Consultas Ajax para select2
  function recargarAjaxProdLab(){
	$('.select2AjaxProductoLab').select2({
		placeholder: "Buscar por nombre, marca , etc",
		minimumInputLength: 2,
		ajax: {
		  url: '<?php echo e(route('ajax.producto_laboratorio_select2')); ?>',
		  data: function (params) {
			return {
				consulta: params.term,
				laboratorio_id: $("#b_laboratorio_id").val(),
				tipo_equipo_id: $("#b_tipo_equipo_id").val()
			};
		},
		  dataType: 'json', 
		  delay: 300,
		  processResults: function (data) {
			return {
			  results: data
			};
		  },
		  cache: true
		}
	});
  }

  function recargarAjaxUbigeo(){
	  $('.select2AjaxUbigeo').select2({
	placeholder: "Buscar Ubigeo",
	minimumInputLength: 3,
	ajax: {
	  url: '<?php echo e(route('ajax.ubigeo_select2')); ?>',
	  dataType: 'json', 
	  delay: 300,
	  processResults: function (data) {
		return {
		  results: data
		};
	  },
	  cache: true
	}
  });
  }


  function recargarAjaxPersona(){
	  $('.select2AjaxPersona').select2({
			placeholder: "Buscar Persona",
			dropdownParent: $('#modal_mante .modal-content'),

			minimumInputLength: 3,
			ajax: {
			  url: '<?php echo e(route('ajax.persona_select2')); ?>',
			  dataType: 'json', 
			  delay: 300,
			  processResults: function (data) {
				return {
				  results: data
				};
			  },
			  cache: true
			}
		  }); 
  }

	function elimfile(idimput){
	$( "#"+idimput ).val('');
	$( "."+idimput ).addClass('d-none');
}
	</script>
	</body>
</html><?php /**PATH C:\wamp64\www\sistemauncp\laboratorio\resources\views/layouts/principal.blade.php ENDPATH**/ ?>