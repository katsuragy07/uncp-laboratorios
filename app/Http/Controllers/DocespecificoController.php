<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Info_academica;
use App\Models\Laboratorio_det;
use App\Models\Laboratorio;
use App\Models\Doc_especifico;
use App\Models\UsuarioPermiso;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DB;
use File;
use PDF;

class DocespecificoController extends Controller
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
        if($request->tipo_documento_id!=''){
            $where = " and `tipo_documento_id` = '".$request->tipo_documento_id."' ";       
        }
        

        $laboratorio_det=DB::table('tb_laboratorio_det AS lt')
       ->join('tb_laboratorio AS l', 'lt.laboratorio_id', '=', 'l.id')
       ->join('tb_tipo_laboratorio AS tl', 'lt.tipolaboratorio_id', '=', 'tl.id')
       ->selectRaw('lt.*, CONCAT(l.nombre_lab," - ",tl.tipo_laboratorio) AS full_name')
       ->get();
       
        $lista = DB::table('tb_doc_especifico as de')
            ->join('tb_laboratorio_det AS ld', 'de.laboratoriodet_id', '=', 'ld.id')
            ->join('tb_tipo_doc_especifico AS te', 'de.tipo_documento_id', '=', 'te.id')
            ->whereRaw("(de.nombre LIKE '%".$request->txtbuscar."%') and de.status <> 'EL' ".$where)
            ->select('de.*','te.tipo_doc_especifico')
            ->Paginate(10)->appends($request->except(['page','_token']));

       return view('docespecifico.lista_docespecifico',['lista'=>$lista,'laboratorio_det'=>$laboratorio_det,'databusqueda'=>$request]);
    }

    public function modal_form_docespecifico(Request $request)
    {
        $laboratorio_det=DB::table('tb_laboratorio_det AS ld')
       ->join('tb_laboratorio AS l', 'ld.laboratorio_id', '=', 'l.id')
       ->join('tb_tipo_laboratorio AS tl', 'ld.tipolaboratorio_id', '=', 'tl.id')
       ->selectRaw('ld.*, CONCAT(l.nombre_lab," - ",tl.tipo_laboratorio) AS full_name')
       ->get();
       //dd($laboratorio_det);
       
        $dt=Doc_especifico::find($request->id);

        return view('docespecifico.modal_form_docespecifico',['info'=>$dt,'laboratorio_det'=>$laboratorio_det]);
    }


    
    public function store(Request $request)
    {
        $url_archivo='';
        if ($request->id!='') {
            $dt=Doc_especifico::find($request->id);
                $dt->laboratoriodet_id=$request->laboratoriodet_id;
                $dt->tipo_documento_id=$request->tipo_documento_id; 
                $dt->nombre=$request->nombre;  
                if ($request->file('archivo')) {
                    $url_archivo='DOCESPECIFICO_'.Str::random(10).time().Str::random(5).'.pdf';
                    $path=public_path().'/files/docespecifico';
                    $request->file('archivo')->move($path,$url_archivo);

                    $dt->archivo=$url_archivo;  // nombre del archivo
                }
            $dt->id_usuariomod=Auth::id();
            $dt->save(); 
           
        }else{
                $dt=new Doc_especifico();
                $dt->laboratoriodet_id=$request->laboratoriodet_id;
                $dt->tipo_documento_id=$request->tipo_documento_id; 
                $dt->nombre=$request->nombre;  
                if ($request->file('archivo')) {
                    $url_archivo='DOCESPECIFICO_'.Str::random(10).time().Str::random(5).'.pdf';
                    $path=public_path().'/files/docespecifico';
                    $request->file('archivo')->move($path,$url_archivo);

                    $dt->archivo=$url_archivo;  // nombre del archivo
                }
            $dt->id_usuariomod=Auth::id();
            $dt->save();       
            } 
    return redirect()->route('listado.docespecifico');   
           
    }
        
    

   
    public function destroy(Request $request)
    {
        $dt=Doc_especifico::find($request->id_eliminar);
        $dt->status='EL';
        $dt->id_usuarioelim=Auth::id();
        $dt->motivo_elim=$request->motivo;
        $dt->deleted_at=\Carbon\Carbon::now()->toDateTimeString();
        $dt->save(); 
        return redirect()->route('listado.docespecifico');
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

