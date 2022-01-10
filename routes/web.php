<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/plantilla', [App\Http\Controllers\HomeController::class, 'plantilla'])->name('plantilla');


// usuarios
Route::get('/cambiar_clave', [App\Http\Controllers\UsuariosController::class, 'cambiar_clave'])->name('cambiar.clave');
Route::post('/actualizar_clave', [App\Http\Controllers\UsuariosController::class, 'actualizar_clave'])->name('actualizar.clave');
Route::get('/usuarios', [App\Http\Controllers\UsuariosController::class, 'index'])->name('listar.usuarios');
Route::post('/guardar_usuarios', [App\Http\Controllers\UsuariosController::class, 'store'])->name('guardar.usuario');
Route::post('/borrar_usuarios', [App\Http\Controllers\UsuariosController::class, 'destroy'])->name('borrar.usuario');
Route::post('/guardar_permisos', [App\Http\Controllers\UsuariosController::class, 'permisos'])->name('guardar.permisos');
	/* --------- ajax con metodo get ---------- */
Route::get('/ajax/ver_permisos', [App\Http\Controllers\UsuariosController::class, 'verpermisos'])->name('ver.permisos');

/*Equipos*/
Route::get('/equipos', [App\Http\Controllers\EquipoController::class, 'lista_equipos'])->name('listar.equipos');
Route::get('/mant_equipo', [App\Http\Controllers\EquipoController::class, 'modal_form_equipos'])->name('mant.equipo');
Route::post('/guardar_equipo', [App\Http\Controllers\EquipoController::class, 'store'])->name('guardar.equipo');
Route::post('/borrar_equipo', [App\Http\Controllers\EquipoController::class, 'destroy'])->name('borrar.equipo');

Route::get('/materiales', [App\Http\Controllers\EquipoController::class, 'lista_material'])->name('listar.material');
Route::get('/mant_material', [App\Http\Controllers\EquipoController::class, 'modal_form_material'])->name('mant.material');

Route::get('/insumos', [App\Http\Controllers\EquipoController::class, 'lista_insumos'])->name('listar.insumos');
Route::get('/mant_insumo', [App\Http\Controllers\EquipoController::class, 'modal_form_insumos'])->name('mant.insumo');
Route::get('/mant_stock_insumo', [App\Http\Controllers\EquipoController::class, 'modal_form_stock_insumos'])->name('mant.stock_insumo');
Route::post('/guardar_stock_insumo', [App\Http\Controllers\EquipoController::class, 'guardar_stock_insumos'])->name('guardar.stock_insumo');
Route::get('/mant_agregar_insumo_lab', [App\Http\Controllers\EquipoController::class, 'modal_form_agregar_insumo_lab'])->name('mant.agregar_insumo_lab');
Route::post('/guardar_insumo_laboratorio', [App\Http\Controllers\EquipoController::class, 'guardar_insumo_laboratorio'])->name('guardar.insumo_laboratorio');


Route::get('/equipo_seguridad_lab', [App\Http\Controllers\EquipoController::class, 'form_equipo_seguridad_lab'])->name('listar.equipo_seguridad_lab');
Route::post('/mant_equipo_seguridad_lab', [App\Http\Controllers\EquipoController::class, 'mant_equipo_seguridad_lab'])->name('mant.equipo_seguridad_lab');

Route::get('/atencion', [App\Http\Controllers\AtencionController::class, 'lista_atencion'])->name('listar.atencion');
Route::get('/mant_atencion', [App\Http\Controllers\AtencionController::class, 'modal_form_atencion'])->name('mant.atencion');
Route::post('/guardar_atencion', [App\Http\Controllers\AtencionController::class, 'store'])->name('guardar.atencion');
Route::post('/borrar_atencion', [App\Http\Controllers\AtencionController::class, 'borrar_atencion'])->name('borrar.atencion');

