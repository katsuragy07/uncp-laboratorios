<?php
namespace App\Http\Controllers\Mantenimiento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Movimiento;
use DB;

class MovimientoController extends Controller
{

    public function index(Request $request)
    {      
        $lista = DB::table('tb_movimiento')
                ->where("movimiento","LIKE",'%'.$request->movimiento.'%')
                ->select('*')
                ->orderBy('movimiento')
                ->Paginate(10)->appends($request->except(['page','_token']));

        return view('mantenimiento.lista_movimiento',['lista'=>$lista,'databusqueda'=>$request]);
    }

    public function store(Request $request)
    {
        
        if ($request->id!='') {
            $dt=Movimiento::find($request->id);
            $dt->movimiento=$request->movimiento;
            $dt->id_usuariomod=Auth::id();
            $dt->save();  
        }else{
            $dt=new Movimiento();
            $dt->movimiento=$request->movimiento;
            $dt->id_usuarioreg=Auth::id();
            $dt->save();            
        }
        return redirect()->route('listar.movimiento');
    }

    public function destroy(Request $request)
    {
       Movimiento::findOrFail($request->id)->delete();
       return redirect()->route('listar.movimiento');
    }

}

