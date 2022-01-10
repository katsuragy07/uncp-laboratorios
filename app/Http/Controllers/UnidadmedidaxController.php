<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Unidad_medida;

use DB;

class UnidadmedidaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
      
        $lista = DB::table('tb_unidad_medida')
                ->where("unidad_medida","=",$request->unidad_medida)
                ->select('*')
                ->orderBy('unidad_medida')
                ->Paginate(10)->appends($request->except(['page','_token']));

        return view('mantenimiento.lista_unidad_medida',['lista'=>$lista,'databusqueda'=>$request]);
    }

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

}