Route::get('/requerimiento', [App\Http\Controllers\AtencionController::class, 'lista_requerimiento'])->name('listar.requerimiento');
Route::get('/mant_requerimiento', [App\Http\Controllers\AtencionController::class, 'modal_form_requerimiento'])->name('mant.requerimiento');
Route::post('/guardar_requerimiento', [App\Http\Controllers\AtencionController::class, 'guardar_requerimiento'])->name('guardar.requerimiento');
Route::post('/aceptar_requerimiento', [App\Http\Controllers\AtencionController::class, 'aceptar_requerimiento'])->name('aceptar.requerimiento');
Route::post('/borrar_requerimiento', [App\Http\Controllers\AtencionController::class, 'borrar_requerimiento'])->name('borrar.requerimiento');

Route::get('/mant_devolver', [App\Http\Controllers\AtencionController::class, 'modal_form_devolver'])->name('mant.devolver');
Route::post('/guardar_devolucion', [App\Http\Controllers\AtencionController::class, 'guardar_devolucion'])->name('guardar.devolucion');



Route::get('/movimiento', [App\Http\Controllers\MovimientoController::class, 'index'])->name('listar.movimiento');
Route::get('/recepcion', [App\Http\Controllers\AtencionController::class, 'lista_recepcion'])->name('listar.recepcion');
Route::post('/aceptar_recepcion', [App\Http\Controllers\AtencionController::class, 'aceptar_recepcion'])->name('aceptar.recepcion');
Route::get('/mant_recepcion', [App\Http\Controllers\AtencionController::class, 'modal_form_recepcion'])->name('mant.recepcion');
Route::post('/guardar_recepcion', [App\Http\Controllers\AtencionController::class, 'guardar_recepcion'])->name('guardar.recepcion');

/*Ajax*/
Route::get('/ajax/producto_laboratorio_select2', [App\Http\Controllers\EquipoController::class, 'select2_producto_laboratorio'])->name('ajax.producto_laboratorio_select2');
Route::post('/ajax/info_producto', [App\Http\Controllers\EquipoController::class, 'json_info_producto'])->name('ajax.info_producto');
Route::post('/ajax/info_inventario_data', [App\Http\Controllers\EquipoController::class, 'json_info_inventario_data'])->name('ajax.info_inventario_data');


//Mantenimiento
Route::get('/mantenimiento/unidad_medida', [App\Http\Controllers\Mantenimiento\Unidad_medidaController::class, 'index'])->name('listar.unidad_medida');
Route::post('/mantenimiento/guardar_unidad_medida', [App\Http\Controllers\Mantenimiento\Unidad_medidaController::class, 'store'])->name('guardar.unidad_medida');
Route::post('/mantenimiento/borrar_unidad_medida', [App\Http\Controllers\Mantenimiento\Unidad_medidaController::class, 'destroy'])->name('borrar.unidad_medida');

Route::get('/mantenimiento/cargo', [App\Http\Controllers\Mantenimiento\CargoController::class, 'index'])->name('listar.cargo');
Route::post('/mantenimiento/guardar_cargo', [App\Http\Controllers\Mantenimiento\CargoController::class, 'store'])->name('guardar.cargo');
Route::post('/mantenimiento/borrar_cargo', [App\Http\Controllers\Mantenimiento\CargoController::class, 'destroy'])->name('borrar.cargo');

Route::get('/mantenimiento/tipo_doc_equipo', [App\Http\Controllers\Mantenimiento\Tipo_doc_equipoController::class, 'index'])->name('listar.tipo_doc_equipo');
Route::post('/mantenimiento/guardar_tipo_doc_equipo', [App\Http\Controllers\Mantenimiento\Tipo_doc_equipoController::class, 'store'])->name('guardar.tipo_doc_equipo');
Route::post('/mantenimiento/borrar_tipo_doc_equipo', [App\Http\Controllers\Mantenimiento\Tipo_doc_equipoController::class, 'destroy'])->name('borrar.tipo_doc_equipo');

Route::get('/mantenimiento/tipo_doc_especifico', [App\Http\Controllers\Mantenimiento\Tipo_doc_especificoController::class, 'index'])->name('listar.tipo_doc_especifico');
Route::post('/mantenimiento/guardar_tipo_doc_especifico', [App\Http\Controllers\Mantenimiento\Tipo_doc_especificoController::class, 'store'])->name('guardar.tipo_doc_especifico');
Route::post('/mantenimiento/borrar_tipo_doc_especifico', [App\Http\Controllers\Mantenimiento\Tipo_doc_especificoController::class, 'destroy'])->name('borrar.tipo_doc_especifico');

