<?php
namespace App\Http\Controllers\Mantenimiento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tipo_equipo;
use DB;

class Tipo_equipoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {      
        $lista = DB::table('tb_tipo_equipo')
                ->where("tipo_equipo","LIKE",'%'.$request->tipo_equipo.'%')
                ->select('*')
                ->orderBy('tipo_equipo')
                ->Paginate(10)->appends($request->except(['page','_token']));

        return view('mantenimiento.lista_tipo_equipo',['lista'=>$lista,'databusqueda'=>$request]);
    }

    public function store(Request $request)
    {
        
        if ($request->id!='') {
            $dt=Tipo_equipo::find($request->id);
            $dt->tipo_equipo=$request->tipo_equipo;
            $dt->id_usuariomod=Auth::id();
            $dt->save();  
        }else{
            $dt=new Tipo_equipo();
            $dt->tipo_equipo=$request->tipo_equipo;
            $dt->id_usuarioreg=Auth::id();
            $dt->save();            
        }
        return redirect()->route('listar.tipo_equipo');
    }

    public function destroy(Request $request)
    {
       Tipo_equipo::findOrFail($request->id)->delete();
       return redirect()->route('listar.tipo_equipo');
    }

}

