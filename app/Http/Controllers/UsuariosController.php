<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Permisos;
use App\Models\UsuarioPermiso;
use DB;

class UsuariosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
      $users = DB::table('tb_usuario')
            ->join('tb_cargo', 'tb_usuario.id_cargo', '=', 'tb_cargo.id')
            ->select('users.*', 'tb_cargo.cargo')
            ->get();
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $where = '';
        if($request->laboratorio_id!=''){
            $where = " and `laboratorio_id` = '".$request->laboratorio_id."' ";            
        }
        if($request->username!=''){
            $where = " and `username`LIKE '%".$request->username."%' ";            
        }

        $lista = DB::table('tb_usuario')
                ->whereRaw("`sts_usuario` <> 'EL' and `nombre_usuario` LIKE '%".$request->nombre_usuario."%' ".$where)
                ->join('tb_laboratorio', 'tb_usuario.laboratorio_id', '=', 'tb_laboratorio.id')
                ->select('tb_usuario.*', 'tb_laboratorio.nombre_lab')
                // selectRaw('select * ()')
                ->orderBy('tb_usuario.id')
                ->Paginate(10)->appends($request->except(['page','_token']));

        return view('usuarios.lista_usuarios',['listausers'=>$lista,'databusqueda'=>$request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if ($request->id_usuario!='') {
            $dtUsuario=User::find($request->id_usuario);
            $dtUsuario->laboratorio_id=$request->laboratorio_id;
            $dtUsuario->nombre_usuario=$request->nombre_usuario;
            $dtUsuario->email=$request->email;
            $dtUsuario->sts_usuario=$request->sts_usuario;
            $dtUsuario->save();  
        }else{
            $dtUsuario=new User();
            $dtUsuario->laboratorio_id=$request->laboratorio_id;
            $dtUsuario->nombre_usuario=$request->nombre_usuario;
            $dtUsuario->username=$request->username;
            $dtUsuario->email=$request->email;
            $dtUsuario->password=Hash::make($request->clave);
            $dtUsuario->save();            
        }

        return redirect()->route('listar.usuarios');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cambiar_clave(Request $request)
    {
        $dtUsuario=User::find(Auth::id());
        return view('usuarios.cambiar_clave',['info'=>$dtUsuario]);

    }

    public function actualizar_clave(Request $request)
    {        
        if($request->tipo=='editar_cambiarclave'){
            $dtUsuario=User::find($request->id_usuario);
            //$dtUsuario->nombre_usuario=$request->nombre_usuario;
            $dtUsuario->fecha_cambioclave= date('Y-m-d H:i:s');
            $dtUsuario->password=Hash::make($request->clave);
            $dtUsuario->flg_cambiarclave = 1;
            $dtUsuario->save(); 
            return redirect()->route('listar.usuarios');
        }else if($request->password == $request->repet_password){
            $dtUsuario=User::find(Auth::id());
            $dtUsuario->nombre_usuario=$request->nombre_usuario;
            $dtUsuario->fecha_cambioclave= date('Y-m-d H:i:s');
            $dtUsuario->password=Hash::make($request->password);
            $dtUsuario->flg_cambiarclave = 0;
            $dtUsuario->save(); 
            return redirect()->route('home');
        }else{
            $dtUsuario=User::find(Auth::id());
            return view('usuarios.cambiar_clave',['info'=>$dtUsuario,'mensaje'=>'error']);
        }
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $dtUsuario=User::find($request->id_usuario);
        $dtUsuario->sts_usuario='EL';
        $dtUsuario->id_usuarioelim=Auth::id();
        $dtUsuario->motivo_elim=$request->motivo;
        $dtUsuario->deleted_at=\Carbon\Carbon::now()->toDateTimeString();
        $dtUsuario->save(); 
        return redirect()->route('listar.usuarios');
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