Route::get('/mantenimiento/tipo_documento', [App\Http\Controllers\Mantenimiento\Tipo_documentoController::class, 'index'])->name('listar.tipo_documento');
Route::post('/mantenimiento/guardar_tipo_documento', [App\Http\Controllers\Mantenimiento\Tipo_documentoController::class, 'store'])->name('guardar.tipo_documento');
Route::post('/mantenimiento/borrar_tipo_documento', [App\Http\Controllers\Mantenimiento\Tipo_documentoController::class, 'destroy'])->name('borrar.tipo_documento');

Route::get('/mantenimiento/tipo_equipo', [App\Http\Controllers\Mantenimiento\Tipo_equipoController::class, 'index'])->name('listar.tipo_equipo');
Route::post('/mantenimiento/guardar_tipo_equipo', [App\Http\Controllers\Mantenimiento\Tipo_equipoController::class, 'store'])->name('guardar.tipo_equipo');
Route::post('/mantenimiento/borrar_tipo_equipo', [App\Http\Controllers\Mantenimiento\Tipo_equipoController::class, 'destroy'])->name('borrar.tipo_equipo');

Route::get('/mantenimiento/tipo_laboratorio', [App\Http\Controllers\Mantenimiento\Tipo_laboratorioController::class, 'index'])->name('listar.tipo_laboratorio');
Route::post('/mantenimiento/guardar_tipo_laboratorio', [App\Http\Controllers\Mantenimiento\Tipo_laboratorioController::class, 'store'])->name('guardar.tipo_laboratorio');
Route::post('/mantenimiento/borrar_tipo_laboratorio', [App\Http\Controllers\Mantenimiento\Tipo_laboratorioController::class, 'destroy'])->name('borrar.tipo_laboratorio');

Route::get('/mantenimiento/tipo_personal', [App\Http\Controllers\Mantenimiento\Tipo_personalController::class, 'index'])->name('listar.tipo_personal');
Route::post('/mantenimiento/guardar_tipo_personal', [App\Http\Controllers\Mantenimiento\Tipo_personalController::class, 'store'])->name('guardar.tipo_personal');
Route::post('/mantenimiento/borrar_tipo_personal', [App\Http\Controllers\Mantenimiento\Tipo_personalController::class, 'destroy'])->name('borrar.tipo_personal');

Route::get('/mantenimiento/persona', [App\Http\Controllers\Mantenimiento\PersonaController::class, 'index'])->name('listar.persona');
Route::post('/mantenimiento/guardar_persona', [App\Http\Controllers\Mantenimiento\PersonaController::class, 'store'])->name('guardar.persona');
Route::post('/mantenimiento/borrar_persona', [App\Http\Controllers\Mantenimiento\PersonaController::class, 'destroy'])->name('borrar.persona');

Route::get('/mantenimiento/proveedor', [App\Http\Controllers\Mantenimiento\ProveedorController::class, 'index'])->name('listar.proveedor');
Route::post('/mantenimiento/guardar_proveedor', [App\Http\Controllers\Mantenimiento\ProveedorController::class, 'store'])->name('guardar.proveedor');
Route::post('/mantenimiento/borrar_proveedor', [App\Http\Controllers\Mantenimiento\ProveedorController::class, 'destroy'])->name('borrar.proveedor');

Route::get('/mantenimiento/equipo_seguridad', [App\Http\Controllers\Mantenimiento\Equipo_seguridadController::class, 'index'])->name('listar.equipo_seguridad');
Route::post('/mantenimiento/guardar_equipo_seguridad', [App\Http\Controllers\Mantenimiento\Equipo_seguridadController::class, 'store'])->name('guardar.equipo_seguridad');
Route::post('/mantenimiento/borrar_equipo_seguridad', [App\Http\Controllers\Mantenimiento\Equipo_seguridadController::class, 'destroy'])->name('borrar.equipo_seguridad');

