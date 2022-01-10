<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Personal;
use App\Models\Persona;
use App\Models\Laboratorio_det;
use App\Models\Laboratorio;
use App\Models\Horario;
use App\Models\UsuarioPermiso;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DB;
use File;
use PDF;

class PersonalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
   
    public function index(Request $request)
    {
        $where = '';
        if($request->laboratorio_id!=''){
            $where = " and `laboratorio_id` = '".$request->laboratorio_id."' ";            
        }
        if($request->asignatura_id!=''){
            $where = " and `responsable_id` = '".$request->asignatura_id."' ";       
        }
        if($request->docente_id!=''){
            $where = " and `responsable_id` = '".$request->docente_id."' ";       
        }

        $laboratorio_det=DB::table('tb_laboratorio_det AS lt')
       ->join('tb_laboratorio AS l', 'lt.laboratorio_id', '=', 'l.id')
       ->join('tb_tipo_laboratorio AS tl', 'lt.tipolaboratorio_id', '=', 'tl.id')
       ->selectRaw('lt.*, CONCAT(l.nombre_lab," - ",tl.tipo_laboratorio) AS full_name')
       ->get();
       
        $lista = DB::table('tb_personal as pl')
            ->join('tb_persona AS p', 'pl.persona_id', '=', 'p.id')
            ->join('tb_laboratorio AS l', 'pl.laboratorio_id', '=', 'l.id')
            ->join('tb_tipopersonal AS tp', 'pl.tipopersonal_id', '=', 'tp.id')
            ->join('tb_cargo AS c', 'pl.cargo_id', '=', 'c.id')
            ->whereRaw("(pl.especialidad LIKE '%".$request->txtbuscar."%') and pl.status <> 'EL' ".$where)
            ->select('pl.*','p.nombres','p.apellidos','l.nombre_lab')
            ->Paginate(10)->appends($request->except(['page','_token']));

       return view('personal.lista_personal',['lista'=>$lista,'laboratorio_det'=>$laboratorio_det,'databusqueda'=>$request]);
    }

    public function modal_form_personal(Request $request)
    {
        $laboratorio_det=DB::table('tb_laboratorio_det AS ld')
       ->join('tb_laboratorio AS l', 'ld.laboratorio_id', '=', 'l.id')
       ->join('tb_tipo_laboratorio AS tl', 'ld.tipolaboratorio_id', '=', 'tl.id')
       ->selectRaw('ld.*, CONCAT(l.nombre_lab," - ",tl.tipo_laboratorio) AS full_name')
       ->get();
       //dd($laboratorio_det);
       
        $dt=Personal::find($request->id);
       
        return view('personal.modal_form_personal',['info'=>$dt,'laboratorio_det'=>$laboratorio_det]);
    }


    
    public function store(Request $request)
    {
        
        if ($request->id!='') {
            $dt=Personal::find($request->id);
            $dt->persona_id=$request->persona_id;
            $dt->laboratorio_id=$request->laboratorio_id;
            $dt->tipopersonal_id=$request->tipopersonal_id;
            $dt->cargo_id=$request->cargo_id;  
            $dt->fch_ingreso=$request->fch_ingreso;  
            $dt->fch_cese=$request->fch_cese;  
            $dt->especialidad=$request->especialidad;  

            if ($request->file('hoja_vida')) {
                $url_hoja_vida='HV_'.Str::random(10).time().Str::random(5).'.pdf';
                $path=public_path().'/files/personal';
                $request->file('hoja_vida')->move($path,$url_hoja_vida);

                $dt->hoja_vida=$url_hoja_vida;  // nombre del archivo
        
            }else{
                $dt->hoja_vida=$request->f_hoja_vida;
            }

            if ($request->file('resolucion')) {
                $url_resolucion='RESOL_'.Str::random(10).time().Str::random(5).'.pdf';
                $path=public_path().'/files/personal';
                $request->file('resolucion')->move($path,$url_resolucion);
                $dt->resolucion=$url_resolucion;  // nopmbre del archivo
           }else{
                $dt->resolucion=$request->f_resolucion;

           }

            $dt->id_usuariomod=Auth::id();
            $dt->save(); 

                // return $dt->id; // id del nuevo registro

               
        }else{
                $dt=new Personal();
                $dt->persona_id=$request->persona_id;
                $dt->laboratorio_id=$request->laboratorio_id;
                $dt->tipopersonal_id=$request->tipopersonal_id;
                $dt->cargo_id=$request->cargo_id;  
                $dt->fch_ingreso=$request->fch_ingreso;  
                $dt->fch_cese=$request->fch_cese;  
                $dt->especialidad=$request->especialidad;  
 
                if ($request->file('hoja_vida')) {
                    $url_hoja_vida='HV_'.Str::random(10).time().Str::random(5).'.pdf';
                    $path=public_path().'/files/personal';
                    $request->file('hoja_vida')->move($path,$url_hoja_vida);

                    $dt->hoja_vida=$url_hoja_vida;  // nombre del archivo
	        
                }

                if ($request->file('resolucion')) {
                    $url_resolucion='RESOL_'.Str::random(10).time().Str::random(5).'.pdf';
                    $path=public_path().'/files/personal';
                    $request->file('resolucion')->move($path,$url_resolucion);
                    $dt->resolucion=$url_resolucion;  // nopmbre del archivo
               }
                $dt->id_usuarioreg=Auth::id();
                $dt->save();  
                // return $dt->id; // id del nuevo registro

                              
            } 
    return redirect()->route('listado.personal');   
           
    }
        
    

   
    public function destroy(Request $request)
    {
     //   var_dump($request->id_fila);
        $dt=Personal::find($request->id_fila);
        $dt->status='EL';
        $dt->id_usuarioelim=Auth::id();
        $dt->motivo_elim=$request->motivo;
        $dt->deleted_at=\Carbon\Carbon::now()->toDateTimeString();
        $dt->save(); 
        return redirect()->route('listado.personal');
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

