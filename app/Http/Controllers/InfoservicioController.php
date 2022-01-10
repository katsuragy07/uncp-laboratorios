<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;    
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Info_servicio;
use App\Models\Laboratorio_det;
use App\Models\Laboratorio;
use App\Models\Actividad_infoservicio;
use App\Models\UsuarioPermiso;
use Illuminate\Support\Str;
use DB;
use File;
use PDF;

class InfoservicioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $where = '';
        if($request->laboratoriodet_id!=''){
            $where = " and `laboratoriodet_id` = '".$request->laboratoriodet_id."' ";            
        }
        if($request->solicitante_id!=''){
            $where = " and `solicitante_id` = '".$request->solicitante_id."' ";       
        }
        if($request->representante_id!=''){
            $where = " and `representante_id` = '".$request->representante_id."' ";       
        }

        $laboratorio_det=DB::table('tb_laboratorio_det AS lt')
       ->join('tb_laboratorio AS l', 'lt.laboratorio_id', '=', 'l.id')
       ->join('tb_tipo_laboratorio AS tl', 'lt.tipolaboratorio_id', '=', 'tl.id')
       ->selectRaw('lt.*, CONCAT(l.nombre_lab," - ",tl.tipo_laboratorio) AS full_name')
       ->get();
       
        $lista = DB::table('tb_info_servicio as iser')
            ->join('tb_persona AS soli', 'iser.solicitante_id', '=', 'soli.id')
            ->join('tb_persona AS rep', 'iser.representante_id', '=', 'rep.id')
            ->join('tb_persona AS pcon', 'iser.personal_contacto_id', '=', 'pcon.id')
            ->whereRaw("(iser.producto LIKE '%".$request->txtbuscar."%') and iser.status <> 'EL' ".$where)
            ->select('iser.*','soli.nombres','soli.apellidos','rep.nombres','rep.apellidos','pcon.nombres','pcon.apellidos')
            ->Paginate(10)->appends($request->except(['page','_token']));

       return view('infoservicio.lista_infoservicio',['listas'=>$lista,'laboratorio_det'=>$laboratorio_det,'databusqueda'=>$request]);
    }

    public function modal_form_infoservicio(Request $request)
    {
        $laboratorio_det=DB::table('tb_laboratorio_det AS ld')
       ->join('tb_laboratorio AS l', 'ld.laboratorio_id', '=', 'l.id')
       ->join('tb_tipo_laboratorio AS tl', 'ld.tipolaboratorio_id', '=', 'tl.id')
       //->join('tb_info_servicio AS iser', 'iser.laboratoriodet_id', '=', 'tl.id')
       ->selectRaw('ld.*, CONCAT(l.nombre_lab," - ",tl.tipo_laboratorio) AS full_name')
       ->get();
       //dd($laboratorio_det);
       
        $dt=Info_servicio::find($request->id);
        return view('infoservicio.modal_form_infoservicio',['info'=>$dt,'laboratorio_det'=>$laboratorio_det]);
    }

    public function modal_agre_infoservicio(Request $request)
    {
        $laboratorio_det=DB::table('tb_laboratorio_det AS ld')
       ->join('tb_laboratorio AS l', 'ld.laboratorio_id', '=', 'l.id')
       ->join('tb_tipo_laboratorio AS tl', 'ld.tipolaboratorio_id', '=', 'tl.id')
       ->selectRaw('ld.*, CONCAT(l.nombre_lab," - ",tl.tipo_laboratorio) AS full_name')
       ->get();
       //dd($laboratorio_det);
       
       $tipo_equipo=DB::table('tb_tipo_equipo AS te')
       ->selectRaw('te.*')
       ->get();
        $dt=Info_servicio::find($request->id);
        $actividad_infoservicio = Actividad_infoservicio::where('info_servicio_id', $request->id)->get();
        return view('infoservicio.modal_agre_infoservicio',['info'=>$dt,'laboratorio_det'=>$laboratorio_det,'actividad_infoservicio'=>$actividad_infoservicio,'tipo_equipo'=>$tipo_equipo]);
    }


    public function guardar_agre_infoservicio(Request $request)
    {
             $info_servicio_id=$request->get('info_servicio_id');
                DB::table('tb_actividad_infoservicio')
                ->where('info_servicio_id', '=', $info_servicio_id)
                ->delete(); 
               
                $tipo_equipo_id=$request->get('tipo_equipo_id');
                $descripcion=$request->get('descripcion'); 
                $cantidad=$request->get('cantidad'); 
                if ($tipo_equipo_id!="") {
                $cont1=0;
                while($cont1 < count($tipo_equipo_id)){
                    $dt=new Actividad_infoservicio();
                    $dt->info_servicio_id=$info_servicio_id;
                    $dt->tipo_equipo_id=$tipo_equipo_id[$cont1];
                    $dt->descripcion=$descripcion[$cont1];
                    $dt->cantidad=$cantidad[$cont1];
                    $dt->save();
                    $cont1=$cont1+1;
            }   
        }
        return redirect()->route('listado.infoservicio'); 
    }

    
    public function store(Request $request)
    {     
        $url_doc_resultado=$request->f_doc_resultado;
 
        if ($request->id!='') {
            $dt=Info_servicio::find($request->id);
                $dt->laboratoriodet_id=$request->laboratoriodet_id;
                $dt->periodo_id=$request->periodo_id;
                $dt->solicitante_id=$request->solicitante_id;
                $dt->representante_id=$request->representante_id;
                $dt->personal_contacto_id=$request->personal_contacto_id;  
                $dt->producto=$request->producto;  
                $dt->servicio_solicitado=$request->servicio_solicitado;
                $dt->marca=$request->marca; 
                $dt->ds_marca=$request->ds_marca;  
                $dt->ie_marca=$request->ie_marca;
                $dt->presentacion=$request->presentacion;
                $dt->cantidad_muestra=$request->cantidad_muestra;
                $dt->cantidad_lote=$request->cantidad_lote;
                $dt->identificacion=$request->identificacion;
                $dt->fecha_produccion=$request->fecha_produccion;
                $dt->ds_fecha_produccion=$request->ds_fecha_produccion;
                $dt->ie_fecha_produccion=$request->ie_fecha_produccion;
                $dt->fecha_vencimiento=$request->fecha_vencimiento; 
                $dt->ds_fecha_vencimiento=$request->ds_fecha_vencimiento; 
                $dt->ie_fecha_vencimiento=$request->ie_fecha_vencimiento; 
                $dt->observacion=$request->observacion; 
                $dt->punto_muestreo=$request->punto_muestreo; 
                $dt->coordenadas=$request->coordenadas; 
                $dt->ubigeo=$request->ubigeo; 
                $dt->lugar=$request->lugar; 
                $dt->fuente_origen=$request->fuente_origen; 
                $dt->persona_muestreo_id=$request->persona_muestreo_id; 
                $dt->fecha_muestreo=$request->fecha_muestreo;
                $dt->hora_muestreo=$request->hora_muestreo;
                $dt->tipo_envase=$request->tipo_envase;
                $dt->conservacion=$request->conservacion;
                $dt->preservacion=$request->preservacion;
                $dt->tipo_muestra=$request->tipo_muestra; 
                $dt->descripcion_servicio=$request->descripcion_servicio;
                $dt->tipo_comprobante_id=$request->tipo_comprobante_id;
                $dt->precio=$request->precio;
            
                if ($request->file('doc_resultado')) {
                    $url_doc_resultado='RESULTADO'.Str::random(10).time().Str::random(5).'.pdf';
                    $path=public_path().'/files/infoservicio';
                    $request->file('doc_resultado')->move($path,$url_doc_resultado);
               }
                    $dt->doc_resultado=$url_doc_resultado;  // nopmbre del archivo
               $dt->responsable_atencion_id=$request->responsable_atencion_id;
                $dt->observacion_resultado=$request->observacion_resultado; 
            $dt->id_usuariomod=Auth::id();
            $dt->save(); 
            

              
        }else{
                $dt=new Info_servicio();
                $dt->laboratoriodet_id=$request->laboratoriodet_id;
                $dt->periodo_id=$request->periodo_id;
                $dt->solicitante_id=$request->solicitante_id;
                $dt->representante_id=$request->representante_id;
                $dt->personal_contacto_id=$request->personal_contacto_id;  
                $dt->producto=$request->producto;  
                $dt->servicio_solicitado=$request->servicio_solicitado;
                $dt->marca=$request->marca;
                $dt->ds_marca=$request->ds_marca;  
                $dt->ie_marca=$request->ie_marca;
                $dt->presentacion=$request->presentacion;
                $dt->cantidad_muestra=$request->cantidad_muestra;
                $dt->cantidad_lote=$request->cantidad_lote;
                $dt->identificacion=$request->identificacion;
                $dt->fecha_produccion=$request->fecha_produccion;
                $dt->ds_fecha_produccion=$request->ds_fecha_produccion;
                $dt->ie_fecha_produccion=$request->ie_fecha_produccion;
                $dt->fecha_vencimiento=$request->fecha_vencimiento; 
                $dt->ds_fecha_vencimiento=$request->ds_fecha_vencimiento; 
                $dt->ie_fecha_vencimiento=$request->ie_fecha_vencimiento; 
                $dt->observacion=$request->observacion; 
                $dt->punto_muestreo=$request->punto_muestreo; 
                $dt->coordenadas=$request->coordenadas; 
                $dt->ubigeo=$request->ubigeo; 
                $dt->lugar=$request->lugar; 
                $dt->fuente_origen=$request->fuente_origen; 
                $dt->persona_muestreo_id=$request->persona_muestreo_id; 
                $dt->fecha_muestreo=$request->fecha_muestreo;
                $dt->hora_muestreo=$request->hora_muestreo;
                $dt->tipo_envase=$request->tipo_envase;
                $dt->conservacion=$request->conservacion;
                $dt->preservacion=$request->preservacion;
                $dt->tipo_muestra=$request->tipo_muestra; 
                $dt->descripcion_servicio=$request->descripcion_servicio;
                $dt->tipo_comprobante_id=$request->tipo_comprobante_id;
                $dt->precio=$request->precio;
              
                if ($request->file('doc_resultado')) {
                    $url_doc_resultado='RESULTADO'.Str::random(10).time().Str::random(5).'.pdf';
                    $path=public_path().'/files/infoservicio';
                    $request->file('doc_resultado')->move($path,$url_doc_resultado);
               }
                    $dt->doc_resultado=$url_doc_resultado;  // nopmbre del archivo
                $dt->responsable_atencion_id=$request->responsable_atencion_id;
                $dt->observacion_resultado=$request->observacion_resultado;

                $dt->id_usuarioreg=Auth::id();
                $dt->save();  
           
               
            }            
             
            return redirect()->route('listado.infoservicio');
    }


    
    public function destroy(Request $request)
    {
        $dtUsuario=Info_servicio::find($request->id);
        $dtUsuario->status='EL';
        $dtUsuario->id_usuarioelim=Auth::id();
        $dtUsuario->motivo_elim=$request->motivo;
        $dtUsuario->deleted_at=\Carbon\Carbon::now()->toDateTimeString();
        $dtUsuario->save(); 
        return redirect()->route('listado.infoservicio');
    }

    public function permisos(Request $request)
    {
        $id_usuario=$request->id_usuario;
        UsuarioPermiso::where('id_usuario',$id_usuario)->delete();
        if (isset($request->permiso)) {
            foreach ($request->permiso as $id_permiso) {
               $dtUsuaPermiso=new UsuarioPermiso();
                $dtUsuaPermiso->id_usuario=$id_usuario;
                $dtUsuaPermiso->id_permiso=$id_permiso;
                $dtUsuaPermiso->id_usuarioreg=Auth::id();
                $dtUsuaPermiso->id_usuariomod=0;
               $dtUsuaPermiso->save();
            }
        }
        return redirect()->route('listar.usuarios');
    }


     //Tipo de Laboratorio
     public function form_tipo_laboratorio(Request $request)
     {
         $where = '';
         if($request->laboratorio_id!=''){
             $where = " and `laboratorio_id` = '".$request->laboratorio_id."' ";            
         }
         /*if($request->marca!=''){
             $where = " and `marca` LIKE '%".$request->marca."%' ";       
         }
         if($request->serie!=''){
             $where = " and `serie` LIKE '%".$request->serie."%' ";            
         }*/
 
         $lista = DB::table('tb_tipo_laboratorio')->get();
         $equipo_lab = DB::table('tb_laboratorio_det')->where('laboratorio_id',$request->laboratorio_id)->get();
         
         if(count($equipo_lab)>0){
             foreach ($equipo_lab as $fila) {
                 $tipo_laboratorio[]=$fila->tiposeguridad_id;                  
             }
         }else{
             $tipo_laboratorio[] = 'Sin_privilegio';
         }
         return view('laboratorio.mant_tipo_laboratorio',['lista'=>$lista,'tipo_laboratorio'=> $tipo_laboratorio,'databusqueda'=>$request]);
     }
 
     public function mant_equipo_seguridad_lab(Request $request)
     {   
 
 
         if ($request->estado==1) {
             $dt=new Equipo_seguridad_lab();
             $dt->equipo_seguridad_id=$request->equipo_seguridad_id;
             $dt->laboratorio_id=$request->laboratorio_id;
             $dt->id_usuarioreg=Auth::id();
             $dt->save(); 
             echo json_encode('Activado');
         }else{
             DB::table('tb_equipo_seguridad_lab')
                 ->where('equipo_seguridad_id', '=', $request->equipo_seguridad_id)
                 ->where('laboratorio_id', '=', $request->laboratorio_id)
                 ->delete(); 
             echo json_encode('Deshabilitado');         
         }
 
     }

    
    public function verpermisos(Request $request)
    {
      if ($request->ajax()) {
            // recibir del ajax
            $id_usuario=$request->get('id_usuario');
            $lista_permisos='';
            // listar todos los permisos
            $permisos=Permisos::all();
            foreach ($permisos as $permiso) {
                // verificar si un permiso está asignado al usuario X
                $permiso_asigando=UsuarioPermiso::where('id_usuario',$id_usuario)
                                    ->where('id_permiso',$permiso->id)->count('id');
                if ($permiso_asigando>0) {
                    $lista_permisos.='
                    <label class="custom-control custom-checkbox" style="cursor: pointer;">
                        <input type="checkbox" class="custom-control-input" name="permiso[]" value="'.$permiso->id.'" checked="">
                        <span class="custom-control-label">'.$permiso->nom_permiso.'</span>
                    </label>'; 
                }else{
                    $lista_permisos.='
                    <label class="custom-control custom-checkbox" style="cursor: pointer;">
                        <input type="checkbox" class="custom-control-input" name="permiso[]" value="'.$permiso->id.'">
                        <span class="custom-control-label">'.$permiso->nom_permiso.'</span>
                    </label>';
                }
            }
            $data=array('permisos' => $lista_permisos);  
            echo json_encode($data);
        }
    }

}

