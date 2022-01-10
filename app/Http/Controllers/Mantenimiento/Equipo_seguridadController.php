<?php
namespace App\Http\Controllers\Mantenimiento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Equipo_seguridad;
use DB;

class Equipo_seguridadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {      
        $lista = DB::table('tb_equipo_seguridad')
                ->where("equipo_seguridad","LIKE",'%'.$request->equipo_seguridad.'%')
                ->select('*')
                ->orderBy('equipo_seguridad')
                ->Paginate(10)->appends($request->except(['page','_token']));

        return view('mantenimiento.lista_equipo_seguridad',['lista'=>$lista,'databusqueda'=>$request]);
    }

    public function store(Request $request)
    {
        
        if ($request->id!='') {
            $dt=Equipo_seguridad::find($request->id);
            $dt->equipo_seguridad=$request->equipo_seguridad;
            $dt->tipo=$request->tipo;
            $dt->id_usuariomod=Auth::id();
            $dt->save();  
        }else{
            $dt=new Equipo_seguridad();
            $dt->equipo_seguridad=$request->equipo_seguridad;
            $dt->tipo=$request->tipo;
            $dt->id_usuarioreg=Auth::id();
            $dt->save();            
        }
        return redirect()->route('listar.equipo_seguridad');
    }

    public function destroy(Request $request)
    {
       Equipo_seguridad::findOrFail($request->id)->delete();
       return redirect()->route('listar.equipo_seguridad');
    }

}