Route::get('/mantenimiento/tipo_fiscalizado', [App\Http\Controllers\Mantenimiento\Tipo_fiscalizadoController::class, 'index'])->name('listar.tipo_fiscalizado');
Route::post('/mantenimiento/guardar_tipo_fiscalizado', [App\Http\Controllers\Mantenimiento\Tipo_fiscalizadoController::class, 'store'])->name('guardar.tipo_fiscalizado');
//Route::post('/mantenimiento/borrar_tipo_fiscalizado', [App\Http\Controllers\Mantenimiento\Tipo_fiscalizadoController::class, 'destroy'])->name('borrar.tipo_fiscalizado');
Route::get('/mantenimiento/tipo_movimiento', [App\Http\Controllers\Mantenimiento\Tipo_movimientoController::class, 'index'])->name('listar.tipo_movimiento');
Route::post('/mantenimiento/guardar_tipo_movimiento', [App\Http\Controllers\Mantenimiento\Tipo_movimientoController::class, 'store'])->name('guardar.tipo_movimiento');

Route::get('/mantenimiento/periodo', [App\Http\Controllers\Mantenimiento\PeriodoController::class, 'index'])->name('listar.periodo');
Route::post('/mantenimiento/guardar_periodo', [App\Http\Controllers\Mantenimiento\PeriodoController::class, 'store'])->name('guardar.periodo');
Route::post('/mantenimiento/borrar_periodo', [App\Http\Controllers\Mantenimiento\PeriodoController::class, 'destroy'])->name('borrar.periodo');

Route::get('/mantenimiento/asignatura', [App\Http\Controllers\Mantenimiento\AsignaturaController::class, 'index'])->name('listar.asignatura');
Route::post('/mantenimiento/guardar_asignatura', [App\Http\Controllers\Mantenimiento\AsignaturaController::class, 'store'])->name('guardar.asignatura');
Route::post('/mantenimiento/borrar_asignatura', [App\Http\Controllers\Mantenimiento\AsignaturaController::class, 'destroy'])->name('borrar.asignatura');


Route::get('/mantenimiento/ubigeo', [App\Http\Controllers\Mantenimiento\UbigeoController::class, 'index'])->name('listar.ubigeo');
Route::post('/mantenimiento/guardar_ubigeo', [App\Http\Controllers\Mantenimiento\UbigeoController::class, 'store'])->name('guardar.ubigeo');
/*Ajax*/
Route::get('/ajax/ubigeo_select2', [App\Http\Controllers\Mantenimiento\UbigeoController::class, 'select2_ubigeo'])->name('ajax.ubigeo_select2');

//facultades
Route::get('/facultades', [App\Http\Controllers\FacultadesController::class, 'index'])->name('listar.facultades');
Route::post('/guardar_facultades', [App\Http\Controllers\FacultadesController::class, 'store'])->name('guardar.facultad');
Route::post('/borrar_facultades', [App\Http\Controllers\FacultadesController::class, 'destroy'])->name('borrar.facultad');
//reportes
Route::get('/reportes', [App\Http\Controllers\ReportesController::class, 'index'])->name('listar.reportes');

/*
// solicitudes
Route::get('/solicitudes', [App\Http\Controllers\SolicitudesController::class, 'index'])->name('listar.solicitudes');
Route::post('/guardar_solicitudes', [App\Http\Controllers\SolicitudesController::class, 'store'])->name('guardar.solicitud');
Route::post('/borrar_solicitud', [App\Http\Controllers\SolicitudesController::class, 'destroy'])->name('borrar.solicitud');
	/* --------- ajax validar num documento ---------- */
//Route::get('/ajax/validar_numdocu', [App\Http\Controllers\SolicitudesController::class, 'validarNumDocumento'])->name('validar.numdocu');


// proyectos
/*Route::get('/proyectos', [App\Http\Controllers\ProyectosController::class, 'index'])->name('listar.proyectos');
Route::post('/guardar_proyecto', [App\Http\Controllers\ProyectosController::class, 'store'])->name('guardar.proyecto');
Route::get('/proyectos/{id}', [App\Http\Controllers\ProyectosController::class, 'actividades'])->name('actividades.proyecto');
*/


