<?php
namespace App\Http\Controllers\Mantenimiento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Unidad_medida;
use DB;

class Unidad_medidaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {      
        $lista = DB::table('tb_unidad_medida')
                ->where("unidad_medida","LIKE",'%'.$request->unidad_medida.'%')
                ->select('*')
                ->orderBy('unidad_medida')
                ->Paginate(10)->appends($request->except(['page','_token']));

        return view('mantenimiento.lista_unidad_medida',['lista'=>$lista,'databusqueda'=>$request]);
    }

    public function store(Request $request)
    {
        
        if ($request->id!='') {
            $dt=Unidad_medida::find($request->id);
            $dt->unidad_medida=$request->unidad_medida;
            $dt->id_usuariomod=Auth::id();
            $dt->save();  
        }else{
            $dt=new Unidad_medida();
            $dt->unidad_medida=$request->unidad_medida;
            $dt->id_usuarioreg=Auth::id();
            $dt->save();            
        }
        return redirect()->route('listar.unidad_medida');
    }

    public function destroy(Request $request)
    {
       Unidad_medida::findOrFail($request->id)->delete();
       return redirect()->route('listar.unidad_medida');
    }

}

