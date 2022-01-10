<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Info_academica;
use App\Models\Laboratorio_det;
use App\Models\Laboratorio;
use App\Models\Software;
use App\Models\UsuarioPermiso;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DB;
use File;
use PDF;

class SoftwareController extends Controller
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
      
       
        $lista = DB::table('tb_software as s')
            ->join('tb_laboratorio AS l', 's.laboratorio_id', '=', 'l.id')
            ->whereRaw("(s.nom_software LIKE '%".$request->txtbuscar."%') and s.status <> 'EL' ".$where)
            ->select('s.*','l.nombre_lab')
            ->Paginate(10)->appends($request->except(['page','_token']));

       return view('software.lista_software',['lista'=>$lista,'databusqueda'=>$request]);
    }

    public function modal_form_software(Request $request)
    {
          
        $dt=Software::find($request->id);
        //$horario = Horario::where('info_academica_id', $request->id)->get();

        return view('software.modal_form_software',['info'=>$dt]);
    }


    
    public function store(Request $request)
    {
        
        if ($request->id!='') {
            $dt=Software::find($request->id);
            $dt->laboratorio_id=$request->laboratorio_id;
                $dt->nom_software=$request->nom_software;
                $dt->version=$request->version;
                $dt->compatibilidad_so=$request->compatibilidad_so;  
                $dt->anio_adquisicion=$request->anio_adquisicion;  
                $dt->fch_ini_vigencia=$request->fch_ini_vigencia; 
                $dt->fch_fin_vigencia=$request->fch_fin_vigencia;  
                $dt->cant_maquina=$request->cant_maquina;  
                $dt->personal_capacitado=$request->personal_capacitado;  

                if ($request->file('carta_garantia')) {
                    $url_carta_garantia='CARTA_'.Str::random(10).time().Str::random(5).'.pdf';
                    $path=public_path().'/files/software';
                    $request->file('carta_garantia')->move($path,$url_carta_garantia);

                    $dt->carta_garantia=$url_carta_garantia;  // nombre del archivo
	        
                }else{
                    $dt->carta_garantia=$request->f_carta_garantia;
                }

                if ($request->file('manual_usuario')) {
                    $url_manual_usuario='Manual_'.Str::random(10).time().Str::random(5).'.pdf';
                    $path=public_path().'/files/software';
                    $request->file('manual_usuario')->move($path,$url_manual_usuario);
                    $dt->manual_usuario=$url_manual_usuario;  // nopmbre del archivo
               }else{
                    $dt->manual_usuario=$request->f_manual_usuario;
                }

            $dt->id_usuariomod=Auth::id();
            $dt->save(); 
            
                 
        }else{
                $dt=new Software();
                $dt->laboratorio_id=$request->laboratorio_id;
                $dt->nom_software=$request->nom_software;
                $dt->version=$request->version;
                $dt->compatibilidad_so=$request->compatibilidad_so;  
                $dt->anio_adquisicion=$request->anio_adquisicion;  
                $dt->fch_ini_vigencia=$request->fch_ini_vigencia; 
                $dt->fch_fin_vigencia=$request->fch_fin_vigencia;  
                $dt->cant_maquina=$request->cant_maquina;  
                $dt->personal_capacitado=$request->personal_capacitado;  

                if ($request->file('carta_garantia')) {
                    $url_carta_garantia='CARTA_'.Str::random(10).time().Str::random(5).'.pdf';
                    $path=public_path().'/files/software';
                    $request->file('carta_garantia')->move($path,$url_carta_garantia);

                    $dt->carta_garantia=$url_carta_garantia;  // nombre del archivo
	        
                }

                if ($request->file('manual_usuario')) {
                    $url_manual_usuario='Manual_'.Str::random(10).time().Str::random(5).'.pdf';
                    $path=public_path().'/files/software';
                    $request->file('manual_usuario')->move($path,$url_manual_usuario);
                    $dt->manual_usuario=$url_manual_usuario;  // nopmbre del archivo
               }
                $dt->id_usuarioreg=Auth::id();
                $dt->save();  
                            
            } 
    return redirect()->route('listado_software');   
           
    }
        
    

   
    public function destroy(Request $request)
    {
        $dt=Software::find($request->id);
        $dt->status='EL';
        $dt->id_usuarioelim=Auth::id();
        $dt->motivo_elim=$request->motivo;
        $dt->deleted_at=\Carbon\Carbon::now()->toDateTimeString();
        $dt->save(); 
        return redirect()->route('listado_software');
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