// Laboratorios
Route::get('/laboratorios', [App\Http\Controllers\LaboratorioController::class, 'index'])->name('listar.laboratorios');
Route::get('/crear', [App\Http\Controllers\LaboratorioController::class, 'create'])->name('crear.laboratorios');
Route::get('/editar/{id}', [App\Http\Controllers\LaboratorioController::class, 'edit'])->name('editar.laboratorios');
Route::get('/mostrar/{id}', [App\Http\Controllers\LaboratorioController::class, 'show'])->name('show.laboratorios');
Route::get('/guardar', [App\Http\Controllers\LaboratorioController::class, 'store'])->name('guardar.laboratorios');
Route::post('/editar/{id}', [App\Http\Controllers\LaboratorioController::class, 'update'])->name('update.laboratorios');
//Route::post('/borrar_facultades', [App\Http\Controllers\LaboratorioController::class, 'destroy'])->name('borrar.facultad');


//tipo Laboratorio
Route::get('/tipo_laboratorio', [App\Http\Controllers\LaboratorioController::class, 'form_tipo_laboratorio'])->name('lista.tipo_laboratorio');
Route::post('/mant_tipo_laboratorio', [App\Http\Controllers\LaboratorioController::class, 'mant_tipo_laboratorio'])->name('mant.tipo_laboratorio');
Route::post('/borrar_laboratorio', [App\Http\Controllers\LaboratorioController::class, 'destroy'])->name('borrar_laboratorio');



//Info Academica
Route::get('/listado', [App\Http\Controllers\InfoacademicaController::class, 'index'])->name('listado.infoacademica');
Route::get('/mant_academica', [App\Http\Controllers\InfoacademicaController::class, 'modal_form_infoacademica'])->name('mant_academica');
Route::post('/guardar_infoacademica', [App\Http\Controllers\InfoacademicaController::class, 'store'])->name('guardar.infoacademica');
Route::post('/borrar_infoacademica', [App\Http\Controllers\InfoacademicaController::class, 'destroy'])->name('editar.infoacademica');
//Registro de Materiales, Insumos, Equipos Por Investigacion
Route::get('/agre_infoacademica', [App\Http\Controllers\InfoacademicaController::class, 'modal_agre_infoacademica'])->name('agre_infoacademica');
Route::post('/guardar_agre_infoacademica', [App\Http\Controllers\InfoacademicaController::class, 'guardar_agre_infoacademica'])->name('guardar.agre_infoacademica');



//Info Servicios
Route::get('/list_servicio', [App\Http\Controllers\InfoservicioController::class, 'index'])->name('listado.infoservicio');
Route::get('/mant_infoservicio', [App\Http\Controllers\InfoservicioController::class, 'modal_form_infoservicio'])->name('mant_infoservicio');
Route::post('/guardar_infoservicio', [App\Http\Controllers\InfoservicioController::class, 'store'])->name('guardar.infoservicio');
Route::post('/borrar_infoservicio', [App\Http\Controllers\InfoservicioController::class, 'destroy'])->name('borrar_infoservicio');
//Registro de Materiales, Insumos, Equipos Por Servicios
Route::get('/agre_infoservicio', [App\Http\Controllers\InfoservicioController::class, 'modal_agre_infoservicio'])->name('agre_infoservicio');
Route::post('/guardar_agre_infoservicio', [App\Http\Controllers\InfoservicioController::class, 'guardar_agre_infoservicio'])->name('guardar.agre_infoservicio');


//Info Investigacion
Route::get('/list_investigacion', [App\Http\Controllers\InfoinvestigacionController::class, 'index'])->name('listado.investigacion');
Route::get('/mant_infoinvestigacion', [App\Http\Controllers\InfoinvestigacionController::class, 'modal_form_infoinvestigacion'])->name('mant_infoinvestigacion');
Route::post('/guardar_infoinvestigacion', [App\Http\Controllers\InfoinvestigacionController::class, 'store'])->name('guardar.infoinvestigacion');
Route::post('/borrar_infoinvestigacion', [App\Http\Controllers\InfoinvestigacionController::class, 'destroy'])->name('borrar_infoinvestigacion');
//Registro de Materiales, Insumos, Equipos Por Investigacion
Route::get('/agre_infoinvestigacion', [App\Http\Controllers\InfoinvestigacionController::class, 'modal_agre_infoinvestigacion'])->name('agre_infoinvestigacion');
Route::post('/guardar_agre_infoinvestigacion', [App\Http\Controllers\InfoinvestigacionController::class, 'guardar_agre_infoinvestigacion'])->name('guardar.agre_infoinvestigacion');

