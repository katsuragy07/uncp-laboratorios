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
use App\Models\Doc_general;
use App\Models\UsuarioPermiso;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DB;
use File;
use PDF;

class DocgeneralController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
   
    public function index(Request $request)
    {
        $lista = DB::table('tb_doc_general as dg')
            ->whereRaw("(dg.nombre LIKE '%".$request->txtbuscar."%') and status <> 'EL'")
            ->select('dg.*')
            ->Paginate(10)->appends($request->except(['page','_token']));
       return view('docgeneral.lista_docgeneral',['lista'=>$lista,'databusqueda'=>$request]);
    }

    public function modal_form_docgeneral(Request $request)
    {      
        $dt=Doc_general::find($request->id);
        return view('docgeneral.modal_form_docgeneral',['info'=>$dt]);
    }


    
    public function store(Request $request)
    {
        $url_archivo='';
        if ($request->id!='') {
            $dt=Doc_general::find($request->id);
            $dt->nombre=$request->nombre;  
            if ($request->file('archivo')) {
                $url_archivo='DOCGENERAL_'.Str::random(10).time().Str::random(5).'.pdf';
                $path=public_path().'/files/docgeneral';
                $request->file('archivo')->move($path,$url_archivo);
                $dt->archivo=$url_archivo;  // nombre del archivo
            }
           // $dt->id_usuarioreg=Auth::id();
            $dt->save();  
           
        }else{
                $dt=new Doc_general();
                $dt->nombre=$request->nombre;  
                if ($request->file('archivo')) {
                    $url_archivo='DOCGENERAL_'.Str::random(10).time().Str::random(5).'.pdf';
                    $path=public_path().'/files/docgeneral';
                    $request->file('archivo')->move($path,$url_archivo);
                    $dt->archivo=$url_archivo;  // nombre del archivo
                }
               // $dt->id_usuarioreg=Auth::id();
                $dt->save();  
               
                               
            } 
    return redirect()->route('listado.docgeneral');   
           
    }
        
    

   
    public function destroy(Request $request)
    {
        $dt=Doc_general::find($request->id_delete);
        $dt->status='EL';
        $dt->motivo_elim=$request->motivo;
        $dt->save(); 
        return redirect()->route('listado.docgeneral');
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

