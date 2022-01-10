<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Info_academica;
use App\Models\Laboratorio_det;
use App\Models\Laboratorio;
use App\Models\Horario;
use App\Models\Programa;
use App\Models\Actividad_infoacademica;
use App\Models\UsuarioPermiso;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DB;
use File;
use PDF;

class infoacademicaController extends Controller
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
        if($request->asignatura_id!=''){
            $where = " and `asignatura_id` = '".$request->asignatura_id."' ";       
        }
        if($request->docente_id!=''){
            $where = " and `docente_id` = '".$request->docente_id."' ";       
        }

        $laboratorio_det=DB::table('tb_laboratorio_det AS lt')
       ->join('tb_laboratorio AS l', 'lt.laboratorio_id', '=', 'l.id')
       ->join('tb_tipo_laboratorio AS tl', 'lt.tipolaboratorio_id', '=', 'tl.id')
       ->selectRaw('lt.*, CONCAT(l.nombre_lab," - ",tl.tipo_laboratorio) AS full_name')
       ->get();
       
        $lista = DB::table('tb_info_academica as ia')
            ->join('tb_asignatura AS a', 'ia.asignatura_id', '=', 'a.id')
            ->join('tb_persona AS p', 'ia.docente_id', '=', 'p.id')
            ->join('tb_laboratorio_det AS ld', 'ia.laboratoriodet_id', '=', 'ld.id')
            ->join('tb_laboratorio AS l', 'ld.laboratorio_id', '=', 'l.id')
            ->whereRaw("(ia.hra_academica LIKE '%".$request->txtbuscar."%') and ia.status <> 'EL' ".$where)
            ->select('ia.*','a.nom_asignatura','p.nombres','p.apellidos','l.nombre_lab')
            ->Paginate(10)->appends($request->except(['page','_token']));

       return view('infoacademica.lista_infoacademica',['listainfoacademica'=>$lista,'laboratorio_det'=>$laboratorio_det,'databusqueda'=>$request]);
    }

    public function modal_form_infoacademica(Request $request)
    {
        $laboratorio_det=DB::table('tb_laboratorio_det AS ld')
       ->join('tb_laboratorio AS l', 'ld.laboratorio_id', '=', 'l.id')
       ->join('tb_tipo_laboratorio AS tl', 'ld.tipolaboratorio_id', '=', 'tl.id')
       ->selectRaw('ld.*, CONCAT(l.nombre_lab," - ",tl.tipo_laboratorio) AS full_name')
       ->get();
       //dd($laboratorio_det);
       
        $dt=Info_academica::find($request->id);
        $horario = Horario::where('info_academica_id', $request->id)->get();
        $programa = Programa::where('info_academica_id', $request->id)->get();
        return view('infoacademica.modal_form_infoacademica',['info'=>$dt,'laboratorio_det'=>$laboratorio_det,'horario'=>$horario,'programa'=>$programa]);
    }

    public function modal_agre_infoacademica(Request $request)
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

        $dt=Info_academica::find($request->id);
        $actividad_infoacademica = Actividad_infoacademica::where('info_academica_id', $request->id)->get();
        return view('infoacademica.modal_agre_infoacademica',['info'=>$dt,'laboratorio_det'=>$laboratorio_det,'actividad_infoacademica'=>$actividad_infoacademica,'tipo_equipo'=>$tipo_equipo]);
    }


    
    public function store(Request $request)
    {
        $url_calendario_uso=$request->f_calendario_uso;
        $url_guia_manual=$request->f_guia_manual;


        if ($request->id!='') {
            $dt=Info_academica::find($request->id);
                $dt->laboratoriodet_id=$request->laboratoriodet_id;
                $dt->periodo_id=$request->periodo_id;
                $dt->docente_id=$request->docente_id;
                $dt->asignatura_id=$request->asignatura_id;
                $dt->hra_academica=$request->hra_academica;    
                $dt->aforo=$request->aforo;
                $dt->fecha_inicio=$request->fecha_inicio;  
                $dt->fecha_fin=$request->fecha_fin;  
                if ($request->file('calendario_uso')) {
                    $url_calendario_uso='CALENDARIO_'.$request->asignatura_id.'_'.Str::random(10).time().Str::random(5).'.pdf';
                    $path=public_path().'/files/infoacademica';
                    $request->file('calendario_uso')->move($path,$url_calendario_uso);                           
                }
                $dt->calendario_uso=$url_calendario_uso;  // nombre del archivo  

                if ($request->file('guia_manual')) {
                    $url_guia_manual='Manual_'.Str::random(10).time().Str::random(5).'.pdf';
                    $path=public_path().'/files/infoacademica';
                    $request->file('guia_manual')->move($path,$url_guia_manual);                    
               }
               $dt->guia_manual=$url_guia_manual;  // nopmbre del archivo

            $dt->id_usuariomod=Auth::id();
            $dt->save(); 
            $info_academica_id=$dt->id;
                // return $dt->id; // id del nuevo registro

                //Horario
                 DB::table('tb_horario')
                ->where('info_academica_id', '=', $info_academica_id)
                ->delete(); 


                $dia_semana=$request->get('dia_semana');
                $hora=$request->get('hora');
                $hora_fin=$request->get('hora_fin');
                if ($dia_semana!="") {
                    $cont=0;
                    while($cont < count($dia_semana)){
                        $horario=new Horario();
                        $horario->info_academica_id=$info_academica_id;
                        $horario->dia_semana=$dia_semana[$cont];
                        $horario->hora=$hora[$cont];
                        $horario->hora_fin=$hora_fin[$cont];
                        $horario->save();
                        $cont=$cont+1;
                    }   
                } 
                
                 //Programa
                DB::table('tb_programa')
                ->where('info_academica_id', '=', $info_academica_id)
                ->delete(); 
                
            $nom_programa=$request->get('nom_programa');
            $cod_programa=$request->get('cod_programa'); 
            if ($nom_programa!="") {
            $cont1=0;
            while($cont1 < count($nom_programa)){
                $programa=new Programa();
                $programa->info_academica_id=$info_academica_id;
                $programa->nom_programa=$nom_programa[$cont1];
                $programa->cod_programa=$cod_programa[$cont1];
                $programa->save();
                $cont1=$cont1+1;
            }   
        }

        }else{
                $dt=new Info_academica();
                $dt->laboratoriodet_id=$request->laboratoriodet_id;
                $dt->periodo_id=$request->periodo_id;
                $dt->docente_id=$request->docente_id;
                $dt->asignatura_id=$request->asignatura_id;
                $dt->hra_academica=$request->hra_academica;
                $dt->aforo=$request->aforo;  
                $dt->fecha_inicio=$request->fecha_inicio;  
                $dt->fecha_fin=$request->fecha_fin;  
                if ($request->file('calendario_uso')) {
                    $url_calendario_uso='CALENDARIO_'.$request->asignatura_id.'_'.Str::random(10).time().Str::random(5).'.pdf';
                    $path=public_path().'/files/infoacademica';
                    $request->file('calendario_uso')->move($path,$url_calendario_uso);

                    $dt->calendario_uso=$url_calendario_uso;  // nombre del archivo
	        
                }

                if ($request->file('guia_manual')) {
                    $url_guia_manual='Manual_'.Str::random(10).time().Str::random(5).'.pdf';
                    $path=public_path().'/files/infoacademica';
                    $request->file('guia_manual')->move($path,$url_guia_manual);
                    $dt->guia_manual=$url_guia_manual;  // nopmbre del archivo
               }
                $dt->id_usuarioreg=Auth::id();
                $dt->save();  
                $info_academica_id=$dt->id;
                // return $dt->id; // id del nuevo registro

                //Horario
                $dia_semana=$request->get('dia_semana');
                $hora=$request->get('hora'); 
                $hora_fin=$request->get('hora_fin');
                if ($dia_semana!="") {
                $cont=0;
                while($cont < count($dia_semana)){
                    $horario=new Horario();
                    $horario->info_academica_id=$info_academica_id;
                    $horario->dia_semana=$dia_semana[$cont];
                    $horario->hora=$hora[$cont];
                    $horario->hora_fin=$hora_fin[$cont];
                    $horario->save();
                    $cont=$cont+1;
                }   
            } 

            //Programa
            $nom_programa=$request->get('nom_programa');
            $cod_programa=$request->get('cod_programa'); 
            if ($nom_programa!="") {
            $cont1=0;
            while($cont1 < count($nom_programa)){
                $programa=new Programa();
                $programa->info_academica_id=$info_academica_id;
                $programa->nom_programa=$nom_programa[$cont1];
                $programa->cod_programa=$cod_programa[$cont1];
                $programa->save();
                $cont1=$cont1+1;
            }   
        }

            
        } 
    return redirect()->route('listado.infoacademica');   
           
    }
        
    public function guardar_agre_infoacademica(Request $request)
    {
             $info_academica_id=$request->get('info_academica_id');
                DB::table('tb_actividad_infoacademica')
                ->where('info_academica_id', '=', $info_academica_id)
                ->delete(); 
               
                $tipo_equipo_id=$request->get('tipo_equipo_id');
                $descripcion=$request->get('descripcion'); 
                $cantidad=$request->get('cantidad'); 
                if ($tipo_equipo_id!="") {
                $cont1=0;
                while($cont1 < count($tipo_equipo_id)){
                    $dt=new Actividad_infoacademica();
                    $dt->info_academica_id=$info_academica_id;
                    $dt->tipo_equipo_id=$tipo_equipo_id[$cont1];
                    $dt->descripcion=$descripcion[$cont1];
                    $dt->cantidad=$cantidad[$cont1];
                    $dt->save();
                    $cont1=$cont1+1;
            }   
        }
           
            
        
            return redirect()->route('listado.infoacademica'); 
    }


   
    public function destroy(Request $request)
    {
        $dt=Info_academica::find($request->id_infoacademica);
        $dt->status='EL';
        $dt->id_usuarioelim=Auth::id();
        $dt->motivo_elim=$request->motivo;
        $dt->deleted_at=\Carbon\Carbon::now()->toDateTimeString();
        $dt->save(); 
        return redirect()->route('listado.infoacademica');
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

