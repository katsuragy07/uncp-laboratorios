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
use App\Models\Componentes_computo; 
use App\Models\UsuarioPermiso;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DB;
use File;
use PDF;

class ComponentesController extends Controller
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
        if($request->equipo_id!=''){
            $where = " and `equipo_id` = '".$request->equipo_id."' ";       
        }
       

        /*$laboratorio_det=DB::table('tb_laboratorio_det AS lt')
       ->join('tb_laboratorio AS l', 'lt.laboratorio_id', '=', 'l.id')
       ->join('tb_tipo_laboratorio AS tl', 'lt.tipolaboratorio_id', '=', 'tl.id')
       ->selectRaw('lt.*, CONCAT(l.nombre_lab," - ",tl.tipo_laboratorio) AS full_name')
       ->get();*/
       
        $lista = DB::table('tb_componentes_computo as cc')
            ->join('tb_equipo AS e', 'cc.equipo_id', '=', 'e.id')
            ->whereRaw("(cc.nom_componente LIKE '%".$request->txtbuscar."%') and cc.status <> 'EL' ".$where)
            ->select('cc.*')
            ->Paginate(10)->appends($request->except(['page','_token']));

       return view('componentes.lista_componentes',['lista'=>$lista,'databusqueda'=>$request]);
    }

    public function modal_form_componentes(Request $request)
    {
      
       
        $dt=Componentes_computo::find($request->id);
        //$horario = Horario::where('info_academica_id', $request->id)->get();

        return view('componentes.modal_form_componentes',['info'=>$dt]);
    }
    
    public function store(Request $request)
    {
        
        if ($request->id!='') {
            $dt=Componentes_computo::find($request->id);
            $dt->equipo_id=$request->equipo_id;
            $dt->nom_componente=$request->nom_componente;
            $dt->marca=$request->marca;
            $dt->capacidad=$request->capacidad;  
            $dt->descripcion=$request->descripcion;  
            $dt->flg_original=$request->flg_original;  

            $dt->id_usuariomod=Auth::id();
            $dt->save(); 
            $info_academica_id=$dt->id;
                // return $dt->id; // id del nuevo registro

        }else{
                $dt=new Componentes_computo();
                $dt->equipo_id=$request->equipo_id;
                $dt->nom_componente=$request->nom_componente;
                $dt->marca=$request->marca;
                $dt->capacidad=$request->capacidad;  
                $dt->descripcion=$request->descripcion;  
                $dt->flg_original=$request->flg_original;  
                $dt->id_usuarioreg=Auth::id();
                $dt->save();  
                         
            } 


    return redirect()->route('listar.componentes');   
           
    }
        
    

   
    public function destroy(Request $request)
    {
        $dt=Componentes_computo::find($request->id);
        $dt->status='EL';
        $dt->id_usuarioelim=Auth::id();
        $dt->motivo_elim=$request->motivo;
        $dt->deleted_at=\Carbon\Carbon::now()->toDateTimeString();
        $dt->save(); 
        return redirect()->route('listar.componentes');
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

