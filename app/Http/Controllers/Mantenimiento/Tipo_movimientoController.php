<?php
namespace App\Http\Controllers\Mantenimiento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tipo_movimiento;
use DB;

class Tipo_movimientoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {      
        $lista = DB::table('tb_tipo_movimiento')
                ->where("tipo_movimiento","LIKE",'%'.$request->tipo_movimiento.'%')
                ->select('*')
                ->orderBy('tipo_movimiento')
                ->Paginate(10)->appends($request->except(['page','_token']));

        return view('mantenimiento.lista_tipo_movimiento',['lista'=>$lista,'databusqueda'=>$request]);
    }

    public function store(Request $request)
    {
        
        if ($request->id!='') {
            $dt=Tipo_movimiento::find($request->id);
            $dt->tipo_movimiento=$request->tipo_movimiento;
           // $dt->id_usuariomod=Auth::id();
            $dt->save();  
        }else{
            $dt=new Tipo_movimiento();
            $dt->tipo_movimiento=$request->tipo_movimiento;
           // $dt->id_usuarioreg=Auth::id();
            $dt->save();            
        }
        return redirect()->route('listar.tipo_movimiento');
    }

    public function destroy(Request $request)
    {
       Tipo_movimiento::findOrFail($request->id)->delete();
       return redirect()->route('listar.tipo_movimiento');
    }

}