//Documentos Generales
Route::get('/list_docgeneral', [App\Http\Controllers\DocgeneralController::class, 'index'])->name('listado.docgeneral');
Route::get('/mant_docgeneral', [App\Http\Controllers\DocgeneralController::class, 'modal_form_docgeneral'])->name('mant_docgeneral');
Route::post('/guardar_docgeneral', [App\Http\Controllers\DocgeneralController::class, 'store'])->name('guardar.docgeneral');
Route::post('/borrar_docgeneral', [App\Http\Controllers\DocgeneralController::class, 'destroy'])->name('editar.docgeneral');

//Documentos Especificos
Route::get('/list_docespecifico', [App\Http\Controllers\DocespecificoController::class, 'index'])->name('listado.docespecifico');
Route::get('/mant_docespecifico', [App\Http\Controllers\DocespecificoController::class, 'modal_form_docespecifico'])->name('mant_docespecifico');
Route::post('/guardar_docespecifico', [App\Http\Controllers\DocespecificoController::class, 'store'])->name('guardar.docespecifico');
Route::post('/borrar_docespecifico', [App\Http\Controllers\DocespecificoController::class, 'destroy'])->name('editar.docespecifico');


//Software de Laboratorio
Route::get('/list_software', [App\Http\Controllers\SoftwareController::class, 'index'])->name('listado_software');
Route::get('/mant_software', [App\Http\Controllers\SoftwareController::class, 'modal_form_software'])->name('mant_software');
Route::post('/guardar_software', [App\Http\Controllers\SoftwareController::class, 'store'])->name('guardar_software');
Route::post('/borrar_software', [App\Http\Controllers\SoftwareController::class, 'destroy'])->name('editar_software');


//Componentes de Laboratorio de Computo
Route::get('/list_componentes', [App\Http\Controllers\ComponentesController::class, 'index'])->name('listar.componentes');
Route::get('/mant_componentes', [App\Http\Controllers\ComponentesController::class, 'modal_form_componentes'])->name('mant_componentes');
Route::post('/guardar_componentes', [App\Http\Controllers\ComponentesController::class, 'store'])->name('guardar_componentes');
Route::post('/borrar_componentes', [App\Http\Controllers\ComponentesController::class, 'destroy'])->name('borrar_componentes');



//Documentos Personal Responsable
Route::get('/list_personal', [App\Http\Controllers\PersonalController::class, 'index'])->name('listado.personal');
Route::get('/mant_personal', [App\Http\Controllers\PersonalController::class, 'modal_form_personal'])->name('mant_personal');
Route::post('/guardar_personal', [App\Http\Controllers\PersonalController::class, 'store'])->name('guardar.personal');
Route::post('/borrar_personal', [App\Http\Controllers\PersonalController::class, 'destroy'])->name('editar.personal');



Route::get('/ajax/persona_select2', [App\Http\Controllers\Mantenimiento\PersonaController::class, 'select2_persona'])->name('ajax.persona_select2');
Route::get('/modal/persona', [App\Http\Controllers\Mantenimiento\PersonaController::class, 'modal_form_persona'])->name('mant.persona');


//Reportes PDF
Route::get('/pdf/ficha_entrega', [App\Http\Controllers\Pdf\Ficha_entregaController::class, 'index'])->name('pdf.ficha_entrega');
Route::get('/pdf/requerimiento', [App\Http\Controllers\Pdf\RequerimientoController::class, 'index'])->name('pdf.requerimiento');
Route::get('/pdf/adeudo_material', [App\Http\Controllers\Pdf\Adeudo_materialController::class, 'index'])->name('pdf.adeudo_material');
Route::get('/pdf/calendario', [App\Http\Controllers\Pdf\CalendarioController::class, 'index'])->name('pdf.calendario');
//. Fin reportes pdf

//Reportes Excel
Route::get('/xls/reporte', [App\Http\Controllers\ExcelController::class, 'exportarExcel'])->name('exportarxls');
Route::get('/xls/lista_equipos', [App\Http\Controllers\ExcelController::class, 'lista_equipos'])->name('xls.lista_equipos');